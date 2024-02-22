<template>

    <div class="mb-5">
        <button  class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90" >
            <i  v-if="Icon != '' " :class="Icon" > </i>
            {{Title}}
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
        }
    }

</script>
