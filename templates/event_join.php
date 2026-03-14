<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Dashboard - Full Screen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] min-h-screen flex font-sans text-gray-800">


    <div class="">
        <?php include 'sideNav_event.php'; ?>
    </div>
    <main class="flex flex-col flex-1 w-full">
        <!-- แผ่นขาวหลัก -->
        <div class="flex-1 bg-white/75 xl:my-4 xl:mr-4 xl:rounded-[2rem] shadow-sm border border-[#213C51]/50 flex flex-col overflow-y-hidden">
            <div class="sticky flex xl:hidden items-center justify-start z-10 p-4 bg-transparent backdrop-blur-lg">
                <button id="openMenuBtn" type="button" onclick="openMenu();">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="25px" height="25px" viewBox="0 0 24 24">
                        <path d="M2,4A1,1,0,0,1,3,3H21a1,1,0,0,1,0,2H3A1,1,0,0,1,2,4Zm1,9H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Zm0,8H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Z" />
                    </svg>
                </button>
                <h1 class="text-2xl font-semibold items-center xl:my-4 mx-4"><?= $data['title'] ?></h1>
            </div>
            <div id="statistics" class="transition-all px-8 pt-4 pb-8">

                <!-- message -->
                <?php if (!empty($_SESSION['message'])): ?>
                    <div class="mb-3 rounded-lg bg-green-50 border border-green-200 px-4 py-2 text-sm text-green-700">
                        <?= $_SESSION['message'] ?>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>


                <!-- ===== stat cards ===== -->
                <div class="relative grid grid-cols-2 md:grid-cols-4 gap-3 transition-all">

                    <div class="bg-gray-50/75 rounded-xl p-4 shadow-sm">
                        <p class="text-xs text-slate-500 mb-1">จำนวนสมาชิก</p>
                        <p class="text-5xl font-bold h-full flex justify-center items-center">
                            <?= (int)($data['totalParticipants'] ?? 0) ?>
                        </p>
                    </div>

                    <div class="bg-gray-50/75 rounded-xl p-4 shadow-sm">
                        <p class="text-xs text-slate-500 mb-1 overflow-y-clip justify-center">สัดส่วนเพศ</p>
                        <div class="w-full max-h-36">
                            <canvas id="PieChart"></canvas>
                        </div>
                        <script>
                            const ctx = document.getElementById('PieChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    datasets: [{
                                        data: [<?= json_encode((int)($data['maleCount'] ?? 0)) ?>, <?= json_encode((int)($data['femaleCount'] ?? 0)) ?>, <?= json_encode((int)($data['otherCount'] ?? 0)) ?>],
                                        backgroundColor: ['#6594B1', '#DDAED3', '#4b5563']
                                    }],
                                    labels: ['ชาย', 'หญิง', 'อื่นๆ']
                                },
                                options: {
                                    plugins: {
                                        legend: {
                                            display: true,
                                            position: 'right',
                                            labels: {
                                                padding: 20,
                                                boxWidth: 40
                                            }
                                        }
                                    },
                                    maintainAspectRatio: false
                                }
                            });
                        </script>
                        <p class="text-sm font-medium">
                            ชาย <?= (int)($data['maleCount'] ?? 0) ?> |
                            หญิง <?= (int)($data['femaleCount'] ?? 0) ?> |
                            อื่นๆ <?= (int)($data['otherCount'] ?? 0) ?>
                        </p>
                    </div>

                    <div class="bg-gray-50/75 rounded-xl p-4 shadow-sm">
                        <p class="text-xs text-slate-500 mb-2">ช่วงอายุทั้งหมด</p>
                        <div class="w-full h-36">
                            <canvas id="AgeChart"></canvas>
                        </div>
                        <script>
                            const ageCtx = document.getElementById('AgeChart').getContext('2d');
                            new Chart(ageCtx, {
                                type: 'bar',
                                data: {
                                    labels: <?= json_encode(array_keys($data['ageBuckets'] ?? [])) ?>,
                                    datasets: [{
                                        label: 'จำนวนคน',
                                        data: <?= json_encode(array_values($data['ageBuckets'] ?? [])) ?>,
                                        backgroundColor: '#6594B1'
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                stepSize: 1
                                            }
                                        }
                                    },
                                    plugins: {
                                        legend: {
                                            display: false
                                        }
                                    },
                                    maintainAspectRatio: false
                                }
                            });
                        </script>
                        <p class="text-sm font-medium mt-2">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <!-- เช็คชื่อแล้ว -->
                        <div class="bg-green-50 border border-green-200 rounded-xl shadow-sm 
                relative min-h-[160px] p-4">

                            <!-- text ซ้ายบน -->
                            <p class="text-sm text-green-700 absolute top-3 left-4">
                                เช็คชื่อแล้ว
                            </p>

                            <!-- ตัวเลขกลาง -->
                            <div class="flex items-center justify-center h-full">
                                <p class="text-5xl font-bold text-green-600">
                                    <?= (int)($data['checkedCount'] ?? 0) ?>
                                </p>
                            </div>

                        </div>

                        <!-- ยังไม่เช็คชื่อ -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl shadow-sm 
                relative min-h-[160px] p-4">

                            <!-- text ซ้ายบน -->
                            <p class="text-sm text-yellow-700 absolute top-3 left-4">
                                ยังไม่เช็คชื่อ
                            </p>

                            <!-- ตัวเลขกลาง -->
                            <div class="flex items-center justify-center h-full">
                                <p class="text-5xl font-bold text-yellow-500">
                                    <?= (int)($data['totalParticipants'] ?? 0) - (int)($data['checkedCount'] ?? 0) ?>
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- =====close button===== -->
                <div class="flex justify-center">
                    <button id="closeStatBtn" class="cursor-pointer select-none transition-all" onclick="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#f9fafb" fill-opacity="0.75" height="25px" width="25   px" version="1.1" id="Icons" viewBox="0 0 32 32" xml:space="preserve">
                            <path d="M16,2C8.3,2,2,8.3,2,16s6.3,14,14,14s14-6.3,14-14S23.7,2,16,2z M21.7,18.7C21.5,18.9,21.3,19,21,19s-0.5-0.1-0.7-0.3  L16,14.4l-4.3,4.3c-0.4,0.4-1,0.4-1.4,0s-0.4-1,0-1.4l5-5c0.4-0.4,1-0.4,1.4,0l5,5C22.1,17.7,22.1,18.3,21.7,18.7z" />
                        </svg>
                    </button>
                    <!--^^^^^^^^^^^-->
                    <Script>
                        const statPanel = document.getElementById("statistics");
                        const closeBtn = document.getElementById("closeStatBtn");

                        let openPanel = true; //true = open , false == close

                        const openStat = () => {
                            //menu.classList.replace('hidden', 'flex');
                            statPanel.style.transform = "translateY(0%)";
                            closeBtn.style.rotate = "0deg";
                            statPanel.style.transition = "transform 0.5s ease-in-out";
                        };

                        const closeStat = () => {
                            //menu.classList.replace('flex', 'hidden');
                            if(window.innerWidth < 1280) {
                                statPanel.style.transform = "translateY(-400px)";
                            } else {
                                statPanel.style.transform = "translateY(-200px)";
                            }
                            closeBtn.style.rotate = "180deg";
                            statPanel.style.transition = "transform 0.5s ease-in-out";
                        };

                        closeBtn.addEventListener("click", () => {
                            openPanel = openPanel === false ? true : false;

                            if (openPanel) {
                                closeStat();
                            } else {
                                openStat();
                            }

                        });
                    </Script>
                </div>

                <!-- ===== search ===== -->
                <form method="GET" action="/event_join" class="mb-4">
                    <input type="hidden" name="eid" value="<?= $_GET['eid'] ?? '' ?>">
                    <div class="relative max-w-lg">
                        <input
                            type="text"
                            name="keyword"
                            placeholder="ค้นหาชื่อ / email / เบอร์"
                            value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"
                            class="w-full rounded-full border border-gray-50/75 px-4 py-2.5 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">

                        <button class="absolute right-3 top-1/2 -translate-y-1/2 text-sm">
                            ค้นหา
                        </button>
                    </div>
                </form>

                <!-- ===== participants scroll ===== -->
                <?php if (!empty($data['participants'])): ?>

                    <div class="max-h-[520px] overflow-y-auto pr-2 grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-3">

                        <?php foreach ($data['participants'] as $row): ?>

                            <?php
                            $checked = !empty($row['checkin_time']);
                            $text = $checked ? 'เช็คชื่อแล้ว' : 'ยังไม่เช็คชื่อ';
                            $colorClass = $checked ? 'text-green-600' : 'text-orange-500';
                            ?>

                            <div
                                class="bg-gray-50/75 rounded-xl p-3 flex items-center gap-3 shadow-sm hover:shadow-md transition cursor-pointer"

                                onclick="openModal(
                                    '<?= htmlspecialchars($row['name'] ?? '', ENT_QUOTES) ?>',
                                    '<?= htmlspecialchars($row['email'] ?? '', ENT_QUOTES) ?>',
                                    '<?= htmlspecialchars($row['tel'] ?? '', ENT_QUOTES) ?>',
                                    '<?= htmlspecialchars($row['birthday'] ?? '', ENT_QUOTES) ?>',
                                    '<?= htmlspecialchars($row['job'] ?? '', ENT_QUOTES) ?>',
                                    '<?= htmlspecialchars($row['gender'] ?? '', ENT_QUOTES) ?>',
                                    '<?= htmlspecialchars($row['address'] ?? '', ENT_QUOTES) ?>',
                                    '<?= $text ?>')">

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