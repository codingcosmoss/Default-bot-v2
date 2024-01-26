<template>


    <a class="topbar" >
        <i :class="TopbarIcon" class="menuIcon" ></i>
        {{Title}}
    </a>

    <!--end::Chat-->

</template>
<script >
    export default  {
        name: 'topbar-item',
        props: {
            TopbarIcon:{
                type: String,
                default: "ki ki-menu-grid text-success"
            },
            Title:{
                type: String,
                default: "Title"
            },
        },

    }

</script>

<style scoped>
    .topbar{
        height: 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 15px;
        margin: 0 15px;
        color: #4c4747;
        font-size: 17px;
        border-bottom: 2px solid rgba(76, 71, 71, 0);
        transition: 1s;
        cursor: pointer;
    }
    .topbar:hover{
        transition: 1s;

        border-bottom: 2px solid   #4c4747;
    }
    .menuIcon{
        font-size: 25px;
        margin-right: 10px;

    }


</style>
