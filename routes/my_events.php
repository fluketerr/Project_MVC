<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    if (isset($_POST['cancel'])) {

        $event_id = $_POST['event_id'];
        $user_id = $_SESSION['user_id'] ?? null;   // หรือ $_SESSION['uid']

        cancelEvent($user_id, $event_id);

        header("Location: /my_events");
        exit();
    }
}



$user_id = $_SESSION['user_id'] ?? null;
$status = $_GET['status'] ?? '';
$result = getMyEvents($user_id, $status);


renderView('my_events', [
    'result' => $result,
]);