<template>

    <ul class="list01" >
        <li class="flex mt-5 " v-for="(item, index) in personal_procents">
            <Select
                :isError ="errors.includes(index)"
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
                :isError ="errors.includes(index)"
                style="margin-left: 20px"
                Type = "number"
                :Couple = "false"
                :Label = "getName('Summa')"
                @onInput ="this.personal_procents[index]['procent'] = $event, sendData()"
                :Value = "this.personal_procents[index]['procent']"
            />

            <Select
                :isError ="errors.includes(index)"
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
            this.getEmployes()
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