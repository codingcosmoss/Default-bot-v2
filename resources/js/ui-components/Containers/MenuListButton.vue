<template>

    <li>
        <a href="javascript: void(0)" class="has-arrow waves-effect menu-waves-effect">
            <i :class="Icon" class="menu_icon"></i>
            <span class="menu-text" key="t-dashboards">{{Title}}</span>
        </a>
        <ul class="sub-menu" aria-expanded="false" >
            <li v-for="link in ChildLinks" ><a @click = "this.$router.push(link['path'])" key="t-default">{{link['title']}}</a></li>
        </ul>
    </li>

</template>

<script>
    export default {
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
                        path: '/'
                    }
                ]
            }
        }
    }
</script>
