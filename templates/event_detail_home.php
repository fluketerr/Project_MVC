<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        svg {
            pointer-events: none;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Prompt', 'sans-serif']
                    },
                    colors: {
                        btnGreen: '#22c55e',
                        btnGreenHover: '#16a34a',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#DBC3D6_25%,#DDAED3_100%)] h-screen w-full flex overflow-hidden font-sans text-gray-800">

    <?php $row = $data['event']; ?>

    <!-- Side Nav -->
    <div class="flex-shrink-0">
        <?php include 'sideNav_home.php'; ?>
    </div>

    <!-- Main panel -->
    <div class="flex-1 relative bg-white/75 xl:my-4 xl:mr-4 xl:rounded-[2rem] shadow-sm border border-[#DDAED3]/50 flex flex-col overflow-hidden">

        <div class="overflow-y-auto flex-1 px-8 py-6 flex flex-col gap-6
                    [&::-webkit-scrollbar]:w-1.5
                    [&::-webkit-scrollbar-thumb]:bg-[#DDAED3]
                    [&::-webkit-scrollbar-thumb]:rounded-full">

            <!-- Back -->

            <div class="flex xl:hidden items-center justify-start">
                    <button id="openMenuBtn" type="button" onclick="openMenu();">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="25px" height="25px" viewBox="0 0 24 24">
                            <path d="M2,4A1,1,0,0,1,3,3H21a1,1,0,0,1,0,2H3A1,1,0,0,1,2,4Zm1,9H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Zm0,8H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Z" />
                        </svg>
                    </button>
                </div>
                <a href="javascript:history.back()" class="text-sm text-gray-500 hover:text-gray-800 w-fit">
                    < ย้อนกลับ
                        </a>


            <!-- ── บน: รูปใหญ่ + info ── -->
            <div class="flex gap-8 flex-col xl:flex-row">

                <!-- รูปหลัก -->
                

                        <!-- Cover Image -->
                        <?php if (!empty($data['pictures']) && $pic = $data['pictures']->fetch_object()): ?>

                            <div class="xl:w-[420px] h-[240px]">
                                <img src="/uploads/events/<?= $pic->picture_name ?>"
                                    class="w-full h-full object-cover rounded-xl border border-gray-300">
                            </div>

                        <?php else: ?>
                            ไม่มีรูป
                        <?php endif; ?>

                        <!-- Info -->
                        <div class="flex-1 flex flex-col gap-3 min-w-0 pt-1">

                            <!-- ชื่อ -->
                            <h1 class="text-2xl font-semibold text-gray-800">
                                <?= htmlspecialchars($row->event_name) ?>
                            </h1>

                            <!-- รายละเอียด -->
                            <p class="flex-1 text-sm text-gray-600 leading-relaxed">
                                <?= htmlspecialchars($row->event_detail) ?>
                            </p>

                            <!-- วันที่ -->
                            <p class="text-sm text-gray-500">
                                <?= date("Y-m-d H:i:s", strtotime($row->start_date)) ?>
                                &nbsp;–&nbsp;
                                <?= date("Y-m-d H:i:s", strtotime($row->end_date)) ?>
                            </p>



                            <!-- ผู้เข้าร่วม + progress -->
                            <div class="mt-6 mb-6">

                                <div class="flex justify-between text-sm mb-2">
                                    <span>ผู้เข้าร่วม</span>
                                    <span class="font-semibold">
                                        <?= (int)$row->approved_count ?> / <?= $row->event_capacity ?>
                                    </span>
                                </div>

                                <?php
                                $percent = 0;
                                if ($row->event_capacity > 0) {
                                    $percent = ($row->approved_count / $row->event_capacity) * 100;
                                }
                                ?>

                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-[#213C51] h-2 rounded-full"
                                        style="width: <?= min(100, $percent) ?>%">
                                    </div>
                                </div>

                            </div>

                        </div>
            </div>

            <!-- ── รูปย่อย ── -->
            <div class="mt-4 ">
                <div class="flex overflow-x-auto snap-x snap-mandatory scroll-smooth gap-4 pb-2 
                    [&::-webkit-scrollbar]:h-1 
                  [&::-webkit-scrollbar-thumb]:bg-white/75
                    [&::-webkit-scrollbar-thumb]:rounded-full
                ">
                    <?php if (!empty($data['pictures'])): ?>
                        <?php while ($pic = $data['pictures']->fetch_object()): ?>
                            <div class="flex-shrink-0 w-44 h-28 rounded-xl overflow-hidden shadow snap-center">
                                <img src="/uploads/events/<?= $pic->picture_name ?>"
                                    class="w-full h-full object-cover">
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>



            <!-- ปุ่มเข้าร่วม -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($row->approved_count >= $row->event_capacity): ?>

                    <div class="xl:w-full w-1/2 text-center bg-red-500
                    text-white text-sm font-medium
                    py-2 rounded-full shadow">
                        เต็มแล้ว
                    </div>

                <?php elseif ($row->event_status === 'Open' && strtotime($row->end_date) > time()): ?>
                    <form method="POST" action="">
                        <input type="hidden" name="event_id" value="<?= $row->eid ?>">
                        <button type="submit" name="join"
                            class="w-full bg-btnGreen hover:bg-btnGreenHover text-white font-medium py-3 rounded-xl shadow transition">
                            เข้าร่วมกิจกรรม
                        </button>
                    </form>
                <?php else: ?>
                    <div class="w-full text-center bg-gray-200 text-gray-400 font-medium py-3 rounded-xl">
                        หมดเวลาสมัครแล้ว
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <a href="/login"
                    class="block text-center w-full bg-btnGreen hover:bg-btnGreenHover text-white font-medium py-3 rounded-xl shadow transition">
                    เข้าสู่ระบบเพื่อเข้าร่วม
                </a>
            <?php endif; ?>


        </div>
    </div>



</body>

</html>