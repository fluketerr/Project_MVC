<?php
$conn = getConnection();
$eid = $_SESSION['eid'] ?? '';
$event = getEventById((int)$eid);
$pictures = getPictureById((int)$eid,$conn);
if($eid != ''){
    renderView('event_manage', ['title' => 'Manage your event', 'event' => $event, 'pictures' => $pictures]);
}else{
    $_SESSION['message'] = 'หา eid ไม่เจอ';
    header('Location: /events');
    exit();
}