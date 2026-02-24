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
                            <div class="flex-1 pr-4 min-w-0">
                                <h3 class="text-lg font-medium text-gray-800 truncate">
                                    <?= htmlspecialchars($row->event_name) ?>
                                </h3>
                                <p class="text-[12px] text-gray-500 mt-1 leading-relaxed line-clamp-2">
                                    <?= htmlspecialchars($row->event_detail) ?>
                                </p>
                            </div>

                            <div class="w-[140px] flex-shrink-0 flex flex-col items-center justify-center">
                                <span class="text-sm text-gray-600 mb-0.5">ผู้เข้าร่วม</span>
                                <span class="text-sm font-medium text-gray-800 mb-3">
                                    0 / <?= $row->event_capacity ?>
                                </span>
                                <form method="POST" action="">
                                    <input type="hidden" name="event_id" value="<?= $row->eid ?>">
                                    <button class="bg-btnGreen hover:bg-btnGreenHover transition-colors text-white text-xs font-medium px-6 py-2 rounded-full shadow-sm">
                                        เข้าร่วม
                                    </button>
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
