<?php
$eid = $_SESSION['eid'] ?? null;

if (isset($_SESSION['eid'])) {
    $event = getEventById($eid);
    $conn = getConnection();

    $eventResult = getEventById($eid);
    $picturesResult = getPictureById($eid, $conn);

    renderView('event_edit', [
        'title' => 'Edit Event',
        'event' => $eventResult,
        'pictures' => $picturesResult
    ]);
}else{
    header("Location: /events");
    exit();
}
