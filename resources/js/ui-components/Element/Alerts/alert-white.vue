<template >
    <div >
        <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
        <div class="toast ">

            <div class="toast-content">
                <i v-if="alert" class="fas fa-solid fa-check check"></i>
                <i v-else class="fa-solid fa-circle-exclamation fa-3x"></i>

                <div class="message">
                    <span class="text text-1">{{ title }}</span>
                    <span class="text text-2 " :class="alert ? 'text-black' : 'text-red'"  >{{ desc }}</span>
                </div>
            </div>

            <i class="fa-solid fa-xmark close" @click="closeIcon()"></i>

            <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
            <div class="progress "></div>
        </div>


    </div>
</template>



<script>
export default {
    name: "alert-white",

    props: {
        title: String,
        desc: String,
        isActive: Boolean, // qiymatni true yoki folse qiymatga almashtrish bilan alert habari chiqadi
        alert: Boolean // success bolsa true error bolsa false qiymat qabul qiladi
    },

    watch: {
        isActive() {
            const toast = document.querySelector(".toast");
            if (toast.classList.contains("active")) {
                this.closeIcon();
            }
            this.onClick();
        }
    },



    methods: {

        onClick() {
            const toast = document.querySelector(".toast");
            const closeIcon = document.querySelector(".close");
            const progress = document.querySelector(".progress");

            toast.classList.add("active");
            progress.classList.add("active");

            setTimeout(() => {
                toast.classList.remove("active");
            }, 5000); //1s = 1000 milliseconds

            setTimeout(() => {
                progress.classList.remove("active");
            }, 5300);

        },

        closeIcon() {
            const toast = document.querySelector(".toast");
            const progress = document.querySelector(".progress");

            let timer1, timer2;
            toast.classList.remove("active");

            setTimeout(() => {
                progress.classList.remove("active");
            }, 300);

            clearTimeout(timer1);
            clearTimeout(timer2);
        },


    },


}
</script>



<style scoped>
.toast {
    opacity: 1;
    position: absolute;
    top: 25px;
    right: 30px;
    border-radius: 12px;
    background: #fff;
    padding: 20px 35px 20px 25px;
    box-shadow: 0 6px 20px -5px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transform: translateX(calc(100% + 30px));
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
}

.text-red {
  color: red !important;
}
.text-black {
  color: black !important;
}

.fa-circle-exclamation{
    color: #f10e0e;
}

.toast.active {
    transform: translateX(0%);
}

.toast .toast-content {
    display: flex;
    align-items: center;
}

.toast-content .check {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 35px;
    min-width: 35px;
    background-color: #4070f4;
    color: #fff;
    font-size: 20px;
    border-radius: 50%;
}

.toast-content .message {
    display: flex;
    flex-direction: column;
    margin: 0 20px;
}

.message .text {
    font-size: 16px;
    font-weight: 400;
    color: #666666;
}

.message .text.text-1 {
    font-weight: 600;
    color: #333;
}

.toast .close {
    position: absolute;
    top: 10px;
    right: 15px;
    padding: 5px;
    cursor: pointer;
    opacity: 0.7;
}



.toast .progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 100%;

}

.toast .progress:before {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    height: 100%;
    width: 100%;
    background-color: #4070f4;
}

.progress.active:before {
    animation: progress 5s linear forwards;
}

@keyframes progress {
    100% {
        right: 100%;
    }
}

button {
    padding: 12px 20px;
    font-size: 20px;
    outline: none;
    border: none;
    background-color: #4070f4;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background-color: #0e4bf1;
}

.toast.active~button {
    pointer-events: none;
}
</style>
