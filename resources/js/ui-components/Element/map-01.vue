<template >
  <div
  class="col-span-12 rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-7">
  <h4 class="mb-2 text-xl font-bold text-black dark:text-white">
    {{Title}}
  </h4>
  <div class=" map-btn ">

      <slot></slot>
  </div>
</div>
</template>
<script>
export default {
    props:{
        Title:{
            type: String,
            default: 'Title'
        }
    }
}
</script>
<style lang="">

</style>
