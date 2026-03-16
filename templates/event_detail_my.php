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

    <?php $row = $data['result']; ?>

    <!-- Side Nav -->
    <div class="flex-shrink-0">
        <?php include 'sideNav_home.php'; ?>
    </div>

    <!-- Main panel -->
    <div class="flex-1 relative bg-white/75 xl:my-4 xl:mr-4 xl:rounded-[2rem] shadow-sm border border-[#DDAED3]/50 flex flex-col overflow-hidden">

        <div class="overflow-y-scroll flex-1 px-8 py-6 flex flex-col gap-6
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
                        <div class="flex overflow-x-scroll snap-x snap-mandatory scroll-smooth gap-4 pb-2 
                    [&::-webkit-scrollbar]:h-1 
                  [&::-webkit-scrollbar-thumb]:bg-white/75
                    [&::-webkit-scrollbar-thumb]:rounded-full
                ">
                            <?php if (!empty($data['pictures'])): ?>
                                <?php while ($pic = $data['pictures']->fetch_object()): ?>
                                    <div class="flex-shrink-0 w-72 h-28 rounded-xl overflow-hidden shadow snap-center">
                                        <img src="/uploads/events/<?= $pic->picture_name ?>"
                                            class="w-full h-full object-cover">
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>



                    <!-- ปุ่มเข้าร่วม -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="flex flex-row-reverse justify-around bg-white/30 backdrop-blur-sm rounded-2xl sticky bottom-0 p-3 border-gray-100 border-2">
                            <div class="w-[140px] flex-shrink-0 flex flex-col items-center justify-center">
                                <span class="text-sm text-gray-600 mb-0.5">สถานะ</span>

                                <div class="flex gap-2 mb-3 flex-col">
                                    <div class="flex flex-row gap-2 mb-3">
                                        <?php
                                        $statusColor = '';
                                        $statusText = '';
                                        if ($row->status == 'wait') {
                                            $statusColor = '#fbbf24';
                                            $statusText = "รออนุมัติ";
                                        } elseif ($row->status == 'approved') {
                                            $statusColor = '#22c55e';
                                            $statusText = "อนุมัติแล้ว";
                                        } elseif ($row->status == 'rejected') {
                                            $statusColor = '#ef4444';
                                            $statusText = "ถูกปฏิเสธ";
                                        }
                                        ?>
                                        <svg class="pt-1" width="20" height="20" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="6" cy="6" r="5" fill="<?= $statusColor ?>" opacity="0.8" />
                                            <circle cx="6" cy="6" r="5" fill="none" stroke="<?= $statusColor ?>" stroke-width="1" opacity="0.3" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-800">
                                            <?= $statusText ?>
                                        </span>
                                    </div>

                                    <div class="flex flex-row gap-2 mb-3">
                                        <?php
                                        $checkInStatusColor = '';
                                        $checkInStatusText = '';
                                        if ($row->checkin_time == null && $row->status == 'approved') {
                                            $checkInStatusColor = '#fbbf24';
                                            $checkInStatusText = "ยังไม่เช็คชื่อ";
                                        } elseif ($row->checkin_time != null && $row->status == 'approved') {
                                            $checkInStatusColor = '#22c55e';
                                            $checkInStatusText = "เช็คชื่อแล้ว";
                                        }
                                        ?>
                                        <svg class="pt-1" width="20" height="20" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="6" cy="6" r="5" fill="<?= $checkInStatusColor ?>" opacity="0.8" />
                                            <circle cx="6" cy="6" r="5" fill="none" stroke="<?= $checkInStatusColor ?>" stroke-width="1" opacity="0.3" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-800">
                                            <?= $checkInStatusText ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="w-1/2 flex-shrink-0 flex flex-col items-center justify-center gap-2">
                                <?php
                                if (
                                    isset($_POST['request_otp']) &&
                                    isset($_POST['otp_event_id']) &&
                                    $_POST['otp_event_id'] == $row->eid
                                    && $row->status == 'approved'
                                ) {
                                    $uid = $_SESSION['user_id'];
                                    $otp = generateOTP($uid, $row->eid);
                                ?>
                                    <div class="mt-2 w-1/2">
                                        <input type="text" value="<?= htmlspecialchars($otp) ?>" readonly class="w-full px-3 py-2 text-sm border-gray-300 rounded-lg bg-gray-50 text-center font-mono font-bold">
                                    </div>
                                <?php } ?>
                                <?php if ($row->status == 'approved') { ?>
                                    <?php if (empty($row->checkin_time)) { ?>
                                        <form method="POST"  class="">
                                            <input type="hidden" name="otp_event_id" value="<?= $row->eid ?>">
                                            <button type="submit" name="request_otp" class="bg-[#DDAED3] hover:bg-[#DBC3D6] transition-colors text-white text-xs font-medium px-4 py-2 rounded-full shadow-sm">ขอ OTP</button>
                                        </form>
                                    <?php } else { ?>
                                        <span class="text-sm font-medium text-green-600">เข้างานแล้ว</span>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <input type="hidden" name="event_id" value="<?= $row->eid ?>">
                        <button type="submit" name="cancel" onclick="return confirmCancel('<?= $row->event_name ?>')" class="bg-red-500 hover:bg-red-700 transition-colors
                                     text-white text-xs font-medium px-6 py-2 rounded-full text-nowrap shadow-sm">
                            <div class="w-fit flex gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="20px" width="20px" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve">
                                    <style type="text/css">
                                        .st0 {
                                            fill: #ffffff;
                                        }
                                    </style>
                                    <g>
                                        <path class="st0" d="M355.022,115.897c22.422,0,40.603-18.19,40.603-40.616c0-22.427-18.181-40.608-40.603-40.608   c-22.434,0-40.616,18.182-40.616,40.608C314.406,97.707,332.588,115.897,355.022,115.897z" />
                                        <path class="st0" d="M509.402,232.445l-26.925-40.501c-6.543-9.57-15.22-17.486-25.33-23.155l-52.81-29.574   c-9.676-4.524-16.996-7.402-26.189-6.159l-25.268,3.436c-9.422,1.275-18.01,6.077-24.037,13.429l-48.096,51.183l-44.055,16.244   c-8.346,3.075-12.825,12.137-10.186,20.627l0.204,0.654c2.593,8.358,11.196,13.29,19.715,11.327l35.901-8.284   c8.952-2.07,17.458-5.758,25.072-10.894l24.97-16.783l8.816,67.033c0.647,4.916-0.343,9.913-2.822,14.214l-74.758,129.848   c-5.333,9.242-2.176,21.068,7.05,26.45l0.642,0.376c8.735,5.087,19.908,2.633,25.69-5.643l83.558-119.534l25.322,50.537   c1.873,3.738,4.351,7.132,7.336,10.044l56.164,54.92c7.091,6.928,18.305,7.23,25.747,0.712l0.9-0.786   c3.819-3.345,6.134-8.073,6.436-13.135c0.302-5.055-1.431-10.036-4.826-13.806l-47.421-52.818L424.44,269.16l-0.09,0.082   l-7.394-72.947l26.115,11.753l41.752,43.945c5.251,5.537,13.757,6.429,20.038,2.094l0.426-0.295   C512.256,248.999,514.096,239.495,509.402,232.445z" />
                                        <polygon class="st0" points="129.123,101.06 43.287,42.435 262.74,42.435 262.74,8.934 0,8.934 0,444.44 43.287,444.44    129.123,503.066 129.123,486.315 129.123,444.44 233.8,444.44 233.8,410.94 129.123,410.94  " />
                                    </g>
                                </svg>
                                <h6>ยกเลิกเข้าร่วม</h6>
                            </div>
                        </button>
                    </form>

        </div>
    </div>

    <script>
        function confirmCancel(event_name) {
            return confirm("ต้องการยกเลิกเข้า " + event_name + " มั้ย ?");
        }
    </script>

</body>

</html>