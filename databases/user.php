<?php
function getUsers(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'select * from Users';
    $result = $conn->query($sql);
    return $result;
}
function updateStudentPassword(int $id, string $hashed_password): bool
{
    $conn = getConnection();
    $sql = 'update Users set password = ? where uid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $hashed_password, $id);
    $stmt->execute();
    return  $stmt->affected_rows > 0;
}

function updateUserPassword(int $id, string $hashed_password): bool
{
    $conn = getConnection();
    $sql = 'update Users set password = ? where uid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $hashed_password, $id);
    $stmt->execute();
    return  $stmt->affected_rows > 0;
}

function getUsersById(int $id): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'select * from Users where uid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getUserIdByEmail(string $email): int
{
    $conn = getConnection();
    $sql = 'select uid from Users where email = ?';
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
    $conn = getConnection();
    $sql = 'select name from Users where email = ?';
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
    $conn = getConnection();
    $sql = 'select password from Users where email = ?';
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
    $conn = getConnection();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'insert into Users (name, email, password, birthday, tel, job, gender, address) values (?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssss', $name, $email, $hashed_password, $birthday, $tel, $job, $gender, $address);
    return $stmt->execute();
}

function checkEmailExists(string $email): bool
{
    $conn = getConnection();
    $sql = 'select uid from Users where email = ?';
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
    $conn = getConnection();
    $sql = 'UPDATE Users SET name = ?, birthday = ?, tel = ?, job = ?, gender = ?, address = ? WHERE uid = ?';
    $stmt = $conn->prepare($sql); 
    
    $stmt->bind_param('ssssssi', $name, $birthday, $tel, $job, $gender, $address, $uid);
    $stmt->execute();
    
    return $stmt->affected_rows; 
}

function updateCheckIn(string $uid,string $eid):bool
{ 
    $conn = getConnection();
    $status = 'approved';
    $time = date('Y-m-d H:i:s');
    $sql = 'update Registrations set checkin_time = ? where uid = ? and eid = ? and status = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('siis',$time, $uid, $eid,$status);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}

