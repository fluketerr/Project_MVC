<?php
function getPictureById(int $eid,$conn):mysqli_result | bool
{
    $sql = 'select * from pictures where eid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i',$eid);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function insertPicture(string $picture_name, string $eid,$conn):bool
{
    $sql = 'insert into Pictures (picture_name, eid) VALUES (?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si',$picture_name, $eid);
    $stmt->execute();
    if($stmt->affected_rows > 0){
        return true;
    }else{
        return false;
    }
}

function deletePictureById(int $id, $conn): bool
{
    $sql = 'delete from pictures where eid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}