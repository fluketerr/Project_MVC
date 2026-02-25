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

<body
    class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] h-screen w-full flex  overflow-hidden  font-sans text-gray-800">


    <div class="">
        <?php include 'sideNav_event.php'; ?>
    </div>
    <main class="flex flex-col flex-1 w-full ">

        <div class="text-4xl px-3 pt-6">
            คำขอเข้าร่วม
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

                </h2>
                <span class="text-gray-500 text-sm">
                    <?= $data['regis']->num_rows ?> รายการ
                </span>
            </div>

            <?php if ($data['regis']->num_rows > 0): ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <?php while ($row = $data['regis']->fetch_object()): ?>

                <div class="bg-white rounded-2xl shadow-md p-6 
                        hover:shadow-lg transition cursor-pointer" onclick="openModal(
                    '<?= htmlspecialchars($row->name) ?>',
                    '<?= htmlspecialchars($row->email) ?>',
                    '<?= htmlspecialchars($row->tel) ?>',
                    '<?= htmlspecialchars($row->birthday ?? '') ?>',
                    '<?= htmlspecialchars($row->job ?? '') ?>',
                    '<?= htmlspecialchars($row->gender ?? '') ?>',
                    '<?= htmlspecialchars($row->address ?? '') ?>',
                    '<?= $row->status ?>'
                )">

                    <!-- Basic Info -->
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">
                            <?= htmlspecialchars($row->name) ?>
                        </h3>
                        <p class="text-sm text-gray-600">
                            <?= htmlspecialchars($row->email) ?>
                        </p>
                        <p class="text-sm text-gray-600">
                            <?= htmlspecialchars($row->tel) ?>
                        </p>
                    </div>

                    <!-- Status Badge -->
                    <div class="mb-4">
                        <?php if ($row->status === 'pending'): ?>
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                            รออนุมัติ
                        </span>
                        <?php endif; ?>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3" onclick="event.stopPropagation()">

                        <form method="POST" action="/approve_request">
                            <input type="hidden" name="rid" value="<?= (int)$row->rid ?>">
                            <button class="px-4 py-1 rounded-full text-sm 
                                       bg-green-500 hover:bg-green-600 
                                       text-white transition">
                                อนุมัติ
                            </button>
                        </form>

                        <form method="POST" action="/reject_request">
                            <input type="hidden" name="rid" value="<?= (int)$row->rid ?>">
                            <button class="px-4 py-1 rounded-full text-sm 
                                       bg-red-500 hover:bg-red-600 
                                       text-white transition">
                                ปฏิเสธ
                            </button>
                        </form>

                    </div>

                </div>

                <?php endwhile; ?>

            </div>

            <?php else: ?>

            <div class="text-center text-gray-500 py-10">
                ไม่มีคำขอที่รออนุมัติ
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

    <div id="userModal" class="fixed inset-0 bg-black/40 hidden 
            items-center justify-center z-50">

        <div class="bg-white rounded-2xl shadow-xl p-8 w-[450px] relative">

            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-black">
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