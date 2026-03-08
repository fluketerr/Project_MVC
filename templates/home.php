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
        class="flex-1 relative bg-white/75 md:my-4 md:mr-4 lg:rounded-[2rem] shadow-sm border border-[#DDAED3]/50 flex flex-col overflow-hidden">

        <div name="nev" class="sticky w-full rounded-t-[2rem] lg:px-8 py-6 flex items-end lg:gap-4 flex-shrink-0 z-10 backdrop-blur-lg">
            <div class="w-full max-w-5xl ">
                <form method="POST" class="flex flex-col lg:flex-row items-center gap-3">
                    
                    <div class="flex gap-3 w-full">
                        <div class="flex lg:hidden items-center justify-start pl-5">
                            <button type="button" onclick="openMenu();">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="25px" height="25px" viewBox="0 0 24 24">
                                    <path d="M2,4A1,1,0,0,1,3,3H21a1,1,0,0,1,0,2H3A1,1,0,0,1,2,4Zm1,9H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Zm0,8H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Z"/>
                                </svg>
                            </button>
                        </div>
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

                        <button title="ล้างการค้นหา" type="reset" onclick="window.location.href='home'" class="lg:hidden flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-500 transition-colors bg-white border border-gray-200 rounded-full hover:bg-gray-50 hover:text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex lg:gap-3">
                        <!-- วันที่เริ่ม -->
                        <div class="bg-white rounded-full pl-4 shadow-sm items-center flex">
                            <a class="text-xs lg:text-sm lg:w-14">วันแรก</a>
                            <input type="date"
                                name="start"
                                value="<?= $_POST['start'] ?? '' ?>"
                                class="bg-white text-xs lg:text-sm text-gray-600
                            rounded-full px-4 py-2
                            border border-gray-200
                            shadow-sm focus:ring-2 focus:ring-green-400"
                                onchange="this.form.submit()">
                        </div>

                        <!-- วันที่สิ้นสุด -->
                        <div class="bg-white rounded-full pl-4 shadow-sm items-center flex">
                            <a class="text-xs lg:text-sm lg:w-20">วันสุดท้าย</a>
                            <input type="date"
                                name="end"
                                value="<?= $_POST['end'] ?? '' ?>"
                                class="bg-white text-xs lg:text-sm text-gray-600
                            rounded-full px-4 py-2
                            border border-gray-200
                            shadow-sm focus:ring-2 focus:ring-green-400"
                                onchange="this.form.submit()">
                        </div>
                    
                        <button title="ล้างการค้นหา" type="reset" onclick="window.location.href='home'" class="hidden lg:flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-500 transition-colors bg-white border border-gray-200 rounded-full hover:bg-gray-50 hover:text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                </form>
            </div>
            <p><?= $_SESSION['message'] ?? '';
                unset($_SESSION['message']); ?></p>
        </div>
        <?php if ($data['result'] != []) { ?>
            <div class="overflow-y-auto lg:px-8 pb-8 flex flex-col gap-4
                    [&::-webkit-scrollbar]:w-2 
                  [&::-webkit-scrollbar-thumb]:bg-[#DDAED3]
                    [&::-webkit-scrollbar-thumb]:rounded-full
        ">
                <?php while ($row = $data['result']->fetch_object()) { ?>

                    <div class="bg-white/30 backdrop-blur-sm rounded-2xl flex lg:flex-row flex-col lg:min-h-[170px]
            lg:overflow-hidden border border-white/50
            shadow-md hover:shadow-xl hover:bg-white/60
            transition-all duration-300">

                        <!-- รูป -->
                        <div class="lg:w-[20vw] lg:h-full w-full max-h-64 h-1/2 flex-shrink-0 bg-gray-200 lg:rounded-l-xl lg:rounded-r-none rounded-t-xl">
                            <?php
                            $imgPath = 'uploads/events/' . $row->cover_image;
                            if (!empty($row->cover_image) && file_exists($imgPath)): ?>
                                <img src="/uploads/events/<?= htmlspecialchars($row->cover_image) ?>"
                                    class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm min-h-[190px]">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="24" height="24" rx="4" fill="white" fill-opacity="0.3" />
                                        <path d="M4 16l4.5-4.5 3 3 4-4.5L20 16H4z" fill="white" fill-opacity="0.7" />
                                        <circle cx="8.5" cy="8.5" r="1.5" fill="white" fill-opacity="0.7" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- เนื้อหา -->
                        <div class="flex-1 flex flex-col lg:flex-row justify-between px-8 py-6">

                            <!-- ฝั่งซ้าย -->
                            <div class="flex lg:flex-col flex-1 lg:pr-6 min-w-0">

                                <div class="w-2/3">
                                    <!-- ชื่อ -->
                                    <h3 class="text-xl font-semibold text-gray-800 truncate">
                                        <?= htmlspecialchars($row->event_name) ?>
                                    </h3>

                                    <!-- รายละเอียด -->
                                    <p class="text-sm text-gray-600 mt-2 leading-relaxed lg:line-clamp-2">
                                        <?= htmlspecialchars($row->event_detail) ?>
                                    </p>
                                </div>

                                <!-- เวลาด้านล่าง -->
                                <?php
                                $start = date("d M Y H:i", strtotime($row->start_date));
                                $end   = date("d M Y H:i", strtotime($row->end_date));
                                ?>

                                <div class="lg:mt-auto lg:pt-4 flex flex-row lg:flex-none lg:flex-col">
                                    <div class="lg:border-t border-r border-gray-200 mb-3"></div>
                                    <div class="text-sm text-gray-500 flex lg:items-center gap-2">
                                        <span></span>
                                        <span><?= $start ?> -<br class="lg:hidden"> <?= $end ?></span>
                                    </div>
                                </div>

                            </div>

                            <!-- ฝั่งขวา -->
                            <div class="lg:w-[10vw] flex lg:flex-col items-center lg:justify-center justify-between
                    bg-white/60 rounded-xl px-4 lg:py-4 shadow-inner">

                                <div class="flex-col items-center justify-center w-2/3">
                                    <span class="text-xs text-gray-500 uppercase tracking-wide justify-center">
                                        ผู้เข้าร่วม
                                    </span>
                                    <br>
                                    <span class="text-lg font-bold text-gray-800 my-2">
                                        <?= (int)$row->approved_count ?> / <?= $row->event_capacity ?>
                                    </span>
                                </div>

                                <?php if (isset($_SESSION['user_id'])) { ?>
                                    <?php if ($row->event_status === 'Open' && strtotime($row->end_date) > time()): ?>

                                        <form method="POST" action="" class="w-full flex lg:justify-center justify-end">
                                            <input type="hidden" name="event_id" value="<?= $row->eid ?>">
                                            <button type="submit" name="join"
                                                class="lg:w-full w-1/2 bg-green-500 hover:bg-green-600
                                                        text-white text-sm font-medium
                                                        py-2 rounded-full shadow
                                                        transition duration-200">
                                                เข้าร่วม
                                            </button>
                                        </form>

                                    <?php else: ?>

                                        <div class="lg:w-full w-1/2 text-center bg-gray-400
                                                    text-white text-sm font-medium
                                                    py-2 rounded-full shadow">
                                            หมดเวลา
                                        </div>

                                    <?php endif; ?>
                                <?php } else { ?>
                                    <a href="/login" class="lg:w-full w-1/2 text-center bg-green-500 hover:bg-green-600
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