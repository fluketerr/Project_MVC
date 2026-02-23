<?php
function getUsers(): mysqli_result|bool
{
    global $conn;
    $sql = 'select * from users';
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
function updateStudentPassword(int $id, string $hashed_password): bool
{
    global $conn;
    $sql = 'update users set password = ? where uid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $hashed_password, $id);
    $stmt->execute();
    return  $stmt->affected_rows > 0;
}

function updateUserPassword(int $id, string $hashed_password): bool
{
    global $conn;
    $sql = 'update users set password = ? where uid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $hashed_password, $id);
    $stmt->execute();
    return  $stmt->affected_rows > 0;
}

function getUsersById(int $id): mysqli_result|bool
{
    global $conn;
    $sql = 'select * from users where uid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getUserIdByEmail(string $email): int
{
    global $conn;
    $sql = 'select uid from users where email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return (int)$row['uid'];
    }
    return 0;
}

function getUserNameByEmail(string $email): mysqli_result|string
{
    global $conn;
    $sql = 'select name from users where email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['name'];
    }
    return '';
}

function checkLogin(string $email, string $password): bool
{
    global $conn;
    $sql = 'select password from users where email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return password_verify($password, $row['password']);
    }
    return false;
}
//-------------------Registration User------------------//

function registerUser(string $name, string $email, string $password, string $birthday, string $tel, string $job , string $gender, string $address): bool
{
    global $conn;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'insert into users (name, email, password, birthday, tel, job, gender, address) values (?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssss', $name, $email, $hashed_password, $birthday, $tel, $job, $gender, $address);
    return $stmt->execute();
}

function checkEmailExists(string $email): bool
{
    global $conn;
    $sql = 'select uid from users where email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result && $result->num_rows > 0;
}

function isPassEqualConfirm(string $password, string $confirmPass): bool
{
    return $password === $confirmPass;
}

function isValidBirthday(string $birthday): bool
{
    $date = DateTime::createFromFormat('Y-m-d', $birthday);
    return $date && $date->format('Y-m-d') === $birthday;
}

//---------------------Update data------------------//

function updateUserData(int $uid, string $name, string $birthday, string $tel, string $job , string $gender, string $address): int
{
    global $conn;
    $sql = 'UPDATE users SET name = ?, birthday = ?, tel = ?, job = ?, gender = ?, address = ? WHERE uid = ?';
    $stmt = $conn->prepare($sql); 
    
    $stmt->bind_param('ssssssi', $name, $birthday, $tel, $job, $gender, $address, $uid);
    $stmt->execute();
    
    return $stmt->affected_rows; 
}



