import{a as N,b as A,P as M}from"./Page-oDaSi7Lo.js";import{_ as U,M as z,u as O,aq as G,I as n,ar as V,A as u,as as R,at as $,au as F,av as q,aw as j,ax as H,ay as J,az as K,aA as Q,aB as W,c as p,w as m,r as c,o,e as s,b as _,d as y,F as x,n as X,t as i,a as f,f as v,g}from"./app-YVDEE9Za.js";import{B as Y}from"./BasicTable-ZfmzSUNN.js";import{G as Z}from"./GrowingLoader-vQyHSln3.js";import{P as ee}from"./PrimaryIconBtn-p99sUTrH.js";import{U as te,C as se}from"./create-PMe5nO-E.js";import{D as ae}from"./DefaultInput-p6HHK0Yr.js";import{P as re}from"./Paginate-CHzY4ZgL.js";import{D as ne}from"./DefaultSelect-Mq9jguBD.js";import{C as oe}from"./CardBlock-4ht9T8B7.js";import"./ImageInput-8YHD6RYu.js";const ie={components:{CardBlock:oe,DefaultSelect:ne,Paginate:re,DefaultInput:ae,PrimaryBtn:N,ModalCentered:z,PrimaryIconBtn:ee,PrimaryButton:A,GrowingLoader:Z,BasicTable:Y,Page:M,Update:te,Create:se},setup(){return{counterStore:O()}},data(){return{items:[],item:[],headers:[1,2,3,4,5,6],paginateCount:10,last_page:1,current_page:1,column:"id",type:"desc",errors:[],loader:!1,totals:[],categories:[],totalLoader:!0,totalId:0,indexModel:"index",currency_id:0}},methods:{async index(){try{const e=await G();this.items=e.data}catch(e){n(this,e)}},async indexCategories(){try{const e=await V();this.categories=e.data}catch(e){n(this,e)}},async getCurrencies(e,t=1){try{if(this.currency_id=e,this.paginateCount=100,this.indexModel="currency",this.totalId=e,this.loader=!0,e==0){this.indexPaginates(1),u("info",this.$t("currenciesAlert"));return}const l=await R(e,t);this.loader=!1,this.current_page=l.data.pagination.current_page,this.last_page=l.data.pagination.last_page,this.items=l.data.items,this.item=l.data.items[0],u("info",this.$t("currenciesAlert"))}catch(l){n(this,l)}},async getTotals(){try{this.totalId=0,this.totalLoader=!0;const e=await $();let t=0;e.data.forEach(h=>{t+=h.total_amount});let l=e.data;l.push({title:"Sum",sign:"",currency_id:0,total_amount:t}),this.totals=l,this.totalLoader=!1}catch(e){n(this,e)}},async indexPaginates(e=1){try{this.indexModel="index",this.loader=!0;const t=await F(this.paginateCount,e);this.current_page=t.data.pagination.current_page,this.last_page=t.data.pagination.last_page,this.items=t.data.items,this.item=t.data.items[0],this.loader=!1}catch(t){n(this,t)}},async orderBys(){try{const e=await q(this.column,this.type);this.items=e.data}catch(e){n(this,e)}},async show(e){try{const t=await j(e);this.item=t.data}catch(t){n(this,t)}},async create(){try{const t=await H({});return t.status?(u("success",this.$t("create")),!0):(this.errors=t.errors,u("error",this.$t("formError")),!1)}catch(e){return n(this,e),!1}},async update(){try{const t=await J({});return t.status?(u("success",this.$t("update")),!0):(this.errors=t.errors,u("error",this.$t("formError")),!1)}catch(e){return n(this,e),!1}},async search(e=""){try{if(this.loader=!0,e=="")return this.indexPaginates(),!0;const t=await K(e);return this.items=t.data,this.loader=!1,t.status?(this.loader=!1,!0):(u("error",this.$t("formError")),this.loader=!1,!1)}catch(t){return n(this,t),this.loader=!1,!1}},async deleteData(e){try{if(!confirm(this.$t("DeleteAlert")))return!1;if((await Q(e)).status){u("success",this.$t("delete")),this.indexPaginates(this.current_page),this.getTotals();return}return u("error",this.$t("formError")),!1}catch(t){return n(this,t),!1}},async getCategoryExpensies(e){try{e==0&&this.indexPaginates();const t=await W(e);this.items=t.data}catch(t){n(this,t)}}},mounted(){this.indexPaginates(),this.getTotals(),this.indexCategories()}},le={class:"row"},ce={class:"col-lg-3 cursor-pointer"},de=s("div",{class:"card mini-stats-wid"},[s("div",{class:"card-body"},[s("div",{class:"d-flex flex-wrap"},[s("div",{class:"me-3"},[s("p",{class:"mb-2 placeholder"},"Uzbekistani"),s("br"),s("h5",{class:"mb-0 placeholder"},"201 000 сўм")]),s("div",{class:"avatar-sm ms-auto"},[s("div",{class:"avatar-title bg-light rounded-circle text-primary font-size-20"},[s("i",{class:"bx bx-money"})])])])])],-1),ue=[de],he=["onClick"],pe={class:"card-body"},me={class:"d-flex flex-wrap"},ge={class:"me-3"},_e={class:"text-muted mb-2"},fe={class:"mb-0"},ye=s("div",{class:"avatar-sm ms-auto"},[s("div",{class:"avatar-title bg-light rounded-circle text-primary font-size-20"},[s("i",{class:"bx bx-money"})])],-1),xe={value:"10",selected:""},Ce=s("option",{value:"10"},"10",-1),Pe=s("option",{value:"20"},"20",-1),be=s("option",{value:"50"},"50",-1),ve=s("option",{value:"100"},"100",-1),we=s("tr",null,null,-1);function ke(e,t,l,h,r,d){const w=c("DefaultInput"),k=c("DefaultSelect"),B=c("PrimaryBtn"),C=c("PrimaryIconBtn"),P=c("Paginate"),S=c("GrowingLoader"),T=c("BasicTable"),I=c("Update"),D=c("Create"),E=c("Page");return o(),p(E,{Title:""},{default:m(()=>[s("div",le,[r.totalLoader?(o(),_(x,{key:0},y(4,a=>s("div",ce,ue)),64)):(o(!0),_(x,{key:1},y(r.totals,a=>(o(),_("div",{onClick:b=>d.getCurrencies(a.currency_id),class:"col-lg-3 cursor-pointer"},[s("div",{class:X(["card mini-stats-wid",r.totalId==a.currency_id&&"bg-primary-subtle"])},[s("div",pe,[s("div",me,[s("div",ge,[s("p",_e,i(a.title=="Sum"?e.$t("Total"):a.title),1),s("h5",fe,i(h.counterStore.formatNumber(a.total_amount))+" "+i(a.sign),1)]),ye])])],2)],8,he))),256)),f(T,{Th:[e.$t("No"),e.$t("Title"),e.$t("Amount"),e.$t("Date"),e.$t("ExpensesCategory"),e.$t("Settings")],Title:e.$t("Expenses"),Col:"col-lg-12"},{inputs:m(()=>[f(w,{Class:"col-lg-3 col-sm-2 search_input",Label:"",Name:"name",Type:"text",Pholder:"Search...",onOnInput:t[0]||(t[0]=a=>d.search(a))}),f(k,{Label:"",Class:"col-lg-2 col-sm-2",onOnInput:t[1]||(t[1]=a=>(this.paginateCount=a,this.indexPaginates()))},{default:m(()=>[s("option",xe,i(e.$t("NumberDownloads")),1),Ce,Pe,be,ve]),_:1}),v("   ")]),buttons:m(()=>[h.counterStore.hasRole("Expenses-create")?(o(),p(B,{key:0,role:"button","data-bs-toggle":"modal","data-bs-target":"#expenseCreate"},{default:m(()=>[v(i(e.$t("Create")),1)]),_:1})):g("",!0)]),default:m(()=>[(o(!0),_(x,null,y(r.items,(a,b)=>(o(),_("tr",null,[s("td",null,i((r.current_page-1)*r.paginateCount+b+1),1),s("td",null,i(a.title),1),s("td",null,i(h.counterStore.formatNumber(a.amount))+" "+i(a.currency!=null?a.currency.sign:""),1),s("td",null,i(a.date),1),s("td",null,i(a.category),1),s("td",null,[h.counterStore.hasRole("Expenses-update")?(o(),p(C,{key:0,onClick:L=>this.item=a,Icon:"bx bx-edit-alt",Modal:"expenseUpdate"},null,8,["onClick"])):g("",!0),h.counterStore.hasRole("Expenses-delete")?(o(),p(C,{key:1,onClick:L=>d.deleteData(a.id),class:"bg-danger border-danger",Icon:"bx bx-trash-alt"},null,8,["onClick"])):g("",!0)])]))),256)),r.last_page!=1&&r.indexModel=="index"?(o(),p(P,{key:0,currentPage:this.current_page,totalPages:this.last_page,onChangePage:t[2]||(t[2]=a=>d.indexPaginates(a))},null,8,["currentPage","totalPages"])):g("",!0),r.last_page!=1&&r.indexModel!="index"?(o(),p(P,{key:1,currentPage:this.current_page,totalPages:this.last_page,onChangePage:t[3]||(t[3]=a=>d.getCurrencies(this.currency_id,a))},null,8,["currentPage","totalPages"])):g("",!0),r.loader?(o(),p(S,{key:2,Cols:"7"})):g("",!0),we]),_:1},8,["Th","Title"])]),f(I,{Item:r.item,onOnUpdate:t[4]||(t[4]=a=>(d.indexPaginates(this.current_page),d.getTotals()))},null,8,["Item"]),f(D,{onOnCreate:t[5]||(t[5]=a=>(d.indexPaginates(this.current_page),d.getTotals()))})]),_:1})}const ze=U(ie,[["render",ke]]);export{ze as default};
