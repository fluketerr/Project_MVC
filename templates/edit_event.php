<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>

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
        <?php $event = $data['event']->fetch_object() ?>

<<<<<<< HEAD
        <div class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem] shadow-sm border border-white/50 p-16">
=======
        <div class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem]
<<<<<<< HEAD
shadow-sm border border-white/50 p-16 overflow-y-auto">
>>>>>>> 2afc6e022c08a2fc155b0dbf139c2d73906dfcdc
=======
                    shadow-sm border border-[#213C51]/50 p-16 overflow-y-auto
                    [&::-webkit-scrollbar]:w-2
                  [&::-webkit-scrollbar-thumb]:bg-[#213C51]
                    [&::-webkit-scrollbar-thumb]:rounded-full
">
>>>>>>> dd5f9aa66b78dfa3883733f04bae68e9b2cf2318

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

                <div class="grid grid-cols-2 gap-10 mb-5">

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
                        <div class="flex h-[60vh] w-full flex-wrap gap-8 bg-gray-50 p-6 rounded-2xl border border-gray-300 overflow-y-scroll
                                    [&::-webkit-scrollbar]:w-2
                                  [&::-webkit-scrollbar-thumb]:bg-gray-400
                                    [&::-webkit-scrollbar-thumb]:rounded-full
                                    ">
                            <?php while ($pic = $data['pictures']->fetch_object()): ?>
                                <div class="text-center" id="imageContainer">
                                    <img src="/uploads/events/<?= $pic->picture_name ?>"
                                        class="w-52 h-36 object-cover rounded-2xl shadow-md">
                                    <label class="flex items-center justify-center gap-2 mt-3 cursor-pointer">
                                        <input
                                            type="checkbox"
                                            name="delete_pictures[]"
                                            value="<?= $pic->pid ?>"
                                            class="w-4 h-4 cursor-pointer accent-red-500 rounded-sm" />
                                        <span class="text-red-500 text-sm font-medium">ลบรูป</span>
                                    </label>
                                </div>
                            <?php endwhile; ?>
                        </div>



                    </div>

                    <!-- RIGHT -->
                    <div class="space-y-5">

                        <div>
                            <label class="block mb-2 font-medium text-[#1E293B]">ชื่องาน</label>
                            <input type="text"
                                name="event_name"
                                value="<?= $event->event_name ?>"
                                class="w-full px-6 py-4 rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-400 outline-none">
                        </div>

                        <div>
                            <label class="block mb-2 font-medium text-[#1E293B]">จำนวนผู้เข้าร่วม</label>
                            <input type="number"
                                name="event_capacity"
                                value="<?= $event->event_capacity ?>"
                                class="w-56 px-6 py-4 rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-400 outline-none">
                        </div>

                        <div>
                            <label class="block mb-3 font-medium text-[#1E293B]">ระยะเวลากิจกรรม</label>
                            <div class="flex gap-6">
                                <input type="datetime-local"
                                    name="start_date"
                                    value="<?= str_replace(' ', 'T', substr($event->start_date, 0, 16)) ?>"
                                    class="px-5 py-4 rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-400">

                                <input type="datetime-local"
                                    name="end_date"
                                    value="<?= str_replace(' ', 'T', substr($event->end_date, 0, 16)) ?>"
                                    class="px-5 py-4 rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-400">
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium text-[#1E293B]">รายละเอียด</label>
                            <textarea
                                name="event_detail"
                                class="w-full h-48 px-6 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-blue-400"><?= $event->event_detail ?></textarea>
                        </div>

                        <div class="flex justify-end gap-6 pt-6">

                            <a href="/edit_event"
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

<<<<<<< HEAD

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
=======
                <div class="w-full flex">
                    <a href="/delete_event?eid=<?= (int)$event->eid ?>" onclick="return confirmDelete()" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition-all bg-red-600 rounded-3xl hover:bg-red-700 active:scale-95 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        ลบกิจกรรม
                    </a>
                </div>

                <script>
                    function confirmDelete() {
                        return confirm("ต้องการลบกิจกรรมนี้มั้ย ?");
                    }
                </script>

>>>>>>> dd5f9aa66b78dfa3883733f04bae68e9b2cf2318
            </form>
        </div>
<<<<<<< HEAD
=======
        </div>
>>>>>>> 2afc6e022c08a2fc155b0dbf139c2d73906dfcdc
    </main>

</body>

</html>