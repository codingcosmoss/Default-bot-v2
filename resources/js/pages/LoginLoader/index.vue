<template>

    <div class="loader_box" >

        <div class="laoder_block" >

            <div class="loader"></div>

        </div>

    </div>

</template>

<script>
import {GetUser} from "../../helpers/api.js";
export default {
    methods:{
        pageReload(){
            let isReload = localStorage.getItem('reload');
            if (isReload == 'true'){
                localStorage.setItem('reload', false);
                window.location.reload();
            }else {
                this.$router.push('/');
            }
        }
    },
    mounted() {
        this.pageReload()
    }
}

</script>

<style>
/* HTML: <div class="loader"></div> */



.loader {
    width: 120px;
    height: 22px;
    border-radius: 40px;
    color: #514b82;
    border: 2px solid;
    position: relative;
    overflow: hidden;
}
.loader::before {
    content: "";
    position: absolute;
    margin: 2px;
    width: 14px;
    top: 0;
    bottom: 0;
    left: -20px;
    border-radius: inherit;
    background: currentColor;
    box-shadow: -10px 0 12px 3px currentColor;
    clip-path: polygon(0 5%, 100% 0,100% 100%,0 95%,-30px 50%);
    animation: l14 1s infinite linear;
}
@keyframes l14 {
    100% {left: calc(100% + 20px)}
}
</style>
