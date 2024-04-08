<template>

    <div class="col-span-6 xl:col-span-6 ">


        <StackedBarChart :plot-data="barchartdata"
                         x-key="date" />

        <StackedBarChart :plot-data="barchartdata"
                         x-key="date" />

    </div>





    <Map01>

    </Map01>


</template>

<script>
import Map01 from "@/ui-components/Element/map-01.vue";

export default {
    components: {Map01},
    data(){
        return{
            barchartdata: [
                { "date": 2019, "Utilities": 21, "Rent": 16, "Insurance": 22 },
                { "date": 2020, "Utilities": 19, "Rent": 10, "Insurance": 17 },
            ]
        }
    },
    methods:{
        sendData(){

        }
    }
}

</script>

<style scoped></style>
