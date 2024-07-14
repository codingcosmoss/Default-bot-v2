<template>

    <div :class="Class">
        <div>
            <label class="form-label" v-if="Label != '' ">{{ Label }}</label>
            <select class="form-select"
                    :class="Validated[Name] ? 'border-danger' : '' "
                    @input="this.$emit('onInput', $event.target.value)"
            >
                <slot></slot>
            </select>
            <p class="form-label text-danger">{{ Validated[Name] }}</p>
        </div>
    </div>

</template>
<script>
export default {
    props: {
        Class: {
            type: String,
            default: 'col-lg-12 col-sm-12'
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
