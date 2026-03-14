<?php
$eid = $_GET['eid'] ?? 0 ;
$urOwner= isOwnerEvent($eid,(int)$_SESSION['user_id']);

if ($urOwner) {
    $conn = getConnection();
    $regis = getPendingRegisByEventId($eid, $conn);
    renderView('event_request', ['title' => 'คำขอเข้าร่วม', 'regis' => $regis]);
} else {
    header("Location: /events");
    exit();
}
