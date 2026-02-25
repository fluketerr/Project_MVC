<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<<<<<<< HEAD
<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] h-screen w-full flex overflow-hidden font-sans text-gray-800">
=======
<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] 
h-screen w-full flex overflow-hidden font-sans text-gray-800">
>>>>>>> 2afc6e022c08a2fc155b0dbf139c2d73906dfcdc

    <div>
        <?php include 'sideNav_event.php'; ?>
    </div>

    <main class="flex flex-col flex-1 w-full">
        <div class="text-4xl px-3 pt-6">
            <?= $data['title'] ?>
        </div>
        <?php $event = $data['event']->fetch_object() ?>

<<<<<<< HEAD
        <div class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem] shadow-sm border border-white/50 p-16">
=======
        <div class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem]
shadow-sm border border-white/50 p-16 overflow-y-auto">
>>>>>>> 2afc6e022c08a2fc155b0dbf139c2d73906dfcdc

            <form action="update_event" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="eid" value="<?= (int)$event->eid ?>">
<<<<<<< HEAD
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
=======

                <div class="grid grid-cols-2 gap-20 ">

                    <!-- LEFT -->
                    <div class="space-y-10">

                        <h2 class="text-2xl font-semibold text-[#1E293B]">รูปภาพกิจกรรม</h2>
                        <div>
                            <label class="block mb-3 font-medium text-[#1E293B]">เพิ่มรูปใหม่</label>
                            <input type="file"
                                name="new_pictures[]"
                                multiple
                                class="block w-full text-sm text-gray-700
                              file:mr-4 file:py-2 file:px-6
                              file:rounded-full file:border-0
                              file:bg-gray-500 file:text-white
                              hover:file:bg-gray-600 transition-colors">
                        </div>
                        <div class="flex flex-wrap gap-8 bg-gray-50 p-6 rounded-2xl border border-gray-300">
                            <?php while ($pic = $data['pictures']->fetch_object()): ?>
                                <div class="text-center" id="imageContainer">
                                    <img src="/uploads/events/<?= $pic->picture_name ?>"
                                        class="w-52 h-36 object-cover rounded-2xl shadow-md">
                                    <label class="text-red-500 text-sm mt-2 block">
                                        <input type="checkbox"
                                            name="delete_pictures[]"
                                            value="<?= $pic->pid ?>"
                                            class="mr-1">
                                        ลบรูป
                                    </label>
                                </div>
                            <?php endwhile; ?>
                        </div>



                    </div>

                    <!-- RIGHT -->
                    <div class="space-y-10">

                        <div>
                            <label class="block mb-2 font-medium text-[#1E293B]">ชื่องาน</label>
                            <input type="text"
                                name="event_name"
                                value="<?= $event->event_name ?>"
                                class="w-full px-6 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-blue-400 outline-none">
                        </div>

                        <div>
                            <label class="block mb-2 font-medium text-[#1E293B]">จำนวนผู้เข้าร่วม</label>
                            <input type="number"
                                name="event_capacity"
                                value="<?= $event->event_capacity ?>"
                                class="w-56 px-6 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-blue-400 outline-none">
                        </div>

                        <div>
                            <label class="block mb-3 font-medium text-[#1E293B]">ระยะเวลากิจกรรม</label>
                            <div class="flex gap-6">
                                <input type="datetime-local"
                                    name="start_date"
                                    value="<?= str_replace(' ', 'T', substr($event->start_date, 0, 16)) ?>"
                                    class="px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-blue-400">

                                <input type="datetime-local"
                                    name="end_date"
                                    value="<?= str_replace(' ', 'T', substr($event->end_date, 0, 16)) ?>"
                                    class="px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-blue-400">
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium text-[#1E293B]">รายละเอียด</label>
                            <textarea
                                name="event_detail"
                                class="w-full h-48 px-6 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-blue-400"><?= $event->event_detail ?></textarea>
                        </div>

                        <div class="flex justify-end gap-6 pt-6">
                            <a href="/my_events"
                                class="px-8 py-3 rounded-full bg-gray-300 hover:bg-gray-400 transition text-[#1E293B]">
                                ยกเลิก
                            </a>

                            <button type="submit"
                                class="px-10 py-3 rounded-full bg-gray-500 hover:bg-gray-600 text-white transition shadow ">
                                บันทึกการเปลี่ยนแปลง
                            </button>
                        </div>

                    </div>

                </div>
>>>>>>> 2afc6e022c08a2fc155b0dbf139c2d73906dfcdc


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
<<<<<<< HEAD
=======
        </div>
>>>>>>> 2afc6e022c08a2fc155b0dbf139c2d73906dfcdc
    </main>

</body>

</html>