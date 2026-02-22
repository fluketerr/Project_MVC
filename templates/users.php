<html>

<head></head>

<body>
    <?php include 'header.php' ?>

    <!-- ส่วนแสดงผลหลักของหน้า -->
    <main>
        <h1><?= $data['title'] ?></h1>
        <form action="users" method="get">
            <input type="text" name="keyword" />
            <button type="submit">Search</button>
        </form>
        <?php
        if ($data['result'] != []) {
            while ($row = $data['result']->fetch_object()) {
        ?>
                <?= $row->uid ?>
                <?= $row->name ?>
                <?= $row->email ?>
                <a href="/users-delete?id=<?= $row->uid ?>" onclick="return confirmSubmission()">ลบข้อมูล</a>
                <a href="/user-chgpwd?id=<?= $row->uid ?>">เปลี่ยนรหัสผ่าน</a>

                <br>
        <?php
            }
        }
        ?>
    </main>
    <!-- ส่วนแสดงผลหลักของหน้า -->
    <script>
        function confirmSubmission() {
            return confirm("ยืนยันการลบข้อมูล ?");
        }
    </script>

    <?php include 'footer.php' ?>
</body>

</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             