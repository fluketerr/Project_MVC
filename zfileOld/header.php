<header>
    </header>
    <nav>
        <a href="/">Home</a>
        <a href="/events">Events</a>
        <?php if (isset($_SESSION['user_email'])) { ?>
            <span>ยินดีต้อนรับ, <?= $_SESSION['name'] ?></span>
            <?php print_r($_SESSION); ?>
            <a href="/logout">Logout</a>
            <a href="/update_user">Update Profile</a>
        <?php } else { ?>
            <a href="/login">Login</a> 
        <?php } ?>

    </nav>