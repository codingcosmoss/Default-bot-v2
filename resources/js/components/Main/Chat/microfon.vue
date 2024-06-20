<template>

    <div class="mic_box" >
        <div class="mic" @click="isAnime = true">
            <i class="mic-icon"></i>
            <div v-if="isAnime" class="mic-shadow"></div>
        </div>
    </div>

</template>

<script>
    export default {
        props:{
            isAnime:{
                type: Boolean,
                default: false
            }
        }
    }
</script>

<style scoped lang="css">
body {
    overflow: hidden;
    background: #3b0e68;
    background: radial-gradient(circle, #3b0e68
    0%, #1a084e 100%);
}
.mic_box{
    position: relative;
    width: 100%;
    //height: 300px;
    height: 100vh;
    margin: 0 auto;
    background-image: linear-gradient(rgba(34, 39, 54, 0.7), rgba(34, 39, 54, 0.8)), url("https://a-static.besthdwallpaper.com/jinx-in-arcane-netflix-series-league-of-legends-lol-wallpaper-1920x1080-92560_48.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    //display: none;
}
.mic {
    cursor: pointer;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transform: scale(.5);
    color: #fff;
}
.mic::before, .mic::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 100%;
    z-index: 2;
    box-shadow: 0 0 20px 20px #1c084f;
}
.mic::before {
    width: 400px;
    height: 400px;
    background-color: #1a084e;
}
.mic::after {
    width: 250px;
    height: 250px;
    background-color: #2f1e5f;
    animation: circle-size 0.8s linear infinite alternate;
}
.mic-icon {
    box-sizing: border-box;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(5);
    display: block;
    width: 16px;
    height: 12px;
    border-bottom-left-radius: 120px;
    border-bottom-right-radius: 120px;
    border: 2px solid;
    border-top: 0;
    margin-top: 20px;
    z-index: 3;
}
.mic-icon::before, .mic-icon::after {
    content: "";
    display: block;
    box-sizing: border-box;
    position: absolute;
}
.mic-icon::before {
    width: 2px;
    height: 5px;
    top: calc(100% + 1px);
    left: 50%;
    transform: translate(-50%, 0);
    background-color: #fff;
}
.mic-icon::after {
    border: 2px solid;
    width: 8px;
    height: 18px;
    left: 50%;
    top: -10px;
    border-radius: 4px;
    transform: translate(-50%, 0);
}
.mic-shadow {
    width: 400px;
    height: 400px;
    position: absolute;
    top: 50%;
    left: 50%;
    border-radius: 100%;
    z-index: 1;
    box-shadow: 10px -55px 30px 15px #823ca6, 24px -10px 47px 10px #aab3d2, -21px -25px 97px 10px #5acee3, 51px 5px 17px 10px #1b7d8f, 3px 2px 77px 10px #f30bf5;
    animation: shadow-rotate 1.5s linear infinite;
    transform-origin: center;
}
@keyframes circle-size {
    from {
        width: 250px;
        height: 250px;
    }
    to {
        width: 300px;
        height: 300px;
    }
}
@keyframes shadow-rotate {
    from {
        transform: translate(-50%, -50%) rotate(0deg);
    }
    to {
        transform: translate(-50%, -50%) rotate(360deg);
    }
}
@media (max-width: 500px) {
    .mic{
        transform: scale(.4);
    }
}
@media (max-width: 754px) {
    .mic_box{
        width: 100%;
        height: 40vh !important;
    }
}

</style>
<script setup>
</script>
