<?php
$eid = $_GET['eid'] ?? '';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $eid != '') {

    $conn = getConnection();
    $conn->begin_transaction();

    try {
        $pictures = getPictureById($eid, $conn);

        $filePaths = [];

        while ($row = $pictures->fetch_object()) {
            $filePaths[] = UPLOADS_DIR . '/events/' . $row->picture_name;
        }

        if (!deletePictureById($eid, $conn)) {
            $_SESSION['message'] = 'ลบรูปไมสำเร็จ';
            throw new Exception("Delete picture fail");
        }
        if (!deleteEventById($eid, $conn)) {
            $_SESSION['message'] = 'ลบกิจกรรมไมสำเร็จ';
            throw new Exception("Delete event fail");
        }
        $conn->commit();

        foreach ($filePaths as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }

        header("Location: /events");
        exit();
    } catch (Exception $e) {
        $conn->rollback();

        header("Location: /events");
        exit;
    }
} else {
    renderView('events', ['title' => 'All event']);
}
