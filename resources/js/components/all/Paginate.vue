<template>
    <td :colspan="Cols" class="paginate_td">
        <div class="btn-group me-2 paginate_box" role="group" aria-label="First group">
            <button
                v-for="page in pages"
                :key="page"
                :class="['btn', 'btn-outline-secondary', { active: page === currentPage }, { media_paginate: totalPages > 36 }]"
                @click="changePage(page)"
            >
                {{ page }}
            </button>
        </div>
    </td>
</template>

<script>
export default {
    props: {
        Cols: {
            type: [Number, String],
            default: 8
        },
        currentPage: {
            type: Number,
            default: 1
        },
        totalPages: {
            type: Number,
            default: 1
        }
    },
    computed: {
        pages() {
            const pages = [];
            for (let i = 1; i <= this.totalPages; i++) {
                pages.push(i);
            }
            return pages;
        }
    },
    methods: {
        changePage(page) {
            this.$emit('changePage', page);
        }
    }
}
</script>

<style lang="scss">
.paginate_td {
    text-align: end;
}
.media_paginate{
    height: 24px;
    width: 9px;
    font-size: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.paginate_box {
    margin-top: 10px;

    button {
        height: 35px;
        width: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
}
</style>
