import{_ as d,f as _,b as o,e as s,a as u,g as i,t as a,o as c,p,h as m,r as h}from"./app-kSgaNykg.js";import{S as n}from"./sweetalert2.all-GO3Kscmp.js";const f={data(){return{url:location.origin,isSuccess:!1,message:"",output:""}},methods:{async index(){try{const e=await _();if(e.status!=null&&e.status==!0)return this.message=e.message,this.output=e.output,this.isSuccess=!0,!0;n.fire({title:"Not allowed",text:"",icon:"error"})}catch{n.fire({title:"Not allowed",text:"",icon:"error"})}}},mounted(){this.index()}},r=e=>(p("data-v-6ff511de"),e=e(),m(),e),x={class:"account-pages my-5 pt-5"},g={class:"container"},v={class:"row"},S={class:"col-lg-12"},y={key:0,class:"text-center mb-5"},w={key:1,class:"text-center mb-5"},b=r(()=>s("i",{class:"bx bx-key text-success bx-tada",style:{"font-size":"60px"}},null,-1)),k={class:"text404"},N={class:"text-primary"},B=r(()=>s("div",{class:"mt-5 text-center"},[s("a",{class:"btn btn-primary waves-effect waves-light",href:"/"},"Back to Login")],-1)),I={class:"row justify-content-center"},L={class:"col-md-8 col-xl-6"},V=["src"];function C(e,j,z,D,t,E){const l=h("LoaderSpinning");return c(),o("div",x,[s("div",g,[s("div",v,[s("div",S,[t.isSuccess?i("",!0):(c(),o("div",y,[u(l)])),t.isSuccess?(c(),o("div",w,[b,s("h4",k,a(t.message),1),s("p",N,a(t.output),1),B])):i("",!0)])]),s("div",I,[s("div",L,[s("div",null,[s("img",{src:t.url+"assets/images/error-img.png",alt:"",class:"img-fluid"},null,8,V)])])])])])}const A=d(f,[["render",C],["__scopeId","data-v-6ff511de"]]);export{A as default};
