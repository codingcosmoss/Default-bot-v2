<!-- MyComponent.vue -->
<template>
    <div class="form-check font-size-16">
        <input class="form-check-input" type="checkbox" id="transactionCheck02" :checked="isCheck" >
        <label class="form-check-label" for="transactionCheck02">{{Title}}</label>
    </div>
</template>

<script>
export default {
    name: 'BaseCheck',
    props:{
        Title:{
            type: String,
            default: 'Title'
        },
        isCheck:{
            type: Boolean,
            default: false
        }
    }
    // Other component options like props, data, methods, etc.
}
</script>

<style scoped>
/* Component styling */
</style>
