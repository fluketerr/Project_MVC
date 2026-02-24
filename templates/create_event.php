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

        /*For WebKit browsers (Chrome, Edge, Safari) */
        #imagePreviewContainer::-webkit-scrollbar {
            width: 6px;
        }

        #imagePreviewContainer::-webkit-scrollbar-track {
            background: transparent;
            border-radius: 10px;
        }

        #imagePreviewContainer::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
            border-radius: 10px;
        }

        #imagePreviewContainer::-webkit-scrollbar-thumb:hover {
            background-color: #9ca3af;
        }

        /* For Firefox (Firefox uses different rules) */
        #imagePreviewContainer {
            scrollbar-width: thin;
            scrollbar-color: #d1d5db transparent;
        }
    </style>
</head>

<body class="bg-[linear-gradient(90deg,#D9D9D9_0%,#6594B1_25%,#213C51_100%)] flex flex-row justify-center">


    <!-- ส่วนแสดงผลหลักของหน้า -->

    <!-- ยังไม่ได้กรอกให้แสดงของตัวเอง -->
    <main class="items-center justify-center">

        <form action="create_event" method="POST" enctype="multipart/form-data">
            <div class="min-h-screen flex items-center justify-center p-8">
                <div class="w-full max-w-4xl bg-gray-200/75 rounded-3xl p-10 shadow-lg">
                    <div class="flex items-center mb-6 ">
                        <a class="text-3xl font-semibold mb-6" href="/events">← &nbsp;&nbsp;</a>
                        <h1 class="text-3xl font-semibold mb-6"><?= $data['title'] ?></h1>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                        <div class="space-y-6">
                            <div>
                                <label for="event_picture" class="block text-[#1E293B] font-medium mb-3">รูปประกอบงาน(สามารถอัปโหลดได้หลายภาพ)</label>
                                <div class="w-full aspect-[4/3] bg-white rounded-2xl flex items-center justify-center border-2 border-dashed border-gray-300 cursor-pointer">
                                    <label for="imageInput" class="relative w-full h-full flex items-center justify-center cursor-pointer">
                                        <input type="file" name="event_picture[]" id="imageInput" multiple required class="absolute opacity-0">
                                        <span class="text-3xl text-gray-400">+</span>
                                    </label>
                                    </insert>
                                </div>
                            </div>

                            <div class="relative w-full aspect-[6/4]">
                                <div id="imagePreviewContainer" class="absolute w-full h-full bg-white rounded-2xl flex flex-wrap content-start overflow-y-auto border-2 border-gray-300 p-3 scroll-bar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200 webkit-scrollbar">
                                    <!--ใส่รูป-->

                                </div>
                            </div>
                            <script>
                                const imageInput = document.getElementById('imageInput');
                                const previewContainer = document.getElementById('imagePreviewContainer');

                                let selectedFiles = new DataTransfer();

                                imageInput.addEventListener('change', function(event) {
                                    const files = event.target.files;

                                    for (let i = 0; i < files.length; i++) {
                                        const file = files[i];

                                        if (file && file.type.startsWith('image/')) {
                                            selectedFiles.items.add(file);

                                            const wrapper = document.createElement('div');
                                            wrapper.className = 'relative inline-block w-16 h-16 mr-3 mb-3 group hover:filter hover:brightness-90 transition-all';

                                            const img = document.createElement('img');
                                            img.src = URL.createObjectURL(file);
                                            img.className = 'w-full h-full object-cover border border-gray-300 rounded-lg shadow-sm';

                                            img.onload = function() {
                                                URL.revokeObjectURL(img.src);
                                            };

                                            //delete button
                                            const deleteBtn = document.createElement('button');
                                            deleteBtn.innerHTML = '&times;'; // An 'X' symbol
                                            deleteBtn.type = 'button'; // Prevents it from submitting a form
                                            deleteBtn.className = 'absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-sm opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer shadow focus:outline-none';

                                            deleteBtn.addEventListener('click', function() {
                                                wrapper.remove();
                                                removeFileFromInput(file.name);
                                            });

                                            wrapper.appendChild(img);
                                            wrapper.appendChild(deleteBtn);
                                            previewContainer.appendChild(wrapper);
                                        }
                                    }

                                    imageInput.files = selectedFiles.files;
                                });

                                function removeFileFromInput(fileNameToRemove) {
                                    const newFiles = new DataTransfer();
                                    for (let i = 0; i < selectedFiles.files.length; i++) {
                                        if (selectedFiles.files[i].name !== fileNameToRemove) {
                                            newFiles.items.add(selectedFiles.files[i]);
                                        }
                                    }
                                    selectedFiles = newFiles;
                                    imageInput.files = selectedFiles.files;
                                }
                            </script>
                        </div>

                        <div class="flex flex-col">
                            <div class="space-y-4 flex-grow">
                                <div>
                                    <label class="block text-[#1E293B] font-medium mb-1">ชื่องาน</label>
                                    <input type="text" name="event_name" id="" required class="w-full bg-white rounded-full px-4 py-2 border-none focus:ring-2 focus:ring-gray-400">
                                </div>

                                <div>
                                    <label class="block text-[#1E293B] font-medium mb-1">จำนวนผู้เข้าร่วม</label>
                                    <input type="number" name="event_capacity" required class="w-24 bg-white rounded-full px-4 py-2 border-none focus:ring-2 focus:ring-gray-400">
                                </div>

                                <div class="space-y-3 w-[420px]">

                                    <p class="text-[#1E293B]">ระยะเวลากิจกรรม</p>

                                    <div>
                                        <p class="text-[#1E293B]/75 mb-1">&nbsp;เริ่ม</p>
                                        <div class="relative">
                                            <input
                                                type="datetime-local"
                                                class="w-2/3 px-4 py-2 rounded-full bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                name="start_date" required>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-[#1E293B]/75 mb-1">&nbsp;ถึง</p>
                                        <input
                                            type="datetime-local"
                                            class="w-2/3 px-4 py-2 rounded-full bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            name="end_date" required>
                                    </div>

                                </div>
                                <div>
                                    <label class="block text-[#1E293B] font-medium mb-1">รายละเอียด</label>
                                    <textarea name="event_detail" placeholder="Insert Text here..." rows="5" class="w-full bg-white rounded-2xl p-4 border-none focus:ring-2 focus:ring-gray-400 resize-none"></textarea>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="    text-white px-10 py-2 rounded-full font-medium transition-colors">
                                    บันทึก
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>

        <!--<section>
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
        </section>-->

    </main>

</body>

</html>