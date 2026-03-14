<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cancel'])) {

        $event_id = $_POST['event_id'];
        $user_id = $_SESSION['user_id'] ?? null;   // หรือ $_SESSION['uid']

        cancelEvent($user_id, $event_id);

        header("Location: /events_my");
        exit();
    }
}

$user_id = $_SESSION['user_id'] ?? null;
$eid = $_SESSION['eid'] ?? null;
$status = $_GET['status'] ?? '';
$result = getEventById($eid);

if ($eid != '') {

    $conn = getConnection();
    $pictures = getPictureById((int)$eid, $conn);
    $event = getEventRegisById((int)$eid, (int)$user_id)->fetch_object();

    renderView('event_detail_my', [
        'title' => 'Event Detail My',
        'result' => $event,
        'pictures' => $pictures
    ]);
    $conn->close();
} else {

    $_SESSION['message'] = 'หา eid ไม่เจอ';
    header('Location: /home');
    exit();
}
