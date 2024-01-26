<template>

    <li class="menu-item "  :class="isActive ? 'menu-item-active' : '' " >
        <a @click = "this.$router.push(Link)"  class="menu-link">

            <span class="svg-icon menu-icon">
                <i :class="MenuIcon" class="menuIcon" ></i>
            </span>

            <span class="menu-text">{{Title}}</span>

        </a>
    </li>

</template>
<script >

    export default {
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
            Link: {
                type: String,
                default: '#'
            },

        }
    }

</script>

<style scoped >
  .menuIcon{
      font-size: 20px;
  }
  .menu-text{
      font-size: 15px !important;
  }
</style>
