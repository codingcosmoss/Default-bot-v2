import{P as y}from"./Page-mAivDXea.js";import{_ as p,o as i,c as u,a as t,t as d,n as m,i as h,m as w,u as g,B as x,A as k,r as f,b,F as v,d as E,w as C}from"./app-8i59_tig.js";import{I}from"./ImageInput-kHPAZAJB.js";const $={props:{Couple:{type:Boolean,default:!0},Label:{type:String,default:"Input label"},Value:{type:[String,Boolean,Number],default:""},Type:{type:String,default:"text"},isError:{type:Boolean,default:!1},isLoginError:{type:Boolean,default:!1},message:{type:String,default:""}}},B={class:"mb-2.5 block text-black dark:text-white"},L=["value","type"],N={key:0,class:"text-danger"};function P(s,e,r,c,n,o){return i(),u("div",{class:m(r.Couple?"mb-4.5":"w-full xl:w-1/2")},[t("label",B,d(r.Label),1),t("input",{value:r.Value,type:r.Type,min:"0",class:m([r.isError==!0?"isError":"","w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"]),placeholder:"...",onInput:e[0]||(e[0]=a=>this.$emit("onInput",a.target.value))},null,42,L),r.isError?(i(),u("p",N,d(r.message),1)):h("",!0)],2)}const _=p($,[["render",P]]),F={components:{Input:_},props:{Couple:{type:Boolean,default:!0},Title:{type:String,default:"Checkbox title"}}};function S(s,e,r,c,n,o){return i(),u("li",null,[t("input",{type:"checkbox",onInput:e[0]||(e[0]=a=>this.$emit("onCheck",!0))},null,32),w("   "+d(r.Title),1)])}const T=p(F,[["render",S],["__scopeId","data-v-782ad0f1"]]),V={props:{Couple:{type:Boolean,default:!0},Label:{type:String,default:"Input label"},Value:{type:[String,Boolean,Number],default:""},Type:{type:String,default:"text"},isError:{type:Boolean,default:!1}}},j={class:"mb-2.5 block text-black dark:text-white"},O=["value","type"];function A(s,e,r,c,n,o){return i(),u("div",{class:m(r.Couple?"mb-4.5":"w-full xl:w-1/2")},[t("label",j,d(r.Label),1),t("input",{value:r.Value,type:r.Type,class:m([r.isError==!0?"isError":"","rounded border-[1.5px] border-stroke bg-transparent py-20 px-2 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"]),placeholder:"Select subject",onInput:e[0]||(e[0]=a=>this.$emit("onInput",a.target.value)),style:{width:"80px",height:"40px"}},null,42,O)],2)}const K=p(V,[["render",A]]),q={data(){return{password:"",isPasswordError:!1,reset_password:"",isLoginError:!1,color:"#FFFFFF",errorObj:{}}},components:{ImageInput:I,InputColor:K,Checkbox:T,Input:_},methods:{getName(s){return g().getName(s)},testPassword(s){return this.password!=s||this.password==""?this.isPasswordError=!0:this.isPasswordError=!1,this.reset_password=s,this.isPasswordError},async create(){if(this.testPassword(this.reset_password)!=!0){var s={id:this.$route.query.id,password:this.password};const e=await x(s);e.status?(k("success","Update successfully !"),this.$router.push("/employees")):(console.log(e.data),this.errorObj=e.data)}},hasKey(s){return s in this.errorObj}}},z={class:"breadcrumb-nav mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"},D={class:"flex items-center gap-2"},U={class:"font-medium text-primary"},G={style:{width:"500px",margin:"0 auto"},class:"box-01 flex flex-col gap-9"},H={class:"rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"},J={class:"border-b border-stroke py-4 px-6.5 dark:border-strokedark"},M={class:"font-semibold text-black dark:text-white"},Q={action:"#"},R={class:"p-6.5"},W={class:"pl-7 p-6.5"};function X(s,e,r,c,n,o){const a=f("Input");return i(),u(v,null,[t("div",z,[t("nav",null,[t("ol",D,[t("li",null,[t("a",{class:"font-medium cursor-pointer",onClick:e[0]||(e[0]=l=>this.$router.push("/employees"))},d(o.getName("employees"))+" /",1)]),t("li",U,d(o.getName("edit_password")),1)])])]),t("div",G,[t("div",H,[t("div",J,[t("h3",M,d(o.getName("edit_password")),1)]),t("form",Q,[t("div",R,[b(a,{Label:o.getName("password"),onOnInput:e[1]||(e[1]=l=>n.password=l),Type:"password",isError:o.hasKey("password"),message:n.errorObj.password},null,8,["Label","isError","message"]),b(a,{Label:o.getName("reset_password"),onOnInput:e[2]||(e[2]=l=>o.testPassword(l)),isError:n.isPasswordError,Type:"password",Value:n.reset_password,message:"The password is not the same"},null,8,["Label","isError","Value"]),t("div",W,[t("button",{type:"button",onClick:e[3]||(e[3]=(...l)=>o.create&&o.create(...l)),class:"flex w-full justify-center rounded bg-primary p-3 font-medium text-gray"}," Submit ")])])])])])],64)}const Y=p(q,[["render",X]]),Z={components:{FormLayouts:Y,Page:y}};function ee(s,e,r,c,n,o){const a=f("FormLayouts"),l=f("Page");return i(),E(l,{Classes:!1,Animation:!1},{default:C(()=>[b(a)]),_:1})}const oe=p(Z,[["render",ee]]);export{oe as default};
