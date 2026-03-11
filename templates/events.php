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
                }
            }
        }
    </script>
</head>

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] h-screen w-full flex overflow-hidden font-sans text-gray-800">

    <div class="">
        <?php include 'sideNav_allEvents.php'; ?>
    </div>

    <div
        class="flex-1 bg-white/75 xl:my-4 xl:mr-4 xl:rounded-[2rem] shadow-sm border border-[#213C51]/50 flex flex-col overflow-hidden">
        <div class="relative px-8 py-6 flex items-start flex-shrink-0">
            <div class="flex xl:hidden items-center justify-start">
                <button id="openMenuBtn" type="button" onclick="openMenu();">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="25px" height="25px" viewBox="0 0 24 24">
                        <path d="M2,4A1,1,0,0,1,3,3H21a1,1,0,0,1,0,2H3A1,1,0,0,1,2,4Zm1,9H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Zm0,8H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Z" />
                    </svg>
                </button>
            </div>
            <a class="xl:sticky xl:top-0 fixed bottom-5 right-5 w-14 h-14 py-6 bg-[#6594B1]  rounded-full flex items-center justify-center text-4xl font-semibold text-black shadow-sm hover:bg-[#213C51] hover:text-white transition-colors"
                href="/event_create">
                <svg fill="white" width="30" height="30" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512" height="512">
                    <path d="M17,11H13V7a1,1,0,0,0-1-1h0a1,1,0,0,0-1,1v4H7a1,1,0,0,0-1,1H6a1,1,0,0,0,1,1h4v4a1,1,0,0,0,1,1h0a1,1,0,0,0,1-1V13h4a1,1,0,0,0,1-1h0A1,1,0,0,0,17,11Z" />
                </svg>
            </a>

        </div>

        <div class="overflow-y-auto px-8 xl:pb-8 flex flex-col gap-4 h-full
                    [&::-webkit-scrollbar]:w-2
                  [&::-webkit-scrollbar-thumb]:bg-[#213C51]
                    [&::-webkit-scrollbar-thumb]:rounded-full
            ">
            <?php while ($row = $data['result']->fetch_object()) { ?>
                <?php
                $isExpired = strtotime($row->end_date) <= time();
                $isClosed  = $row->event_status === 'Closed';
                ?>
                <div id="card" class="bg-white/30 rounded-2xl flex --webkit-box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); --moz-box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border 
                            <?= ($isClosed || $isExpired) ? 'border-red-200' : 'border-green-200' ?>
                            hover:bg-white/50 transition-all shadow-md hover:shadow-xl min-h-[45vh] xl:flex-row flex-col xl:min-h-[170px]
            xl:overflow-hidden">
                    <div class="xl:w-[18vw] xl:h-full w-full max-h-48 h-1/2 bg-imagePlaceholder flex-shrink-0 xl:rounded-l-xl xl:rounded-r-none rounded-t-xl">
                        <?php
                        $imgPath = 'uploads/events/' . $row->cover_image;
                        if (!empty($row->cover_image) && file_exists($imgPath)): ?>
                            <img src="/uploads/events/<?= htmlspecialchars($row->cover_image) ?>"
                                class="w-full h-full object-cover rounded-t-xl xl:rounded-r-none">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-40 bg-gray-500 rounded-t-2xl xl:rounded-r-none">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="24" height="24" rx="4" fill="white" fill-opacity="0.3" />
                                    <path d="M4 16l4.5-4.5 3 3 4-4.5L20 16H4z" fill="white" fill-opacity="0.7" />
                                    <circle cx="8.5" cy="8.5" r="1.5" fill="white" fill-opacity="0.7" />
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1 flex px-8 py-5 flex-col xl:flex-row">
                        <div class="flex flex-1 xl:flex-col flex-row">

                            <div class="flex flex-col xl:w-2/3 w-1/3 flex-1">
                                <div class="flex items-start gap-2 flex-row">

                                    <h3 class="text-lg font-medium text-gray-800 truncate">
                                        <?= $row->event_name ?>
                                    </h3>

                                    <?php if ($isClosed || $isExpired): ?>
                                        <span class="hidden xl:inline-block px-2 py-1 text-xs font-semibold
                            bg-red-100 text-red-600
                            rounded-full">
                                            ปิดแล้ว
                                        <?php else: ?>
                                            <span class="hidden xl:inline-block px-2 py-1 text-xs font-semibold
                            bg-green-100 text-green-600
                            rounded-full">
                                                เปิดรับสมัคร
                                            </span>
                                        <?php endif; ?>
                                </div>

                                <p class="grow text-[12px] text-gray-500 mt-1 leading-relaxed max-w-lg truncate">
                                    <?= $row->event_detail ?>
                                </p>
                            </div>

                            <?php
                            $start = date("d M Y H:i", strtotime($row->start_date));
                            $end   = date("d M Y H:i", strtotime($row->end_date));
                            ?>

                            <div class="w-2/3 xl:w-full">

                                <?php if ($isClosed || $isExpired): ?>
                                    <span class="xl:hidden inline-block px-2 py-1 text-xs font-semibold
                            bg-red-100 text-red-600
                            rounded-full">
                                        ปิดแล้ว
                                    </span>
                                <?php else: ?>
                                    <span class="xl:hidden inline-block px-2 py-1 text-xs font-semibold
                            bg-green-100 text-green-600
                            rounded-full">
                                        เปิดรับสมัคร
                                    </span>
                                <?php endif; ?>

                                <div class="xl:border-t border-l border-white/50 mb-3"></div>
                                <div class="text-sm text-gray-500 flex gap-2">
                                    <span></span>
                                    <span><?= $start ?> - <?= $end ?></span>
                                </div>
                            </div>

                        </div>
                        <div class="flex xl:flex-col items-center xl:justify-center justify-between min-w-[120px] gap-3">
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-600">ผู้เข้าร่วม</span>
                                <span class="text-sm font-medium text-gray-800 mb-3"><?= (int)$row->approved_count ?> /
                                    <?= $row->event_capacity ?> </span>
                            </div>
                            <div class="flex gap-2">
                                <a class="w-20 bg-blue-500 hover:bg-blue-600 transition-colors text-white text-xs font-medium px-6 py-2 rounded-full shadow-sm whitespace-nowrap"
                                    href="/set_sessionEid?eid=<?= (int)$row->eid ?>&page=event_join">
                                    สถิติ
                                </a>

                            <a class="w-20 bg-gray-500 hover:bg-gray-600 transition-colors text-white text-xs font-medium px-6 py-2 rounded-full shadow-sm"
                                href="/set_sessionEid?eid=<?= (int)$row->eid ?>">
                                จัดการ
                            </a>
                            
                            <a class="w-20 bg-blue-500 hover:bg-blue-600 transition-colors text-white text-xs font-medium px-6 py-2 rounded-full shadow-sm"
                                href="/set_sessionEid?eid=<?= (int)$row->eid ?>&page=event_join">
                                สถิติ
                            </a>
                            
                        </div>
                    </div>
                </div>


            <?php } ?>
        </div>
    </div>

</body>

</html>