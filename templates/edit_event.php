<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] h-screen w-full flex overflow-hidden font-sans text-gray-800">

    <div>
        <?php include 'sideNav_event.php'; ?>
    </div>

    <main class="flex flex-col flex-1 w-full">
        <div class="text-4xl px-3 pt-6">
            <?= $data['title'] ?>
        </div>
        <?php $event = $data['event']->fetch_object() ?>

        <div class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem] shadow-sm border border-white/50 p-16">

            <form action="update_event" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="eid" value="<?= (int)$event->eid ?>">
                <div class="grid grid-cols-2 gap-2">
                    <!-- LEFT SIDE -->
                    <div>

                        <h3 class="mb-3 font-medium">รูปภาพปัจจุบัน</h3>
                        <div class="flex flex-wrap gap-3 mb-6">
                            <?php if (!empty($data['pictures'])): ?>
                                <?php while ($pic = $data['pictures']->fetch_object()): ?>
                                    <div class="text-center">
                                        <img src="/uploads/events/<?= $pic->picture_name ?>"
                                            class="w-32 h-32 object-cover rounded-xl shadow">
                                        <label class="text-sm">
                                            <input type="checkbox"
                                                name="delete_pictures[]"
                                                value="<?= $pic->pid ?>">
                                            ลบ
                                        </label>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                ไม่มีรูป
                            <?php endif; ?>
                        </div>


                        <h3 class="mb-2 font-medium">เพิ่มรูปใหม่</h3>

                        <input type="file"
                            name="new_pictures[]"
                            multiple
                            class="mb-6">

                    </div>

                    <!-- RIGHT SIDE -->
                    <div class="space-y-4">

                        <div>
                            <label>ชื่องาน</label>
                            <input type="text"
                                name="event_name"
                                value="<?= $event->event_name ?>"
                                required
                                class="w-full px-4 py-2 rounded-full bg-white shadow" />
                        </div>


                        <div>
                            <label>จำนวนผู้เข้าร่วม</label>
                            <input type="number"
                                name="event_capacity"
                                value="<?= $event->event_capacity ?>"
                                required
                                class="w-32 px-4 py-2 rounded-full bg-white shadow" />
                        </div>

                        <div>
                            <label>ระยะเวลากิจกรรม</label>

                            <div class="flex gap-3">
                                <input type="datetime-local"
                                    name="start_date"
                                    value="<?= str_replace(' ', 'T', substr($event->start_date, 0, 16)) ?>"
                                    class="px-3 py-2 rounded-full shadow">
                                <span class="self-center">ถึง</span>

                                <input type="datetime-local"
                                    name="end_date"
                                    value="<?= str_replace(' ', 'T', substr($event->end_date, 0, 16)) ?>"
                                    class="px-3 py-2 rounded-full shadow">

                            </div>
                        </div>

                        <div>
                            <label>รายละเอียด</label>
                            <textarea
                                name="event_detail"
                                required
                                class="w-full h-40 rounded-2xl shadow p-3"><?= $event->event_detail ?></textarea>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit"
                                class="px-8 py-2 rounded-fullbg-gray-400 text-whitehover:bg-gray-500 transition">
                                บันทึก
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

</body>

</html>