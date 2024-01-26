<template >
	<!--begin::Login-->
	<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid " id="kt_login">
		<!--begin::Content-->
		<div
			class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
			<!--begin::Content body-->
			<div class="login-box">
				<!--begin::Signin-->
				<div class="login-form login-signin">
					<!--begin::Form-->

					<slot></slot>

					<!--end::Form-->
				</div>
				<!--end::Signin-->


			</div>
			<!--end::Content body-->
			<!--begin::Content footer-->

			<!--end::Content footer-->
		</div>
		<div v-for="link in Links"
			class="my-link d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
			<a :href="link.link" target="_blank" class="text-primary font-weight-bolder font-size-h5">{{ link.name }}</a>
		</div>
		<!--end::Content-->
	</div>
	<!--end::Login-->
</template>
<script>
export default {
	name: 'login-box',
	props: {
		Links: {
			type: Array,
			default: [
				{
					name: "Muhammadalidev.uz",
					link: 'http://muhammadalidev.uz/'
				}
			]
		}
	}
}
</script>
<style scoped>
.login-signin {

	background-color: #2f3056;
	box-shadow: 1px 1px 15px #262747;
	padding: 54px;
}

#kt_login {
    background-color: #262747;
}
.login-form{
    width: 440px;
    height: 500px;
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    align-items: center;
}
.login-box{
    display: flex;
    justify-content: center;
}
.login-content{
    display: flex;
    justify-content: center;
    height: 100vh;
    align-items: center;
}
.my-link{
    font-weight: bold;
}
@media (max-width: 461px) {
    .login-form{
        width: 360px;
        box-shadow: none;
    }
    .login-content{
        background: #2f3056;

    }

}


</style>
