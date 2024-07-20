<template>
    <div class="mb-3">
        <label class="form-label">{{Title}}</label>
        <div class="text-center">
            <div class="position-relative d-inline-block">
                <div class="position-absolute bottom-0 end-0">
                    <label :for="Name" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Select Image" data-bs-original-title="Select Image">
                        <div class="avatar-xs">
                            <div style="transform: scale(1.3)" class="avatar-title bg-light border rounded-circle text-muted cursor-pointer shadow font-size-16">
                                <i class="bx bxs-image-alt"></i>
                            </div>
                        </div>
                    </label>
                    <input class="form-control d-none" :name="Name" value="" :id="Name" type="file" @change = "this.$emit(Name ,$event.target.files[0])" :accept="Accept">
                </div>
                <div class="avatar-lg">
                    <div class="avatar-title bg-light  rounded-circle " :style="'background-image: url('+ Image + ')'" style="background-position: center; background-repeat: no-repeat; background-size: cover">
                    </div>

                </div>
            </div>
            <p  class="form-label text-danger" >{{Validated[ValidatedName]}}</p>
        </div>
    </div>
</template>

<script>
export default
{
    props:{
        Validated:{
            type: [Array, Object, String],
            default: []
        },
        ValidatedName:{
            type: String,
            default: 'image'
        },
        Image:{
            type: String,
            default: location.origin + '/Photos/file.png'
        },
        Title:{
            type: String,
            default: "Title"
        },
        Name:{
            type: String,
            default: ""
        },
        Accept:{
            type: String,
            default: "image/png, image/gif, image/jpeg"
        },

    },
    methods:{

    }
}
</script>
