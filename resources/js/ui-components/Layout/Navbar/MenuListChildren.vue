<template>

    <li class="menu-item menu-item-submenu" @click = "clickMenu()" :class="isActive ? 'menu-item-active' : '' " aria-haspopup="true" data-menu-toggle="hover"
            data-bs-toggle="collapse" :href="'collapseExample' + Unic " role="button" aria-expanded="false" aria-controls="collapseExample"
    >
        <a  class="menu-link menu-toggle ">
            <span class="svg-icon menu-icon">
                <i :class="MenuIcon" class="menuIcon " ></i>
            </span>
            <span class="menu-text">{{ Title }}</span>
            <i class="menu-arrow"></i>
        </a>
        <div class=" menu-submenu collapse hidden "   :id="'collapseExample' + Unic "  >
            <ul  >
               <slot>
                    <h1>sas</h1>
               </slot>
            </ul>

        </div>
    </li>

</template>
<script>
    import MenuList from "./MenuList.vue";


    export default {
        components: {MenuList},
        props: {
            MenuIcon:{
                type: String,
                default: "ki ki-menu-grid text-success"
            },
            Title:{
                type: String,
                default: 'Link menu'
            },
            isActive: {
                type: Boolean,
                default: false
            },
            Unic: {
                type: String,
                default: '1'
            },

        },

        methods:{
            clickMenu(){
                const menubox = document.querySelector('.menu-submenu');
                const icon = document.querySelector('.menu-arrow');
                if (menubox.classList.contains("hidden")) {
                    icon.classList.add("iconRotate")
                    menubox.classList.remove("hidden")
                }else {
                    icon.classList.remove("iconRotate")
                    menubox.classList.add("hidden")
                }
            }
        }

    }
</script>

<style scoped>

    .menu-submenu{
        display: block !important;
        transition: .3s !important;
        overflow: hidden;
    }
    .hidden{
        height: 0px ;
    }

    .menu-arrow{
        transition: .3s !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        border-radius: 50% ;
    }
    .iconRotate{
        transition: .3s !important;

        transform: rotate(90deg);
    }

    .menuIcon{
        font-size: 20px;
    }
    .menu-text{
        font-size: 15px !important;
    }


</style>
