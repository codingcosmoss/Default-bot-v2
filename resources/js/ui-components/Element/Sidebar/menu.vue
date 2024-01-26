<template>

    <!-- Menu Item Calendar -->
    <li @click = "this.$router.push(Path)" style="cursor: pointer">
        <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
            @click="selected = (selected === 'Calendar' ? '' : 'Calendar')"
           :class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Calendar') && (page === 'calendar') }">
            <i :class="Icon"></i>

            {{Title}}
        </a>
    </li>
    <!-- Menu Item Calendar -->
</template>
<script >
export default {
    data(){
        return{
            selected: '',
            page: '',
        }
    },
    props:{
        Title:{
            type: String,
            default: 'Menu Title'
        },
        Icon:{
            type: String,
            default: 'fa-solid fa-layer-group'
        },
        Path:{
            type: String,
            default: '/'
        }
    }
}
</script>
