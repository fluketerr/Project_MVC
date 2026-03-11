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

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#DBC3D6_25%,#DDAED3_100%)] h-screen w-full flex overflow-hidden font-sans text-gray-800">

    <div class="">
        <?php include 'sideNav_home.php'; ?>
    </div>

    <div class="flex-1 bg-white/75 xl:my-4 xl:mr-4 xl:rounded-[2rem] shadow-sm border border-[#DDAED3]/50 flex flex-col overflow-hidden">

        <div class="xl:px-8 px-3 py-6 flex items-start gap-4 flex-shrink-0">
            <div class="relative w-[320px] gap-2">
                <form method="GET" class="flex gap-3">
                    <div class="flex xl:hidden items-center justify-start">
                        <button id="openMenuBtn" type="button" onclick="openMenu();">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="25px" height="25px" viewBox="0 0 24 24">
                                <path d="M2,4A1,1,0,0,1,3,3H21a1,1,0,0,1,0,2H3A1,1,0,0,1,2,4Zm1,9H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Zm0,8H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Z" />
                            </svg>
                        </button>
                    </div>
                    <input type="hidden" name="page" value="my_events">
                    <label for="">สถานะ : </label>
                    <select name="status" class="bg-white text-sm text-gray-600
                      rounded-full px-2
                      border border-gray-200
                      shadow-sm focus:ring-2 focus:ring-green-400 appearance-none"
                        onchange="this.form.submit()">
                        <option value=""> ทั้งหมด</option>
                        <option value="wait" <?= ($_GET['status'] ?? '') == 'wait' ? 'selected' : '' ?>>รออนุมัติ</option>
                        <option value="approved" <?= ($_GET['status'] ?? '') == 'approved' ? 'selected' : '' ?>>อนุมัติแล้ว</option>
                        <option value="rejected" <?= ($_GET['status'] ?? '') == 'rejected' ? 'selected' : '' ?>>ปฏิเสธ</option>
                    </select>

                </form>
            </div>
            <p><?= $_SESSION['message'] ?? '';
                unset($_SESSION['message']); ?></p>

        </div>
        <?php if ($data['result'] && $data['result']->num_rows > 0) { ?>
            <div class="overflow-y-auto xl:px-8 pb-8 flex flex-col gap-4
                    [&::-webkit-scrollbar]:w-2 
                  [&::-webkit-scrollbar-thumb]:bg-[#DDAED3]
                    [&::-webkit-scrollbar-thumb]:rounded-full
                ">

                <?php while ($row = $data['result']->fetch_object()) { ?>
                    <!--my event-->

                    <div class="bg-white/30 backdrop-blur-sm rounded-2xl flex xl:flex-row flex-col xl:min-h-[170px]
            xl:overflow-hidden border border-white/50
            shadow-md hover:shadow-xl hover:bg-white/60
            transition-all duration-300">
                        <div class="xl:w-[25vw] xl:h-full w-full max-h-44 h-1/3 bg-imagePlaceholder flex-shrink-0 xl:rounded-l-xl xl:rounded-r-none rounded-t-xl overflow-hidden">
                            <?php
                            $imgPath = 'uploads/events/' . $row->cover_image;
                            if (!empty($row->cover_image) && file_exists($imgPath)): ?>
                                <img src="/uploads/events/<?= htmlspecialchars($row->cover_image) ?>" class="w-full h-full object-cover xl:rounded-l-xl xl:rounded-r-none rounded-t-xl">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-40 bg-gray-500 min-h-[190px] rounded-t-xl xl:rounded-r-none ">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="24" height="24" rx="4" fill="white" fill-opacity="0.3" />
                                        <path d="M4 16l4.5-4.5 3 3 4-4.5L20 16H4z" fill="white" fill-opacity="0.7" />
                                        <circle cx="8.5" cy="8.5" r="1.5" fill="white" fill-opacity="0.7" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="xl:flex-1 flex px-8 py-5 flex-col xl:flex-row">
                            <div class="flex flex-col flex-1 min-w-0 ">
                                <div class="w-full xl:max-w-[200px]">
                                    <h3 class="text-lg font-medium text-gray-800 truncate">
                                        <?= htmlspecialchars($row->event_name) ?>
                                    </h3>
                                    <p class="text-[12px] text-gray-500 mt-1 leading-relaxed xl:line-clamp-2 truncate">
                                        <?= htmlspecialchars($row->event_detail) ?>
                                    </p>
                                </div>

                                <?php
                                $start = date("d M Y H:i", strtotime($row->start_date));
                                $end   = date("d M Y H:i", strtotime($row->end_date));
                                ?>

                                <div class="xl:mt-auto xl:pt-4 flex flex-row xl:flex-none xl:flex-col justify-center mt-4">
                                    <div class="xl:border-t border-l border-gray-200 mb-3"></div>
                                    <div class="text-sm text-gray-500 flex xl:items-center gap-2  ">
                                        <span></span>
                                        <span class="text-nowrap"><?= $start ?> -<wbr><?= $end ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-row-reverse justify-between">
                                <div class="w-[140px] flex-shrink-0 flex flex-col items-center justify-center">
                                    <span class="text-sm text-gray-600 mb-0.5">สถานะ</span>

                                    <div class="flex gap-2 mb-3 xl:flex-col flex-row">
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
                                <div class="w-[140px] flex-shrink-0 flex flex-col items-center justify-center gap-2">
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
                                        <div class="mt-2 w-full ">
                                            <input type="text" value="<?= htmlspecialchars($otp) ?>" readonly class="w-full px-3 py-2 text-sm border-gray-300 rounded-lg bg-gray-50 text-center font-mono font-bold">
                                        </div>
                                    <?php } ?>
                                    <?php if ($row->status == 'approved') { ?>
                                        <?php if (empty($row->checkin_time)) { ?>
                                            <form method="POST">
                                                <input type="hidden" name="otp_event_id" value="<?= $row->eid ?>">
                                                <button type="submit" name="request_otp" class="bg-[#DDAED3] hover:bg-[#DBC3D6] transition-colors text-white text-xs font-medium px-4 py-2 rounded-full shadow-sm">ขอ OTP</button>
                                            </form>
                                        <?php } else { ?>
                                            <span class="text-sm font-medium text-green-600">เข้างานแล้ว</span>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="xl:w-[10vw] flex xl:flex-col items-center xl:justify-center justify-between
                    bg-white/60 rounded-xl px-4 xl:py-4 shadow-inner">
                                <div>
                                    <span class="text-sm text-gray-600 mb-0.5">ผู้เข้าร่วม</span><br>
                                    <span class="text-sm font-medium text-gray-800 mb-3">
                                        <?= (int)$row->approved_count ?> / <?= $row->event_capacity ?>
                                    </span>
                                </div>
                                <form method="POST">
                                    <input type="hidden" name="event_id" value="<?= $row->eid ?>">
                                    <button type="submit" name="cancel" onclick="return confirmCancel('<?= $row->event_name ?>')" class="bg-red-500 hover:bg-red-700 transition-colors
                                     text-white text-xs font-medium px-6 py-2 rounded-full text-nowrap shadow-sm">
                                     ยกเลิกเข้าร่วม</button>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="px-8 py-6">
                <p>ไม่มีข้อมูล</p>
            </div>
        <?php } ?>

    </div>

    <script>
        function confirmCancel(event_name) {
            return confirm("ต้องการยกเลิกเข้า " + event_name + " มั้ย ?");
        }
    </script>

</body>

</html>