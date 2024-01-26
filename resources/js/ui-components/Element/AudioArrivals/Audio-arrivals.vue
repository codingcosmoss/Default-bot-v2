<template>

<div  class=" order-2 order-xxl-1" :class = "'col-xxl-' + Size">
        <!--begin::Advance Table Widget 2-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">{{Title}}</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">{{Desc}}</span>
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <a v-if="deletes.length>0" class="nav-link bg-danger py-2 px-4 active"  data-bs-toggle="modal" data-bs-target="#delete01"  href="#kt_tab_pane_1_2">Delete</a>
                            <AlertModal Name = "delete01" Title = "Chindan o'chib tashlamoqchimisiz">

                                <button  @click = "onDelete" type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Ha</button>

                            </AlertModal>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_tab_pane_1_2">Restart</a>
                        </li>

                        <UploadModal @isUpload = "this.$emit('isUpload', true)">

                        </UploadModal>

                    </ul>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-3 pb-0">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-borderless table-vertical-center">
                        <thead>
<!--                        <tr >-->
<!--                            <th class="p-0" style="width: 50px">Rasmi</th>-->
<!--                            <th class="p-0 " >Malumotlar</th>-->
<!--                            <th class="p-0 d-flex justify-content-center" style="min-width: 100px">Janiri</th>-->
<!--                            <th class="p-0 " style=" text-align: end; min-width: 125px">Boshlangan vaqti</th>-->
<!--                            <th class="p-0" style="min-width: 110px; text-align: end">Holati</th>-->
<!--                            <th class="p-0" style="min-width: 150px; text-align: end"> Sozlamalar</th>-->
<!--                        </tr>-->
                        </thead>
                        <tbody>

                        <tr >
                            <td class="pl-0 py-4">
                                <div class="symbol symbol-50 symbol-light mr-1">
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                        <input type="checkbox" class="checkbox" @click = "onChecked()" :checked = "deletes.length == Items.length && Items.length != 0">
                                    </span>
                                </div>
                            </td>
                            <td class="pl-0">
                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Malumotlar</span>
                            </td>
                            <td class="text-right">
                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Player</span>
                            </td>
                            <td class="text-right">
                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Order</span>
                            </td>

                            <td class="text-right pr-0">
                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Sozlamalar</span>
                            </td>
                        </tr>


                        <tr v-if="this.Items.length > 0" v-for="item in Items" class="row01">
                            <td class="pl-0 py-4">
                                <div class="symbol symbol-50 symbol-light mr-1">
                                    <input type="checkbox" class="checkbox" :checked = "this.deletes.indexOf(item['id']) != -1" @click = "itemChecked(item['id'])" :id = "'checked'+ item['id']" >
                                </div>
                            </td>
                            <td class="pl-0">
                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{item['title']}}</a>
                                <div>
                                    <a class="text-muted font-weight-bold text-hover-primary" href="#">{{item['description']}}</a>
                                </div>
                            </td>
                            <td class="text-right">
                                <audio controls :src="item['url']" ></audio>
                            </td>
                            <td class="text-right">
                                <span class="text-muted font-weight-600">{{ item['album'] }}</span>
                            </td>

                            <td class="text-right pr-0">



                                <a data-bs-toggle="modal" @click = "saveAudioId(item['id'])" data-bs-target="#UpdateMusic" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:../../../assets/media/svg/icons/Communication/Write.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </a>

                                <AlertModal :Name = "'delete00'+item['id']" Title = "Chindan o'chib tashlamoqchimisiz">

                                    <button  @click = "oneDelete(item['id'])" type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Ha</button>

                                </AlertModal>

                                <a data-bs-toggle="modal" :data-bs-target="'#delete00'+item['id']"   class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:../../../assets/media/svg/icons/General/Trash.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </a>

                            </td>
                        </tr>


                        <tr v-if="!isFinished" >
                            <td  colspan="6">
                                <div class="d-flex justify-content-center ">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr v-if="isFinished && Items == '' " >
                            <td  colspan="6">
                                <div class="d-flex justify-content-center ">
                                    <h3 style="color: rgba(60,60,63,0.74)">Audio fayllar mavjud emas</h3>
                                </div>
                            </td>
                        </tr>



                        </tbody>

                    </table>

                </div>
                <!--end::Table-->
            </div>
            <!--end::Body-->
            <div class="d-flex justify-content-end pr-9">
                <Paginate :Links = "Links"  @onLink = "this.$emit('onLink', $event)"/>
            </div>

            <UpdateModal @updateModal = "this.$emit('updateAudio', true)"  Name = "UpdateMusic" :AudioId = "AudioId"   >

            </UpdateModal>


        </div>
        <!--end::Advance Table Widget 2-->
    </div>

</template>

<script >
    import StationTr from "../../Form/AddUser/StationTr.vue";
    import Index from "../LatestMedia/index.vue";
    import UploadModal from '../../../components/Pages/Playlist/UploadModal.vue'
    import Item from "../LatestMedia/item.vue";
    import { useConterStore } from '../../../store/counter.js';
    import AlertModal from "../../../components/Contents/AlertModal.vue";
    import Paginate from "../../../components/Contents/Paginate.vue";
    import UpdateModal from "../../../components/Contents/UpdateModal.vue";

    export default {
        name: 'New-arrivals',
        components: {UpdateModal, Paginate, AlertModal, Index, StationTr, UploadModal},
        data(){
            return{
                Images: 'assets/media/default.jpg',
                checked: false,
                deletes: [],
                onCheck:1,
                AudioId: 0,
            }
        },
        setup(){
          const counterStore = useConterStore();
          return {counterStore}
        },
        props: {
            Size:{
                type:Number ,
                default: 8
            },
            Title:{
                type: String ,
                default: 'Title'
            },
            Desc:{
                type: String ,
                default: 'Descrition'
            },
            Items:{
                type: Array ,
                default: []
            },
            isFinished:{
                type: Boolean ,
            },
            Links:{
                type: Array,

            },

        },
        methods:{
            onChecked(){

                if (this.deletes.length != this.Items.length){
                    this.deletes = [];
                    for (let i=0; i < this.Items.length; i++){
                        this.deletes.push(this.Items[i]['id']);
                    }
                }else {
                    this.deletes = [];
                }
                console.log(this.deletes)

            },
            saveAudioId(id){
              this.AudioId = id;
            },
            async onDelete() {
                try {
                    const formData = new FormData();
                    formData.append('station_id', this.counterStore.station['id']);
                    formData.append('musics', this.deletes);

                    const response = await axios.post(`/station-music/delete`, formData, {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('token')}`
                        }
                    });

                    this.deletes = [];
                    this.checked = false;
                    this.$emit('onDelete', true);

                } catch (error) {
                    console.error(error);
                }
            },
            oneDelete(id){
                console.log('Station:' + this.deletes);
                if (this.deletes.indexOf(id) == -1){
                    this.deletes.push(id)
                }

                this.onDelete();
            },
            itemChecked(id){

                if (this.deletes.indexOf(id) != -1){
                    this.deletes = this.deletes.filter(item => item !== id)
                }else {
                    this.deletes.push(id)
                }

            }
        },

        mounted() {
           // this.isLoader()

        }


    }

</script>
<style >
    .station-img{
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .checkbox{
        margin-left: 10px ;
        transform: scale(1.5);
    }

</style>
