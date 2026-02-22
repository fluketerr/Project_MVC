<?php
$eid = $_GET['eid'] ?? '';
$_SESSION['eid'] = $eid;
if($_SERVER['REQUEST_METHOD'] == 'GET' && $eid != ''){
    header('Location: /manage_event');
    exit();
}else{
    header('Location: /events');
    exit();
}