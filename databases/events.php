<?php

function getEvents(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = "select e.*,
               (
                   SELECT picture_name
                   FROM Pictures p
                   WHERE p.eid = e.eid
                   LIMIT 1
               ) AS cover_image,
               (
                   SELECT COUNT(*)
                   FROM Registrations r
                   WHERE r.eid = e.eid
                   AND r.status = 'approved'
               ) AS approved_count from events e
           where e.event_status != 'Closed'";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function getNotinEvents(int $uid): mysqli_result|bool
{
    $conn = getConnection();

    $sql = "
        SELECT e.*,
               (
                   SELECT picture_name
                   FROM Pictures p
                   WHERE p.eid = e.eid
                   LIMIT 1
               ) AS cover_image,
               (
                   SELECT COUNT(*)
                   FROM Registrations r
                   WHERE r.eid = e.eid
                   AND r.status = 'approved'
               ) AS approved_count
        FROM Events e
        WHERE e.eid NOT IN (
                SELECT eid
                FROM Registrations
                WHERE uid = ?
        )
        AND e.create_uid != ?
        and e.event_status != 'Closed'
        ORDER BY e.eid DESC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $uid, $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

function getEventById(int $eid): mysqli_result|bool
{
    global $conn;
    $sql = "select e.*,
               (    SELECT COUNT(*)
                   FROM Registrations r
                   WHERE r.eid = e.eid
                   AND r.status = 'approved'
               ) AS approved_count 
            from events e where eid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $eid);
    $stmt->execute();
    $result = $stmt->get_result();
    $conn->close();

    return $result;
}

function getEventByCreateUid(int $uid)
{
    $conn = getConnection();

    $sql = "
        SELECT e.*,
               (
                   SELECT picture_name
                   FROM Pictures p
                   WHERE p.eid = e.eid
                   LIMIT 1
               ) AS cover_image,
               (
                   SELECT COUNT(*)
                   FROM Registrations r
                   WHERE r.eid = e.eid
                   AND r.status = 'approved'
               ) AS approved_count
        FROM Events e
        WHERE e.create_uid = ?
        ORDER BY e.eid DESC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    $conn->close();

    return $result; 
}

function insertEvent($event, $conn): int | bool
{
    $str = 'Open';
    $sql = 'insert into Events (event_name, event_detail, start_date, end_date, event_capacity, event_status, create_uid) 
    VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'ssssiss',
        $event['name'],
        $event['detail'],
        $event['start'],
        $event['end'],
        $event['capacity'],
        $str,
        $event['create_uid']
    );

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $eid = $stmt->insert_id;
        return $eid;
    } else {
        return false;
    }
}

