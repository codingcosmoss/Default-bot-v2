<template>

    <div :class="Class">
        <div>
            <label class="form-label" v-if="Label != '' ">
                {{ Label }}
                <a v-if="isButton" class="btn btn-primary waves-effect waves-light" role="button" data-bs-toggle="modal" :data-bs-target="'#'+ModalName" style="padding: 0px 5px;font-size: 10px;"> {{$t('Create')}} </a>
            </label>
            <select class="form-select"
                    :class="Validated[Name] ? 'border-danger' : '' "
                    @input="this.$emit('onInput', $event.target.value)"
            >
                <slot></slot>
            </select>
            <p class="form-label text-danger" v-if="Validated[Name]">{{ Validated[Name] }}</p>
        </div>
    </div>

</template>
<script>
export default {
    props: {
        isButton: {
            type: Boolean,
            default: false
        },
        Class: {
            type: String,
            default: 'col-lg-12 col-sm-12'
        },
        ModalName: {
            type: String,
            default: 'modal'
        },
        Name: {
            type: [String],
            default: ''
        },
        Label: {
            type: String,
            default: 'Label title'
        },
        Pholder: {
            type: String,
            default: 'enter here...'
        },
        Type: {
            type: String,
            default: 'text'
        },
        Value: {
            type: [String, Number],
            default: ''
        },
        Validated: {
            type: [Array, Object, String],
            default: []
        }
    },
}

</script>
