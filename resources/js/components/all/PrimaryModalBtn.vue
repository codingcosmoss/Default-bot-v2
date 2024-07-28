<template>
    <button :disabled="Loader"  type="button" data-bs-toggle="modal" :data-bs-target="'#'+Modal" class="btn btn-primary w-md" >
        <slot v-if="!Loader"></slot>
        <div v-else class="spinner-border text-white m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </button>
</template>

<script>
export default
{
    props:{
        Loader:{
            type: Boolean,
            default: false
        },
        Modal:{
            type: String,
            default: 'modal'
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
