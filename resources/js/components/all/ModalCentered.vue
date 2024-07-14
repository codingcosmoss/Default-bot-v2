<template>

    <div class="card-body">
        <div>

            <!-- Static Backdrop Modal -->
            <div class="modal fade" :id="ModalName" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered " :class="ModalTypes" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">{{Title}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <slot></slot>
                        </div>
                        <div class="modal-footer" v-if="isModalFooter">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ $t('Close') }}</button>
                            <button @click="this.$emit('onModal', true)" type="button" class="btn btn-primary">{{ $t('Submit') }}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        props:{
            Title: {
                type: [String, Number],
                default: 'Title'
            },
            isModalFooter: {
                type: Boolean,
                default: true
            },
            ModalName: {
                type: [String, Number],
                default: 'modal'
            },
            Icon: {
                type: String,
                default: 'bx bx-copy-alt font-size-24'
            },
            ModalTypes: {
                type: String,
                default: ''
            }

        }
    }
</script>
