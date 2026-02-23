<?php

$result = getUsers();
renderView('users', ['title' => 'Users Information','result' => $result]);