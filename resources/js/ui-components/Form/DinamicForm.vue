<template>

    <ul class="list01" >
        <li class="flex " v-for="(item, index) in personal_procents">
            <Select
                :Couple = "false"
                :Label = "getName('employees')"
                @onSelect = "this.personal_procents[index]['employee'] = $event"
            >

                <option>---</option>
                <option
                    v-for=" employe in employes"
                    :value="employe.id"
                    :selected = "employe.id == this.personal_procents[index]['employee']"
                > {{employe.name}}</option>

            </Select>

            <Input
                style="margin-left: 20px"
                Type = "number"
                :Couple = "false"
                :Label = "getName('percentage')"
                @onInput = "this.personal_procents[index]['procent'] = $event"
                :isError = "hasKey('status')"
                :message = "errorObj['status']"
                :Value = "this.personal_procents[index]['procent']"
            />

            <PrimaryButton2 @click = "removeTudo(index)" Class ="btn-delete " class ="btn2"  Icon = "fa-solid fa-trash" Title = "" />

        </li>

        <PrimaryButton2 @click = "addTodo" Class ="btn-primary" class="btn" Icon = "fa-solid fa-plus" Title = "" />

    </ul>
</template>
<script >
import PrimaryButton2 from "./PrimaryButton2.vue";
import Input from "../../components/Pages/Services/Create/Inputs/Input.vue";
import Select from "../../components/Pages/Services/Create/Inputs/Select.vue";
import {GET} from "../../Config.js";

    export default {
        data(){
            return
            {
                personal_procents: [
                    {
                        procent: 0,
                        employee: '',
                    },

                ]
            }

        },
        methods:{
            addTodo(){
                this.personal_procents.push({
                    employee: '',
                    procent: 0
                })
            },
            removeTudo(key){
                this.personal_procents.splice(key, 1);
            },
            async getEmployes(){
                const response = await GET('/employee/index?pages=1000');
                this.employes = response.data.employees;
            },
        },
        mounted() {
            this.getEmployes()
        }
    }
</script>
