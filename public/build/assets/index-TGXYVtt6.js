import{P as m}from"./Page-X_CL2XrS.js";import{_ as u,o as h,c as f,a as e,h as _,i as p,G as d,A as o,R as v,d as w,w as b,r as c,e as l,n as y}from"./app-HuQxhYkh.js";import{L}from"./LoginInput-SOPIGRKx.js";const k={},x={class:"account-pages my-5 pt-sm-5"},V={class:"container"},I={class:"row justify-content-center"},P={class:"col-md-8 col-lg-6 col-xl-5"},S={class:"card overflow-hidden"},B=p('<div class="bg-primary-subtle"><div class="row"><div class="col-7"><div class="text-primary p-4"><h5 class="text-primary">Welcome Back !</h5><p>Sign in to continue to Skote.</p></div></div><div class="col-5 align-self-end"><img src="http://127.0.0.1:8000/assets/images/profile-img.png" alt="" class="img-fluid"></div></div></div>',1),E={class:"card-body pt-0"},U=p('<div class="auth-logo"><a href="index.html" class="auth-logo-light"><div class="avatar-md profile-user-wid mb-4"><span class="avatar-title rounded-circle bg-light"><img src="http://127.0.0.1:8000/assets/images/logo-light.svg" alt="" class="rounded-circle" height="34"></span></div></a><a href="index.html" class="auth-logo-dark"><div class="avatar-md profile-user-wid mb-4"><span class="avatar-title rounded-circle bg-light"><img src="http://127.0.0.1:8000/assets/images/logo.svg" alt="" class="rounded-circle" height="34"></span></div></a></div>',1),C={class:"p-2"},F=e("br",null,null,-1);function N(t,s){return h(),f("div",x,[e("div",V,[e("div",I,[e("div",P,[e("div",S,[B,e("div",E,[U,e("div",C,[_(t.$slots,"default"),F])])])])])])])}const O=u(k,[["render",N]]),$={components:{LoginInput:L,Layout:O,Page:m},data(){return{login:"",password:"",reset_password:"",isError:!1,Loader:!1}},methods:{async getUser(){const t=await d();console.log(t),t.success==200&&this.$router.push("/admin")},async addForm(){try{if(this.Loader=!0,this.reset_password!=this.password||this.password.length<5)return this.isError=!0,this.Loader=!1,o("error","Parolni kiritishda xatolik bor, parol eng kami 5ta harfdan iboratbolishi kerak"),!0;if(this.login.length<5)return o("error","Formadagi barcha maydonlar eng kami 5ta harf va sonlar bilan toldirilishi kerak "),!0;let t={login:this.login,password:this.password};const s=await v(t);console.log(s),s.success!=null?s.success==200?(this.isError=!1,this.Loader=!1,localStorage.setItem("0008a78764c2",s.data.token),localStorage.setItem("user",JSON.stringify(s.data.user)),this.$router.push("/"),o("success",this.$t("loginSuccess"))):(this.Loader=!1,o("error","Bunday username mavjud !")):(o("error","Bunday username mavjud"),this.isError=!0,this.Loader=!1)}catch{this.Loader=!1,this.isError=!0}},async getUserLocal(){await d(),this.$router.push("/")}},mounted(){this.getUser()}},j=e("br",null,null,-1),R={class:"mt-3 d-grid"};function A(t,s,G,T,a,n){const i=c("LoginInput"),g=c("Layout");return h(),w(g,null,{default:b(()=>[l(i,{Label:"Username",Pholder:"username",Value:a.login,onOnInput:s[0]||(s[0]=r=>a.login=r)},null,8,["Value"]),l(i,{Label:"Parol",Pholder:"password",Value:a.password,onOnInput:s[1]||(s[1]=r=>a.password=r),Type:"password"},null,8,["Value"]),l(i,{Label:"Parolni takrorlang",Pholder:"password",Value:a.reset_password,onOnInput:s[2]||(s[2]=r=>a.reset_password=r),Type:"password"},null,8,["Value"]),j,e("div",R,[e("button",{class:y([a.Loader&&"disabled","btn btn-primary waves-effect waves-light"]),onClick:s[3]||(s[3]=(...r)=>n.addForm&&n.addForm(...r)),type:"submit"},"Ro'yxatdan o'tish",2)])]),_:1})}const q=u($,[["render",A]]);export{q as default};
