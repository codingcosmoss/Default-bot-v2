<template>
    <ul class="mb-6 flex flex-col gap-1.5">

        <Menu
            Path = "/"
            Title = "Components"
            Icon = "fa-solid fa-window-restore"
        />

        <Menu
            Path = "/employees"
            :Title = "getName('employees')"
            Icon = "fa-solid fa-user-group"
        />
        <Menu
            Path = "/services"
            :Title = "getName('services')"
            Icon = "fa-regular fa-hospital"
        />
        <Menu
            Path = "/service-categories"
            :Title = "getName('service_types')"
            Icon = "fa-solid fa-truck-medical"
        />
        <Menu
            Path = "/patients"
            :Title = "getName('Patients')"
            Icon = "fa-solid fa-hospital-user"
        />

        <Menu
            Path = "/diseases"
            :Title = "getName('diseases')"
            Icon = "fa-solid fa-book"
        />

<!--        <MenuList>-->
<!--            <Menu />-->
<!--        </MenuList>-->

<!--        <Menu />-->


    </ul>
</template>
<script >
import MenuList from './menuList.vue';
import Menu from './menu.vue';
import {useConterStore} from "../../../store/counter.js";
export default {
    components: {Menu, MenuList},
    data(){
        return{
            selected: '',
            page: '',
        }
    },


    methods:{
        getName(val){
            return useConterStore().getName(val)
        }
    },

    mounted() {
        this.getName()
    }
}
</script>
