<template>
    <div class=" col-sm-4 col-md-6 col-lg-4 col-xl-3 p-2 cursor-pointer  waves-effect waves-light">
        <!-- Simple card -->
        <div class="card m-0 selling_card_box border border-primary" :class="Amount > 0 ? 'border-primary' : 'border-danger opacity-50 disabled not_amount' ">

            <div class="selling_card_img bg-warning-subtle" :style="'background-image: url(' +Image+ ')'" ></div>
            <div class="selling_qty p-1 btn  waves-effect waves-light"
                 :class="Amount > 0 ? 'btn-primary' : 'btn-danger' "
            >QTY: {{Amount}}</div>
            <div class="card-body text-center " style="padding: 5px ">
                <h4 class="card-title font-size-13"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{Title}}</font></font></h4>
                <p class="card-text font-size-12"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{truncateText(Text)}} </font></font></p>
            </div>
        </div>

    </div>
</template>
<script>
export default
{
    props:{
        Amount:{Number},
        Title:{String},
        Text:{String},
        Image:{String},
    },
    methods:{
        truncateText(text) {
            if (text.length > 60) {
                return text.substring(0, 45) + '...';
            }
            return text;
        }
    }
}
</script>
