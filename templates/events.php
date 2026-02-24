<html>

<head></head>

<body>
    <!-- Header -->
    <?php include 'header_owner.php' ?>

    <!-- ส่วนแสดงผลหลักของหน้า -->
    <main>
        <h1> <?= $data['title'] ?></h1>

        <!-- flash card แลดงข้อความ -->
        <p> <?= $_SESSION['message'] ?? '';
            unset($_SESSION['message']); ?></p>

        <?php if ($data['result'] != []) { ?>

            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>EID</th>
                        <th>Event Name</th>
                        <th>Detail</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Create UID</th>
                        <th>Option</th>
                        <th>Checkin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $data['result']->fetch_object()) { ?>
                        <tr>
                            <td>
                                <?php if (!empty($row->cover_image)): ?>
                                    <img src="/uploads/events/<?= htmlspecialchars($row->cover_image) ?>" width="80">
                                <?php else: ?>
                                    ไม่มีรูป
                                <?php endif; ?>
                            </td>
                            <td><?= $row->eid ?></td>
                            <td><?= $row->event_name ?></td>
                            <td><?= $row->event_detail ?></td>
                            <td><?= $row->start_date ?></td>
                            <td><?= $row->end_date ?></td>
                            <td><?= $row->event_capacity ?></td>
                            <td><?= $row->event_status ?></td>
                            <td><?= $row->create_uid ?></td>
                            <td>
                                <a href="/set_sessionEid?eid=<?= (int)$row->eid ?>">จัดการกิจกรรม</a>
                            </td>
                            <td>
                                <form action="/check_otp" method="POST">
                                    <input type="hidden" name="eid" value="<?=(int)$row->eid ?>">
                                    <div>
                                        <label for="uid">กรอก Uid</label>
                                        <input type="text" name="uid">
                                    </div>
                                    <div>
                                        <label for="otp">กรอก OTP</label>
                                        <input type="tel" name="otp" id="">
                                        <button type="submit">ยืนยัน</button>
                                    </div>
                                    <?php if (isset($_SESSION['notice'])) {
                                        echo $_SESSION['notice'];
                                        unset($_SESSION['notice']);
                                    } ?>
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
</body>

</html>