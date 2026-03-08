<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $rid = (int)$_POST['rid'];
    $eid = $_SESSION['eid'];

    $conn = getConnection();

    $result = getApprovedParticipantsByEventId($eid, $conn);
    $approvedCount = $result->num_rows;

    $event = getEventById((int)$eid)->fetch_object();
    $maxParticipants = $event->event_capacity;

    if ($approvedCount >= $maxParticipants) {

        $_SESSION['message'] = "จำนวนผู้เข้าร่วมเต็มแล้ว";

    } else {

        updateRegistrationStatus($rid, 'approved', $conn);
        $_SESSION['message'] = "อนุมัติเรียบร้อย";
    }
}

header("Location: /event_request");
exit();
?>