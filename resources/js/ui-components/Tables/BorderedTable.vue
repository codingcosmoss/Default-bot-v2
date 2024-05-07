<template>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{Title}}</h4>
                <p class="card-title-desc">{{Desc}}</p>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <div>
                            <input class="form-control" type="text" placeholder="Search..." @click="this.$emit('search', $event.target.value)">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">

                    <table class="table table-bordered mb-0">

                        <slot>

                        </slot>

                    </table>
                </div>

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
            }
        }
    }
</script>
