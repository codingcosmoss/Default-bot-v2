<template>

    <div title="User-info" class="col-lg-12 order-1 order-xxl-2" :class="'col-xxl-'+ColXxl">
        <!--begin::Card-->
        <div class="card card-custom gutter-b card-stretch">
            <!--begin::Body-->
            <div class="card-body pt-4">

                <!--begin::Toolbar-->
                <TopbarInfo Display = "hidden"  />
                <!--end::Toolbar-->

                <!--begin::User-->
                <div class="d-flex align-items-end mb-7">
                    <!--begin::Pic-->
                    <div class="d-flex align-items-center">
                        <!--begin::Pic-->
                        <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                            <div class="symbol symbol-circle symbol-lg-75">
                                <img :src="Img" alt="image" />
                            </div>
                            <div class="symbol symbol-lg-75 symbol-circle symbol-primary d-none">
                                <span class="font-size-h3 font-weight-boldest">JM</span>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column">
                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">Luca Doncic</a>
                            <span class="text-muted font-weight-bold">Head of Development</span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::User-->

                <!--begin::Desc-->
                <p class="mb-7 hidden">I distinguish three
                    <a href="#" class="text-primary pr-1">#XRS-54PQ</a>objectives First objectives and nice cooked rice</p>
                <!--end::Desc-->

                <!--begin::Info-->
                <div class="mb-3" v-for="list in InfoList">

                    <div class="d-flex justify-content-between align-items-center "  >
                        <span class="text-dark-75 font-weight-bolder mr-2">{{ list.key }}:</span>
                        <p class="text-muted text-hover-primary m-0">{{list.value}}</p>
                    </div>

                </div>
                <!--end::Info-->
                <a @click = "this.$router.push(Btn[1])" class="btn btn-block btn-sm btn-light-warning font-weight-bolder text-uppercase py-4">{{Btn[0]}}</a>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>

</template>

<script>
import TopbarInfo from './Topbar-info.vue';
    export default {
        name: 'UserInfo',
        components:{
            TopbarInfo
        },
        props:{
            ColXxl:{
                type: Number,
                default: 4
            },
            Btn:{
                type: Array,
                default: [
                    'White Message',
                    '/'
                ]
            },
            Img:{
                type:String,
                default: '../../../assets/media/users/300_1.jpg'
            },
            InfoList: {
                type: Array,
                default: [
                    {
                        'key': 'Email',
                        'value': 'muhammadaliwebdeveloper@gmail.com'
                    },
                    {
                        'key': 'Email',
                        'value': 'muhammadaliwebdeveloper@gmail.com'
                    }
                ]
            }
        }

    }

</script>

