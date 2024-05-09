
<script setup lang="ts">
import { ref } from "vue";
const onClickHandler = (page: number) => {
    console.log(page);
};

const currentPage = ref(1);
const totalItems = ref(1);


</script>


<template>
   <slot>

   </slot>
</template>


<style>
.pagination-container {
    display: flex;
    column-gap: 10px;
}
.paginate-buttons {
    height: 40px;
    width: 40px;
    border-radius: 20px;
    cursor: pointer;
    background-color: rgb(8, 147, 234);
    border: 1px solid rgba(217, 217, 217, 0);
    color: #ffffff;
}
.paginate-buttons:hover {
    background-color: rgba(8, 147, 234, 0.66);
}
.active-page {
    background-color: #3498db;
    border: 1px solid #3498db;
    color: white;
}
.active-page:hover {
    background-color: #2988c8;
}
</style>
