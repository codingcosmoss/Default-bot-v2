<template>

    <div class="row justify-content-center">
        <div class="col-xl-9">
            <!--begin::Wizard Step 1-->
            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                <h5 class="text-dark font-weight-bold mb-10">{{Title}}</h5>

                <slot>


                </slot>


            </div>
            <!--end::Wizard Step 1-->
        </div>
    </div>

</template>
<script>

export default {
    props:{
        Title:{
            type:String,
            default: 'Form title'
        }
    }
}
</script>
