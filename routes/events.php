<?php
$result = [];
$result = getEventByCreateUid($_SESSION['user_id']);
unset($_SESSION['eid']);

renderView('events', ['title' => 'All events', 'result' => $result]);
