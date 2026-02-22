<?php

if (isset($_POST['join'])) {

    $event_id = $_POST['event_id'];
    $user_id = $_SESSION['user_id'] ?? null;

    joinEvent($user_id, $event_id);

    header("Location: /home");
    exit();
}
// ประมวลผลก่อนแสดงผลหน้า
unset($_SESSION['eid']);

$keyword = $_GET['keyword'] ?? '';
$start   = $_GET['start'] ?? '';
$end     = $_GET['end'] ?? '';

if ($keyword != '' || ($start != '' && $end != '')) {
    $result = searchEvents($keyword, $start, $end);
} else {
    $user_id = $_SESSION['user_id'] ?? null;
    $result = getNotinEvets((int)$user_id);   
}

renderView('home', [
    'title' => 'Welcome to Home Page',
    'result' => $result
]);
if (isset($_POST['join'])) {

    $event_id = $_POST['event_id'];
    $user_id = $_SESSION['user_id'] ?? null;

    joinEvent($user_id, $event_id);

    header("Location: /home");
    exit();
}
