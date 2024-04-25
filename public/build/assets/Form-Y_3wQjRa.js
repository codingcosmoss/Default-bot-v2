import{P as N}from"./Page-8n99lQGG.js";import{_ as g,o as n,c as d,a as r,t as u,n as f,h as k,s as x,u as T,v as R,C as O,A as j,z as C,r as h,b as a,F as y,D as L,f as w,w as A}from"./app-TemNFbnf.js";import{I as S}from"./ImageInput-WFQR4nv9.js";import{T as B}from"./Table-ucvpLxN8.js";import{C as F}from"./Checkbox01-7mbR3o1K.js";import"./Switch-ytQAvUOl.js";import"./Input-FG7ZHoFJ.js";import"./InputDefault-tLeF0Vsp.js";import"./CreateForm-QH3CCTcw.js";import"./Select-2LcnBieZ.js";import"./Input-kd4mt6Nc.js";import"./pagination-01.vue_vue_type_style_index_0_lang-ZvTme92P.js";import"./paginate-OCobNe55.js";import"./InputText-v4oYWxFI.js";import"./Select-INjU42Te.js";import"./Textarea-2uEfp-ul.js";import"./InputTime-I--emg10.js";import"./Loader-rZq7vIO3.js";const V={props:{Couple:{type:Boolean,default:!0},Label:{type:String,default:"Input label"},Value:{type:[String,Boolean,Number],default:""},Type:{type:String,default:"text"},isError:{type:Boolean,default:!1},isLoginError:{type:Boolean,default:!1},message:{type:String,default:""}}},K={class:"mb-2.5 block text-black dark:text-white"},D=["value","type"],z={key:0,class:"text-danger"};function q(s,e,l,c,o,t){return n(),d("div",{class:f(l.Couple?"mb-4.5":"w-full xl:w-1/2")},[r("label",K,u(l.Label),1),r("input",{value:l.Value,type:l.Type,min:"0",class:f([l.isError==!0?"isError":"","w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"]),placeholder:"...",onInput:e[0]||(e[0]=m=>this.$emit("onInput",m.target.value))},null,42,D),l.isError?(n(),d("p",z,u(l.message),1)):k("",!0)],2)}const P=g(V,[["render",q]]),G={components:{Input:P},props:{Couple:{type:Boolean,default:!0},Title:{type:String,default:"Checkbox title"}}};function H(s,e,l,c,o,t){return n(),d("li",null,[r("input",{type:"checkbox",onInput:e[0]||(e[0]=m=>this.$emit("onCheck",!0))},null,32),x("   "+u(l.Title),1)])}const J=g(G,[["render",H],["__scopeId","data-v-5c9ec93d"]]),M={props:{Couple:{type:Boolean,default:!0},Label:{type:String,default:"Input label"},Value:{type:[String,Boolean,Number],default:""},Type:{type:String,default:"text"},isError:{type:Boolean,default:!1}}},Q={class:"mb-2.5 block text-black dark:text-white"},U=["value","type"];function W(s,e,l,c,o,t){return n(),d("div",{class:f(l.Couple?"mb-4.5":"w-full xl:w-1/2")},[r("label",Q,u(l.Label),1),r("input",{value:l.Value,type:l.Type,class:f([l.isError==!0?"isError":"","rounded border-[1.5px] border-stroke bg-transparent py-20 px-2 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"]),placeholder:"Select subject",onInput:e[0]||(e[0]=m=>this.$emit("onInput",m.target.value)),style:{width:"80px",height:"40px"}},null,42,U)],2)}const X=g(M,[["render",W]]);let E=[];function Y(){for(;E.length;)E.shift()()}const Z={data(){return{name:"",position:"",login:"",password:"",profil_photo_path:"",percent_salary:"",salary_static:"",sort_order:"",isPasswordError:!1,reset_password:"",isLoginError:!1,color:"#FFFFFF",errorObj:{},image:"",Roles:[],Permissions:[],PermissionsArr:[],Loader:!1}},components:{Checkbox01:F,Table:B,ImageInput:S,InputColor:X,Checkbox:J,Input:P},methods:{releaseNextTicks:Y,getName(s){return T().getName(s)},async getPermissions(){const s=await R();this.Permissions=s.data,console.log(s.data)},testPassword(s){return this.password!=s?this.isPasswordError=!0:this.isPasswordError=!1,this.reset_password=s,this.isPasswordError},addAllRoles(){this.Roles.length!=16?(this.Roles=[],this.Permissions.forEach(s=>{this.Roles.push(s.id),console.log("Permission>",s.permissions),s.permissions.forEach(e=>{this.PermissionsArr.push({role_id:e.role_id,permission_id:e.id})})})):(this.Roles=[],this.PermissionsArr=[])},addRoles(s){this.Roles.includes(s)?(this.Roles=this.Roles.filter(e=>e!=s),this.PermissionsArr=this.PermissionsArr.filter(e=>e.role_id!=s)):this.Roles.push(s)},addPermission(s,e){this.hasPermission(s,e)?this.PermissionsArr=this.PermissionsArr.filter(l=>!(l.role_id==s&&l.permission_id==e)):this.PermissionsArr.push({role_id:s,permission_id:e})},hasPermission(s,e){let l=!1;return this.PermissionsArr.forEach(c=>{c.role_id==s&&c.permission_id==e&&(l=!0)}),!!l},async create(){if(this.Loader=!0,this.testPassword(this.reset_password)!=!0){var s={name:this.name,position:this.position,login:this.login,password:this.password,profil_photo_path:this.profil_photo_path,percent_salary:this.percent_salary,salary_static:this.salary_static,sort_order:this.sort_order,color:this.color,image:this.image,roles:this.Roles,permissions:this.PermissionsArr};const e=await O(s);e.status?(j("success","Created successfully !"),this.$router.push("/employees")):(console.log(e.data),this.errorObj=e.data,this.Loader=!1),this.Loader=!1}},async testLogin(s){this.login=s;const e=await C({login:s,id:0});console.log("R:",e),e.status?this.isLoginError=!0:this.isLoginError=!1},async sendData(){this.Loader=!0;const s=this.login;(await C({login:s,id:0})).status?(this.isLoginError=!0,this.Loader=!1):(this.isLoginError=!1,this.create())},hasKey(s){return s in this.errorObj}},mounted(){this.getPermissions()}},$={class:"breadcrumb-nav mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"},ee={class:"flex items-center gap-2"},se={class:"font-medium text-primary"},re={class:"grid grid-cols-1 gap-9 sm:grid-cols-2"},te={class:"flex flex-col gap-9"},oe={class:"rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"},ie={class:"border-b border-stroke py-4 px-6.5 dark:border-strokedark"},le={class:"font-semibold text-black dark:text-white"},ne={action:"#"},ae={class:"p-6.5"},de={class:"mb-4.5 flex flex-col gap-6 xl:flex-row"},ue={class:"mb-4.5 flex flex-col gap-6 xl:flex-row"},me={class:"mb-4.5 flex flex-col gap-6 xl:flex-row"},pe={class:"flex flex-col gap-9"},ce={class:"rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"},he=r("div",{class:"border-b border-stroke py-4 px-6.5 dark:border-strokedark"},[r("h3",{class:"font-semibold text-black dark:text-white"})],-1),fe={class:"pt-0 p-6.5"},ge={style:{padding:"5px 27px"}},be={style:{width:"100%"}},_e={class:"table01",style:{width:"100%"}},ye={style:{"font-weight":"bold","max-width":"120px"}},ke={class:"pl-7 p-6.5",style:{display:"flex","justify-content":"center"}};function xe(s,e,l,c,o,t){const m=h("ImageInput"),p=h("Input"),v=h("InputColor"),_=h("Checkbox01"),I=h("loader-spinning");return n(),d(y,null,[r("div",$,[r("nav",null,[r("ol",ee,[r("li",null,[r("a",{class:"font-medium cursor-pointer",onClick:e[0]||(e[0]=i=>this.$router.push("/employees"))},u(t.getName("employees"))+" /",1)]),r("li",se,u(t.getName("create")),1)])])]),r("div",re,[r("div",te,[r("div",oe,[r("div",ie,[r("h3",le,u(t.getName("add_employee")),1)]),r("form",ne,[r("div",ae,[a(m,{onImage:e[1]||(e[1]=i=>o.image=i)}),r("div",de,[a(p,{Couple:!1,Label:t.getName("employee_name"),onOnInput:e[2]||(e[2]=i=>o.name=i),isError:t.hasKey("name"),message:o.errorObj.name},null,8,["Label","isError","message"]),a(p,{Couple:!1,Label:t.getName("Position_employee"),onOnInput:e[3]||(e[3]=i=>o.position=i),isError:t.hasKey("position"),message:o.errorObj.position},null,8,["Label","isError","message"])]),a(p,{Label:t.getName("login"),onOnInput:e[4]||(e[4]=i=>t.testLogin(i)),Value:o.login,isError:o.isLoginError||o.errorObj.login,message:o.errorObj.login?o.errorObj.login:"Login is available !"},null,8,["Label","Value","isError","message"]),r("div",ue,[a(p,{Couple:!1,Label:t.getName("password"),onOnInput:e[5]||(e[5]=i=>o.password=i),Type:"password",isError:t.hasKey("password"),message:o.errorObj.password},null,8,["Label","isError","message"]),a(p,{Couple:!1,Label:t.getName("reset_password"),onOnInput:e[6]||(e[6]=i=>t.testPassword(i)),isError:o.isPasswordError,Type:"password",Value:o.reset_password,message:"The password is not the same"},null,8,["Label","isError","Value"])]),r("div",me,[a(v,{Type:"color",Couple:!1,Label:t.getName("color"),onOnInput:e[7]||(e[7]=i=>o.color=i),isError:t.hasKey("color"),message:o.errorObj.color},null,8,["Label","isError","message"]),a(p,{Type:"number",Couple:!1,Label:t.getName("Serial_number"),onOnInput:e[8]||(e[8]=i=>o.sort_order=i),isError:t.hasKey("sort_order"),message:o.errorObj.sort_order},null,8,["Label","isError","message"])])])])])]),r("div",pe,[r("div",ce,[he,x("   "),r("p",fe,u(t.getName("employee_roles"))+":",1),r("ul",ge,[r("li",null,[a(_,{onClick:e[9]||(e[9]=i=>t.addAllRoles()),onCheck:o.Roles.length==16,Title:t.getName("allPermissions")},null,8,["onCheck","Title"])]),x("    "),r("li",be,[r("table",_e,[(n(!0),d(y,null,L(o.Permissions,i=>(n(),d("tr",null,[r("td",ye,[a(_,{onClick:b=>t.addRoles(i.id),onCheck:o.Roles.includes(i.id),Title:t.getName(i.lang_name),Class:"genderCheckbox"},null,8,["onClick","onCheck","Title"])]),r("td",{class:f(o.Roles.includes(i.id)?"":"td_hidden")},[(n(!0),d(y,null,L(i.permissions,b=>(n(),w(_,{style:{margin:"5px 0"},onClick:Ee=>t.addPermission(i.id,b.id),onCheck:t.hasPermission(i.id,b.id),Title:t.getName(b.lang_name),Class:"genderCheckbox"},null,8,["onClick","onCheck","Title"]))),256))],2)]))),256))])])]),r("div",ke,[o.Loader?(n(),w(I,{key:0,style:{margin:"0 auto"}})):k("",!0),o.Loader?k("",!0):(n(),d("button",{key:1,onClick:e[10]||(e[10]=(...i)=>t.sendData&&t.sendData(...i)),class:"flex w-full justify-center rounded bg-primary p-3 font-medium text-gray"},u(t.getName("create")),1))])])])])],64)}const we=g(Z,[["render",xe]]),Ce={components:{FormLayouts:we,Page:N}};function Le(s,e,l,c,o,t){const m=h("FormLayouts"),p=h("Page");return n(),w(p,{Classes:!1,Animation:!1},{default:A(()=>[a(m)]),_:1})}const He=g(Ce,[["render",Le]]);export{He as default};
