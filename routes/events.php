<?php
$result = [];
$result = getEvets();

renderView('events', ['title' => 'All events', 'result' => $result]);
