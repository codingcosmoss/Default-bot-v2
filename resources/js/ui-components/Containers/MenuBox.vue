<template>
    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li class="menu-title" key="t-menu">Menu</li>

                <slot></slot>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</template>
<script setup>
import MenuButton from "@/ui-components/Containers/MenuButton.vue";
</script>
