<template>

    <div :class="Col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{Title}}</h4>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0">
                        <thead class="table-light">
                        <tr>
                            <th style="width: 20px;">
                                <div class="form-check font-size-16 align-middle">
                                    <input class="form-check-input" type="checkbox" id="transactionCheck01">
                                    <label class="form-check-label" for="transactionCheck01"></label>
                                </div>
                            </th>
                            <th v-for="th in Th" class="align-middle">{{th}}</th>
                        </tr>
                        </thead>
                        <tbody>

                            <slot></slot>

                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props:{
            Col: {
                type: [String, Number],
                default: 'col-lg-12'
            },
            Title: {
                type: [String, Number],
                default: 'Latest Transaction'
            },
            Th: {
                type: [Array, Object],
                default: ['Order ID', 'Billing Name', 'Date', 'Total', 'Payment Status']
            },
        }
    }
</script>
