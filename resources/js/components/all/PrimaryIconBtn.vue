<template>
    <a class="btn btn-primary waves-effect waves-light"  style="padding: 5px 10px;" :style="Style" role="button" data-bs-toggle="modal" :data-bs-target="'#'+Modal">
        <i :class="Icon"></i>
    </a>

</template>
<script>
export default
{
    props:{
        Icon:{
            type: String,
            default: 'bx bx-edit-alt'
        },
        Modal:{
            type: String,
            default: 'modal'
        },
        Style:{
            type: String,
            default: 'margin-right: 6px'
        },
    }
}
</script>
