<html>

<head></head>

<body>
    <!-- Header และ Footer อาจแยกออกเป็นไฟล์แยกต่างหากได้ -->
    <?php include 'header.php' ?>
    <!-- Header และ Footer อาจแยกออกเป็นไฟล์แยกต่างหากได้ -->

    <!-- ส่วนแสดงผลหลักของหน้า -->
    <main>
        <a href="/home">กิจกรรมทั้งหมด</a>
        <a href="/my_events">กิจกรรมของฉัน</a>

        <form method="GET">
            <input type="hidden" name="page" value="home">

            <input type="text" name="keyword" placeholder="ค้นหาชื่อกิจกรรม" value="<?= $_GET['keyword'] ?? '' ?>">

            <input type="date" name="start">
            <input type="date" name="end">

            <button type="submit">ค้นหา</button>
        </form>
        <p> <?= $_SESSION['message'] ?? '';
            unset($_SESSION['message']); ?></p>

        <?php if ($data['result'] != []) { ?>

            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>EID</th>
                        <th>Event Name</th>
                        <th>Detail</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Create UID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $data['result']->fetch_object()) { ?>
                        <tr>
                            <td><?= $row->eid ?></td>
                            <td><?= $row->event_name ?></td>
                            <td><?= $row->event_detail ?></td>
                            <td><?= $row->start_date ?></td>
                            <td><?= $row->end_date ?></td>
                            <td><?= $row->event_capacity ?></td>
                            <td><?= $row->event_status ?></td>
                            <td><?= $row->create_uid ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="event_id" value="<?= $row->eid ?>">
                                    <button type="submit" name="join" >ขอเข้าร่วม</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        <?php } else { ?>
            <p>ไม่มีข้อมูล</p>
        <?php } ?>

    </main>
    <!-- ส่วนแสดงผลหลักของหน้า -->

    <!-- Header และ Footer อาจแยกออกเป็นไฟล์แยกต่างหากได้ -->
    <?php include 'footer.php' ?>
    <!-- Header และ Footer อาจแยกออกเป็นไฟล์แยกต่างหากได้ -->
</body>

</html>