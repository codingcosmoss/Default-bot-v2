<template>
    <div class="w-100 d-flex justify-content-end mt-3">
        <button :disabled="Loader" @click="this.$emit('onButton', true)" :class="isDisabled ? 'disabled' : '' " type="button" class="btn btn-primary w-md ">
            <slot v-if="!Loader"></slot>
            <div v-else class="spinner-border text-white m-1" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </button>
    </div>
</template>

<script>

export default
{
    props:{
        Loader:{
            type: Boolean,
            default: false
        },
        isDisabled:{
            type: Boolean,
            default: false
        }
    }
}
</script>

<style scoped>
.spinner-border {
    --bs-spinner-width: 1rem;
    --bs-spinner-height: 1rem;
}
</style>
