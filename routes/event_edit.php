<?php
$eid = $_SESSION['eid'] ?? null;
$eid = $_GET['eid'] ?? null;
$urOwner = isOwnerEvent($eid,(int)$_SESSION['user_id']);

if ($urOwner) {
    $event = getEventById($eid);
    $conn = getConnection();

    $eventResult = getEventById($eid);
    $picturesResult = getPictureById($eid, $conn);

    renderView('event_edit', [
        'title' => 'แก้ไขกิจกรรม',
        'event' => $eventResult,
        'pictures' => $picturesResult
    ]);
}else{
    header("Location: /events");
    exit();
}
