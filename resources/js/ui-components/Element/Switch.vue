<template>

      <div class="switch">

        <label class="mb-2.5 block text-black dark:text-white">
            sasasa
        </label>

        <div x-data="{ isSwitch: false }">
                    <label for="toggle4" class="flex cursor-pointer select-none items-center">
                      <div class="relative">
                        <input type="checkbox" id="toggle4" class="sr-only"
                          @change="this.$emit('onClick', !isSwitch)" />
                        <div :class="isSwitch && '!bg-primary'" class="block h-8 w-14 rounded-full bg-black">
                        </div>
                        <div :class="isSwitch && '!right-1 !translate-x-full'"
                          class="absolute left-1 top-1 flex h-6 w-6 items-center justify-center rounded-full bg-white transition">
                        </div>
                      </div>
                    </label>
                  </div>
                  

      </div>

</template>

<script>

export default {
   
    props:
    {
        isSwitch:{
            type: Boolean,
            default:false
        }
    }
}
</script>


<style scoped>
    .switch{
        width: 100%;
        padding: 15px 0;
        display: flex;
        flex-direction: column;
    }
</style>