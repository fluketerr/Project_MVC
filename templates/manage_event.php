<html>

<head></head>

<body>
    <!-- Header -->
    <?php include 'header_manageE.php' ?>

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
        <?php $row = $data['event']->fetch_object(); ?>
        <?= $row->event_name ?>
        <?= $row->event_detail ?>
        <?= $row->event_capacity ?>
        <?= $row->start_date ?>
        <?= $row->end_date ?>
        <?= $row->event_status ?>

    </main>



    <!-- Footer  -->
    <?php include 'footer.php' ?>

</body>

</html>