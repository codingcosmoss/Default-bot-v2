<template>

    <div  :class=" Couple  ? 'mb-4.5' : 'w-full xl:w-1/2' ">
        <label class="mb-2.5 block text-black dark:text-white">
            {{Label}}
        </label>
        <input :value="Value" :type="Type" :class="isError == true ? 'isError' : '' "  placeholder="Select subject" @input = "this.$emit('onInput', $event.target.value)"
                style="width: 80px; height: 40px"
               class=" rounded border-[1.5px] border-stroke bg-transparent py-20 px-2 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
    </div>

</template>

<script>

    export default {
        props:{
            Couple:{
                type: Boolean,
                default: true
            },
            Label:{
                type: String,
                default: 'Input label'
            },
            Value:{
                type: [String, Boolean, Number],
                default: ''
            },
            Type:{
                type: String,
                default: 'text'
            },
            isError:{
                type: Boolean,
                default: false
            }

        }
    }

</script>

<style >
    .isError{
        border: 1px solid #ff0000 !important;
    }
</style>
