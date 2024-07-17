<template>
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center px-3 py-4">

                <h5 class="m-0 me-2">Settings</h5>

                <a @click="setting()" style="cursor: pointer" class="right-bar-toggle ms-auto right_bar_icon">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Layouts</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="http://127.0.0.1:8000/assets/images/layouts/layout-1.jpg" class="img-thumbnail" alt="layout images">
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" :checked="!darkMode"  @click="addSession('light-mode-switch')">
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="http://127.0.0.1:8000/assets/images/layouts/layout-2.jpg" class="img-thumbnail" alt="layout images">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" :checked="darkMode" id="dark-mode-switch" @click="addSession('dark-mode-switch')" >
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>

            </div>

        </div> <!-- end slimscroll-menu-->
    </div>

</template>
<script>
    export default {
        data(){return{
            darkMode: true,
        }},
        methods:{
            getSession(){
                let mode =  sessionStorage.getItem('is_visited');
                let fon = localStorage.getItem('fon');
                console.log('Fon:', fon);
                if (mode == 'dark-mode-switch' || fon == 'dark'){
                    this.darkMode = true;
                }else {
                    this.darkMode = false;
                }
            },
            setting(){
                const app = document.getElementById('app');
                if (app.classList.contains('right-bar-enabled')){
                    app.classList.remove('right-bar-enabled');
                }else {
                    app.classList.add('right-bar-enabled');
                }
            },
            addSession(val){
                if (val == 'dark-mode-switch'){
                    this.darkMode = true;
                    localStorage.setItem('fon', 'dark');
                    document.documentElement.setAttribute("data-bs-theme","dark");
                }else {
                    document.documentElement.setAttribute("data-bs-theme","light");
                    localStorage.setItem('fon', 'white');
                    this.darkMode = false;
                }
                let mode = sessionStorage.setItem('is_visited', val);
                document.documentElement.removeAttribute("dir")
            }


        },
        mounted() {
            this.getSession()
        }
    }
</script>
