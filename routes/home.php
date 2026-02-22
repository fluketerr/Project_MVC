<?php

if (isset($_POST['join'])) {

    $event_id = $_POST['event_id'];
    $user_id = 1;

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
    $result = getNotinEvets(1);   
}

renderView('home', [
    'title' => 'Welcome to Home Page',
    'result' => $result
]);