function deleteEventById(int $id, $conn): bool
{
    $sql = 'delete from Events where eid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}
function searchEvents($keyword, $start, $end, $uid)
{
    global $conn;

    $sql = "";

    if ($keyword != '' && $uid != "") {
        $keyword = strtolower($keyword);
        $sql = "
                SELECT e.*,
               (
                   SELECT picture_name
                   FROM Pictures p
                   WHERE p.eid = e.eid
                   LIMIT 1
               ) AS cover_image,
               (
                   SELECT COUNT(*)
                   FROM Registrations r
                   WHERE r.eid = e.eid
                   AND r.status = 'approved'
               ) AS approved_count
                FROM Events e
                WHERE e.create_uid != ?
                AND e.eid NOT IN (
                SELECT eid
                FROM registrations
                WHERE uid = ?
                                )
                AND LOWER(e.event_name) LIKE '%$keyword%' 
                and e.event_status != 'Closed'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $uid, $uid);
        $stmt->execute();
        return $stmt->get_result();
    }

  if ($start != '' && $end != '') {

        $sql = "
            SELECT e.*,
               (
                   SELECT picture_name
                   FROM Pictures p
                   WHERE p.eid = e.eid
                   LIMIT 1
               ) AS cover_image,
               (
                   SELECT COUNT(*)
                   FROM Registrations r
                   WHERE r.eid = e.eid
                   AND r.status = 'approved'
               ) AS approved_count 
                FROM Events e
                WHERE start_date >= ?
                AND end_date <= ?
                and e.create_uid != ?
                and e.event_status != 'Closed'
                AND e.eid NOT IN (
                SELECT eid
                FROM registrations
                WHERE uid = ?
                                )
                
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $start, $end, $uid, $uid);
        $stmt->execute();
        return $stmt->get_result();
    }

    
    if ($start != '') {

        $sql = "
            SELECT e.*,
               (
                   SELECT picture_name
                   FROM Pictures p
                   WHERE p.eid = e.eid
                   LIMIT 1
               ) AS cover_image,
               (
                   SELECT COUNT(*)
                   FROM Registrations r
                   WHERE r.eid = e.eid
                   AND r.status = 'approved'
               ) AS approved_count 
                FROM Events e
                WHERE start_date >= ?
                and e.create_uid != ?
                and e.event_status != 'Closed'
                AND e.eid NOT IN (
                SELECT eid
                FROM registrations
                WHERE uid = ?
                                )
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $start, $uid, $uid);
        $stmt->execute();
        return $stmt->get_result();
    }

    
    if ($end != '') {

        $sql = "
            SELECT e.*,
               (
                   SELECT picture_name
                   FROM Pictures p
                   WHERE p.eid = e.eid
                   LIMIT 1
               ) AS cover_image,
               (
                   SELECT COUNT(*)
                   FROM Registrations r
                   WHERE r.eid = e.eid
                   AND r.status = 'approved'
               ) AS approved_count
                 FROM Events e
                WHERE end_date <= ?
                and e.create_uid != ?
                and e.event_status != 'Closed'
                AND e.eid NOT IN (
                SELECT eid
                FROM registrations
                WHERE uid = ?
                                )
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $end, $uid, $uid);
        $stmt->execute();
        return $stmt->get_result();
    }



    return $conn->query($sql);
}

function searchEventsPublic($keyword, $start, $end)
{
    global $conn;

    $sql = "
        SELECT e.*,
               (
                   SELECT picture_name
                   FROM Pictures p
                   WHERE p.eid = e.eid
                   LIMIT 1
               ) AS cover_image,
               (
                   SELECT COUNT(*)
                   FROM Registrations r
                   WHERE r.eid = e.eid
                   AND r.status = 'approved'
               ) AS approved_count
        FROM Events e
        WHERE 1=1
        and e.event_status != 'Closed'
    ";

    if ($keyword != '') {
        $keyword = strtolower($keyword);
        $sql .= " AND LOWER(e.event_name) LIKE '%$keyword%' ";
    }

    if ($start != '' && $end != '') {
        $sql .= " AND e.start_date >= '$start'
                  AND e.end_date <= '$end' ";
    }

    $result = $conn->query($sql);
    $conn->close();

    return $result;
}

function joinEvent($user_id, $event_id)
{
    global $conn;

    $sql = "INSERT INTO Registrations (uid, eid, status)
            VALUES ('$user_id', '$event_id', 'wait')";

    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function countCapacity($eid)
{
    global $conn;

    $sql = "select e.*,
                    COALESCE((select count(uid) 
                    from   registrations
                    where  eid = ?), 0) as count_uid
            from  events e
            where eid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $eid, $eid);
    $stmt->execute();
    return $stmt->get_result()->fetch_object();
}

function autoCloseEvent()
{
    $conn = getConnection();

    $sql = "
        UPDATE events
        SET event_status = 
            CASE
                WHEN end_date < NOW() THEN 'Closed'
                ELSE 'Open'
            END
    ";

    $conn->query($sql);
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
    $result = $stmt->affected_rows >= 0;
    $conn->close();

    return $result;
}
