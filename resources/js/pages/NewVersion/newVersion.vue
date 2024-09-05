<template>
    <ModalCentered :Title="$t('NewVersion')" ModalName="newVersionModal" ModalTypes="modal-xl"  :isSubmit="false" >
        <div>
          
<!--            <p class="text-muted">10 Apr, 2020</p>-->

            <div class="position-relative mb-3">
                <img :src="counterStore.baseUrl+'/Photos/new.png'" alt="" class="img-thumbnail">
            </div>


        </div>

    </ModalCentered>
</template>
<script >
import ModalCentered from "@/components/all/ModalCentered.vue";
import {useConterStore} from "@/store/counter.js";
export default {
    components:{ModalCentered},
    setup() {
        const counterStore = useConterStore();
        return {counterStore}
    },
}
</script>
