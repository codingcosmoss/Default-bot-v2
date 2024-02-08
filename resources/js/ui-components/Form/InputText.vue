<template>

    <div class="mb-4">
        <label class="mb-2.5 block font-medium text-black dark:text-white">{{ Label }}</label>
        <div class="relative">
            <input :type="Type" :placeholder="Plholder"
                   required
                   class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                   :value="Value != '' ? Value : '' "
                @input = "this.$emit('result', $event.target.value)"
            />

            <span class="absolute right-4 top-4">
                <i class="fa-2x" :class="Icon"></i>
            </span>
        </div>
    </div>

</template>
<script >

    export default {
        props:{
            Label: {
                type: String,
                default: 'Label text'
            },
            Plholder: {
                type: String,
                default: 'Plaseholder'
            },
            Icon: {
                type: String,
                default: 'fa-regular fa-envelope '
            },
            Value: {
                type: String,
                default: ''
            },
            Type: {
                type: String,
                default: 'text'
            },
        }

    }

</script>
