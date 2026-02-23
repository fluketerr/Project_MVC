<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h1>Update User</h1>
    <?php include 'header.php' ?>
    <form method="POST" action="">
        <label for="name">First Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" required>
    
        <label for="surname">Last Name:</label>
        <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($user['surname'] ?? ''); ?>">
        <br><br>
        
        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" value="<?php echo htmlspecialchars($user['birthday'] ?? ''); ?>">
        <br><br>
        
        <label for="tel">Tel:</label>
        <input type="text" id="tel" name="tel" value="<?php echo htmlspecialchars($user['tel'] ?? ''); ?>">
        <br><br>
        
        <label for="job">Job:</label>
        <select id="job" name="job">
            <option value="">Select Job</option>
            <option value="Student" <?php echo ($user['job'] ?? '') === 'Student' ? 'selected' : ''; ?>>Student</option>
            <option value="Designer" <?php echo ($user['job'] ?? '') === 'Designer' ? 'selected' : ''; ?>>Designer</option>
            <option value="Developer" <?php echo ($user['job'] ?? '') === 'Developer' ? 'selected' : ''; ?>>Developer</option>
            <option value="Programmer" <?php echo ($user['job'] ?? '') === 'Programmer' ? 'selected' : ''; ?>>Programmer</option>
            <option value="Manager" <?php echo ($user['job'] ?? '') === 'Manager' ? 'selected' : ''; ?>>Manager</option>
            <option value="Teacher" <?php echo ($user['job'] ?? '') === 'Teacher' ? 'selected' : ''; ?>>Teacher</option>
            <option value="Engineer" <?php echo ($user['job'] ?? '') === 'Engineer' ? 'selected' : ''; ?>>Engineer</option>
            <option value="Self-employed" <?php echo ($user['job'] ?? '') === 'Self-employed' ? 'selected' : ''; ?>>Self-employed</option>
            <option value="Unemployed" <?php echo ($user['job'] ?? '') === 'Unemployed' ? 'selected' : ''; ?>>Unemployed</option>
            <option value="Other" <?php echo ($user['job'] ?? '') === 'Other' ? 'selected' : ''; ?>>Other</option>
        </select>
        <br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="">Select Gender</option>
            <option value="male" <?php echo ($user['gender'] ?? '') === 'male' ? 'selected' : ''; ?>>Male</option>
            <option value="female" <?php echo ($user['gender'] ?? '') === 'female' ? 'selected' : ''; ?>>Female</option>
            <option value="other" <?php echo ($user['gender'] ?? '') === 'other' ? 'selected' : ''; ?>>Other</option>
        </select>
        <br><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" ><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
        <br><br>

        <button type="submit">Update</button>
    </form>
    
    <p>Change Password? <a href="/user-chgpwd">Change here</a></p>
</body>
</html>
