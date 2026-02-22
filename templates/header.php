<header>
        <h1>Project</h1>
    </header>
    <nav>
        <a href="/">Home</a>
        <a href="/events">Events</a>
        <?php if (isset($_SESSION['user_email'])) { ?>
            <span>ยินดีต้อนรับ, <?= $_SESSION['name'] ?></span>
            <a href="/logout">Logout</a>
        <?php } else { ?>
            <a href="/login">Login</a> 
        <?php } ?>
        <a href="/user-chgpwd">Change Password</a>


    </nav>