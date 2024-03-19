<template>

    <div class="modal_box hidden">
        <div
            :class="full ? 'full' : '' "
            class=" modal_block rounded-sm border border-stroke bg-white py-6 px-7.5 dark:border-strokedark dark:bg-boxdark ">
            <h1 class="title dark:text-white" >{{Title}}</h1>
            <div class="mb-2  font-bold text-black dark:text-white">
                <slot></slot>
            </div>
            <div class="btn-box">
                <button class="dark:text-white" @click = "onModal" >Close</button>
                <button v-if="isSubmit" class="dark:text-white" @click = "this.$emit('Submit', true)">Submit</button>
            </div>
        </div>
    </div>


</template>

<script>
    import {set} from "vue-modal-service";

    export default {
        props:{
          isModal:{
              type: Boolean,
              default: false
          },
            full:{
                type: Boolean,
                default: false
            },
        isSubmit:{
            type: Boolean,
            default: true
        },
          Title:{
              type: String,
              default: 'Modal title'
          }
        },
        methods:{
            onModal(){
                const modal_box = document.querySelector('.modal_box');
                if (modal_box.classList.contains('open-modal')){
                    modal_box.classList.add('close-modal');
                    setTimeout(()=>{
                        modal_box.classList.add('hidden');
                    }, 300 );
                    modal_box.classList.remove('open-modal');
                    this.$emit('closeModal', false);
                }else {
                    modal_box.classList.remove('hidden');
                    modal_box.classList.remove('close-modal');
                    modal_box.classList.add('open-modal');
                }
            },
            isOnModal(){
                console.log('open modal')
                const modal_box = document.querySelector('.modal_box');
                if (!this.isModal){
                    modal_box.classList.add('close-modal');
                    setTimeout(()=>{
                        modal_box.classList.add('hidden');
                    }, 300 );
                    modal_box.classList.remove('open-modal');
                    // this.$emit('closeModal', false);
                }else {
                    modal_box.classList.remove('hidden');
                    modal_box.classList.remove('close-modal');
                    modal_box.classList.add('open-modal');
                }

            }
        },
        watch:{
            isModal: function(newVal, oldVal) { // watch it
               this.isOnModal()
            }
        }

    }

</script>

<style scoped lang="scss">
    .modal_box{
        position: fixed;
        width: 100%;
        height: 100vh;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.58);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        overflow-y: auto;
        padding: 25px 0;
    }


    .open-modal{
        animation: open-modal 0.1s linear alternate forwards;
        .modal_block{
            animation: block-modal 0.3s linear alternate;
        }
    }
    .hidden{
        display: none;
    }
    .close-modal{
        animation: close-modal 0.1s linear alternate forwards;
        .modal_block{
            animation: block-modal-close 0.3s linear alternate;
        }
    }

    .modal_block{
        width: 500px;
        overflow-y: auto;
        margin: auto;
        z-index: 999 !important;
    }

    .full{
       height: 90%;
    }

    .title{
        margin-bottom: 20px;
        font-size: 20px;
    }
    .btn-box{
        width: 100%;
        display: flex;
        justify-content: flex-end;
        button{
            padding: 10px 20px;
            border-radius: 20px;
            background: #10B981;
            margin-left: 10px;
            color: white;
        }
        button:active{
            transform: scale(0.8);
        }
    }
    @keyframes block-modal {
        from{
            opacity: 0;
            transform: scale(0.8);
        }to{
        opacity: 1;
        transform: scale(1);
                 }
    }
    @keyframes block-modal-close {
        from{
            opacity: 1;
            transform: scale(1);
        }to{
             opacity: 0;
                     transform: scale(0.8);
         }
    }
    @keyframes open-modal {
        from{
            opacity: 0;
        }to{
             opacity: 1;
            display: flex;
         }
    }
    @keyframes close-modal {
        from{
            opacity: 1;
        }to{
             opacity: 0;
             display: none;
         }
    }
</style>
