<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] flex flex-row min-h-screen">

    <!-- sidebar -->
    <div class="flex flex-col gap-4 p-4">
        <div class="flex items-center gap-2">
            <?php include 'logo.php' ?> <!--logo-->
        </div>
    </div>

    <!-- ส่วนแสดงผลหลักของหน้า -->
    <main class="flex-1 p-4 m-4 bg-white rounded-lg shadow overflow-y-auto">

        <div class="flex  gap-2">
            <?php include 'header_owner.php' ?>
        </div>

        <h1 class="text-2xl font-bold"><?= $data['title'] ?></h1>

        <!-- flash card แลดงข้อความ -->
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
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $data['result']->fetch_object()) { ?>
                        <div class="flex w-full bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden font-sans">

                            <div class="w-1/4 bg-gray-300">
                            </div>

                            <div class="flex flex-1 p-6 justify-between items-start">

                                <div class="flex-1 pr-4">
                                    <h2 class="text-xl font-semibold text-slate-800 mb-2">
                                        <?= $row->event_name ?>
                                    </h2>
                                    <p class="text-sm text-slate-500 leading-relaxed max-w-md">
                                        <?= $row->event_detail ?>
                                </div>

                                <div class="flex flex-col items-end justify-between h-full space-y-8">
                                    <div class="text-right">
                                        <p class="text-slate-800 font-medium text-lg">ผู้เข้าร่วม</p>
                                        <p class="text-slate-600 text-sm">67 / <?= $row->event_capacity ?></p>
                                    </div>

                                    <button class="bg-gray-500 hover:bg-gray-700 text-white px-8 py-2 rounded-xl text-sm font-medium transition-colors">
                                        เข้าร่วม
                                    </button>
                                </div>

                            </div>
                        </div>
                        <tr>
                            <td><?= $row->eid ?></td>
                            <td><?= $row->event_name ?></td>
                            <td><?= $row->event_detail ?></td>
                            <td><?= $row->start_date ?></td>
                            <td><?= $row->end_date ?></td>
                            <td><?= $row->event_capacity ?></td>
                            <td><?= $row->event_status ?></td>
                            <td><?= $row->create_uid ?></td>
                            <td><a href="/delete_event?eid=<?=(int)$row->eid ?>" onclick="return confirmDelete()" >ลบกิจกรรม</a>
                                <a href="/set_sessionEid?eid=<?= (int)$row->eid ?>">จัดการกิจกรรม</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        <?php } else { ?>
            <p>ไม่มีข้อมูล</p>
        <?php } ?>

        <?php include 'footer.php' ?>
    </main>

    <script>
        function confirmDelete() {
            return confirm("ต้องการลบกิจกรรมนี้มั้ย ?");
        }
    </script>

    <!-- Footer -->
    <?php include 'footer.php' ?>
</body>

</html>