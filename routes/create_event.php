<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $start_date = str_replace('T', ' ', $_POST['start_date']);
    $end_date   = str_replace('T', ' ', $_POST['end_date']);

    $fileName = time() . '_' . basename($_FILES['event_picture']['name']);

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

            $uploadDir = UPLOADS_DIR . '/events/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['event_picture']['tmp_name'], $targetPath)) {

                if (insertPicture($fileName, $eventId, $conn) != false) {
                    $conn->commit();
                    header("Location: /events");
                    exit;
                }
            }
        }
        $conn->rollback();
        if (isset($targetPath) && file_exists($targetPath)) {
            unlink($targetPath);
        }
    } catch (Exception $e) {
        $conn->rollback();
        if (isset($targetPath) && file_exists($targetPath)) {
            unlink($targetPath);
        }
    }
}else{
    renderView('create_event', ['title' => 'Create Event']);
}
