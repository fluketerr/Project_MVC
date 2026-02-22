<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $uploaded_files = [];
    $allow_type = ['image/jpeg', 'image/png', 'image/webp'];

    $start_date = str_replace('T', ' ', $_POST['start_date']);
    $end_date   = str_replace('T', ' ', $_POST['end_date']);

    $event = [
        'name' => $_POST['event_name'],
        'detail' => $_POST['event_detail'],
        'capacity' => (int)$_POST['event_capacity'],
        'start' => $start_date,
        'end' => $end_date,
        'create_uid' => 1
    ];

    $conn = getConnection();
    $conn->begin_transaction();

    try {
        $eventId = insertEvent($event, $conn);

        if ($eventId !== false) {

            $upload_dir = UPLOADS_DIR . '/events/';

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            foreach ($_FILES['event_picture']['name'] as $index => $file_nameOg) {

                if ($_FILES['event_picture']['error'][$index] === 0) {

                    if (!in_array($_FILES['event_picture']['type'][$index], $allow_type)) {
                        $_SESSION['error'] = 'Invalid file type';
                        throw new Exception("Invalid file type");
                    }

                    $file_name  = uniqid() . '_' . basename($file_nameOg);
                    $file_tmp   = $_FILES['event_picture']['tmp_name'][$index];
                    $target_path = $upload_dir . $file_name;

                    if (!move_uploaded_file($file_tmp, $target_path)) {
                        $_SESSION['error'] = 'Upload picture failed';
                        throw new Exception("Upload picture failed");
                    }

                    $uploaded_files[] = $target_path;

                    if (!insertPicture($file_name, $eventId, $conn)) {
                        $_SESSION['error'] = 'Insert picture failed';
                        throw new Exception("Insert picture failed");
                    }
                }
            }

            $conn->commit();
            $_SESSION['message'] = 'เพิ่มกิจกรรมสำเร็จ';
            header("Location: /events");
            exit;
        }
    } catch (Exception $e) {
        $conn->rollback();

        foreach ($uploaded_files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
        header("Location: /events");
        exit;
    }
} else {
    renderView('create_event', ['title' => 'Create Event']);
}
