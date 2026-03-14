<?php

$eid = $_GET['eid'] ?? 0;
$urOwner = isOwnerEvent($eid,(int)$_SESSION['user_id']);

if (!$urOwner) {
    header("Location: /events");
    exit();
}

$conn = getConnection();
$keyword = $_GET['keyword'] ?? '';
$result = getApprovedParticipantsByEventId($eid, $conn, $keyword);

$participants = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $participants[] = $row;
    }
}

$maleCount = 0;
$femaleCount = 0;
$otherCount = 0;
$checkedCount = 0;

foreach ($participants as $p) {
    $genderRaw = $p['gender'] ?? '';
    $gender = strtolower(trim($genderRaw));

    if (in_array($gender, ['male', 'ชาย', 'm'])) {
        $maleCount++;

    } elseif (in_array($gender, ['female', 'หญิง', 'f'])) {
        $femaleCount++;

    } elseif (in_array($gender, ['other', 'อื่นๆ', 'o'])) {
        $otherCount++;
    }

    if (!empty($p['checkin_time'])) {
        $checkedCount++;
    }
}
$totalParticipants = count($participants);

$ageBuckets = []; // เก็บจำนวนในแต่ละช่วง

foreach ($participants as $p) {
    if (empty($p['birthday'])) continue;

    $birth = new DateTime($p['birthday']);
    $today = new DateTime();
    $age = $today->diff($birth)->y;

    //  กำหนดขนาดช่วง (5 ปีต่อช่วง)
    if($age >= 60) {
        $rangeKey = "60+";
    } else {
        $start = floor($age / 5) * 5;
        $end = $start + 4;
        $rangeKey = "{$start}-{$end}";
    }

    if (!isset($ageBuckets[$rangeKey])) {
        $ageBuckets[$rangeKey] = 0;
    }
    $ageBuckets[$rangeKey]++;
}

if (!empty($ageBuckets)) {
    arsort($ageBuckets);
    $topAgeRange = array_key_first($ageBuckets);
    $topAgeCount = $ageBuckets[$topAgeRange];
}

renderView('event_join', [
    'title' => 'ผู้เข้าร่วม',
    'participants' => $participants,
    'maleCount' => $maleCount,
    'femaleCount' => $femaleCount,
    'otherCount' => $otherCount,
    'totalParticipants' => $totalParticipants,
    'ageBuckets' => $ageBuckets,
    'checkedCount' => $checkedCount
]);
