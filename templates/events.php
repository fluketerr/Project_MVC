<?php
// Side Navigation Component
?>

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

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] h-screen w-full flex overflow-hidden font-sans text-gray-800">

    <div class="">
        <?php include 'sideNav_home.php'; ?>
    </div>

    <div class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem] shadow-sm border border-white/50 flex flex-col overflow-hidden">

        <div class="px-8 py-6 flex items-start flex-shrink-0">
        
            <a class="w-14 h-14 bg-[#6594B1]  rounded-full flex items-center justify-center text-4xl font-semibold text-black shadow-sm hover:bg-[#213C51] hover:text-white transition-colors"
                href="/create_event">
                +
            </a>

        </div>

        <div class="flex-1 overflow-y-auto px-8 pb-8 flex flex-col gap-4">
            <?php while ($row = $data['result']->fetch_object()) { ?>
                <div class="bg-white rounded-2xl flex h-[150px] overflow-hidden shadow-sm">
                    <div class="w-[280px] h-[150px] bg-imagePlaceholder flex-shrink-0 overflow-hidden">
                        <?php if (!empty($row->cover_image)): ?>
                            <img src="/uploads/events/<?= htmlspecialchars($row->cover_image) ?>"
                                class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="flex items-center justify-center h-full">
                                ไม่มีรูป
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1 flex px-8 py-5">
                        <div class="flex-1 pr-4">
                            <h3 class="text-lg font-medium text-gray-800"><?= $row->event_name ?></td></h3>
                            <p class="text-[12px] text-gray-500 mt-1 leading-relaxed max-w-lg">
                                <?= $row->event_detail ?>
                            </p>
                        </div>
                        <div class="flex flex-col items-center justify-center min-w-[120px]">
                            <span class="text-sm text-gray-600 mb-0.5">ผู้เข้าร่วม</span>
                            <span class="text-sm font-medium text-gray-800 mb-3"><?= (int)$row->approved_count ?> / <?= $row->event_capacity ?>   </span>
                            <a class="bg-btnGreen hover:bg-btnGreenHover transition-colors text-white text-xs font-medium px-6 py-2 rounded-full shadow-sm"
                                href="/set_sessionEid?eid=<?= (int)$row->eid ?>">
                                จัดการ
                            </a>
                        </div>
                    </div>
                </div>

                
            <?php } ?>
        </div>
    </div>

</body>

</html>