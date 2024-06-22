<template>
    <div class="preg_box">
        <i class="bx bx-copy-alt font-size-15" @click="copyPreContent"></i>
        <pre :id="'contentToCopy' + No">
            {{Codes}}
        </pre>
    </div>
</template>

<script>
import {Alert} from "@/helpers/Config.js";
export default {
    props: {
        No: {
            type: String,
            required: true
        },
        Codes: {
            type: String,
            default:""
        }
    },
    methods: {
        copyPreContent() {
            const preElement = document.getElementById('contentToCopy' + this.No);
            if (preElement) {
                const range = document.createRange();
                range.selectNode(preElement);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);

                try {
                    document.execCommand('copy');
                    window.getSelection().removeAllRanges();
                    Alert('success', 'copySuccess');
                } catch (err) {
                    console.error('Failed to copy: ', err);
                    Alert('success', 'copyError');
                }
            }
        }
    }
};
</script>

<style scoped lang="scss">
    .preg_box{
        width: 100%;
        background: #0b0b0b;
        position: relative;
        padding: 10px 0;
        i{
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
            padding: 10px;
            &:active{
                transform: scale(1.2);
            }
        }
        pre{
            color: #4fe663;
        }
    }
</style>
