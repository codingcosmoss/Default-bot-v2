<template>
    <div class="col-md-10">
        <select class="form-select" >
            <option>Select</option>
            <option>Large select</option>
            <option>Small select</option>
        </select>
    </div>
</template>

<script>
export default{
    props:{
        Class:{
            type: String,
            default: 'col-lg-12 col-sm-12'
        },
        Name:{
            type: [String],
            default: []
        },
        Label:{
            type:String,
            default: 'Label title'
        },
        Pholder:{
            type:String,
            default: ''
        },
        Type:{
            type:String,
            default: 'text'
        },
        Value:{
            type: [String, Number],
            default: ''
        },
        Validated:{
            type: [Array, Object, String],
            default: []
        }
    }

}
</script>
