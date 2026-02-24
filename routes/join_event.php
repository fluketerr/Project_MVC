<?php
require_once __DIR__ . '/../databases/registration.php';

if (!isset($_SESSION['eid'])) {
    header("Location: /events");
    exit();
}

$eid = (int)$_SESSION['eid'];
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
$checkedCount = 0;

foreach ($participants as $p) {
    $gender = $p['gender'] ?? '';

    if ($gender === 'male' || $gender === 'ชาย') {
        $maleCount++;
    } elseif ($gender === 'female' || $gender === 'หญิง') {
        $femaleCount++;
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
    $start = floor($age / 5) * 5;
    $end = $start + 4;
    $rangeKey = "{$start}-{$end}";

    if (!isset($ageBuckets[$rangeKey])) {
        $ageBuckets[$rangeKey] = 0;
    }
    $ageBuckets[$rangeKey]++;
}

$topAgeRange = '-';
$topAgeCount = 0;

if (!empty($ageBuckets)) {
    arsort($ageBuckets);
    $topAgeRange = array_key_first($ageBuckets);
    $topAgeCount = $ageBuckets[$topAgeRange];
}

renderView('join_event', [
    'title' => 'Participants',
    'participants' => $participants,
    'maleCount' => $maleCount,
    'femaleCount' => $femaleCount,
    'totalParticipants' => $totalParticipants,
    'topAgeRange' => $topAgeRange,
    'topAgeCount' => $topAgeCount,
    'checkedCount' => $checkedCount
]);
