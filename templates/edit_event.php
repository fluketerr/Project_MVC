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

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] 
h-screen w-full flex overflow-hidden font-sans text-gray-800">

    <div>
        <?php include 'sideNav_event.php'; ?>
    </div>

    <main class="flex flex-col flex-1 w-full">
        <div class="text-4xl px-3 pt-6">
            แก้ไขกิจกรรม
        </div>
        <?php $event = $data['event']->fetch_object() ?>

        <div class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem]
shadow-sm border border-white/50 p-16 overflow-y-auto">

            <form action="update_event" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="eid" value="<?= (int)$event->eid ?>">

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

            </form>
        </div>
        </div>
    </main>

</body>

</html>