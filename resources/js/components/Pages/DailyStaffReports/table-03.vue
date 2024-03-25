<template >
  <div
  class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
  <div class="max-w-full overflow-x-auto">
    <table class="w-full table-auto" >
        <tr >

            <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                <h5 class="font-medium text-black dark:text-white"><b>{{getName('Date')}}</b></h5>
            </td>
            <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <h5 class="font-medium text-black dark:text-white"><b>{{getName('AllServices')}}</b></h5>
            </td>
            <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <h5 class="font-medium text-black dark:text-white"><b>{{getName('CilinicSum')}}</b></h5>
            </td>
            <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <h5 class="font-medium text-black dark:text-white"><b>{{getName('DoctorSum')}}</b></h5>
            </td>
            <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <h5 class="font-medium text-black dark:text-white"><b>{{getName('AmountPaidSum')}}</b></h5>
            </td>

            <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <h5 class="font-medium text-black dark:text-white"><b>{{getName('DiscountAmount')}}</b></h5>
            </td>

            <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <h5 class="font-medium text-black dark:text-white"><b>{{getName('TechnicSum')}}</b></h5>
            </td>

            <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <h5 class="font-medium text-black dark:text-white"><b>{{getName('MaterialAmount')}}</b></h5>
            </td>

            <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <h5 class="font-medium text-black dark:text-white"><b>{{getName('Show')}}</b></h5>
            </td>

        </tr>
      <tbody v-for="(item, index) in Treatments" >


      <tr  >

          <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p class="text-black dark:text-white">{{index+1}} Jan 13,2023</p>
          </td>
          <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p class="text-black dark:text-white">Jan 13,2023</p>
          </td>
          <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p class="text-black dark:text-white">Jan 13,2023</p>
          </td>
          <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p class="text-black dark:text-white">Jan 13,2023</p>
          </td>
          <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p class="text-black dark:text-white">Jan 13,2023</p>
          </td>
          <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p class="text-black dark:text-white">Jan 13,2023</p>
          </td>
          <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p class="text-black dark:text-white">Jan 13,2023</p>
          </td>
          <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p class="text-black dark:text-white">Jan 13,2023</p>
          </td>

          <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p class=" action_btn inline-flex rounded-full bg-success bg-opacity-10 py-1 px-3 text-sm font-medium text-success">
                  <i @click = "onTable(item.id)" class="fa-solid fa-plus"></i>
                  <i @click = "onTable(item.id)" class="fa-solid fa-minus"></i>
              </p>
          </td>

      </tr>

      <tr class="bottom_table01   hidden" :class="'bottom_table011' + item.id" >
          <td colspan="9" >

              <table class="table001" >

                  <tr class="tabletr">
                      <td><b>{{getName('Employee')}}</b></td>
                      <td><b>{{getName('AllServices')}}</b></td>
                      <td><b>{{getName('CilinicSum')}}</b></td>
                      <td><b>{{getName('DoctorSum')}}</b></td>
                      <td><b>{{getName('AmountPaidSum')}}</b></td>
                      <td><b>{{getName('DiscountAmount')}}</b></td>
                      <td><b>{{getName('TechnicSum')}}</b></td>
                      <td><b>{{getName('MaterialAmount')}}</b></td>
                  </tr>

                  <tr  class="tabletr">
                      <td>Alisher</td>
                      <td>Alisher</td>
                      <td>Alisher</td>
                      <td>Alisher</td>
                      <td>Alisher</td>
                      <td>Alisher</td>
                      <td>Alisher</td>
                      <td>Alisher</td>
                  </tr>

              </table>

          </td>
      </tr>



      </tbody>

    </table>
  </div>
</div>
</template>
<script>
import Table from "@/components/Pages/Diseases/Table.vue";
import {useConterStore} from "@/store/counter.js";
import {dalyTreatments} from "@/Api.js";
export default {

    components: {Table},
    data(){
        return{
            year: 2024,
            moon: 3,
            Treatments: []
        }
    },
    methods:{
        onTable(id){
            const tableBox = document.querySelector('.bottom_table011'+id)
            if (tableBox.classList.contains('hidden')){
                tableBox.classList.remove('hidden')
            }else {
                tableBox.classList.add('hidden')
            }
        },
        getName(val){
            return useConterStore().getName(val)
        },
        async getModels() {
            const response = await dalyTreatments(this.year, this.moon);
            console.log(response)
            this.Treatments = response.data;
        }

    },
    mounted() {
        this.getModels()
    }

}
</script>
<style scoped>
        td{
            font-size: 13px;
        }
        .bottom_table01{
            margin: 0 auto;
            //background: rgba(60, 80, 224, 0.29) !important;
        }
        .action_btn:hover{
            .fa-plus{
                display: none;
            }
            .fa-minus{
                display: block;
            }
        }
        .fa-minus{
            display: none;
        }
        .table001{

            width: 100%;
            margin: 20px auto;
            overflow: hidden;
        }
        .tabletr{
            border: 1px solid rgba(6, 45, 202, 0.84);
            td{
                padding: 5px;
                border: 1px solid rgba(10, 125, 220, 0.76);
            }
        }
</style>
