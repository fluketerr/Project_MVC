<?php
$eid = $_GET['eid'] ?? '';
$page = $_GET['page'] ?? '';
$_SESSION['eid'] = $eid;
if($_SERVER['REQUEST_METHOD'] == 'GET' && $eid != '' && $page == ''){
    header('Location: /event_manage');
    exit();
}elseif($_SERVER['REQUEST_METHOD'] == 'GET' && $eid != '' && $page == 'event_join'){
    header('Location: /event_join');
    exit();
}else{
    header('Location: /events');
    exit();
}