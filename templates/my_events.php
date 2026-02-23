<html>

<head>

</head>

<?php include 'header.php' ?>

<a href="/home">กิจกรรมทั้งหมด</a>
<a href="/my_events">กิจกรรมของฉัน</a>

<form method="GET">
    <input type="hidden" name="page" value="my_events">
    <label for="">สถานะ : </label>
    <select name="status">
        <option value="">ทั้งหมด</option>
        <option value="wait" <?= ($_GET['status'] ?? '') == 'wait' ? 'selected' : '' ?>>รออนุมัติ</option>
        <option value="approved" <?= ($_GET['status'] ?? '') == 'approved' ? 'selected' : '' ?>>อนุมัติแล้ว</option>
        <option value="rejected" <?= ($_GET['status'] ?? '') == 'rejected' ? 'selected' : '' ?>>ปฏิเสธ</option>
    </select>

    <button type="submit">กรอง</button>
</form>
<?php if ($data['result'] && $data['result']->num_rows > 0): ?>

    <table border="1">
        <tr>
            <th>ชื่อกิจกรรม</th>
            <th>วันเริ่ม</th>
            <th>วันสิ้นสุด</th>
            <th>สถานะ</th>
        </tr>

        <?php while ($row = $data['result']->fetch_object()): ?>
            <tr>
                <td><?= $row->event_name ?></td>
                <td><?= $row->start_date ?></td>
                <td><?= $row->end_date ?></td>
                <td>
                    <?php
                    if ($row->status == 'wait') {
                        echo "รออนุมัติ";
                    } elseif ($row->status == 'approved') {
                        echo "อนุมัติแล้ว";
                    } elseif ($row->status == 'rejected') {
                        echo "ถูกปฏิเสธ";
                    }
                    ?>
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="event_id" value="<?= $row->eid ?>">
                        <button type="submit" name="cancel">ยกเลิกการเข้าร่วม</button>
                    </form>
                </td>
                <td>
                    <?php if ($row->status == 'approved'): ?>
                    <form method="POST">
                        <input type="hidden" name="otp_event_id" value="<?= $row->eid ?>">
                        <button type="submit" name="request_otp">ขอ OTP</button>
                    </form>
                    <?php endif; ?>
                    <?php
                    if (
                        isset($_POST['request_otp']) &&
                        isset($_POST['otp_event_id']) &&
                        $_POST['otp_event_id'] == $row->eid
                    ) {
                        
                        $uid = $_SESSION['user_id'];
                        $otp = generateOTP($uid, $row->eid);
                        echo "<div><strong>OTP:</strong> $otp </div>";
                    }
                    ?>

                   
                </td>
            </tr>
        <?php endwhile; ?>

    </table>

<?php else: ?>
    <p>ยังไม่ได้สมัครกิจกรรม</p>
<?php endif; ?>
<?php include 'footer.php' ?>

</html>