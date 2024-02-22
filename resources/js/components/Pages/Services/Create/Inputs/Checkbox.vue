<template>

    <li>
        <input type="checkbox" @input = "this.$emit('onCheck', true)" />
        &nbsp;
        {{Title}}
    </li>

</template>

<script>

    import Input from "./Input.vue";

    export default {
        components: {Input},
        props:{
            Couple:{
                type: Boolean,
                default: true
            },
            Title:{
                type: String,
                default: 'Checkbox title'
            }
        }
    }

</script>

<style scoped>
    input{
        transform: scale(1.4);
        cursor: pointer;

    }
    li{
        font-size: 18px;
        margin: 10px 0;
    }
</style>
