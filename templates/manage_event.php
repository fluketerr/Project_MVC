<html>

<head></head>

<body>
    <!-- Header -->
    <header>
        <h1>Project</h1>
        <?php $row = $data['event']->fetch_object(); ?>
    </header>
    <nav>
        <a href="/">Home</a>
        <a href="/manage_event">Event</a>
        <a href="/join_event">ผู้ขอเข้าร่วม</a>
        <a href="/request_event">คำขอ</a>
        <a href="/edit_event">แก้ไข</a>
        <a href="/delete_event?eid=<?= (int)$row->eid ?>" onclick="return confirmDelete()">ลบกิจกรรม</a>
    </nav>

    <!-- ส่วนแสดงผลหลักของหน้า -->
    <main>
        <h1><?= $data['title'] ?></h1>
        <?php if (!empty($data['pictures'])): ?>
            <?php while ($pic = $data['pictures']->fetch_object()): ?>
                <div style="display:inline-block; margin:10px;">
                    <img src="/uploads/events/<?= $pic->picture_name ?>"
                        width="150">

                    <br>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            ไม่มีรูป
        <?php endif; ?>
        <?= $row->event_name ?>
        <?= $row->event_detail ?>
        <?= $row->event_capacity ?>
        <?= $row->start_date ?>
        <?= $row->end_date ?>
        <?= $row->event_status ?>

    </main>

    <script>
        function confirmDelete() {
            return confirm("ต้องการลบกิจกรรมนี้มั้ย ?");
        }
    </script>


    <!-- Footer  -->
    <?php include 'footer.php' ?>

</body>

</html>