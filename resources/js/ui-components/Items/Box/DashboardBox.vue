<template>
    <div class="col-md-3">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium">{{ Title }}</p>
                        <h4 class="mb-0">{{Number}}</h4>
                    </div>

                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="font-size-24" :class="Icon"></i>
                                                            </span>
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
            Title:{
                type: String,
                default: 'Title'
            },
            Icon:{
                type: String,
                default: 'bx bx-copy-alt'
            },
            Number:{
                type: [String, Number],
                default: 1234
            }
        }
    }

</script>
