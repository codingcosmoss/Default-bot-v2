<template>
    <div class="text-center mb-4">
        <div class="avatar-md mx-auto mb-4">
            <div class="avatar-title bg-light rounded-circle text-primary h1">
                <i class="bx bx-info-circle"></i>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-10">
                <h4 class="text-primary">{{$t('ChangeRole')}}</h4>
                <p class="text-muted font-size-14 mb-4">{{$t('ChangeRoleInfo')}}</p>

                <div>
                    <PrimaryBtn @click="reload()">{{$t('PageReload')}}</PrimaryBtn>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
import PrimaryButton from "@/components/all/PrimaryButton.vue";
import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
export default {
    components:{PrimaryBtn, PrimaryButton},
    methods:{
        reload(){
            window.location.reload()
        }
    }
}
</script>
