<?php
// ประมวลผลก่อนแสดงผลหน้า
unset($_SESSION['eid']);
renderView('home', ['title' => 'Welcome to Home Page']);