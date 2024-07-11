<template>

    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18">
                                                            <i :class="Icon"></i>
                                                        </span>
                    </div>
                    <h5 class="font-size-14 mb-0">{{ Title }}</h5>
                </div>
                <div class="text-muted mt-4">
                    <h4>{{Number}} <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                    <div class="d-flex">
                        <span class="badge badge-soft-success font-size-12"> {{Share}} </span> <span
                        class="ms-2 text-truncate">{{Text}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props: {
        Title: {
            type: [String, Number],
            default: 'Title'
        },
        Text: {
            type: [String, Number],
            default: "Block desc or text"
        },
        Share: {
            type: [String, Number],
            default: '+0.2%'
        },
        Number: {
            type: [String, Number],
            default: '1,200'
        },
        Icon: {
            type: String,
            default: 'bx bx-copy-alt'
        }

    }
}
</script>
