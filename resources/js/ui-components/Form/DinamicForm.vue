<template>

    <ul class="list01" >
        <li class="flex mt-5 " v-for="(item, index) in personal_procents">
            <Select
                :isError ="errors.includes(index)  || summError"
                :Couple = "false"
                :Label = "getName('employees')"
                @onSelect ="this.personal_procents[index]['employee'] = $event, sendData()"
            >

                <option>---</option>
                <option
                    v-for=" employe in employes"
                    :value="employe.id"
                    :selected ="employe.id == this.personal_procents[index]['employee']"
                > {{employe.name}}</option>

            </Select>

            <Input
                :isError ="errors.includes(index) || summError"
                style="margin-left: 20px"
                Type = "number"
                :Couple = "false"
                :Label = "getName('Summa')"
                @onInput ="this.personal_procents[index]['procent'] = $event, sendData()"
                :Value = "this.personal_procents[index]['procent']"
            />

            <Select
                :isError ="errors.includes(index) || summError"
                style="width: 100px; margin: 0 20px"
                :Couple = "false"
                Label = "Type"
                @onSelect ="this.personal_procents[index]['type'] = $event,this.personal_procents[index]['index'] = index, sendData()"
            >

                <option selected value="%">%</option>
                <option value="sum">Sum</option>

            </Select>

            <div class="btn-delete">
                <i @click ="removeTudo(index), sendData()" class = "fa-solid fa-trash"></i>
            </div>

        </li>
        <p v-if="summError" class="text-danger mt-5">{{ getName('summError') }}  </p>

        <PrimaryButton2 @click ="addTodo" Class ="btn-primary" class="btn mt-5" Icon = "fa-solid fa-plus" Title = "" />

    </ul>
</template>
<script >
import PrimaryButton2 from "./PrimaryButton2.vue";
import Input from "./Input.vue";
import Select from "./Select.vue";
import { GET } from "../../Config";
import { useConterStore } from "../../store/counter";

    export default {
        components:{PrimaryButton2, Input, Select},
        data() {
            return{
                personal_procents: [],
                employes: [] // Qo'shimcha qator qo'shing
            }

        },
        props:{
            errors:{
                type: [Object, Array],
                default: []
            },

            personalProcents:{
                type: [Object, Array, String],
                default: []
            },

            summError:{
                type: [Boolean],
                default: false
            }
        },
        methods:{
            addTodo(){
                this.personal_procents.push({
                    employee: '',
                    procent: 0,
                    type: '%',
                    index: 0,
                })
            },
            async getData(){
                if (this.personalProcents.length > 0){
                    this.personal_procents =  this.personalProcents;
                }

            },
            removeTudo(key){

                if (confirm('Do you really want to delete it?')) {
                    this.personal_procents.splice(key, 1);
                }

            },
            async getEmployes(){
                const response = await GET('/employee/index?pages=1000');
                this.employes = response.data.employees;
            },
            sendData(){
                this.$emit('Data', this.personal_procents);
            },
            getName(val){
                return useConterStore().getName(val);
            },
            hasKey(key) {
                return key in this.errorObj;
            },

        },
        mounted() {
            this.getEmployes(),
            this.getData()
        },
        watch:{
            personalProcents: function (val1, val2){
                this.getData();
            }
        }
    }
</script>

<style scoped>
    .btn-delete{
        /* background-color: rgb(220, 250, 215) ; */
        width: 40px;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        color: rgb(219, 21, 21);
        cursor: pointer;
        /* height: 45px; */
        font-size: 20px;
        padding-bottom: 15px;
    }
</style>
