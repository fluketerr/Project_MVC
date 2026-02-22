<?php
$eid = $_SESSION['eid'] ?? '';
$event = getEvetById((int)$eid);
if($eid != ''){
    renderView('manage_event', ['title' => 'Manage your event', 'event' => $event]);
}else{
    $_SESSION['message'] = 'หา eid ไม่เจอ';
    header('Location: /events');
    exit();
}