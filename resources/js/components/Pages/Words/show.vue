<template>
    <StaticBackdropModal :ModalLg="true" :isSubmit="false" Id="show" Title="So'z malumotlari" @onClose="this.$emit('onClose', true)" >

        <BorderedTable :isHeader="false">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">

                    <thead  >

                        <tr>
                            <th>#Id raqami:</th>
                            <td>{{Word.id}}</td>
                        </tr>
                        <tr>
                            <th>Umumiy matn:</th>
                            <td>{{Word.text}}</td>
                        </tr>
                        <tr>
                            <th>So'z turi:</th>
                            <td>{{Word.phrase != null ? Word.phrase.name : ''}}</td>
                        </tr>
                        <tr>
                            <th>Mavzulari:</th>
                            <td>
                                <ul>
                                    <li v-for="topic in Word.topics" ><span style="font-weight: bold" >{{topic.name}}</span>  &nbsp;&nbsp;(foiz: {{topic.percent}}%)  &nbsp;(id: {{topic.id}})</li>
                                </ul>
                            </td>
                        </tr>

                    </thead>

                </table>
            </div>
        </BorderedTable>

    </StaticBackdropModal>
</template>
<script>
import StaticBackdropModal from "@/ui-components/Modals/StaticBackdropModal.vue";
import BorderedTable from "@/ui-components/Tables/BorderedTable.vue";
import Paginate from "@/ui-components/Items/Paginate/paginate.vue";
export default {
    components:{Paginate, BorderedTable, StaticBackdropModal},
    props:{
        Word:{
            type: [Array, Object],
            default: []
        }
    }
}
</script>


<style scoped>
    th{
        display: flex;
        align-items: center;
    }
</style>
