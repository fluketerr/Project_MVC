<?php
function getPendingRegisByEventId(int $eid, mysqli $conn): mysqli_result|bool
{
    $sql = "SELECT r.rid, r.status,
                   u.uid, u.name, u.email, u.birthday,
                   u.tel, u.job, u.gender, u.address
            FROM registrations r
            JOIN users u ON r.uid = u.uid
            WHERE r.eid = ? AND r.status = 'wait'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $eid);
    $stmt->execute();

    return $stmt->get_result();
}

function getMyEvents($user_id, $status = '')
{
    global $conn;

    $sql = "SELECT e.*, r.status
            FROM Registrations r
            JOIN Events e ON r.eid = e.eid
            WHERE r.uid = '$user_id'";

     if ($status != '') {
        $sql .= " AND r.status = '$status'";
    }

    return $conn->query($sql);
}

function updateEvent(array $event, mysqli $conn): bool
{
    $sql = "UPDATE Events 
            SET event_name = ?, 
                event_detail = ?, 
                start_date = ?, 
                end_date = ?, 
                event_capacity = ?, 
                event_status = ?
            WHERE eid = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        'ssssisi',
        $event['name'],
        $event['detail'],
        $event['start'],
        $event['end'],
        $event['capacity'],
        $event['status'],
        $event['eid']
    );

    $stmt->execute();

    return $stmt->affected_rows >= 0;
}

function cancelEvent(int $uid, int $eid): bool
{
    $conn = getConnection();

    $sql = "DELETE FROM Registrations
            WHERE uid = ? AND eid = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $uid, $eid);

    return $stmt->execute();
}

//----------------------------------------

function generateOTP($uid, $eid) {
    $secret = "MySecretKey2026";
    $timeWindow = floor(time() / 10);

    $data = $uid . $eid . $timeWindow . $secret;
    $hash = hash('sha256', $data);

    return str_pad(abs(crc32($hash)) % 1000000, 6, '0', STR_PAD_LEFT);
}

function getUserRegisById(string $eid,string $uid) : mysqli_result|bool
{
    global $conn;
    $sql = 'select * from registrations where uid = ? and eid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $uid,$eid);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

// update status
function updateRegistrationStatus(int $rid, string $status, mysqli $conn): bool
{
    $sql = "UPDATE registrations SET status = ? WHERE rid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $status, $rid);
    return $stmt->execute();
}

function getApprovedParticipantsByEventId(int $eid, mysqli $conn, string $keyword = ''): mysqli_result|bool
{
    if ($keyword !== '') {
        $sql = "SELECT 
                    r.rid,
                    r.checkin_time,
                    u.name,
                    u.email,
                    u.tel,
                    u.gender
                FROM registrations r
                JOIN users u ON r.uid = u.uid
                WHERE r.eid = ?
                AND r.status = 'approved'
                AND (u.name LIKE ? OR u.email LIKE ? OR u.tel LIKE ?)";

        $stmt = $conn->prepare($sql);
        $like = "%{$keyword}%";
        $stmt->bind_param("isss", $eid, $like, $like, $like);

    } else {
        $sql = "SELECT 
                    r.rid,
                    r.checkin_time,
                    u.name,
                    u.email,
                    u.tel,
                    u.gender
                FROM registrations r
                JOIN users u ON r.uid = u.uid
                WHERE r.eid = ?
                AND r.status = 'approved'";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $eid);
    }

    $stmt->execute();
    return $stmt->get_result();

}
