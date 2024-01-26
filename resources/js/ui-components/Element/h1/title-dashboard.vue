<template>

    <h1 class="col-lg-12 col-xxl-4 order-1 order-xxl-2 w-100">{{Title}} <hr></h1>

</template>
<script >

export default {
    name: 'title-dashboard',
    props:{
        Title:{
            type: String,
            default: 'Title dashboard'
        }
    }
}

</script>
