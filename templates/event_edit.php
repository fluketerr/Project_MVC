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
        <?php $event = $data['event']->fetch_object() ?>

        <div class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem]
                    shadow-sm border border-[#213C51]/50 p-16 overflow-y-auto
                    [&::-webkit-scrollbar]:w-2
                  [&::-webkit-scrollbar-thumb]:bg-[#213C51]
                    [&::-webkit-scrollbar-thumb]:rounded-full
">
            >>>>>>> dd5f9aa66b78dfa3883733f04bae68e9b2cf2318

            <form action="event_update" method="POST" enctype="multipart/form-data">
                <div class="flex xl:hidden items-center justify-start">
                    <button id="openMenuBtn" type="button" onclick="openMenu();">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="25px" height="25px" viewBox="0 0 24 24">
                            <path d="M2,4A1,1,0,0,1,3,3H21a1,1,0,0,1,0,2H3A1,1,0,0,1,2,4Zm1,9H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Zm0,8H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Z" />
                        </svg>
                    </button>
                </div>
                <input type="hidden" name="eid" value="<?= (int)$event->eid ?>">

                <div class="flex flex-col gap-10 mb-5">

                    <!-- image-->
                    <div class="space-y-10">

                        <h2 class="xl:mt-0 mt-5 text-2xl font-semibold text-[#1E293B]">รูปภาพกิจกรรม</h2>
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

                    <!-- imformation -->
                    <div class="space-y-5">

                        <div>
                            <label class=" block mb-2 font-medium text-[#1E293B]">ชื่องาน</label>
                            <input type="text"
                                name="event_name"
                                value="<?= $event->event_name ?>"
                                class="w-full px-6 py-4 rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-400 outline-none">
                        </div>

                        <div class="flex xl:flex-row flex-col xl:gap-3">
                            <div>
                                <label class="block mb-2 font-medium text-[#1E293B]">จำนวนผู้เข้าร่วม</label>
                                <input type="number"
                                    name="event_capacity"
                                    value="<?= $event->event_capacity ?>" min="1" max="999999"
                                    class="xl:w-40 w-1/4 px-6 py-4 rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-400 outline-none">
                            </div>
                            <div>
                                <label class="block mb-2 font-medium text-[#1E293B]">ระยะเวลากิจกรรม</label>
                                <div class="flex gap-6 xl:flex-row flex-col">
                                    <input type="datetime-local"
                                        name="start_date"
                                        value="<?= str_replace(' ', 'T', substr($event->start_date, 0, 16)) ?>"
                                        class="px-6 py-4 rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-400">

                                    <input type="datetime-local"
                                        name="end_date"
                                        value="<?= str_replace(' ', 'T', substr($event->end_date, 0, 16)) ?>"
                                        class="px-6 py-4 rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-400">
                                </div>
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

                            <button type="submit" onclick="return confirmEdit()"
                                class="px-10 py-3 rounded-full bg-gray-500 hover:bg-gray-600 text-white transition shadow ">
                                บันทึก
                            </button>
                        </div>

                    </div>

                </div>

                <div class="w-full flex">
                    <a href="/event_delete?eid=<?= (int)$event->eid ?>" onclick="return confirmDelete()" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition-all bg-red-600 rounded-3xl hover:bg-red-700 active:scale-95 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
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

                <script>
                    function confirmEdit() {
                        return confirm("ต้องการบันทึกการแก้ไขกิจกรรมนี้มั้ย ?");
                    }
                </script>

            </form>
        </div>
        </div>
    </main>

</body>

</html>