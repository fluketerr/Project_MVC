<?php

unset($_SESSION['eid']);

$keyword = $_GET['keyword'] ?? '';
$start   = $_GET['start'] ?? '';
$end     = $_GET['end'] ?? '';
$user_id = $_SESSION['user_id'] ?? null;

/* ---------------------- JOIN (ต้องมาก่อน render) ---------------------- */
if (isset($_POST['join'])) {

    if (!$user_id) {
        header("Location: /login");
        exit();
    }

    $event_id = $_POST['event_id'];
    $countCapacity = countCapacity($event_id);

    if ($countCapacity->count_uid < $countCapacity->event_capacity) {
        joinEvent($user_id, $event_id);
    }

    header("Location: /home");
    exit();
}

/* ---------------------- SEARCH / DEFAULT ---------------------- */

if ($keyword != '' || $start != '' || $end != '') {

    if ($user_id) {
        $result = searchEvents($keyword, $start, $end, $user_id);
    } else {
        $result = searchEventsPublic($keyword, $start, $end);
    }

} else {

    if ($user_id) {
        $result = getNotinEvets($user_id);
    } else {
        $result = getEvents();   // public default
    }

}

/* ---------------------- RENDER ---------------------- */

renderView('home', [
    'title' => 'Welcome to Home Page',
    'result' => $result
]);
