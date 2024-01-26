<template>


    <div class="col-lg-6 col-xxl-4" title="Resent-activate">
        <!--begin::List Widget 9-->
        <div class="card card-custom card-stretch gutter-b">

            <resentHeader/>

            <resentBody/>


        </div>
        <!--end: Card-->
        <!--end: List Widget 9-->
    </div>

</template>
<script >
import resentHeader from './resent-header.vue';
import resentBody from './resent-body.vue';
export default {
    name: 'RecentActivitie',
    components:{
        resentHeader,
        resentBody
    }
}

</script>
