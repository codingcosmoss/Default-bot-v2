<template>

    <div class="box">
        <i @click = "addCount(false)" class="fa-solid fa-minus"></i>
        <span>
            {{Count}}
        </span>
        <i @click = "addCount(true)" class="fa-solid fa-plus"></i>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                Count: 1
            }
        },
        props:{
            Value:{
                type: Number,
                default: 1
            },
        },
        methods:{
            addCount(e){
                if (e){
                    this.Count = this.Value + 1;
                }else {
                    if (this.Count != 1 ){
                        this.Count = this.Value - 1;
                    }
                }
                console.log('Values:', this.Count);
                this.$emit('count', this.Count)
            },
            valueReversed(){
                // this.Count = this.Value
            }
        },
        mounted() {
            this.valueReversed()
        },
        watch:{
            Value: function (){
                this.valueReversed()
            }
        }
    }
</script>

<style scoped lang="scss">
    .box{
        border: 2px solid blue;
        border-radius: 10px;
        margin: 0 10px;
        width: 200px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        i{
            cursor: pointer;
            margin: 2px 5px;
            font-weight: bold;
            padding: 10px;
            border-radius: 10px;
        }
        i:active{
            background: #3C50E0;
            color: white;
        }
        span{
            margin: 0 15px;
        }

    }
</style>
