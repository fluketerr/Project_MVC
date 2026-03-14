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

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] h-screen w-full flex  overflow-y-auto  font-sans text-gray-800">

    <div class="">
        <?php include 'sideNav_event.php'; ?>
    </div>
    <main class="flex flex-col flex-1 w-full overflow-x-auto">
        <?php $row = $data['event']->fetch_object(); ?>
        <div class="flex-1 bg-white/75 xl:my-4 xl:mr-4 xl:rounded-[2rem] shadow-sm border border-[#213C51]/50 p-8 flex flex-col overflow-y-auto
                [&::-webkit-scrollbar]:w-2
                [&::-webkit-scrollbar-thumb]:bg-[#213C51]
                [&::-webkit-scrollbar-thumb]:rounded-full
        ">

            <!-- Header Section -->
            <div class="flex gap-8 flex-col xl:flex-row">
                <div class="flex xl:hidden items-center justify-start">
                    <button id="openMenuBtn" type="button" onclick="openMenu();">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="25px" height="25px" viewBox="0 0 24 24">
                            <path d="M2,4A1,1,0,0,1,3,3H21a1,1,0,0,1,0,2H3A1,1,0,0,1,2,4Zm1,9H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Zm0,8H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Z" />
                        </svg>
                    </button>
                </div>

                <!-- Cover Image -->
                <?php if (!empty($data['pictures']) && $pic = $data['pictures']->fetch_object()): ?>

                    <div class="xl:w-[420px] h-[240px]">
                        <img src="/uploads/events/<?= $pic->picture_name ?>"
                            class="w-full h-full object-cover rounded-xl border border-gray-300">
                    </div>

                <?php else: ?>
                    ไม่มีรูป
                <?php endif; ?>

                <!-- Event Info -->
                <div class="flex-1 flex flex-col justify-between">

                    <div>
                        <h1 class="text-2xl font-bold mb-2">
                            <?= $row->event_name ?>
                        </h1>

                        <h2 class="text-gray-500 text-sm">
                            <?= $row->start_date ?> - <?= $row->end_date ?>
                        </h2>

                        <h3 class="text-gray-600 mt-4 max-w-xl">
                            <?= $row->event_detail ?>
                        </h3>
                    </div>

                    <!-- Capacity Section -->
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

            <!-- Gallery Section -->
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
            <div class="flex flex-col items-center justify-center pt-4">

                <?php
                $isExpired = strtotime($row->end_date) <= time();
                $isClosed  = $row->event_status === 'Closed';
                ?>
                
                <?php if(isset($_SESSION['message'])): ?>
                <div class="bg-red-100 border border-red-200
                                text-red-600 px-6 py-4 rounded-2xl
                                text-center font-medium mb-2 shadow">
                    <?= $_SESSION['message']." ".$_SESSION['error'] ?>
                    <?php unset($_SESSION['message']) ?>
                    <?php unset($_SESSION['error']) ?>
                </div>
                <?php endif; ?>

                <?php if (!$isClosed && !$isExpired): ?>

                    <form action="/check_otp" method="POST"
                        class="bg-white/70 p-8 rounded-2xl
                                border border-gray-100 
                                flex xl:items-end gap-6 flex-col">

                        <input type="hidden" name="eid" value="<?= (int)$row->eid ?>">

                        <div class="flex xl:flex-row flex-col xl:gap-6 gap-3">
                            <!-- UID -->
                            <div class="flex flex-col">
                                <label class="text-sm text-gray-500 mb-2">UID</label>
                                <input type="text" name="uid"
                                    class="w-48 border border-gray-300 rounded-lg px-3 py-2
                                        focus:ring-2 focus:ring-blue-400 focus:outline-none
                                        text-center"
                                    required>
                            </div>

                            <!-- OTP -->
                            <div class="flex flex-col">
                                <label class="text-sm text-gray-500 mb-2">OTP</label>
                                <input type="tel" name="otp" maxlength="6" placeholder="000000"
                                    class="w-48 border border-gray-300 rounded-lg px-3 py-2
                                focus:ring-2 focus:ring-blue-400 focus:outline-none
                                text-center tracking-widest font-semibold"
                                    required>
                            </div>
                        </div>

                        <button type="submit"
                            class="bg-[#6594B1] hover:bg-[#213C51] 
                            text-white px-6 py-2 rounded-lg w-full
                            transition shadow">
                            เช็คชื่อ
                        </button>

                    </form>

                <?php else: ?>

                    <div class="bg-red-100 border border-red-200
                                text-red-600 px-6 py-4 rounded-2xl
                                text-center font-medium shadow">
                        กิจกรรมนี้ปิดแล้ว ไม่สามารถเช็คชื่อได้
                    </div>

                <?php endif; ?>
                <?php if (isset($_SESSION['notice'])):

                    $type = $_SESSION['notice_type'] ?? 'success';

                    $styles = [
                        'success' => 'bg-green-100 border-green-400 text-green-700',
                        'error'   => 'bg-red-100 border-red-400 text-red-700',
                        'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
                    ];
                ?>
                    <div class="mt-4 p-4 rounded-lg shadow-md border <?= $styles[$type]; ?>">
                        <?= $_SESSION['notice']; ?>
                    </div>
                <?php
                    unset($_SESSION['notice']);
                    unset($_SESSION['notice_type']);
                endif;
                ?>

            </div>
        </div>
    </main>


</body>

</html>