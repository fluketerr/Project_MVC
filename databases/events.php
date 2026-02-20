<?php

function getEvets(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = "select * from events";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}