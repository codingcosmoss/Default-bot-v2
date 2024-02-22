<template>

    <div  :class=" Couple  ? 'mb-4.5' : 'w-full xl:w-1/2' ">
        <label class="mb-2.5 block text-black dark:text-white">
            {{Label}}
        </label>
        <select :class="isError == true ? 'isError' : '' "  @input = "this.$emit('onSelect', $event.target.value)" class=" w-full rounded border-[1.5px] border-stroke bg-transparent px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary select-input">
            <slot></slot>
        </select >
        <p v-if="isError" class="text-danger" >{{message}}</p>

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
            },
            isLoginError:{
                type: Boolean,
                default: false
            },
            message:{
                type: String,
                default: ''
            }


        }
    }

</script>

<style >
    .isError{
        border: 1px solid #ff0000 !important;
    }
    select{
        padding: 15px 0;
    }
</style>
