<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = getConnection();

    $eid = isset($_POST['eid']) ? (int)$_POST['eid'] : 0;

    if ($eid <= 0) {
        $_SESSION['message'] = "Invalid Event ID";
        header("Location: /events");
        exit;
    }

    $start_date = str_replace('T', ' ', $_POST['start_date']);
    $end_date   = str_replace('T', ' ', $_POST['end_date']);

    $event = [
        'eid'      => $eid,
        'name'     => trim($_POST['event_name']),
        'detail'   => trim($_POST['event_detail']),
        'capacity' => (int)$_POST['event_capacity'],
        'start'    => $start_date,
        'end'      => $end_date,
        'status'   => $_POST['event_status'] ?? 'open'
    ];

    $conn->begin_transaction();

    try {

        $filesToDelete = [];

        // 1️⃣ update event
        if (!updateEvent($event, $conn)) {
            throw new Exception("Update event failed");
        }

        // 2️⃣ ลบรูปที่ติ๊ก
        if (!empty($_POST['delete_pictures'])) {

            foreach ($_POST['delete_pictures'] as $pid) {

                $pid = (int)$pid;
                $picture = getPictureByPid($pid, $conn);
                if ($picture) {
                    $filePath = UPLOADS_DIR . '/events/' . $picture['picture_name'];
                    if (!deletePictureByPid($pid, $conn)) {
                        throw new Exception("Delete picture failed");
                    }
                    $filesToDelete[] = $filePath;
                }
            }
        }

        // 3️⃣ เพิ่มรูปใหม่
        if (!empty($_FILES['new_pictures']['name'][0])) {

            foreach ($_FILES['new_pictures']['name'] as $key => $name) {

                if ($_FILES['new_pictures']['error'][$key] !== 0) {
                    throw new Exception("Upload error");
                }

                $fileName = time() . '_' . basename($name);
                $tmp = $_FILES['new_pictures']['tmp_name'][$key];

                $targetPath = UPLOADS_DIR . '/events/' . $fileName;

                if (!move_uploaded_file($tmp, $targetPath)) {
                    throw new Exception("Move file failed");
                }

                if (!insertPicture($fileName, $eid, $conn)) {
                    throw new Exception("Insert picture failed");
                }
            }
        }

        $conn->commit();

        foreach ($filesToDelete as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
        $_SESSION['message'] = "Update success";

        header("Location: /events");
        exit;
    } catch (Exception $e) {

        $conn->rollback();
        $_SESSION['message'] = "Update failed";
        header("Location: /manage_event?eid=" . $eid);
        exit;
    }
} else {
    header("Location: /events");
    exit;
}
