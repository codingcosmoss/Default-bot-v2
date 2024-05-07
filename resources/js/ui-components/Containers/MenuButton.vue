<template>

    <li  >
        <a @click = "this.$router.push(Path)" :class="this.$route.path == Path ? 'menu_active ': '' " class=" waves-effect menu-waves-effect" style="align-items: center">
            <i :class="this.$route.path == Path ? 'menu_active '+ Icon : Icon" class="menu_icon "></i>
            <span class="menu-text" key="t-chat" >{{Title}}</span>
        </a>
    </li>
<!--   -->
</template>

<script>
    export default {
        props:{
            Title:{
                type: [String, Number],
                default: 'Menu title'
            },
            Path:{
                type: [String, Number],
                default: '/'
            },
            Icon:{
                type: [String, Number],
                default: 'bx bx-chat'
            }
        }
    }
</script>
