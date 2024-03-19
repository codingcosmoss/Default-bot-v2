<template>
    <a :class="active ? 'active' : '' " class="cursor-pointer" >{{number}}</a>
</template>

<script>

    export default {
        props:{
            number:{
                type: Number,
                default: 0
            },
            active:{
                type: Boolean,
                default: false
            },
            link:{
                type: String,
                default: 0
            },


        }

    }

</script>
