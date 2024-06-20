<template>
    <li :class="isYou && 'right' ">
        <div class="conversation-list">
            <div class="dropdown">

                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<!--                    <i class="bx bx-dots-vertical-rounded"></i>-->
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Copy</a>
                    <a class="dropdown-item" href="#">Save</a>
                    <a class="dropdown-item" href="#">Forward</a>
                    <a class="dropdown-item" href="#">Delete</a>
                </div>
            </div>
            <div class="ctext-wrap">
                <div class="conversation-name">{{isYou ? 'You' : 'Alisa'}}</div>
                <p>
                    {{Text}}
                </p>
                <p class="chat-time mb-0">
<!--                    <i class="bx bx-check-double"></i>-->
<!--                    <i class="bx bx-time-five align-middle me-1"></i> -->
                    {{Time}}
                </p>
            </div>

        </div>
    </li>
</template>

<script>
    export default{
        props:{
            isYou:{
                type: Boolean,
                default: false
            },
            Text:{
                type: [String, Number],
                default: ''
            },
            Time:{
                type: [String],
                default: '--:--'
            },


        }
    }
</script>
