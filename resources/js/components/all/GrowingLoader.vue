<template>
    <tr>
        <td :colspan="Cols" style="text-align: center" >
            <div class="spinner-grow text-primary m-1" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </td>
    </tr>

</template>

<script>
export default
{
    props:{
        Cols:{
            type: Number,
            default: 0
        }
    }
}
</script>
<style scoped>
    .loaderBox{
        margin: 0 auto !important;
    }
</style>
