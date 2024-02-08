<template >
    <div class="col-span-12 xl:col-span-12">
        <div
            class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
                {{getName('employees')}}
            </h4>

            <div class="flex flex-col">


                <div class="grid grid-cols-3 rounded-sm mb-2 sm:grid-cols-5 relative">

                    <div >
                        <input type="text" placeholder="Search" @input = "clickSearch($event.target.value)"
                               class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"  />
                    </div>

                    <div>
                        <select type="text" placeholder="Search" @input = "onSearch($event.target.value)"
                                class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"  >

                            <option value="id">ID</option>
                            <option value="name">{{getName('name')}}</option>
                            <option value="login">{{getName('login')}}</option>
                            <option value="position">{{getName('position')}}</option>

                        </select>

                    </div>

                    <div class="ml-4">
                        <select type="text" placeholder="Search" @input = "order = $event.target.value"
                               class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"  >

                            <option value="desc">{{getName('decrease')}}</option>
                            <option value="asc">{{getName('growth')}}</option>

                        </select>

                    </div>



                    <div class="ml-4">
                        <select type="text" placeholder="Search" @change = "clickSearch" @input = "paginate = $event.target.value"
                                class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"  >

                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>

                        </select>

                    </div>

                    <div class="flex flex-wrap gap-5 xl:gap-20" style="position: absolute; right: 0px; top: 0">
                        <a @click = "this.$router.push('/employees/create')"
                           class=" cursor-pointer inline-flex items-center justify-center rounded-md bg-primary py-3 px-10 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10">
                            {{getName('create')}}
                        </a>

                    </div>

                </div>

                <TableHeader></TableHeader>

                <div v-for="(item, index) in items" class="grid grid-cols-6 border-b border-stroke dark:border-strokedark sm:grid-cols-6">

                    <div class="flex items-center gap-3 p-2.5 xl:p-5">
                        <p class="font-medium hidden text-black dark:text-white sm:block">{{index+1}}.  {{item.name}}</p>
                    </div>

                    <div class="flex items-center justify-center p-2.5 xl:p-5">
                        <p class="font-medium text-black dark:text-white">{{item.position}}</p>
                    </div>

                    <div class="flex items-center justify-center p-2.5 xl:p-5">
                        <p class="font-medium text-meta-3">{{item.login}}</p>
                    </div>

                    <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                        <p class="font-medium text-black dark:text-white">
                            <div style="width: 40px; height: 20px; " :style = " 'background:'+item.color +'' " >
                            </div>
                        </p>
                    </div>

                    <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                        <p class="font-medium text-meta-5">
                            {{item.sort_order}}
                        </p>
                    </div>



                    <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                        <p class="font-medium text-meta-5">
                            <i @click = "this.$router.push({ path: '/employees/update', query: { id: item.id } })" class="fa-solid fa-pen-to-square"></i>
                            &nbsp;
                            <i class="fa-solid fa-eye"></i>
                            &nbsp;
                            <i class="fa-solid fa-key"></i>
                            &nbsp;
                            <i class="fa-solid fa-calendar-days"></i>
                            &nbsp;
                            <i class="fa-solid fa-trash"></i>
                        </p>
                    </div>

                </div>


            </div>
        </div>
    </div>

</template>
<script>
import {useConterStore} from "../../../store/counter.js";
import TableHeader from "./Table-header.vue";
import router from "../../../router/index.js";
import {Employees} from "../../../Api.js";
import {searchEmployee} from "../../../Api.js";

export default {
    components: {TableHeader},
    data(){
        return{
            items: [],
            search: '',
            column: 'sort_order',
            order: 'asc',
            paginate: 10

        }
    },
    methods:{
        router() {
            return router
        },
        getName(val){
            return useConterStore().getName(val)
        },
        async getItems(){
            const response = await Employees();
            this.items = response.data.employees;
        },
        async clickSearch(val){
            this.search = val;
            if (val == ''){
                this.getItems();
            }else {
                var data = {
                    'search': this.search,
                    'order' : '',
                    'column': '',
                    'paginate': 10
                }
                const response = await searchEmployee(data);
                this.items = response.data.items;
                console.log(response.data.items)
            }


        },
        onSearch(val){
            this.order = val;
            this.search();
        }

    },
    mounted() {
        this.getItems()
    }
}
</script>
<style >
    .fa-solid{cursor: pointer}

</style>
