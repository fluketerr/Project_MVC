<html>

<head></head>

<body>
    <!-- Header -->
    <?php include 'header.php' ?>

    <!-- ส่วนแสดงผลหลักของหน้า -->

    <!-- ยังไม่ได้กรอกให้แสดงของตัวเอง -->
    <main>
        <h1> <?= $data['title'] ?></h1>
        <h1> <?php //echo $_SESSION['eid'] ?></h1>
        <?php $event = $data['event']->fetch_object() ?>

        <section>
            <form action="update_event" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="eid" value="<?= (int)$event->eid ?>">
                <h3>รูปภาพปัจจุบัน</h3>

                <?php if (!empty($data['pictures'])): ?>
                    <?php while ($pic = $data['pictures']->fetch_object()): ?>
                        <div style="display:inline-block; margin:10px;">
                            <img src="/uploads/events/<?= $pic->picture_name ?>"
                                width="150">

                            <br>

                            <label>
                                <input type="checkbox" name="delete_pictures[]"
                                    value="<?= $pic->pid ?>">
                                ลบรูปนี้
                            </label>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    ไม่มีรูป
                <?php endif; ?>
                <div>
                    <label>เพิ่มรูปใหม่</label>
                    <input type="file" name="new_pictures[]" multiple>
                </div>
                <div>
                    <label for="event_name">ชื่อกิจกรรม: </label>
                    <input type="text" name="event_name" id="" value="<?= $event->event_name ?>" required>
                </div>
                <div>
                    <label for="event_detail">รายละเอียด: </label>
                    <textarea name="event_detail" rows="2" cols="25" required><?= $event->event_detail ?></textarea>
                </div>
                <div>
                    <label for="event_capacity">จำนวนคนเข้าร่วม</label>
                    <input type="number" name="event_capacity" id="" value="<?= $event->event_capacity ?>" required>
                </div>
                <div>
                    <label for="start_date">วันเริ่มต้น: </label>
                    <input type="datetime-local" name="start_date" value="<?= str_replace(' ', 'T', substr($event->start_date, 0, 16)) ?>" required>
                </div>
                <div>
                    <label for="end_date">วันสิ้นสุด: </label>
                    <input type="datetime-local" name="end_date" value="<?= str_replace(' ', 'T', substr($event->end_date, 0, 16)) ?>" required>
                </div>
                <button type="submit">บันทึกการแก้ไข</button>

            </form>
        </section>


    </main>

    <!-- Footer -->
    <?php include 'footer.php' ?>
</body>

</html>