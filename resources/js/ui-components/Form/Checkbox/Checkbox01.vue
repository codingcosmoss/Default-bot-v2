<template>
    <div  :class="Class">
        <label for="checkboxLabelFour" class="flex cursor-pointer select-none items-center">
            <div class="relative">
                <input type="checkbox" class="sr-only "
                       />
                <div :class="{ 'border-primary': onCheck, 'error': isError }"
                     class="mr-4  flex h-5 w-5 items-center justify-center rounded-full border">
                          <span :class="onCheck && '!bg-primary'"
                                class="h-2.5 w-2.5 rounded-full bg-transparent">
                          </span>
                </div>
            </div>
            {{Title}}
        </label>

    </div>
</template>
<script >
    export default {

        props:{
            Title:{
                type: String,
                default: 'Checkbox text'
            },
            onCheck:{
                type: Boolean,
                default: false
            },
            isError:{
                type: Boolean,
                default: false
            },
            message:{
                type: String,
                default: ''
            },
            Class:{
                type: String,
                default: ''
            }
        }
    }
</script>

<style scoped>
    .error{
        border: 1px solid #e60707;
        box-shadow: 1px 1px 15px crimson;
    }
</style>
