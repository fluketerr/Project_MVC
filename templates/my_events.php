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

    <div class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem] shadow-sm border border-white/50 flex flex-col overflow-hidden">

        <div class="px-8 py-6 flex items-start gap-4 flex-shrink-0">
            <div class="relative w-[320px] gap-2">
                <form method="GET">
                    <input type="hidden" name="page" value="my_events">
                    <label for="">สถานะ : </label>
                    <select name="status">
                        <option value="">ทั้งหมด</option>
                        <option value="wait" <?= ($_GET['status'] ?? '') == 'wait' ? 'selected' : '' ?>>รออนุมัติ</option>
                        <option value="approved" <?= ($_GET['status'] ?? '') == 'approved' ? 'selected' : '' ?>>อนุมัติแล้ว</option>
                        <option value="rejected" <?= ($_GET['status'] ?? '') == 'rejected' ? 'selected' : '' ?>>ปฏิเสธ</option>
                    </select>

                    <button type="submit">กรอง</button>
                </form>
            </div>
            <p><?= $_SESSION['message'] ?? '';
                unset($_SESSION['message']); ?></p>

        </div>
        <?php if ($data['result'] && $data['result']->num_rows > 0) { ?>
            <div class="overflow-y-auto px-8 pb-8 flex flex-col gap-4">

                <?php while ($row = $data['result']->fetch_object()) { ?>

                    <div class="bg-white/35 rounded-2xl flex min-h-[150px] overflow-hidden shadow-sm --webkit-box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); --moz-box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border border-white/50
                            hover:bg-white transition-colors">
                        <div class="w-[280px] bg-imagePlaceholder flex-shrink-0">
                            <?php if (!empty($row->cover_image)): ?>
                                <img src="/uploads/events/<?= htmlspecialchars($row->cover_image) ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    ไม่มีรูป
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 flex px-8 py-5">
                            <div class="flex flex-col flex-1 pr-4 min-w-0">
                                <h3 class="text-lg font-medium text-gray-800 truncate">
                                    <?= htmlspecialchars($row->event_name) ?>
                                </h3>
                                <p class="text-[12px] text-gray-500 mt-1 leading-relaxed line-clamp-2">
                                    <?= htmlspecialchars($row->event_detail) ?>
                                </p>

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

                            <div class="w-[140px] flex-shrink-0 flex flex-col items-center justify-center">
                                <span class="text-sm text-gray-600 mb-0.5">ผู้เข้าร่วม</span>
                                <span class="text-sm font-medium text-gray-800 mb-3">
                                    0 / <?= $row->event_capacity ?>
                                </span>
                                <form method="POST">
                                    <input type="hidden" name="event_id" value="<?= $row->eid ?>">
                                    <button type="submit" name="cancel" class="bg-red-500 hover:bg-red-700 transition-colors text-white text-xs font-medium px-6 py-2 rounded-full shadow-sm">ยกเลิกการเข้าร่วม</button>
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

</body>

</html>