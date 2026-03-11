<?php
$conn = getConnection();
$eid = $_SESSION['eid'] ?? '';
$pictures = getPictureById((int)$eid,$conn);
$event = getEventById((int)$eid);

if($eid != ''){
    renderView('event_manage', ['title' => 'Manage your event', 'event' => $event, 'pictures' => $pictures]);
}else{
    $_SESSION['message'] = 'หา eid ไม่เจอ';
    header('Location: /events');
    exit();
}