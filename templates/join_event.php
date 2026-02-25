<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Dashboard - Full Screen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] min-h-screen flex font-sans text-gray-800">


    <div class="">
        <?php include 'sideNav_event.php'; ?>
    </div>
    <main class="flex flex-col flex-1 w-full">

        <div class="text-4xl px-3 pt-6">
            ผู้เข้าร่วม
        </div>

        <!-- แผ่นขาวหลัก -->
        <div class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem] shadow-sm border border-white/50 p-8 flex flex-col">

            <!-- message -->
            <?php if (!empty($_SESSION['message'])): ?>
                <div class="mb-3 rounded-lg bg-green-50 border border-green-200 px-4 py-2 text-sm text-green-700">
                    <?= $_SESSION['message'] ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>


            <!-- ===== stat cards ===== -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">

                <div class="bg-gray-50 rounded-xl p-4 shadow-sm">
                    <p class="text-xs text-slate-500 mb-1">จำนวนสมาชิก</p>
                    <p class="text-2xl font-bold">
                        <?= (int)($data['totalParticipants'] ?? 0) ?>
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 shadow-sm">
                    <p class="text-xs text-slate-500 mb-1">สัดส่วนเพศ</p>
                    <canvas id="myChart" style="width:100%; max-width:700px;"></canvas>
                    <p class="text-sm font-medium">
                        ชาย <?= (int)($data['maleCount'] ?? 0) ?> |
                        หญิง <?= (int)($data['femaleCount'] ?? 0) ?> |
                        อื่นๆ <?= (int)($data['otherCount'] ?? 0) ?>
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 shadow-sm">
                    <p class="text-xs text-slate-500 mb-1">ช่วงอายุ</p>
                    <p class="text-xl font-bold">
                        <?= htmlspecialchars($data['topAgeRange'] ?? '-') ?>
                    </p>
                    <p class="text-xs text-slate-500">
                        <?= (int)($data['topAgeCount'] ?? 0) ?> คน
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 shadow-sm">
                    <p class="text-xs text-slate-500 mb-1">เช็คชื่อแล้ว</p>
                    <p class="text-2xl font-bold text-green-600">
                        <?= (int)($data['checkedCount'] ?? 0) ?>
                    </p>
                </div>

            </div>

            <!-- ===== search ===== -->
            <form method="GET" action="/join_event" class="mb-4">
                <div class="relative max-w-lg">
                    <input
                        type="text"
                        name="keyword"
                        placeholder="ค้นหาชื่อ / email / เบอร์"
                        value="<?= htmlspecialchars($data['keyword'] ?? '') ?>"
                        class="w-full rounded-full border border-gray-200 px-4 py-2.5 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">

                    <button class="absolute right-3 top-1/2 -translate-y-1/2 text-sm">
                        ค้นหา
                    </button>
                </div>
            </form>
            </form>

            <!-- ===== participants scroll ===== -->
            <?php if (!empty($data['participants'])): ?>

                <div class="max-h-[520px] overflow-y-auto pr-2 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">

                    <?php foreach ($data['participants'] as $row): ?>

                        <?php
                        $checked = !empty($row['checkin_time']);
                        $text = $checked ? 'เช็คชื่อแล้ว' : 'ยังไม่เช็คชื่อ';
                        $colorClass = $checked ? 'text-green-600' : 'text-orange-500';
                        ?>

                        <div class="bg-gray-50 rounded-xl p-3 flex items-center gap-3 shadow-sm hover:shadow-md transition">

                            <!-- avatar -->
                            <div class="w-14 h-14 bg-gray-300 rounded-lg flex-shrink-0"></div>

                            <!-- info -->
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-base truncate">
                                    <?= htmlspecialchars($row['name']) ?>
                                </h3>
                                <p class="text-xs text-slate-600 truncate">
                                    <?= htmlspecialchars($row['email']) ?>
                                </p>
                                <p class="text-xs text-slate-600">
                                    <?= htmlspecialchars($row['tel']) ?>
                                </p>
                            </div>

                            <!-- status -->
                            <div class="text-xs font-semibold whitespace-nowrap <?= $colorClass ?>">
                                <?= $text ?>
                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php else: ?>
                <div class="text-center text-gray-500 py-10">
                    ยังไม่มีผู้เข้าร่วม
                </div>
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