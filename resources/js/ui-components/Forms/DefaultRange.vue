<template>
    <div class="col-lg-5 position-relative" >

        <label class="form-label d-flex align-items-end justify-content-between">
            <p class="m-0 font-size-15">{{Label}}  <i class="bx bx-trash-alt cursor-pointer text-danger" @click="this.$emit('onDelete', true)"></i></p>
            <p class="m-0 text-primary">{{Range}}</p>
        </label>
        <input type="range" class="form-range" id="customRange1" :value="Range" :min="Min" :max="Max" @input="onRange($event.target.value)">
    </div>
</template>

<script>
export default{
    data(){return{
       Range: 50,
       Min: 0,
       Max: 100
    }},
    props:{
        Class:{
            type: String,
            default: 'col-lg-12 col-sm-12'
        },
        Name:{
            type: [String, Number],
            default: ''
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
            type: Number,
            default: 50
        },
        Validated:{
            type: [Array, Object, String],
            default: []
        }
    },
    methods:{
        onRange(val){
            this.Range = val;
            this.$emit('onInput', val)
        }
    },
    mounted() {
        this.Range = this.Value
    }

}

</script>
