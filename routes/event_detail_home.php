<?php

$conn = getConnection();
$eid = $_SESSION['eid'] ?? '';

$user_id = $_SESSION['user_id'] ?? null;

/* ---------------------- JOIN ---------------------- */
autoCloseEvent();

if (isset($_POST['join'])) {

    if (!$user_id) {
        header("Location: /login");
        exit();
    }

    $event_id = $_POST['event_id'];
    $event = getEventById($event_id)->fetch_object();
    $countCapacity = countCapacity((int)$event_id);

    if ($event->event_status === 'Open' && $countCapacity->count_uid < $countCapacity->event_capacity) {
        joinEvent($user_id, $event_id);
    }

    header("Location: /home");
    exit();
}

/* ---------------------- EVENT DETAIL ---------------------- */

if ($eid != '') {

    $pictures = getPictureById((int)$eid, $conn);
    $event = getEventById((int)$eid)->fetch_object();

    unset($_SESSION['eid']);

    renderView('event_detail_home', [
        'title' => 'Event Detail',
        'event' => $event,
        'pictures' => $pictures
    ]);

} else {

    $_SESSION['message'] = 'หา eid ไม่เจอ';
    header('Location: /home');
    exit();

}