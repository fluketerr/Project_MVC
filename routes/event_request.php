<?php
$eid = $_SESSION['eid'] ?? null;

if (isset($_SESSION['eid'])) {
    $conn = getConnection();
    $regis = getPendingRegisByEventId($eid, $conn);
    renderView('event_request', ['title' => 'Request to event', 'regis' => $regis]);
} else {
    header("Location: /events");
    exit();
}
