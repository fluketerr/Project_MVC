<?php
$eid = $_GET['eid'] ?? '';
$_SESSION['eid'] = $eid;
if($_SERVER['REQUEST_METHOD'] == 'GET' && $eid != ''){
    header('Location: /event_manage');
    exit();
}else{
    header('Location: /events');
    exit();
}