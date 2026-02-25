<html>

<head>
    <style>
        .card {
            background: #ddd;
            padding: 15px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <main>

        <a href="/home">กิจกรรมทั้งหมด</a>
        <a href="/my_events">กิจกรรมของฉัน</a>

        <p>
            <?= $_SESSION['message'] ?? '' ?>
            <?php unset($_SESSION['message']); ?>
        </p>

        <h2>ผู้เข้าร่วมกิจกรรม</h2>

        <p><strong>จำนวนสมาชิก:</strong> <?= (int)($data['totalParticipants'] ?? 0) ?> คน</p>

        <div style="margin-bottom:15px;">
            ชาย: <?= (int)($data['maleCount'] ?? 0) ?> คน |
            หญิง: <?= (int)($data['femaleCount'] ?? 0) ?> คน
        </div>

        <div class="stat-box">
            <strong>ช่วงอายุที่มีผู้เข้าร่วมมากที่สุด</strong><br>
            ช่วงอายุ <?= htmlspecialchars($data['topAgeRange'] ?? '-') ?> ปี
            จำนวน <?= (int)($data['topAgeCount'] ?? 0) ?> คน
        </div>

        <p><strong>เช็คชื่อแล้ว:</strong>
            <?= (int)($data['checkedCount'] ?? 0) ?> คน
        </p>

        <form method="GET" action="/join_event" style="margin-bottom:15px;">
            <input type="text" name="keyword"
                placeholder="ค้นหาชื่อ / email / เบอร์"
                value="<?= htmlspecialchars($data['keyword'] ?? '') ?>">
            <button type="submit">ค้นหา</button>
        </form>

        <?php if (!empty($data['participants'])): ?>

            <?php foreach ($data['participants'] as $row): ?>

                <div class="card">
                    <h3><?= htmlspecialchars($row['name']) ?></h3>
                    <p>Email: <?= htmlspecialchars($row['email']) ?></p>
                    <p>เบอร์โทร: <?= htmlspecialchars($row['tel']) ?></p>

                    <?php
                    $checked = !empty($row['checkin_time']);

                    if ($checked) {
                        $text = 'เช็คชื่อแล้ว';
                        $color = 'green';
                    } else {
                        $text = 'ยังไม่เช็คชื่อ';
                        $color = 'red';
                    }
                    ?>

                    <p>
                        <strong>สถานะเช็คชื่อ:</strong>
                        <span style="color: <?= $color ?>;"> <?= $text ?> </span>
                    </p>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <p>ยังไม่มีผู้เข้าร่วม</p>
        <?php endif; ?>

    </main>
    <?php include 'footer.php'; ?>

</body>

</html>