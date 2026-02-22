<?php

$user_id = 1;
$status = $_GET['status'] ?? '';

$result = getMyEvents($user_id, $status);

renderView('my_events', [
    'title' => 'กิจกรรมของฉัน',
    'result' => $result
]);