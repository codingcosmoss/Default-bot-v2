<template>

    <div :class="Display" class="  d-flex justify-content-end">
        <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
            <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ki ki-bold-more-hor"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <!--begin::Navigation-->
                <ul class="navi navi-hover">
                    <li class="navi-header font-weight-bold py-4">
                        <span class="font-size-lg">Choose Label:</span>
                        <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                    </li>
                    <li class="navi-separator mb-3 opacity-70"></li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
																		<span class="navi-text">
																			<span class="label label-xl label-inline label-light-success">Customer</span>
																		</span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
																		<span class="navi-text">
																			<span class="label label-xl label-inline label-light-danger">Partner</span>
																		</span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
																		<span class="navi-text">
																			<span class="label label-xl label-inline label-light-warning">Suplier</span>
																		</span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
																		<span class="navi-text">
																			<span class="label label-xl label-inline label-light-primary">Member</span>
																		</span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
																		<span class="navi-text">
																			<span class="label label-xl label-inline label-light-dark">Staff</span>
																		</span>
                        </a>
                    </li>
                    <li class="navi-separator mt-3 opacity-70"></li>
                    <li class="navi-footer py-4">
                        <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                            <i class="ki ki-plus icon-sm"></i>Add new</a>
                    </li>
                </ul>
                <!--end::Navigation-->
            </div>
        </div>
    </div>

</template>
<script>
    export default {
        props:{
            Display:{
                type: String,
                defult: ''
            }
        }
    }
</script>

<style>
    .hidden{
        display: none !important;
    }

</style>
