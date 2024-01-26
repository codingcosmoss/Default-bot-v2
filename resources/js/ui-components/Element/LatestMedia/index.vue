<template >
    <div :class="'col-xl-'+ColXl">
        <!--begin::List Widget 12-->
        <div class="card card-custom card-stretch gutter-b">

            <Header :Title = "Title" />

            <!--begin::Body-->
            <div class="card-body pt-2">

                <Item />

            </div>
            <!--end::Body-->
        </div>
        <!--end::List Widget 12-->
    </div>
</template>
<script>
import Header from './header.vue';
import Item from './item.vue';
export default {
    components: {
        Header,
        Item
    },

    props:{
        Title:{
            type: String,
            default: 'Title'
        },
        ColXl:{
            type: Number,
            default: 6
        }
    }
}
</script>
<style lang="">
    
</style>