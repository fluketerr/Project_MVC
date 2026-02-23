
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

function getUserByEmail(string $email): mysqli_result|string
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


