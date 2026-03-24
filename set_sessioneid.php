<?php
session_start();
$eid = $_GET['eid'] ?? '';
$page = $_GET['page'] ?? '';
$_SESSION['eid'] = $eid;
if($_SERVER['REQUEST_METHOD'] == 'GET' && $eid != '' && $page == ''){
    header('Location: /event_manage');
    exit();
}elseif($_SERVER['REQUEST_METHOD'] == 'GET' && $eid != '' && $page == 'event_join'){
    header('Location: /event_join');
    exit();
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $eid != '' && $page == 'event_detail_home') {
    header('Location: /event_detail_home');
    exit();
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $eid != '' && $page == 'event_detail_my') {
    header('Location: /event_detail_my');
    exit();

} else{
    header('Location: /events');
    exit();
}