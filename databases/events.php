<?php

function getEvets(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = "select * from events";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
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
