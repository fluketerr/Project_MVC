<!DOCTYPE html>
<html lang="en">

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
    class="bg-[linear-gradient(90deg,#D9D9D9_0%,#DBC3D6_25%,#DDAED3_100%)] h-screen w-full flex overflow-hidden font-sans text-gray-800">

    <div class="">
        <?php include 'sideNav_home.php'; ?>
    </div>

    <div
        class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem] shadow-sm border border-[#DDAED3]/50 flex flex-col overflow-hidden">

        <div name="nev" class="absolute w-[81%] rounded-t-[2rem] px-8 py-6 flex items-end gap-4 flex-shrink-0 z-10 backdrop-blur-lg">
            <div class="w-full max-w-5xl ">
                <form method="POST" class="flex items-center gap-3">

                    <!-- ช่องค้นหา -->
                    <div class="relative flex-1">
                        <input
                            type="text"
                            name="keyword"
                            placeholder="ค้นหา ชื่อกิจกรรม"
                            value="<?= $_POST['keyword'] ?? '' ?>"
                            class="w-full bg-white text-sm text-gray-700 
                       rounded-full py-2.5 pl-5 pr-10 
                       outline-none shadow-sm 
                       placeholder-gray-400
                       border border-gray-200
                       focus:ring-2 focus:ring-green-400">

                        <!-- ไอคอน -->
                        <button type="submit"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>

                    <!-- วันที่เริ่ม -->
                    <a>วันแรก</a>
                    <input type="date"
                        name="start"
                        value="<?= $_POST['start'] ?? '' ?>"
                        class="bg-white text-sm text-gray-600
                      rounded-full px-4 py-2
                      border border-gray-200
                      shadow-sm focus:ring-2 focus:ring-green-400">

                    <!-- วันที่สิ้นสุด -->
                    <a>วันสุดท้าย</a>
                    <input type="date"
                        name="end"
                        value="<?= $_POST['end'] ?? '' ?>"
                        class="bg-white text-sm text-gray-600
                      rounded-full px-4 py-2
                      border border-gray-200
                      shadow-sm focus:ring-2 focus:ring-green-400">

                    <button title="ล้างการค้นหา" type="reset" onclick="window.location.href='home'" class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-500 transition-colors bg-white border border-gray-200 rounded-full hover:bg-gray-50 hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                </form>
            </div>
            <p><?= $_SESSION['message'] ?? '';
                unset($_SESSION['message']); ?></p>
        </div>
        <?php if ($data['result'] != []) { ?>
            <div class="overflow-y-auto px-8 pb-8 flex flex-col gap-4
                    [&::-webkit-scrollbar]:w-2 
                  [&::-webkit-scrollbar-thumb]:bg-[#DDAED3]
                    [&::-webkit-scrollbar-thumb]:rounded-full
                    [&::-webkit-scrollbar-track]:mt-[13vh]
        ">
                    <div class="mb-14" >ㅤ</div>
                <?php while ($row = $data['result']->fetch_object()) { ?>

                    <div class="bg-white/30 backdrop-blur-sm rounded-2xl flex min-h-[170px]
            overflow-hidden border border-white/50
            shadow-md hover:shadow-xl hover:bg-white/60
            transition-all duration-300">

                        <!-- รูป -->
                        <div class="w-[260px] flex-shrink-0 bg-gray-200">
                            <?php if (!empty($row->cover_image)): ?>
                                <img src="/uploads/events/<?= htmlspecialchars($row->cover_image) ?>"
                                    class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                                    ไม่มีรูป
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- เนื้อหา -->
                        <div class="flex-1 flex justify-between px-8 py-6">

                            <!-- ฝั่งซ้าย -->
                            <div class="flex flex-col flex-1 pr-6 min-w-0">

                                <!-- ชื่อ -->
                                <h3 class="text-xl font-semibold text-gray-800 truncate">
                                    <?= htmlspecialchars($row->event_name) ?>
                                </h3>

                                <!-- รายละเอียด -->
                                <p class="text-sm text-gray-600 mt-2 leading-relaxed line-clamp-2">
                                    <?= htmlspecialchars($row->event_detail) ?>
                                </p>

                                <!-- เวลาด้านล่าง -->
                                <?php
                                $start = date("d M Y H:i", strtotime($row->start_date));
                                $end   = date("d M Y H:i", strtotime($row->end_date));
                                ?>

                                <div class="mt-auto pt-4">
                                    <div class="border-t border-gray-200 mb-3"></div>
                                    <div class="text-sm text-gray-500 flex items-center gap-2">
                                        <span></span>
                                        <span><?= $start ?> - <?= $end ?></span>
                                    </div>
                                </div>

                            </div>

                            <!-- ฝั่งขวา -->
                            <div class="w-[160px] flex-shrink-0 flex flex-col items-center justify-center
                    bg-white/60 rounded-xl px-4 py-4 shadow-inner">

                                <span class="text-xs text-gray-500 uppercase tracking-wide">
                                    ผู้เข้าร่วม
                                </span>

                                <span class="text-lg font-bold text-gray-800 my-2">
                                    <?= (int)$row->approved_count ?> / <?= $row->event_capacity ?>
                                </span>

                                <?php if (isset($_SESSION['user_id'])) { ?>
                                    <?php if ($row->event_status === 'Open' && strtotime($row->end_date) > time()): ?>

                                        <form method="POST" action="" class="w-full flex justify-center">
                                            <input type="hidden" name="event_id" value="<?= $row->eid ?>">
                                            <button type="submit" name="join"
                                                class="w-full bg-green-500 hover:bg-green-600
                                                        text-white text-sm font-medium
                                                        py-2 rounded-full shadow
                                                        transition duration-200">
                                                เข้าร่วม
                                            </button>
                                        </form>

                                    <?php else: ?>

                                        <div class="w-full text-center bg-gray-400
                                                    text-white text-sm font-medium
                                                    py-2 rounded-full shadow">
                                            หมดเวลา
                                        </div>

                                    <?php endif; ?>
                                <?php } else { ?>
                                    <a href="/login" class="w-full text-center bg-green-500 hover:bg-green-600
                          text-white text-sm font-medium
                          py-2 rounded-full shadow
                          transition duration-200">
                                        เข้าร่วม
                                    </a>
                                <?php } ?>

                            </div>

                        </div>
                    </div>

                <?php } ?>
            </div>
        <?php } else { ?>
            <p>ไม่มีข้อมูล</p>
        <?php } ?>


</body>

</html>