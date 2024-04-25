import{P as N}from"./Page-EAuwfOTr.js";import{_ as g,u as h,o as i,c as l,a as e,t as a,N as P,bE as L,bF as j,r as c,n as x,b as _,F as S,C as $,x as b,f as k,h as I,w as f,J as M}from"./app-wmakNrFD.js";import{P as T}from"./paginate-CoOZTaYR.js";import{_ as V}from"./pagination-01.vue_vue_type_style_index_0_lang-Z69Tj-9G.js";import{L as z}from"./Loader-mtXqPlpY.js";const B={data(){return{order:"asc",search:"",column:"id"}},methods:{getName(t){return h().getName(t)}}},H={class:"grid grid-cols-6 border-b border-stroke dark:border-strokedark sm:grid-cols-6 overflow-x-auto media_header"},D={class:"flex items-center justify-center p-2.5 xl:p-5"},F={class:"font-medium text-black dark:text-white"},A={class:"flex items-center justify-center p-2.5 xl:p-5"},E={class:"font-medium text-black dark:text-white"},O={class:"flex items-center justify-center p-2.5 xl:p-5"},q={class:"font-medium text-black dark:text-white"},G={class:"flex items-center justify-center p-2.5 xl:p-5"},J={class:"font-medium text-black dark:text-white"},K={class:"flex items-center justify-center p-2.5 xl:p-5"},R={class:"font-medium text-black dark:text-white"},U={class:"flex items-center justify-center p-2.5 xl:p-5"},Q={class:"font-medium text-black dark:text-white"};function W(t,r,m,d,n,s){return i(),l("div",H,[e("div",D,[e("p",F,a(s.getName("Doctor")),1)]),e("div",A,[e("p",E,a(s.getName("Date")),1)]),e("div",O,[e("p",q,a(s.getName("MoneyAmount")),1)]),e("div",G,[e("p",J,a(s.getName("PaymentTypes")),1)]),e("div",K,[e("p",R,a(s.getName("Patients")),1)]),e("div",U,[e("p",Q,a(s.getName("actions")),1)])])}const X=g(B,[["render",W],["__scopeId","data-v-b14a1b59"]]),Y={components:{Loader:z,VueAwesomePaginate:P,Pagination01:V,Paginate:T,TableHeader:X},setup(){return{counterStore:h()}},data(){return{Items:[],search:"",column:"updated_at",order:"asc",paginateCount:10,pagination:{},last_page:0,currentPage:1,errorObj:{},crud:""}},methods:{async clickSearch(t,r){this.search=t,this.order=r;var m={search:this.search,order:this.order,column:this.column,paginate:this.paginateCount};const d=await L(m);console.log("Response:",d),this.Items=d.data.items},async getModel(){const t=await j();this.Items=t.data},getName(t){return h().getName(t)},onSearch(t){this.order=t,this.search()},onPaginate(t){this.paginateCount=t,this.getItems()},hasKey(t){return t in this.errorObj}},mounted(){this.getModel()}},Z={class:"col-span-12 xl:col-span-12"},ee={class:"rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"},te={class:"mb-6 text-xl font-bold text-black dark:text-white"},se={class:"flex flex-col table_media_box"},oe={class:"grid grid-cols-3 rounded-sm mb-2 sm:grid-cols-5 relative media_top_bar"},re={class:"ml-4 flex btn01"},ae=["title"],ne=e("path",{fill:"currentColor",d:"M6 17.59L7.41 19L12 14.42L16.59 19L18 17.59l-6-6z"},null,-1),ie=e("path",{fill:"currentColor",d:"m6 11l1.41 1.41L12 7.83l4.59 4.58L18 11l-6-6z"},null,-1),ce=[ne,ie],de=["title"],le=e("path",{fill:"currentColor",d:"M18 6.41L16.59 5L12 9.58L7.41 5L6 6.41l6 6z"},null,-1),_e=e("path",{fill:"currentColor",d:"m18 13l-1.41-1.41L12 16.17l-4.59-4.58L6 13l6 6z"},null,-1),me=[le,_e],pe={class:"ml-4"},ue=e("option",{value:"10"},"10",-1),he=e("option",{value:"20"},"20",-1),fe=e("option",{value:"50"},"50",-1),ge=e("option",{value:"100"},"100",-1),xe=[ue,he,fe,ge],be={class:"databes_table grid grid-cols-6 border-b border-stroke dark:border-strokedark sm:grid-cols-6"},ke={class:"flex items-center gap-3 p-2.5 xl:p-5"},ve={class:"font-medium text-black dark:text-white sm:block"},we={class:"flex items-center justify-center p-2.5 xl:p-5"},ye={class:"font-medium text-black dark:text-white"},Ce={class:"flex items-center justify-center p-2.5 xl:p-5"},Ne={class:"font-medium text-black dark:text-white"},Pe={class:"flex items-center justify-center p-2.5 xl:p-5"},Le={class:"font-medium text-black dark:text-white"},je={class:"flex items-center justify-center p-2.5 xl:p-5",style:{"white-space":"nowrap"}},Se={class:"font-medium text-black dark:text-white"},$e={class:"flex items-center justify-center p-2.5 sm:flex xl:p-5"},Ie={class:"font-medium text-meta-5"},Me=["onClick"];function Te(t,r,m,d,n,s){const p=c("TableHeader"),u=c("Loader"),v=c("vue-awesome-paginate"),w=c("Pagination01"),y=c("Paginate");return i(),l("div",Z,[e("div",ee,[e("h4",te,a(s.getName("GivenMoney")),1),e("div",se,[e("div",oe,[e("div",null,[e("input",{type:"text",placeholder:"Search",onInput:r[0]||(r[0]=o=>s.clickSearch(o.target.value,n.order)),class:"w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"},null,32)]),e("div",re,[(i(),l("svg",{onClick:r[1]||(r[1]=o=>s.clickSearch(n.search,"asc")),title:s.getName("growth"),class:x(n.order=="asc"?"active":""),xmlns:"http://www.w3.org/2000/svg",width:"32",height:"32",viewBox:"0 0 24 24"},ce,10,ae)),(i(),l("svg",{onClick:r[2]||(r[2]=o=>s.clickSearch(n.search,"desc")),class:x(n.order=="desc"?"active":""),title:s.getName("decrease"),xmlns:"http://www.w3.org/2000/svg",width:"32",height:"32",viewBox:"0 0 24 24"},me,10,de))]),e("div",pe,[e("select",{onInput:r[3]||(r[3]=o=>s.onPaginate(o.target.value)),class:"w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"},xe,32)])]),_(p),(i(!0),l(S,null,$(n.Items,(o,C)=>(i(),l("div",be,[e("div",ke,[e("p",ve,a(C+1)+". "+a(o.doctor.name),1)]),e("div",we,[e("p",ye,a(o.doctor_givey_money_at),1)]),e("div",Ce,[e("p",Ne,a(d.counterStore.formatNumber(o.doctor_result_sum))+" uzs",1)]),e("div",Pe,[e("p",Le,a(o.technic_or_doctor_payment_type),1)]),e("div",je,[e("p",Se,a(o.patient.first_name)+" "+a(o.patient.last_name),1)]),e("div",$e,[e("p",Ie,[b("   "),e("i",{onClick:He=>this.$router.push({path:"/patient/show",query:{id:o.patient_id}}),class:"fa-solid setting-icon fa-eye"},null,8,Me),b("   ")])])]))),256)),n.Items.length==0&&n.search==""?(i(),k(u,{key:0})):I("",!0),_(y,null,{default:f(()=>[_(w,null,{default:f(()=>[_(v,{"total-items":n.last_page,"items-per-page":1,"max-pages-shown":1,modelValue:n.currentPage,"onUpdate:modelValue":r[4]||(r[4]=o=>n.currentPage=o),"on-click":t.onClickHandler},null,8,["total-items","modelValue","on-click"])]),_:1})]),_:1})])])])}const Ve=g(Y,[["render",Te]]),ze=M({components:{Table:Ve,Page:N}});function Be(t,r,m,d,n,s){const p=c("Table"),u=c("Page");return i(),k(u,null,{default:f(()=>[_(p)]),_:1})}const qe=g(ze,[["render",Be]]);export{qe as default};
