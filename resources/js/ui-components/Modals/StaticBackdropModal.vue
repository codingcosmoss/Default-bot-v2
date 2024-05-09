<template>

    <!-- Static Backdrop modal Button -->
<!--    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop">-->
<!--        Static backdrop modal-->
<!--    </button>-->

    <div >

        <!-- Static Backdrop Modal -->
        <div class="modal fade " :id="Id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog  modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{Title}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button @click="this.$emit('onModal', true)" :class="isDisabled == true ? 'disabled' : ''" data-bs-dismiss="modal" type="button" class=" btn btn-primary" >Submit</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>
<script>
    export default {
        props:{
            Title:{
                type:String,
                default: 'Title'
            },
            Id:{
                type: String,
                default: 'modal-01'
            },
            isDisabled:{
                type: Boolean,
                default: true
            },
        }
    }
</script>
