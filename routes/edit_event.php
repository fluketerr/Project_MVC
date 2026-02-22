<?php
$eid = $_SESSION['eid'];
$event = getEvetById($eid);
$conn = getConnection();

$eventResult = getEvetById($eid);
$picturesResult = getPictureById($eid, $conn);

renderView('edit_event', [
    'title' => 'Edit Event',
    'event' => $eventResult,
    'pictures' => $picturesResult
]);
