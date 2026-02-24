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
        <?php include 'sideNev.php'; ?>
    </div>

    <div class="flex-1 bg-white/75 my-4 mr-4 rounded-[2rem] shadow-sm border border-white/50 flex flex-col overflow-hidden">
        
        <div class="px-8 py-6 flex items-start gap-4 flex-shrink-0">
            <div class="relative w-[320px]">
                <input 
                    type="text" 
                    placeholder="Search event or date" 
                    class="w-full bg-white text-sm text-gray-700 rounded-full py-2.5 pl-5 pr-10 outline-none shadow-sm placeholder-gray-500"
                >
                <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <button class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-sm font-semibold text-gray-600 shadow-sm hover:bg-gray-50 transition-colors">
                ?
            </button>

            <div class="bg-white/40 text-[10px] text-gray-600 px-4 py-2 rounded-xl max-w-[300px] leading-relaxed border border-white/50">
                หากต้องการค้นหาด้วยวันที่ให้พิมพ์วันเริ่มต้น และ วันสิ้นสุด<br>
                เช่น "13/1/26 - 12/2/26"
            </div>
        </div>

        <div class="flex-1 overflow-y-auto px-8 pb-8 flex flex-col gap-4">
            
            <div class="bg-white rounded-2xl flex h-[150px] overflow-hidden shadow-sm">
                <div class="w-[280px] bg-imagePlaceholder flex-shrink-0"></div>
                <div class="flex-1 flex px-8 py-5">
                    <div class="flex-1 pr-4">
                        <h3 class="text-lg font-medium text-gray-800">Epstein island party</h3>
                        <p class="text-[12px] text-gray-500 mt-1 leading-relaxed max-w-lg">
                            Lorem ipsum dolor sit ametLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center min-w-[120px]">
                        <span class="text-sm text-gray-600 mb-0.5">ผู้เข้าร่วม</span>
                        <span class="text-sm font-medium text-gray-800 mb-3">67 / 100</span>
                        <button class="bg-btnGreen hover:bg-btnGreenHover transition-colors text-white text-xs font-medium px-6 py-2 rounded-full shadow-sm">
                            เข้าร่วม
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl flex h-[150px] overflow-hidden shadow-sm">
                <div class="w-[280px] bg-imagePlaceholder flex-shrink-0"></div>
                <div class="flex-1 flex px-8 py-5">
                    <div class="flex-1 pr-4">
                        <h3 class="text-lg font-medium text-gray-800">Lorem ipsum</h3>
                        <p class="text-[12px] text-gray-500 mt-1 leading-relaxed max-w-lg">
                            Lorem ipsum dolor sit ametLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        </p>
                    </div>
                    <div class="w-[220px] flex flex-col justify-center text-[12px] text-gray-600 leading-snug">
                        <p class="font-medium text-gray-800 mb-1">เงื่อนไข</p>
                        <p>-ต้องอายุ 18 ปีขึ้นไป</p>
                        <p>-ต้องมีน้ำหนักไม่เกิน 80 กก.</p>
                        <p>-สูง200ซม.ขึ้นไป</p>
                        <p>-อยู่หน่วยSEAL</p>
                    </div>
                    <div class="flex flex-col items-center justify-center min-w-[120px]">
                        <span class="text-sm text-gray-600 mb-0.5">ผู้เข้าร่วม</span>
                        <span class="text-sm font-medium text-gray-800 mb-3">42 / 100</span>
                        <button class="bg-btnGreen hover:bg-btnGreenHover transition-colors text-white text-xs font-medium px-6 py-2 rounded-full shadow-sm">
                            เข้าร่วม
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl flex h-[150px] overflow-hidden shadow-sm">
                <div class="w-[280px] bg-imagePlaceholder flex-shrink-0"></div>
                <div class="flex-1 flex px-8 py-5">
                    <div class="flex-1 pr-4">
                        <h3 class="text-lg font-medium text-gray-800">Lorem ipsum</h3>
                        <p class="text-[12px] text-gray-500 mt-1 leading-relaxed max-w-lg">
                            Lorem ipsum dolor sit ametLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center min-w-[120px]">
                        <span class="text-sm text-gray-600 mb-0.5">ผู้เข้าร่วม</span>
                        <span class="text-sm font-medium text-gray-800 mb-3">99 / 100</span>
                        <button class="bg-btnGreen hover:bg-btnGreenHover transition-colors text-white text-xs font-medium px-6 py-2 rounded-full shadow-sm">
                            เข้าร่วม
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl flex h-[150px] overflow-hidden shadow-sm">
                <div class="w-[280px] bg-imagePlaceholder flex-shrink-0"></div>
                <div class="flex-1 flex px-8 py-5">
                    <div class="flex-1 pr-4">
                        <h3 class="text-lg font-medium text-gray-800">Lorem ipsum</h3>
                        <p class="text-[12px] text-gray-500 mt-1 leading-relaxed max-w-lg">
                            Lorem ipsum dolor sit ametLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center min-w-[120px]">
                        <span class="text-sm text-gray-600 mb-0.5">ผู้เข้าร่วม</span>
                        <span class="text-sm font-medium text-gray-800 mb-3">77 / 999</span>
                        <button class="bg-btnGreen hover:bg-btnGreenHover transition-colors text-white text-xs font-medium px-6 py-2 rounded-full shadow-sm">
                            เข้าร่วม
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>