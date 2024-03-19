<template>

    <div class="mb-5">
        <input type="submit" :value="Title"
               class="w-full cursor-pointer rounded-lg border border-primary bg-primary  font-medium text-white transition hover:bg-opacity-90" />
    </div>
</template>
<script >

    export default {
        props:{
            Title:{
                type: [String, Number],
                default: 'Button title'
            }
        }
    }

</script>
