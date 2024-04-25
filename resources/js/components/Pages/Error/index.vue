<template>
    <section class="page_404">
        <div class="container">
            <div class="row" >
                <div class="col-sm-12 ">
                    <div class="col-sm-10 col-sm-offset-1  text-center">
                        <div class="four_zero_four_bg">
                            <h1 class="text-center ">403</h1>


                        </div>

                        <div class="contant_box_404">
                            <h3 class="h2">
                                Texnik xato yuz berdi yoki
                                bu sahifaga kirish uchun sizga ruxsat berilmagan !
                            </h3>

                            <p>Произошла техническая ошибка или у вас нет доступа к этой странице!</p>

                            <a href = "/" class="link_404">Ortga qaytish </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        methods:{

            redirectPage(){
                const path = this.$route.path.replace(/^\/|\/$/g, '');
                const roles = this.caesarDecipher( localStorage.getItem('roles'), 7).split(',');

                console.log(path)
                if (roles.includes(path)){
                    this.$router.push('/'+path);
                };
            },
            caesarDecipher(input, shift) {
                if(input != null){
                    let result = '';
                    for (let i = 0; i < input.length; i++) {
                        let charCode = input.charCodeAt(i);
                        if (charCode >= 65 && charCode <= 90) {
                            result += String.fromCharCode(((charCode - 65 - shift + 26) % 26) + 65);
                        } else if (charCode >= 97 && charCode <= 122) {
                            result += String.fromCharCode(((charCode - 97 - shift + 26) % 26) + 97);
                        } else {
                            result += input[i];
                        }
                    }
                    return result;
                }
                return ',';

            },

        },
        mounted() {
            this.redirectPage()
        }

    }

</script>


<style scoped>


/*======================
    404 page
=======================*/

body{
    background: black ;
}
.container{

    width: 100%;
    height: 100vh;
    margin-top: 50px;
    //display: flex;
    //justify-content: center;
    //align-items: center;
}
.page_404{ padding:40px 0;
    background:#fff; font-family: 'Arvo', serif;
}

.page_404  img{ width:100%;}

.four_zero_four_bg{

    background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
    height: 400px;
    background-position: center;
    background-repeat: no-repeat;
}


.four_zero_four_bg h1{
    font-size:80px;
}

.four_zero_four_bg h3{
    font-size:80px;
}

.link_404{
    color: #fff!important;
    padding: 10px 20px;
    background: #39ac31;
    margin: 20px 0;
    display: inline-block;}
.contant_box_404{ margin-top:-50px;}

</style>
