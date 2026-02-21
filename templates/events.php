<html>

<head></head>

<body>
    <!-- Header -->
    <?php include 'header_owner.php' ?>

    <!-- ส่วนแสดงผลหลักของหน้า -->

    <!-- ยังไม่ได้กรอกให้แสดงของตัวเอง -->
    <main>
        <h1> <?= $data['title'] ?></h1>
        <p> <?= $data['message'] ?? '' ?></p>

        <?php if ($data['result'] != []){ ?>

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
                    <?php while ($row = $data['result']->fetch_object()){ ?>
                        <tr>
                            <td><?= $row->eid ?></td>
                            <td><?= $row->event_name ?></td>
                            <td><?= $row->event_detail ?></td>
                            <td><?= $row->start_date ?></td>
                            <td><?= $row->end_date ?></td>
                            <td><?= $row->event_capacity ?></td>
                            <td><?= $row->event_status ?></td>
                            <td><?= $row->create_uid ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        <?php }else{ ?>
            <p>ไม่มีข้อมูล</p>
        <?php } ?>

    </main>

    <!-- Footer -->
    <?php include 'footer.php' ?>
</body>

</html>