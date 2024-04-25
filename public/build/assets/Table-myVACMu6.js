import{_ as b,u as h,o as c,c as m,a as o,t as n,F as _,D as f,i as P,j as S,bD as I,A as T,bE as w,ag as N,r as u,f as p,w as C,b as y,h as E}from"./app-TemNFbnf.js";import{C as $}from"./Checkbox01-7mbR3o1K.js";import{C as A}from"./Checkbox-CcM-0a8e.js";import{P as D}from"./Page-8n99lQGG.js";import{i as j}from"./InputText-v4oYWxFI.js";import{P as M}from"./PrimaryButton-K5Vl9PDh.js";import"./Input-bbvb1mt7.js";const q={setup(){return{counterStore:h()}},methods:{getName(e){return h().getName(e)},async getItems(){this.ItemModels=[];const e=await treatmentAddServiceAll(this.$route.query.treatment_id);console.log("Response:",e),this.ItemModels=e.data.items,this.ItemModels.forEach(t=>{this.Services.push({id:t.id,count:t.count})}),this.ItemModels.length>0&&this.$emit("getModels",this.ItemModels)},async sendResponse(){let e=[];if(this.Items.length>0&&(this.Items.forEach(t=>{let s=null;this.Services.forEach(i=>{if(t.id==i.id)return s=i,!0}),s!=null?e.push({id:s.id,count:s.count>0?s.count:1}):e.push({id:t.id,count:1})}),e.length>0)){let t={items:e,treatment_id:this.$route.query.treatment_id};const s=await treatmentAddService(t);console.log("Respone:",s),s.status?this.$router.push({path:"/treatmetns/treatmetn",query:{id:this.$route.query.id,treatment_id:this.$route.query.treatment_id}}):this.errorObj=s.data}},hasKey(e){return e in this.errorObj},addCount(e,t){let s=e;const i=document.querySelector(".ui_input"+t.id);Number(s)>Number(t.max_count)&&(i.value=t.max_count,s=t.max_count,Alert("error",this.getName("ProductMin")));let r=null;this.Services.forEach((a,l)=>{if(a.id==t.id)return r=l,!0}),r==null?this.Services.push({id:t.id,count:s}):this.Services[r].count=s},removeItem(e){this.Services=this.Services.filter(t=>t.id!=e)},searchKey(e){let t=null;return this.Services.forEach((s,i)=>{if(s.id==e)return t=i,!0}),t!=null?this.Services[t].count:1}},data(){return{Services:[],ItemModels:[],errorObj:[]}},props:{Items:{type:[Array,Object],default:[]},Id:{type:Number,default:0},Sum:{type:Number,default:0}},mounted(){}},B=e=>(P("data-v-33a81ba2"),e=e(),S(),e),R={class:"col-span-12 rounded-sm border border-stroke bg-white py-6 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4"},O={class:"mb-6 px-7.5 text-xl font-bold text-black dark:text-white"},K={class:"flex items-center gap-5 py-3 px-7.5 hover:bg-gray-3 dark:hover:bg-meta-4"},F={class:"flex flex-1 items-center justify-between"},V={class:"item_box"},z={class:"font-medium"},L={style:{display:"flex","justify-content":"space-between"}},U={class:"text-sm font-medium"},Z=B(()=>o("span",{class:"text-xs"}," uzs",-1)),G={class:"text-xs"},H={style:{width:"100%",padding:"10px 30px"}},J={class:"font-medium"};function Q(e,t,s,i,r,a){return c(),m("div",R,[o("h4",O,n(a.getName("DebtorFinishedTreatments")),1),o("div",null,[(c(!0),m(_,null,f(s.Items,l=>(c(),m("div",K,[o("div",F,[o("div",V,[o("h5",z,n(l.patient_name),1),o("p",L,[o("div",null,[o("span",U,n(i.counterStore.formatNumber(l.doctor_sum)),1),Z]),o("span",G,n(l.start),1)])])])]))),256)),o("div",H,[o("h5",J,n(a.getName("TotalSum"))+": "+n(i.counterStore.formatNumber(s.Sum)),1)])])])}const W=b(q,[["render",Q],["__scopeId","data-v-33a81ba2"]]),X={computed:{inputText(){return j}},setup(){return{counterStore:h()}},components:{PrimaryButton:M,RightTable:W,Page:D,Checkbox:A,Checkbox01:$},data(){return{Employee:[],PayTypes:[],PaymentId:0,Patients:[],DebtorSum:0}},methods:{async Payment(){let e={patients:this.Patients,payment_type_id:this.PaymentId};const t=await I(e);console.log(t),t.status==!0&&(this.$router.push("/employees-payments"),T("success","Saved successfully !"))},sendData(e){let t=0;this.Patients.forEach(s=>{e.id==s.id&&(t=e.id)}),t!=0?this.Patients=this.Patients.filter(s=>s.id!=t):this.Patients.push({id:e.id})},searchKey(e){let t=!1;return this.Patients.forEach(s=>{s.id==e&&(t=!0)}),t},getName(e){return h().getName(e)},async getIndex(){const e=await w(this.$route.query.id);console.log("DEPTOR::",e.data.deptor_treatments),this.Employee=e.data,e.data.deptor_treatments.forEach(t=>{this.DebtorSum+=t.doctor_sum})},async getPaymentTypes(){const e=await N(1,1e3);this.PayTypes=e.data.items,e.data.items.length>0&&(this.PaymentId=e.data.items[0].id)}},mounted(){this.getIndex(),this.getPaymentTypes()}},Y={class:"col-span-12 xl:col-span-8"},ee={class:"mb-6 mt-6 text-xl font-bold text-black dark:text-white"},te={class:"rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"},se={class:"mb-6 mt-6 text-xl font-bold text-black dark:text-white"},oe={class:"flex flex-col table_media_box"},re={class:"grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-3"},ae={class:"flex items-center gap-3 p-2.5 xl:p-5"},ne={class:"font-bold text-black dark:text-white sm:block"},ie={class:"flex items-center justify-center p-2.5 xl:p-5"},de={class:"font-medium text-black dark:text-white"},ce={class:"flex items-center justify-center p-2.5 xl:p-5"},le={class:"font-medium text-black dark:text-white"};function me(e,t,s,i,r,a){const l=u("Checkbox01"),x=u("RightTable"),g=u("PrimaryButton"),k=u("Page");return c(),p(k,{Animation:!1},{default:C(()=>[o("div",Y,[o("h4",ee,n(a.getName("Employee"))+": "+n(r.Employee.name),1),o("div",te,[o("h4",se,n(a.getName("PaymentTreatments")),1),o("div",oe,[(c(!0),m(_,null,f(r.Employee.finished_treatments,d=>(c(),m("div",re,[o("div",ae,[o("p",ne,[y(l,{onCheck:a.searchKey(d.id),onClick:v=>a.sendData(d),Title:a.getName("Patient")+": "+d.patient_name},null,8,["onCheck","onClick","Title"])])]),o("div",ie,[o("p",de,n(i.counterStore.formatNumber(d.doctor_sum))+" UZS",1)]),o("div",ce,[o("p",le,n(d.start),1)])]))),256))])])]),y(x,{class:"box001",Sum:r.DebtorSum,Items:r.Employee.deptor_treatments},null,8,["Sum","Items"]),o("h4",null,n(a.getName("PaymentTypes"))+":",1),(c(!0),m(_,null,f(r.PayTypes,d=>(c(),p(l,{Title:d.name,onClick:v=>r.PaymentId=d.id,onCheck:d.id==r.PaymentId},null,8,["Title","onClick","onCheck"]))),256)),r.Patients.length>0?(c(),p(g,{key:0,Title:a.getName("ToPay"),onClick:t[0]||(t[0]=d=>a.Payment())},null,8,["Title"])):E("",!0)]),_:1})}const xe=b(X,[["render",me],["__scopeId","data-v-40d621c2"]]);export{xe as default};
