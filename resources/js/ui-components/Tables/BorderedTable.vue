<template>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 v-if="isHeader" class="card-title">{{Title}}</h4>
                <p v-if="isHeader" class="card-title-desc">{{Desc}}</p>
                <div v-if="isHeader" class="row mb-3 justify-content-between "  >
                    <div class="col-lg-3 col-sm-3">
                        <div>
                            <input class="form-control" type="text" placeholder="Search..." @input="this.$emit('search', $event.target.value)">
                        </div>
                    </div>
                    <button @click="this.$emit('onCreate', true)" data-bs-toggle="modal" :data-bs-target="'#'+CreateModal" type="button" class="btn btn-primary waves-effect waves-light create_btn" >
                        Qo'shish
                    </button>

                </div>
                <slot >
                </slot>



            </div>
        </div>

    </div>

</template>
<script >
    export default {
        props:{
            Title:{
                type:String,
                default: 'Bordered table'
            },
            Desc:{
                type:String,
                default: 'Add for borders on all sides of the table and cells.'
            },
            CreateModal:{
                type:String,
                default: 'modal-01'
            },
            isHeader:{
                type:Boolean,
                default: true
            },
        }
    }
</script>
