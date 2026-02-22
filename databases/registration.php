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