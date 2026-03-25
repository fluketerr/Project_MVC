<?php
$conn = getConnection();
$uid = (int)$_SESSION['user_id'] ?? '';
$eid = $_GET['eid'];
$urOwner = isOwnerEvent((int)$eid, (int)$uid);

if ($urOwner) {
    $pictures = getPictureById((int)$eid, $conn);
    $event = getEventById((int)$eid);
    renderView('event_manage', ['title' => 'กิจกรรม', 'event' => $event, 'pictures' => $pictures]);
} else {
    $_SESSION['message'] = 'หา eid ไม่เจอ';
    header('Location: /events');
    exit();
}
