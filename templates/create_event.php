<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Optional: Style the preview image so it isn't too large */
        #imagePreview {
            max-width: 300px;
            max-height: 300px;
            margin-top: 15px;
            display: none;
            /* Hidden by default */
            border: 2px solid #ccc;
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] flex flex-row justify-center">


    <!-- ส่วนแสดงผลหลักของหน้า -->

    <!-- ยังไม่ได้กรอกให้แสดงของตัวเอง -->
    <main class="items-center justify-center">
        <a href="/">Home</a>

        <h1> <?= $data['title'] ?></h1>
        <form action="create_event" method="POST" enctype="multipart/form-data">
            <div class="min-h-screen flex items-center justify-center p-8">
                <div class="w-full max-w-4xl bg-gray-200 rounded-3xl p-10 shadow-lg">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                        <div class="space-y-6">
                            <div>
                                <label for="event_picture" class="block text-gray-700 font-medium mb-3">รูปประกอบงาน(สามารถอัปโหลดได้หลายภาพ)</label>
                                <div class="w-full aspect-[4/3] bg-white rounded-2xl flex items-center justify-center border-2 border-dashed border-gray-300 cursor-pointer">
                                    <input type="file" name="event_picture[]" id="imageInput" multiple required class="absolute opacity-0">
                                    <span class="text-3xl text-gray-400">+</span>
                                </div>
                            </div>

                            <div>
                                <div id="imagePreviewContainer" class="w-full aspect-[6/4] bg-white rounded-2xl flex cursor-pointer">
                                    <span class="text-3xl text-white">+</span>
                                </div>
                            </div>
                            <script>
                                const imageInput = document.getElementById('imageInput');
                                const previewContainer = document.getElementById('imagePreviewContainer');

                                imageInput.addEventListener('change', function(event) {
                                    // Clear the container first
                                    previewContainer.innerHTML = '';
                                    const files = event.target.files;

                                    for (let i = 0; i < files.length; i++) {
                                        const file = files[i];

                                        if (file && file.type.startsWith('image/')) {
                                            const img = document.createElement('img');
                                            img.src = URL.createObjectURL(file);

                                            img.className = 'w-32 h-32 object-cover border border-gray-300 rounded-lg shadow-sm';

                                            img.onload = function() {
                                                URL.revokeObjectURL(img.src);
                                            };

                                            previewContainer.appendChild(img);
                                        }
                                    }
                                });
                            </script>
                        </div>

                        <div class="flex flex-col">
                            <div class="space-y-4 flex-grow">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-1">ชื่องาน</label>
                                    <input type="text" class="w-full bg-white rounded-full px-4 py-2 border-none focus:ring-2 focus:ring-gray-400">
                                </div>

                                <div>
                                    <label class="block text-gray-700 font-medium mb-1">จำนวนผู้เข้าร่วม</label>
                                    <input type="number" class="w-24 bg-white rounded-full px-4 py-2 border-none focus:ring-2 focus:ring-gray-400">
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-gray-700 font-medium">ระยะเวลากิจกรรม</label>
                                    <div class="flex gap-2">
                                        <select class="bg-white rounded-lg border-none text-sm px-2 py-1">
                                            <option>Day</option>
                                        </select>
                                        <select class="bg-white rounded-lg border-none text-sm px-2 py-1">
                                            <option>Sep</option>
                                        </select>
                                        <select class="bg-white rounded-lg border-none text-sm px-2 py-1">
                                            <option>2025</option>
                                        </select>
                                        <span class="self-center">:</span>
                                        <input type="text" class="w-16 bg-white rounded-lg border-none text-sm px-2 py-1">
                                    </div>

                                    <p class="text-gray-600 text-sm pl-2 italic">ถึง</p>

                                    <div class="flex gap-2">
                                        <select class="bg-white rounded-lg border-none text-sm px-2 py-1">
                                            <option>Day</option>
                                        </select>
                                        <select class="bg-white rounded-lg border-none text-sm px-2 py-1">
                                            <option>Sep</option>
                                        </select>
                                        <select class="bg-white rounded-lg border-none text-sm px-2 py-1">
                                            <option>2025</option>
                                        </select>
                                        <span class="self-center">:</span>
                                        <input type="text" class="w-16 bg-white rounded-lg border-none text-sm px-2 py-1">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-gray-700 font-medium mb-1">รายละเอียด</label>
                                    <textarea placeholder="Insert Text here..." rows="5" class="w-full bg-white rounded-2xl p-4 border-none focus:ring-2 focus:ring-gray-400 resize-none"></textarea>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-10 py-2 rounded-full font-medium transition-colors">
                                    บันทึก
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>

        <section>
            <form action="create_event" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="event_picture">รูปกิจกรรม</label>
                    <input type="file" accept="image/*" name="event_picture[]" id="" multiple required>
                </div>
                <div>
                    <label for="event_name">ชื่อกิจกรรม: </label>
                    <input type="text" name="event_name" id="" required>
                </div>
                <div>
                    <label for="event_detail">รายละเอียด: </label>
                    <textarea name="event_detail" rows="2" cols="25" placeholder="รายละเอียด" required></textarea>
                </div>
                <div>
                    <label for="event_capacity">จำนวนคนเข้าร่วม</label>
                    <input type="number" name="event_capacity" id="" required>
                </div>
                <div>
                    <label for="start_date">วันเริ่มต้น: </label>
                    <input type="datetime-local" name="start_date" required>
                </div>
                <div>
                    <label for="end_date">วันสิ้นสุด: </label>
                    <input type="datetime-local" name="end_date" required>
                </div>
                <button type="submit">สร้างกิจกรรม</button>

            </form>
        </section>

    </main>

</body>

</html>