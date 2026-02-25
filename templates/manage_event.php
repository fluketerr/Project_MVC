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
    <main class="flex flex-col flex-1 w-full overflow-x-auto">
        <?php $row = $data['event']->fetch_object(); ?>
        <div class="text-4xl px-3 pt-6">
            กิจกรรม
        </div>
        <div class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem] shadow-sm border border-white/50 p-8 flex flex-col overflow-y-hidden">

            <!-- Header Section -->
            <div class="flex gap-8">

                <!-- Cover Image -->
                <?php if (!empty($data['pictures']) && $pic = $data['pictures']->fetch_object()): ?>

                    <div class="w-[420px] h-[240px]">
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

                        <p class="text-gray-500 text-sm">
                            <?= $row->start_date ?> - <?= $row->end_date ?>
                        </p>

                        <p class="text-gray-600 mt-4 max-w-xl">
                            <?= $row->event_detail ?>
                        </p>
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
                            <div class="bg-blue-500 h-2 rounded-full"
                                style="width: <?= min(100, $percent) ?>%">
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Gallery Section -->
            <div class="mt-4 ">
                <div class="flex overflow-x-auto snap-x snap-mandatory scroll-smooth gap-4 pb-2 
                    [&::-webkit-scrollbar]:h-2 
                  [&::-webkit-scrollbar-thumb]:bg-[#EEEEEE]
                    [&::-webkit-scrollbar-thumb]:rounded-full
                    [&::-webkit-scrollbar-th]:
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

                <form action="/check_otp" method="POST"
                    class="bg-white/70 p-8 rounded-2xl
               border border-gray-100 
               flex items-end gap-6">

                    <input type="hidden" name="eid" value="<?= (int)$row->eid ?>">

                    <!-- UID -->
                    <div class="flex flex-col">
                        <label class="text-sm text-gray-500 mb-2">UID</label>
                        <input type="text" name="uid"
                            class="w-40 border border-gray-300 rounded-lg px-3 py-2
                       focus:ring-2 focus:ring-blue-400 focus:outline-none
                       text-center"
                            required>
                    </div>

                    <!-- OTP -->
                    <div class="flex flex-col">
                        <label class="text-sm text-gray-500 mb-2">OTP</label>
                        <input type="tel" name="otp" maxlength="6"
                            class="w-48 border border-gray-300 rounded-lg px-3 py-2
                       focus:ring-2 focus:ring-blue-400 focus:outline-none
                       text-center tracking-widest font-semibold"
                            required>
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 
                   text-white px-6 py-2 rounded-lg 
                   transition shadow">
                        เช็คชื่อ
                    </button>
                </form>
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