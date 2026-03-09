<?php
$eid = $_SESSION['eid'];
$conn = getConnection();
$regis = getPendingRegisByEventId($eid,$conn);
if(isset($_SESSION['eid'])){
    renderView('event_request', ['title' => 'Request to event', 'regis' => $regis]);
}else{
    header("Location: /events");
    exit();
}