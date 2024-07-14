<template>
    <div class="w-100 d-flex justify-content-end  align-items-start ">
            <slot></slot>
    </div>
</template>

<script>
export default
{
    props:{
        Loader:{
            type: Boolean,
            default: false
        }
    }
}
</script>

<style scoped>
.spinner-border {
    --bs-spinner-width: 1.5rem;
    --bs-spinner-height: 1.5rem;
}
</style>
