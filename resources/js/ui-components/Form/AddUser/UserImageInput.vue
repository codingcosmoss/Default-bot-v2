<template>

    <!--begin::Group-->
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-left">{{Label}}</label>
        <div class="col-lg-9 col-xl-9">
            <div class="image-input image-input-outline" id="kt_user_add_avatar">
                <div class="image-input-wrapper" :style="{ backgroundImage: 'url(' + Value + ')' }"></div>

                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                    <i class="fa fa-pen icon-sm text-muted"></i>
                    <input type="file" multiple
                           :name="Name"
                           @change = "onFileChange($event)"
                    />
                    <input type="hidden" name="profile_avatar_remove" />
                </label>
                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
																							<i class="ki ki-bold-close icon-xs text-muted"></i>
																						</span>

            </div>
        </div>
    </div>
    <!--end::Group-->

</template>
<script >
    export default {
        props:{
            Name: {
                type: String,
            default: 'Input_name'
            },
            Value: {
                type: [String, Object],
                default: 'assets/media/default.jpg'
            },
            Type: {
                type: String,
                default: 'file'
            },
            Desc: {
                type: String,
                default: 'If you want your invoices addressed to a company. Leave blank to use your'
            },

            Label: {
                type: String,
                default: 'Input Label'
            },
            Accept:{
                type: String,
                default: ''
            }

        },
        methods: {
            onFileChange(e) {
                const selectedFile = e.target.files;
                console.log(selectedFile)

                // FormData obyektini yaratish va faylni qo'shish
                // const formData = new FormData();
                // formData.append('file', selectedFile);

                this.$emit(this.Name, selectedFile);

                // // APIga post so'rovini yuborish
                // axios.post('api/upload', formData, {
                //     headers: {
                //         'Content-Type': 'multipart/form-data'
                //     }
                // })
                // .then(response => {
                //     console.log('Yuborish muvaffaqiyatli:', response);
                //     // Yuborish muvaffaqiyatli bo'lsa kerakli ishlarni amalga oshiring
                // })
                // .catch(error => {
                //     console.error('Yuborishda xatolik:', error);
                //     // Yuborishda xatolik bo'lsa kerakli ishlarni bajarish
                // });
            }
        }

    }

</script>

