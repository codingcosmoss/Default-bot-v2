<template>

    <div class=" form-c bg-white col-xl-12 col-xxl-10">
        <!--begin::Wizard Form-->
        <form class="form" id="kt_form" @submit.prevent enctype="multipart/form-data">
           <InputBox :Title = "Title" >

                <slot>

<!--                    <UserInput Value = "email" Name = "First_Name" @First_Name = "logs($event)" />-->

                </slot>

               <div class="btn01">
                   <button @click = "this.$router.push(BackRoute)" type="button" class="btn btn-secondary float-right px-5 py-3 mr-5 ">Back</button>

                   <button @click = "this.$emit('onSubmit', true)" type="button" class="btn btn-primary float-right px-5 py-3 ">Submit</button>
               </div>
           </InputBox>
        </form>
        <!--end::Wizard Form-->
    </div>

</template>

<script>
import InputBox from './Input-box.vue';
import UserInput from './UserInput.vue';
    export default {
        methods:{
            logs(w){
                console.log(w);
            }
        },
        props:{
            Title:{
                type: String,
                default: 'Title'
            },
            BackRoute:{
                type: String,
                default: '/'
            }
        },
        components:{
            InputBox,
            UserInput
        }
    }


</script>

<style scoped>
    .form-c{
        margin: 0 auto;
    }

    .btn01{
        width: 100%;
        display: flex;
        justify-content: flex-end;
    }

</style>
