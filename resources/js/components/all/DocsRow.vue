<template>
    <div class="row mb-4" >
        <div class="docs_box">
            <h4 class="mb-sm-0 font-size-16">1. d_card_block </h4>
        </div>

        <slot ></slot>


    </div>

</template>
<script>
</script>

<style scoped>
    .box{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .row_slot{
        width: 100%;
    }
    .docs_box{
        width: 100%;
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        h4{
            margin-right: 10px;
            color: #6f2cf5;
        }
        button{
            border-radius: 5px;
            display: flex;
            align-items: center;
            p{
                margin: 0 10px;

            }
        }
    }
</style>
