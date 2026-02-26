<?php
// Side Navigation Component
?>
<aside class="flex flex-col w-64 bg-transparent h-screen left-0 top-0">

    <div class="w-64 flex items-center justify-center pt-6">
        <a href="/" class="">
            <?php include 'logo.php'; ?>
        </a>
    </div>

    <div class="justify-center items-center flex flex-col gap-4 mb-2">

        <!-- SWITCH -->
        <div id="switch" class="relative flex w-36 p-1 rounded-full bg-[#DDAED3]/50 cursor-pointer select-none">

            <!-- Sliding active background -->
            <div id="slider"
                class="absolute top-1 left-1 w-1/2 h-[calc(100%-8px)] bg-white/30 border border-white rounded-full transition-all duration-300">
            </div>

            <!-- Buttons -->
            <div class="relative z-10 flex w-full">
                <div class="w-1/2 flex justify-center items-center py-2 text-sm">
                    <svg fill="#DDAED3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 24 24" data-name="Layer 1"><path d="m24 9c0-1.654-1.346-3-3-3h-3c-.9 0-1.7.407-2.25 1.037-.55-.63-1.35-1.037-2.25-1.037h-3c-.9 0-1.7.407-2.25 1.037-.55-.63-1.35-1.037-2.25-1.037h-3c-1.654 0-3 1.346-3 3v8h2v7h2v-7h1v7h2v-7h2.5v7h2v-7h1v7h2v-7h2.5v7h2v-7h1v7h2v-7h2zm-17 6h-5v-6c0-.552.449-1 1-1h3c.551 0 1 .448 1 1zm7.5 0h-5v-6c0-.552.449-1 1-1h3c.551 0 1 .448 1 1zm7.5 0h-5v-6c0-.552.449-1 1-1h3c.551 0 1 .448 1 1zm-5-12.5c0-1.381 1.119-2.5 2.5-2.5s2.5 1.119 2.5 2.5-1.119 2.5-2.5 2.5-2.5-1.119-2.5-2.5zm-7.5 0c0-1.381 1.119-2.5 2.5-2.5s2.5 1.119 2.5 2.5-1.119 2.5-2.5 2.5-2.5-1.119-2.5-2.5zm-7.5 0c0-1.381 1.119-2.5 2.5-2.5s2.5 1.119 2.5 2.5-1.119 2.5-2.5 2.5-2.5-1.119-2.5-2.5z"/></svg>
                </div>
                <div class="w-1/2 flex justify-center items-center py-2 text-sm">
                    <svg fill="#213C51" width="20" height="20" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="m4,19c-1.379,0-2.5-1.121-2.5-2.5s1.121-2.5,2.5-2.5,2.5,1.121,2.5,2.5-1.121,2.5-2.5,2.5Zm10.5-2.5c0-1.381-1.119-2.5-2.5-2.5s-2.5,1.119-2.5,2.5,1.119,2.5,2.5,2.5,2.5-1.119,2.5-2.5Zm-2.5-11.5c1.381,0,2.5-1.119,2.5-2.5s-1.119-2.5-2.5-2.5-2.5,1.119-2.5,2.5,1.119,2.5,2.5,2.5Zm5.5,11.5c0,1.381,1.119,2.5,2.5,2.5s2.5-1.119,2.5-2.5-1.119-2.5-2.5-2.5-2.5,1.119-2.5,2.5Zm.336-9.186l5.315-4.556c.419-.359.468-.99.108-1.409-.36-.421-.992-.469-1.41-.108l-5.314,4.555c-.906.776-2.062,1.204-3.254,1.204h-2.561c-1.192,0-2.348-.428-3.254-1.203L2.151,1.241c-.419-.359-1.051-.312-1.41.108-.359.419-.311,1.05.108,1.409l5.315,4.557c.551.472,1.177.833,1.835,1.111v4.073c0,.553.448,1,1,1s1-.447,1-1v-3.564c.24.025.477.064.72.064h2.561c.243,0,.48-.039.72-.064v3.564c0,.553.448,1,1,1s1-.447,1-1v-4.073c.659-.279,1.285-.64,1.836-1.112Zm6.099,15.331c-.6-1.582-2.181-2.646-3.935-2.646s-3.335,1.063-3.935,2.646c-.196.517.064,1.094.581,1.29.516.195,1.094-.064,1.29-.581.307-.811,1.137-1.354,2.065-1.354s1.758.544,2.065,1.354c.151.399.532.646.935.646.118,0,.238-.021.354-.064.516-.196.776-.773.581-1.29Zm-11.935-2.646c-1.754,0-3.335,1.063-3.935,2.646-.196.517.064,1.094.581,1.29.515.195,1.094-.064,1.29-.581.307-.811,1.137-1.354,2.065-1.354s1.758.544,2.065,1.354c.151.399.532.646.935.646.118,0,.238-.021.354-.064.516-.196.776-.773.581-1.29-.6-1.582-2.181-2.646-3.935-2.646Zm-8,0c-1.754,0-3.335,1.063-3.935,2.646-.196.517.064,1.094.581,1.29.516.195,1.094-.064,1.29-.581.307-.811,1.137-1.354,2.065-1.354s1.758.544,2.065,1.354c.151.399.532.646.935.646.118,0,.238-.021.354-.064.516-.196.776-.773.581-1.29-.6-1.582-2.181-2.646-3.935-2.646Z"/></svg>
                </div>
            </div>
        </div>

        <script>
            const switchEl = document.getElementById("switch");
            const slider = document.getElementById("slider");
            const islogin = <?= json_encode(isset($_SESSION['user_id'])); ?>;
            let currentPage = window.location.pathname;

            let active = 0; // 0 = left, 1 = right

            if (currentPage === "/events") {
                active = 1;
                switchEl.style.backgroundColor = "#6594B1";
                slider.style.transform = "translateX(89%)";
            }

            switchEl.addEventListener("click", () => {
                if (islogin) {
                    active = active === 0 ? 1 : 0;

                    if (active === 1) {
                        switchEl.style.backgroundColor = "#6594B1";
                        slider.style.transform = "translateX(89%)";
                        window.location.href = "/events";
                    } else {
                        switchEl.style.backgroundColor = "#DDAED3";
                        slider.style.transform = "translateX(0)";
                        window.location.href = "/home";
                    }
                }else{window.location.href = "/login";}
            });
        </script>
    </div>

    <nav class="flex flex-col h-full">
        <ul name="top_main_menu" class="list-none p-0 mb-0">
            <li class="m-0">
                <a id="home" href="/"
                    class="flex items-center px-5 py-4 text-[#1E293B] no-underline transition-all duration-300 border-l-4 border-transparent hover:bg-[#DBC3D6] hover:border-l-[#DDAED3]">
                    <span class="text-base">กิจกรรมทั้งหมด</span>
                </a>
            </li>
            <?php if (isset($_SESSION['user_email'])) { ?>
                <li class="m-0">
                    <a id="my_events" href="/my_events"
                        class="flex items-center px-5 py-4 text-[#1E293B] no-underline transition-all duration-300 border-l-4 border-transparent hover:bg-[#DBC3D6] hover:border-l-[#DDAED3]">
                        <span class="text-base">กิจกรรมที่ฉันเข้าร่วม</span>
                    </a>
                </li>
            <?php } ?>
        </ul>

        <script>
            const routeMap = {
                "/": "home",
                "/home": "home",
                "/my_events": "my_events"
            };

            const activeId = routeMap[currentPage];
            const activeElement = document.getElementById(activeId);

            if (activeElement) {
                Object.assign(activeElement.style, {
                    backgroundColor: "#DBC3D6",
                    borderColor: "#DDAED3",
                    filter: "grayscale(50%)"
                });
            }
        </script>

        <div class="mt-auto flex flex-col gap-4 px-6 pb-8 pt-4 border-t border-slate-300/50">
            <?php if (isset($_SESSION['user_email'])) { ?>

                <div name="bottom_menu" class="flex items-center gap-3">
                    <div class="text-slate-600">
                        <svg width="20" height="20" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M25.2041 26.4644V23.944C25.2041 22.6071 24.673 21.325 23.7277 20.3796C22.7823 19.4343 21.5002 18.9032 20.1633 18.9032H10.0816C8.74474 18.9032 7.46259 19.4343 6.51725 20.3796C5.57192 21.325 5.04083 22.6071 5.04083 23.944V26.4644M20.1633 8.82158C20.1633 11.6055 17.9064 13.8624 15.1225 13.8624C12.3385 13.8624 10.0816 11.6055 10.0816 8.82158C10.0816 6.03761 12.3385 3.78076 15.1225 3.78076C17.9064 3.78076 20.1633 6.03761 20.1633 8.82158Z"
                                stroke="#213C51" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>

                    <div class="flex flex-col">
                        <a href="/update_user" class="text-sm font-semibold text-slate-800"><span
                                class="text-base"><?= isset($_SESSION['name']) ? $_SESSION['name'] : 'Update User' ?></span></a>
                        <span class="text-xs text-slate-500">UID:
                            <?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Update User' ?></span>
                    </div>
                </div>

                <a href="/logout"
                    class="group flex items-center gap-3 py-2 text-sm font-medium text-slate-700 transition-colors duration-200 hover:text-red-600">
                    <div class="text-slate-500 transition-colors duration-200 group-hover:text-red-600">
                        <svg width="20" height="20" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="mr-2">
                            <path
                                d="M9.5 24.5H4.5C3.83696 24.5 3.20107 24.2366 2.73223 23.7678C2.26339 23.2989 2 22.663 2 22V4.5C2 3.83696 2.26339 3.20107 2.73223 2.73223C3.20107 2.26339 3.83696 2 4.5 2H9.5M18.25 19.5L24.5 13.25M24.5 13.25L18.25 7M24.5 13.25H9.5"
                                stroke="#213C51" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <span>Logout</span>
                </a>
            <?php } else { ?>
                <div class="m-0">
                    <a href="/login"
                        class="group flex items-center gap-3 py-2 text-sm font-medium text-slate-700 transition-colors duration-200 hover:text-gray-600">
                        <div class="text-slate-500 transition-colors duration-200 group-hover:text-gray-600">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18.75 3.75H23.75C24.413 3.75 25.0489 4.01339 25.5178 4.48223C25.9866 4.95107 26.25 5.58696 26.25 6.25V23.75C26.25 24.413 25.9866 25.0489 25.5178 25.5178C25.0489 25.9866 24.413 26.25 23.75 26.25H18.75M12.5 21.25L18.75 15M18.75 15L12.5 8.75M18.75 15H3.75"
                                    stroke="#213C51" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span>Login</span>
                    </a>
                </div>
            <?php } ?>

        </div>
    </nav>
</aside>