<!-- MyComponent.vue -->
<template>
    <div :class="Col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4" v-if="Title != '' " >{{Title}}</h4>
                <slot></slot>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</template>

<script>
export default {
    name: 'BaseBox',
    props:{
        Title:{
            type: String,
            default: 'Title'
        },
        Col:{
            type: String,
            default: 'col-xl-6'
        },
    }
    // Other component options like props, data, methods, etc.
}
</script>

<style scoped>
/* Component styling */
</style>
