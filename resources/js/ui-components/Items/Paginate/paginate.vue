<template>
    <div class="box">
        <div class="pagination">

            <slot>
                <PaginationContent>

                </PaginationContent>
            </slot>

        </div>
    </div>
</template>

<script>
import PaginationContent from "@/ui-components/Containers/PaginationContent.vue";
 export default {
     components:{PaginationContent}
 }
</script>

<style>
.box{
    width: 100%;
    display: flex;
    justify-content: flex-end;
}

.pagination {
    display: inline-block;
    margin: 20px 0;
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    color: #10B981;

}

.pagination a.active {
    background-color: #4CAF50;
    color: white;
}

.pagination a:hover:not(.active) {background-color: #ddd;}
</style>
<script setup>
</script>
