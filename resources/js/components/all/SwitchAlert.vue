<template>

</template>
<script>
import Swal from 'sweetalert2'
export default
{
    mounted() {
        Swal.fire({
            title: "Good job!",
            text: "You clicked the button!",
            icon: "success"
        });
    }
}
</script>

