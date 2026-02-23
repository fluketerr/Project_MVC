<!DOCTYPE html>
<html>
<head>
    <title>Register User</title>
</head>
<body>
    <h1>Register</h1>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        
        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" required>
        <br><br>
        
        <label for="tel">Tel:</label>
        <input type="text" id="tel" name="tel" required>
        <br><br>
        
        <label for="job">Job:</label>
        <select id="job" name="job" required>
            <option value="">Select Job</option>
            <option value="student">Student</option>
            <option value="designer">Designer</option>
            <option value="developer">Developer</option>
            <option value="programer">Programmer</option>
            <option value="manager">Manager</option>
            <option value="teacher">Teacher</option>
            <option value="engineer">Engineer</option>
            <option value="self-employed">Self-employed</option>
            <option value="unemployed">Unemployed</option>
            <option value="other">Other</option>
        </select>
        <br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        <br><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>
        <br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br><br>
        
        <button type="submit">Register</button>
    </form>
    
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
