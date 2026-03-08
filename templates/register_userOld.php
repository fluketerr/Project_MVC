<!DOCTYPE html>
<html>

<head>
    <title>Register User</title>
</head>

<body>
    <h1>Register</h1>
    <form method="POST" action="">
        <label for="name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="surname">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>
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
            <option value="Student">Student</option>
            <option value="Designer">Designer</option>
            <option value="Developer">Developer</option>
            <option value="Programmer">Programmer</option>
            <option value="Manager">Manager</option>
            <option value="Teacher">Teacher</option>
            <option value="Engineer">Engineer</option>
            <option value="Self-employed">Self-employed</option>
            <option value="Unemployed">Unemployed</option>
            <option value="Other">Other</option>
        </select>
        <br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
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