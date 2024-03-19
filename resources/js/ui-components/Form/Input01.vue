<template>
    <input class=" w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
           :class="isError == true ? 'isError' : '' " />

</template>
<script >
export default {
    props: {
        isError: {
            type: Boolean,
            default: false
        },
        message: {
            type: String,
            default: ''
        }
    }
}



</script>
