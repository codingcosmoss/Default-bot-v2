<template>
    <div class="mb-3">
        <label for="username" class="form-label">{{Label}}</label>
        <input :type="Type" class="form-control" :value="Value" :placeholder="Pholder" @input ="this.$emit('onInput', $event.target.value)" >
    </div>
</template>
<script>
    export default {
        props:{
            Label:{
                type: [String],
                default: 'Label...'
            },
            Type:{
                type: [String],
                default: 'text'
            },
            Value: {
                type: [String],
                default: null
            },
            Pholder:{
                type: [String],
                default: 'Placeholder...'
            }
        }
    }
</script>
