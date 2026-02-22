<?php
$result = [];
$result = getEvets();
unset($_SESSION['eid']);

renderView('events', ['title' => 'All events', 'result' => $result]);
