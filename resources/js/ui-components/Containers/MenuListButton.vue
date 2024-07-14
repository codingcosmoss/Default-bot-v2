<template>

    <div class="accordion" :id="'accordionExample'+Name" >
        <div class="accordion-item ">
            <h2 class="accordion-header">
                <button @click="chevron = !chevron" class="accordion-button collapsed "  type="button" data-bs-toggle="collapse" :data-bs-target="'#collapseTwo'+Name" aria-expanded="false" :aria-controls="'collapseTwo'+Name">
                    <i :class="Icon" class="menu_icon"></i>
                    <p class="menu-text" :id="Name">{{Title}}</p>
                    <div class="chevronIcon" :class="chevron ? 'chevronTop'  : '' ">
                        <i class="bx bx-chevron-down "></i>
                    </div>
                </button>

            </h2>
            <div  :id="'collapseTwo'+Name" class="accordion-collapse collapse" :data-bs-parent="'#accordionExample' + Name">
                <div class="accordion-body">
                    <ul class="sub-menu" aria-expanded="false" >
                        <li @click="onMenuMedia" v-for="link in ChildLinks.filter(item => item.isPermission == true)" ><a class="menu-text " :class="this.$route.path == link.path ? 'menu_active ' : ''"  @click = "this.$router.push(link['path'])" key="t-default">
                            <i :class="link.icon" class="menu_icon "></i>
                            {{link['title']}}</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>


</template>

<script>
    export default {
        data(){return{
           chevron: false
        }},
        props:{
            Title:{
                type: [String, Number],
                default: 'Menu title'
            },
            Icon:{
                type: [String, Number],
                default: 'bx bx-home-circle'
            },
            ChildLinks:{
                type: [Array],
                default:[
                    {
                        title: 'Link title',
                        path: '/admin',
                        icon:'bx bx-home-circle'
                    },
                    {
                        title: 'Link title',
                        path: '/admin',
                        icon:'bx bx-home-circle'
                    }
                ]
            },
            Name:{
                type: [String, Number],
                default: 'name'
            },
        },
        methods:{

            onMenuMedia(){
                const body = document.getElementById('body');

                if (body.classList.contains('sidebar-enable')){
                    body.classList.remove('sidebar-enable');

                }else {
                    body.classList.add('sidebar-enable');

                }
            },
        }
    }
</script>

<style scoped lang="scss">
    .accordion:hover{
        .accordion-item{
            .menu-text{
                display: block;
            }
        }
    }

    .accordion-button{
        position: relative;
    }
    .chevronIcon{
        background: unset;
        width: 20px;
        height: 20px;
        display: flex;
        top: 10px;
        right: 15px;
        position: absolute;
        transition: .1s;
        align-items: center;
        /* justify-content: center; */
        border-radius: 50%;
        padding-bottom: 1px;
    }

    .chevronTop{
        transform: rotate(-180deg) !important;
    }

    .accordion-button[data-v-bc1d6530]::after {
        display: none;
    }
    .accordion-header:hover{
        button{
            .menu-text{
                display: flex;
            }
        }
    }


    .accordion-button:not(.collapsed)::after {
        display: none;
        transform: var(--bs-accordion-btn-icon-transform) scale(0.7) !important;
    }
    .accordion-button::after {
        transform: scale(0.7);
    }

    // o'zgarishlarni bekor qilish
    .accordion-button:not(.collapsed) {
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .accordion-item:last-of-type .accordion-button.collapsed {
        border-bottom-right-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }

    .sub-menu{
        padding: 0;
        li{
            width: 100%;
            margin: 0;
        }
    }
    .accordion-body{
        background: #2a3042;
        border: none;
    }
    .accordion-item{
        border: none;
        h2{
            margin: 0;
            button{
                padding: .625rem 1.5rem;
                display: flex;
                align-items: center;
                margin: 0 ;
                background: #2a3042;
                color: #a6b0cf;
                border: none;
                p{
                    margin: 0;
                    //background: #2a9c72;
                    padding-top: 2px;
                }
                i{
                    font-size: 1.25rem;
                    min-width: 1.75rem;
                }
            }
        }
    }
    //.accordion-button:not(.collapsed) {
    //    .menu_icon{
    //        color: green !important;
    //        background-color: rgb(52 64 107);
    //    }
    //}

</style>
