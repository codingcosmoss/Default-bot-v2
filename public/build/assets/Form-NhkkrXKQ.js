import{P as C}from"./Page-EAuwfOTr.js";import{_ as p,o as d,c as u,a as t,t as n,n as b,h as x,x as v,k as w,u as S,aM as N,b6 as I,b7 as L,A as E,r as _,b as c,w as g,F as h,C as B,f as P}from"./app-wmakNrFD.js";import{P as T}from"./PrimaryButton-VtnifkGT.js";import{P as V}from"./PrimaryButton2-VF5CKIB7.js";import{M as O}from"./MultiSelect-W1AtSkqJ.js";import{C as y}from"./Checkbox01-R3umV7Dp.js";import"./Select-MhHGqNEH.js";const z={props:{Couple:{type:Boolean,default:!0},Label:{type:String,default:"Input label"},Value:{type:[String,Boolean,Number],default:""},Type:{type:String,default:"text"},isError:{type:Boolean,default:!1},isLoginError:{type:Boolean,default:!1},message:{type:String,default:""}}},j={class:"mb-2.5 block text-black dark:text-white"},G=["value","type"],D={key:0,class:"text-danger"};function M(o,e,a,m,s,r){return d(),u("div",{class:b(a.Couple?"mb-4.5":"w-full xl:w-1/2")},[t("label",j,n(a.Label),1),t("input",{value:a.Value,type:a.Type,min:"0",class:b([a.isError==!0?"isError":"","w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"]),placeholder:"...",onInput:e[0]||(e[0]=i=>this.$emit("onInput",i.target.value))},null,42,G),a.isError?(d(),u("p",D,n(a.message),1)):x("",!0)],2)}const k=p(z,[["render",M]]),K={components:{Input:k},props:{Couple:{type:Boolean,default:!0},Title:{type:String,default:"Checkbox title"}}};function A(o,e,a,m,s,r){return d(),u("li",null,[t("input",{type:"checkbox",onInput:e[0]||(e[0]=i=>this.$emit("onCheck",!0))},null,32),v("   "+n(a.Title),1)])}const F=p(K,[["render",A],["__scopeId","data-v-827fb6b6"]]),W={props:{Couple:{type:Boolean,default:!0},Label:{type:String,default:"Input label"},Value:{type:[String,Boolean,Number],default:""},Type:{type:String,default:"text"},isError:{type:Boolean,default:!1}}},q={class:"mb-2.5 block text-black dark:text-white"},U=["value","type"];function H(o,e,a,m,s,r){return d(),u("div",{class:b(a.Couple?"mb-4.5":"w-full xl:w-1/2")},[t("label",q,n(a.Label),1),t("input",{value:a.Value,type:a.Type,class:b([a.isError==!0?"isError":"","rounded border-[1.5px] border-stroke bg-transparent py-20 px-2 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"]),placeholder:"Select subject",onInput:e[0]||(e[0]=i=>this.$emit("onInput",i.target.value)),style:{width:"80px",height:"40px"}},null,42,U)],2)}const J=p(W,[["render",H]]),Q={props:{Couple:{type:Boolean,default:!0},Label:{type:String,default:"Input label"},Value:{type:[String,Boolean,Number],default:""},Type:{type:String,default:"text"},isError:{type:Boolean,default:!1},isLoginError:{type:Boolean,default:!1},message:{type:String,default:""}}},R={class:"mb-2.5 block text-black dark:text-white"},X={key:0,class:"text-danger"};function Y(o,e,a,m,s,r){return d(),u("div",{class:b(a.Couple?"mb-4.5":"w-full xl:w-1/2")},[t("label",R,n(a.Label),1),t("select",{onInput:e[0]||(e[0]=i=>this.$emit("onSelect",i.target.value)),class:"w-full rounded border-[1.5px] border-stroke bg-transparent px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"},[w(o.$slots,"default")],32),a.isError?(d(),u("p",X,n(a.message),1)):x("",!0)],2)}const Z=p(Q,[["render",Y]]),$={computed:{checkbox01(){return y}},data(){return{name:"",order:"",code:"",price:"",category:"",material_price:"",technic_price:"",status:1,isLoginError:!1,errorObj:{},Groups:[],Checkbox:"",ProductName:"",WendorCode:"",BarCode:"",Price:0,GroupID:0,SizeType:"",MinAmount:0}},components:{Checkbox01:y,Select:Z,PrimaryButton2:V,MultiSelect:O,PrimaryButton:T,InputColor:J,Checkbox:F,Input:k},methods:{getName(o){return S().getName(o)},async getGroups(){const o=await N(1,1e3);this.Groups=o.data.items},async getModel(){let e=(await I(this.$route.query.id)).data;this.ProductName=e.name,this.Price=e.price,this.BarCode=e.bar_code,this.WendorCode=e.vendor_code,this.GroupID=e.group_id,this.SizeType=e.size_type,this.MinAmount=e.min_amount},async update(){var o={name:this.ProductName,price:this.Price,bar_code:this.BarCode,vendor_code:this.WendorCode,group_id:this.GroupID,size_type:this.SizeType,min_amount:this.MinAmount};const e=await L(this.$route.query.id,o);e.status?(E("success","Updated successfully !"),this.$router.push("/products")):this.errorObj=e.data},hasKey(o){return o in this.errorObj},onSelect(o){this.diseasesIds.indexOf(o)==-1&&(this.diseasesIds.push({name:this.allDiseases.filter(e=>e.id==Number(o))[0].name,id:this.allDiseases.filter(e=>e.id==Number(o))[0].id}),this.allDiseases=this.allDiseases.filter(e=>e.id!=Number(o)))},onPush(o){this.allDiseases.push(o),this.diseasesIds=this.diseasesIds.filter(e=>e.id!=o.id)}},mounted(){this.getModel(),this.getGroups()}},ee={style:{"justify-content":"flex-end"},class:"mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"},te={class:"flex items-center gap-2"},re={class:"font-medium text-primary"},se={class:"grid grid-cols-1 gap-9 sm:grid-cols-2"},oe={class:"flex flex-col gap-9"},ae={class:"rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"},le={class:"border-b border-stroke py-4 px-6.5 dark:border-strokedark"},ne={class:"font-semibold text-black dark:text-white"},ie={action:"#"},de={class:"p-6.5"},ue={class:"mb-4.5 flex flex-col gap-6 xl:flex-row"},ce={class:"mb-4.5 flex flex-col gap-6 xl:flex-row"},pe=t("option",null,"---",-1),me=["value","selected"],be={class:"flex flex-col gap-9"},fe={class:"rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"},_e=t("div",{class:"border-b border-stroke py-4 px-6.5 dark:border-strokedark"},[t("h3",{class:"font-semibold text-black dark:text-white"})],-1),ge={class:"flex flex-col gap-6 xl:flex-row p-6.5"},he=t("option",null,"---",-1),ye=["selected"],xe=["selected"],ke=["selected"],Ce=["selected"],ve={class:"pl-7 p-6.5"};function we(o,e,a,m,s,r){const i=_("Input"),f=_("Select");return d(),u(h,null,[t("div",ee,[t("nav",null,[t("ol",te,[t("li",null,[t("a",{class:"font-medium cursor-pointer",onClick:e[0]||(e[0]=l=>this.$router.push("/products"))},n(r.getName("Products"))+" /",1)]),t("li",re,n(r.getName("update")),1)])])]),t("div",se,[t("div",oe,[t("div",ae,[t("div",le,[t("h3",ne,n(r.getName("Products")),1)]),t("form",ie,[t("div",de,[c(i,{Label:r.getName("name_content"),onOnInput:e[1]||(e[1]=l=>s.ProductName=l),isError:r.hasKey("name"),message:s.errorObj.name,Value:s.ProductName},null,8,["Label","isError","message","Value"]),t("div",ue,[c(i,{Couple:!1,Label:r.getName("Bar_code"),onOnInput:e[2]||(e[2]=l=>s.BarCode=l),isError:r.hasKey("bar_code"),message:s.errorObj.bar_code,Value:s.BarCode},null,8,["Label","isError","message","Value"]),c(i,{Couple:!1,Label:r.getName("WendorCode"),onOnInput:e[3]||(e[3]=l=>s.WendorCode=l),isError:r.hasKey("wendor_code"),message:s.errorObj.wendor_code,Value:s.WendorCode},null,8,["Label","isError","message","Value"])]),t("div",ce,[c(i,{Couple:!1,Label:r.getName("price"),onOnInput:e[4]||(e[4]=l=>s.Price=l),isError:r.hasKey("price"),message:s.errorObj.price,Value:s.Price,Type:"number"},null,8,["Label","isError","message","Value"]),c(f,{Couple:!1,Label:r.getName("Group"),onOnSelect:e[5]||(e[5]=l=>this.GroupID=l),isError:r.hasKey("group_id"),message:s.errorObj.group_id},{default:g(()=>[pe,(d(!0),u(h,null,B(s.Groups,l=>(d(),u("option",{value:l.id,selected:l.id==s.GroupID},n(l.name),9,me))),256))]),_:1},8,["Label","isError","message"])])])])])]),t("div",be,[t("div",fe,[_e,t("div",ge,[c(f,{Couple:!1,Label:r.getName("SizeType"),onOnSelect:e[6]||(e[6]=l=>this.SizeType=l),isError:r.hasKey("size_type"),message:s.errorObj.size_type},{default:g(()=>[he,t("option",{value:"piece",selected:s.SizeType=="piece"},n(r.getName("Piece")),9,ye),t("option",{value:"l",selected:s.SizeType=="l"},n(r.getName("Liter"))+" / (l) ",9,xe),t("option",{value:"kg",selected:s.SizeType=="kg"},n(r.getName("Kilogram"))+" / (kg) ",9,ke),t("option",{value:"g",selected:s.SizeType=="g"},n(r.getName("Gram"))+" / (g) ",9,Ce)]),_:1},8,["Label","isError","message"]),c(i,{Couple:!1,Label:r.getName("MinSize"),onOnInput:e[7]||(e[7]=l=>s.MinAmount=l),isError:r.hasKey("min_amount"),message:s.errorObj.min_amount,Value:s.MinAmount,Type:"number"},null,8,["Label","isError","message","Value"])]),t("div",ve,[t("button",{onClick:e[8]||(e[8]=(...l)=>r.update&&r.update(...l)),class:"flex w-full justify-center rounded bg-primary p-3 font-medium text-gray"},n(r.getName("update")),1)])])])])],64)}const Se=p($,[["render",we]]),Ne={components:{FormLayouts:Se,Page:C}};function Ie(o,e,a,m,s,r){const i=_("FormLayouts"),f=_("Page");return d(),P(f,{Classes:!1,Animation:!1},{default:g(()=>[c(i)]),_:1})}const ze=p(Ne,[["render",Ie]]);export{ze as default};
