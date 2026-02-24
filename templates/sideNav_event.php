<?php
// Side Navigation Component
?>
<aside class="flex flex-col w-64 bg-transparent h-screen left-0 top-0">

    <div class="w-64 flex items-center justify-center pt-6">
        <a href="/" class="">
            <?php include 'logo.php'; ?>
        </a>
    </div>

    <div class="justify-center items-center flex flex-col gap-4 ">

        <!-- SWITCH -->
        <div id="switch"
            class="relative flex w-36 p-1 rounded-full bg-[#DDAED3]/75 cursor-pointer select-none">

            <!-- Sliding active background -->
            <div id="slider"
                class="absolute top-1 left-1 w-1/2 h-[calc(100%-8px)] bg-white/30 border border-white rounded-full transition-all duration-300">
            </div>

            <!-- Buttons -->
            <div class="relative z-10 flex w-full">
                <div class="w-1/2 flex justify-center items-center py-2 text-sm">
                    👤
                </div>
                <div class="w-1/2 flex justify-center items-center py-2 text-sm">
                    +
                </div>
            </div>
        </div>



        <script>
            const switchEl = document.getElementById("switch");
            const slider = document.getElementById("slider");
            let currentPage = window.location.pathname; // Get current page path

            let active = 0; // 0 = left, 1 = right

            if (currentPage === "/events") {
                active = 1;
                switchEl.style.backgroundColor = "#6594B1";
                slider.style.transform = "translateX(90%)";
            }

            switchEl.addEventListener("click", () => {
                active = active === 0 ? 1 : 0;

                if (active === 1) {
                    switchEl.style.backgroundColor = "#6594B1";
                    slider.style.transform = "translateX(90%)";
                    window.location.href = "/events";
                } else {
                    switchEl.style.backgroundColor = "#DDAED3";
                    slider.style.transform = "translateX(0)";
                    window.location.href = "/home";
                }
            });
        </script>
    </div>

    <nav class="flex flex-col h-full">
        <ul name="top_main_menu" class="list-none p-0 m-0">
            <li class="m-0">
                <a href="/event" class="flex items-center px-5 py-4 text-[#1E293B] no-underline transition-all duration-300 border-l-4 border-transparent hover:bg-[#DBC3D6] hover:border-l-[#DDAED3]">
                    <span class="text-base">Event</span>
                </a>
            </li>
            <li class="m-0">
                <a href="/join_event" class="flex items-center px-5 py-4 text-[#1E293B] no-underline transition-all duration-300 border-l-4 border-transparent hover:bg-[#DBC3D6] hover:border-l-[#DDAED3]">
                    <span class="text-base">Participant</span>
                </a>
            </li>
            <li class="m-0">
                <a href="/request_event" class="flex items-center px-5 py-4 text-[#1E293B] no-underline transition-all duration-300 border-l-4 border-transparent hover:bg-[#DBC3D6] hover:border-l-[#DDAED3]">
                    <span class="text-base">Request</span>
                </a>
            </li>
            <li class="m-0">
                <a href="/update_eventt" class="flex items-center px-5 py-4 text-[#1E293B] no-underline transition-all duration-300 border-l-4 border-transparent hover:bg-[#DBC3D6] hover:border-l-[#DDAED3]">
                    <span class="text-base">Configure</span>
                </a>
            </li>

        </ul>



        <ul name="bottom_menu" class="list-none p-0 m-0 mt-auto">
            <?php if (isset($_SESSION['user_email'])) { ?>
                <li class="m-0">
                    <a href="/update_user" class="gap-2 flex items-center px-5 py-2 text-[#1E293B] no-underline transition-all duration-300 border-l-4 border-transparent hover:bg-[#DBC3D6] hover:border-l-[#DDAED3]">
                        <svg width="20" height="20" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25.2041 26.4644V23.944C25.2041 22.6071 24.673 21.325 23.7277 20.3796C22.7823 19.4343 21.5002 18.9032 20.1633 18.9032H10.0816C8.74474 18.9032 7.46259 19.4343 6.51725 20.3796C5.57192 21.325 5.04083 22.6071 5.04083 23.944V26.4644M20.1633 8.82158C20.1633 11.6055 17.9064 13.8624 15.1225 13.8624C12.3385 13.8624 10.0816 11.6055 10.0816 8.82158C10.0816 6.03761 12.3385 3.78076 15.1225 3.78076C17.9064 3.78076 20.1633 6.03761 20.1633 8.82158Z" stroke="#213C51" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <span class="text-base"><?= isset($_SESSION['name']) ? $_SESSION['name'] : 'Update User' ?></span>
                    </a>
                </li>
                <li class="m-0">
                    <a class="gap-2 flex items-center px-5 py-2 text-[#1E293B] no-underline transition-all duration-300 border-l-4 border-transparent hover:bg-[#DBC3D6] hover:border-l-[#DDAED3]">
                        <span class="text-base">UID:</span>
                        <span class="text-base"><?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Update User' ?></span>
                    </a>
                </li>
                <li class="m-0">
                    <a href="/logout" class="flex items-center px-5 py-2 text-[#1E293B] no-underline transition-all duration-300 border-l-4 border-transparent hover:bg-[#DBC3D6] hover:border-l-[#DDAED3]">
                        <svg width="20" height="20" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                            <path d="M9.5 24.5H4.5C3.83696 24.5 3.20107 24.2366 2.73223 23.7678C2.26339 23.2989 2 22.663 2 22V4.5C2 3.83696 2.26339 3.20107 2.73223 2.73223C3.20107 2.26339 3.83696 2 4.5 2H9.5M18.25 19.5L24.5 13.25M24.5 13.25L18.25 7M24.5 13.25H9.5" stroke="#213C51" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-base">Logout</span>
                    </a>
                </li>
            <?php } else { ?>
                <li class="m-0">
                    <a href="/login" class="flex items-center px-5 py-4 text-[#1E293B] no-underline transition-all duration-300 border-l-4 border-transparent hover:bg-[#DBC3D6] hover:border-l-[#DDAED3]">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.75 3.75H23.75C24.413 3.75 25.0489 4.01339 25.5178 4.48223C25.9866 4.95107 26.25 5.58696 26.25 6.25V23.75C26.25 24.413 25.9866 25.0489 25.5178 25.5178C25.0489 25.9866 24.413 26.25 23.75 26.25H18.75M12.5 21.25L18.75 15M18.75 15L12.5 8.75M18.75 15H3.75" stroke="#213C51" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <span class="text-base">Login</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</aside>