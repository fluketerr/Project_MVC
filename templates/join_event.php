<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Dashboard - Full Screen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Prompt', 'sans-serif'],
                    },
                    colors: {
                        btnGreen: '#22c55e',
                        btnGreenHover: '#16a34a',
                        cardBg: '#ffffff',
                        imagePlaceholder: '#dcdcdc'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] h-screen w-full flex  overflow-hidden  font-sans text-gray-800">


    <div class="">
        <?php include 'sideNav_event.php'; ?>
    </div>
    <main class="flex flex-col flex-1 w-full ">

        <div class="text-4xl px-3 pt-6">
            <?= $data['title'] ?>
        </div>
        <div class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem] 
            shadow-sm border border-white/50 p-8 flex flex-col gap-6 ">
            <!-- Flash Message -->
            <?php if (!empty($_SESSION['message'])): ?>
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl shadow">
                    <?= $_SESSION['message'] ?>
                    <?php unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>

            <!-- Title -->
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold">
                    ข้อมูลผู้เข้าร่วม
                </h2>
            </div>

            <div class="fles flex-row">
                <span class="text-gray-500 text-sm">
                    <p><strong>จำนวนสมาชิก:</strong> <?= (int)($data['totalParticipants'] ?? 0) ?> คน</p>
                </span>

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


            </div>

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



        </div>
    </main>
    <script>
        function openModal(name, email, tel, birthday, job, gender, address, status) {

            document.getElementById("modalName").innerText = name;
            document.getElementById("modalEmail").innerText = email;
            document.getElementById("modalTel").innerText = tel;
            document.getElementById("modalBirthday").innerText = birthday;
            document.getElementById("modalJob").innerText = job;
            document.getElementById("modalGender").innerText = gender;
            document.getElementById("modalAddress").innerText = address;
            document.getElementById("modalStatus").innerText = status;

            const modal = document.getElementById("userModal");
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        }

        function closeModal() {
            const modal = document.getElementById("userModal");
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }
    </script>

    <div id="userModal"
        class="fixed inset-0 bg-black/40 hidden 
            items-center justify-center z-50">

        <div class="bg-white rounded-2xl shadow-xl p-8 w-[450px] relative">

            <button onclick="closeModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-black">
                ✕
            </button>

            <h2 id="modalName" class="text-xl font-semibold mb-4"></h2>

            <div class="space-y-2 text-sm text-gray-700">
                <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                <p><strong>วันเกิด:</strong> <span id="modalBirthday"></span></p>
                <p><strong>เบอร์โทร:</strong> <span id="modalTel"></span></p>
                <p><strong>อาชีพ:</strong> <span id="modalJob"></span></p>
                <p><strong>เพศ:</strong> <span id="modalGender"></span></p>
                <p><strong>ที่อยู่:</strong> <span id="modalAddress"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
            </div>

        </div>
    </div>

</body>

</html>