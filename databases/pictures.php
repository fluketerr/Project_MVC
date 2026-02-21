<?php
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