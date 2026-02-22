<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] flex flex-row min-h-screen">
    <!-- Header -->
    <?php include 'header.php' ?>

    <!-- ส่วนแสดงผลหลักของหน้า -->

    <!-- ยังไม่ได้กรอกให้แสดงของตัวเอง -->
    <main>
        <h1> <?= $data['title'] ?></h1>

        <section>
            <form action="create_event" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="event_picture">รูปกิจกรรม</label>
                    <input type="file" name="event_picture[]" id="" multiple required>
                </div>
                <div>
                    <label for="event_name">ชื่อกิจกรรม: </label>
                    <input type="text" name="event_name" id="" required>
                </div>
                <div>
                    <label for="event_detail">รายละเอียด: </label>
                    <textarea name="event_detail" rows="2" cols="25" placeholder="รายละเอียด" required></textarea>
                </div>
                <div>
                    <label for="event_capacity">จำนวนคนเข้าร่วม</label>
                    <input type="number" name="event_capacity" id="" required>
                </div>
                <div>
                    <label for="start_date">วันเริ่มต้น: </label>
                    <input type="datetime-local" name="start_date" required>
                </div>
                <div>
                    <label for="end_date">วันสิ้นสุด: </label>
                    <input type="datetime-local" name="end_date" required>
                </div>
                <button type="submit">สร้างกิจกรรม</button>

            </form>
        </section>


    </main>

    <!-- Footer -->
    <?php include 'footer.php' ?>
</body>

</html>