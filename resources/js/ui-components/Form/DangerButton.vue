<template>

    <div class="mb-5">
        <button :class="isActive == true ? 'active_btn' : '' "  class="   w-full cursor-pointer rounded-lg border border-primary bg-danger p-4 font-medium text-white transition hover:bg-opacity-90" >
            <i  v-if="Icon != '' " :class="Icon" > </i>
            <span class="font-bold">{{Title}}</span>
        </button>

    </div>
</template>
<script >

    export default {
        props:{
            Title:{
                type: [String, Number],
                default: ''
            },
            Icon:{
                type: [String, Number],
                default: ''
            },
            Class:{
                type: [String, Number],
                default: ''
            },
            isActive:{
                type: Boolean,
                default: false
            },
        }
    }

</script>

<style>
    .active_btn{
        background: #10b981 !important;
        color: #ffffff !important;
    }

</style>
