<?php

function getEvents(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = "select * from events";
    $result = $conn->query($sql);
    
    return $result;
}

function getNotinEvets(int $uid): mysqli_result|bool
{
    $conn = getConnection();

    $sql = "
        SELECT e.*,
               (
                   SELECT picture_name
                   FROM Pictures p
                   WHERE p.eid = e.eid
                   LIMIT 1
               ) AS cover_image
        FROM Events e
        WHERE e.eid NOT IN (
                SELECT eid
                FROM Registrations
                WHERE uid = ?
        )
        AND e.create_uid != ?
        ORDER BY e.eid DESC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $uid, $uid);
    $stmt->execute();

    return $stmt->get_result();
}

function getEvetById(int $eid): mysqli_result|bool
{
    global $conn;
    $sql = "select * from events where eid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i',$eid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result;
}

function getEvetByCreateUid(int $uid)
{
    $conn = getConnection();

    $sql = "
        SELECT e.*,
               (
                   SELECT picture_name
                   FROM Pictures p
                   WHERE p.eid = e.eid
                   LIMIT 1
               ) AS cover_image
        FROM Events e
        WHERE e.create_uid = ?
        ORDER BY e.eid DESC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $uid);
    $stmt->execute();

    return $stmt->get_result();
}

function insertEvent($event, $conn):int | bool
{
    $sql = 'insert into Events (event_name, event_detail, start_date, end_date, event_capacity, create_uid) 
    VALUES (?, ?, ?, ?, ?,?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'ssssis',
        $event['name'], 
        $event['detail'], 
        $event['start'],$event['end'],
        $event['capacity'],
        $event['create_uid']);

    $stmt->execute();
    
    if($stmt->affected_rows > 0){
        $eid = $stmt->insert_id;
        return $eid;
    }else{
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
function searchEvents($keyword, $start, $end)
{
    global $conn;

    $sql = "SELECT * FROM Events WHERE 1";

    if ($keyword != '') {
        $keyword = strtolower($keyword);
        $sql .= " AND LOWER(event_name) LIKE '%$keyword%'";
    }

    if ($start != '' && $end != '') {
        $sql .= " AND start_date >= '$start'
                  AND end_date <= '$end'";
    }

    return $conn->query($sql);
}
function joinEvent($user_id, $event_id)
{
    global $conn;

    $sql = "INSERT INTO Registrations (uid, eid, status)
            VALUES ('$user_id', '$event_id', 'wait')";

    return $conn->query($sql);
}

