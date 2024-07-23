import{a as $,M as L,b as N,P as U}from"./Page-X_CL2XrS.js";import{_ as A,u as O,a9 as z,l as r,aa as G,A as l,ab as V,ac as M,ad as R,ae as F,af as j,ag as q,ah as H,ai as J,aj as K,ak as Q,d as h,w as p,r as n,o,a as s,c as g,f as b,F as P,e as m,t as i,b as _,g as f,n as W}from"./app-HuQxhYkh.js";import{B as X}from"./BasicTable-yOAfWnez.js";import{P as Y,G as Z}from"./GrowingLoader-hxei4TSu.js";import{U as ee,C as te}from"./create-HBIDIkui.js";import{D as se}from"./DefaultInput-8EaRomtX.js";import{P as ae}from"./Paginate-a87pEyqc.js";import{D as re}from"./DefaultSelect-6fsBvJhD.js";import{C as oe}from"./CardBlock-zWIgrFGz.js";import"./ImageInput-2jWvBMRc.js";const ne={components:{CardBlock:oe,DefaultSelect:re,Paginate:ae,DefaultInput:se,PrimaryBtn:$,ModalCentered:L,PrimaryIconBtn:Y,PrimaryButton:N,GrowingLoader:Z,BasicTable:X,Page:U,Update:ee,Create:te},setup(){return{counterStore:O()}},data(){return{items:[],item:[],headers:[1,2,3,4,5,6],paginateCount:10,last_page:1,current_page:1,column:"id",type:"desc",errors:[],loader:!1,totals:[],categories:[],totalLoader:!0,totalId:0}},methods:{async index(){try{const e=await z();this.items=e.data}catch(e){r(this,e)}},async indexCategories(){try{const e=await G();this.categories=e.data}catch(e){r(this,e)}},async getCurrencies(e){try{if(this.totalId=e,this.loader=!0,e==0){this.indexPaginates(1),l("info",this.$t("currenciesAlert"));return}const t=await V(e);this.loader=!1,this.items=t.data,l("info",this.$t("currenciesAlert"))}catch(t){r(this,t)}},async getTotals(){try{this.totalId=0,this.totalLoader=!0;const e=await M();let t=0;e.data.forEach(c=>{t+=c.total_amount});let y=e.data;y.push({title:"Sum",sign:"",currency_id:0,total_amount:t}),this.totals=y,this.totalLoader=!1}catch(e){r(this,e)}},async indexPaginates(e=1){try{this.loader=!0;const t=await R(this.paginateCount,e);this.current_page=t.data.pagination.current_page,this.last_page=t.data.pagination.last_page,this.items=t.data.items,this.item=t.data.items[0],this.loader=!1}catch(t){r(this,t)}},async orderBys(){try{const e=await F(this.column,this.type);this.items=e.data}catch(e){r(this,e)}},async show(e){try{const t=await j(e);this.item=t.data}catch(t){r(this,t)}},async create(){try{const t=await q({});return t.status?(l("success",this.$t("create")),!0):(this.errors=t.errors,l("error",this.$t("formError")),!1)}catch(e){return r(this,e),!1}},async update(){try{const t=await H({});return t.status?(l("success",this.$t("update")),!0):(this.errors=t.errors,l("error",this.$t("formError")),!1)}catch(e){return r(this,e),!1}},async search(e=""){try{if(this.loader=!0,e=="")return this.indexPaginates(),!0;const t=await J(e);return this.items=t.data,this.loader=!1,t.status?(this.loader=!1,!0):(l("error",this.$t("formError")),this.loader=!1,!1)}catch(t){return r(this,t),this.loader=!1,!1}},async delete(e){try{if(!confirm(this.$t("DeleteAlert")))return!1;const t=await K(e);return this.items=t.data,t.status&&(l("success",this.$t("delete")),this.indexPaginates(this.current_page),this.getTotals()),l("error",this.$t("formError")),!1}catch(t){return r(this,t),!1}},async getCategoryExpensies(e){try{e==0&&this.indexPaginates();const t=await Q(e);this.items=t.data}catch(t){r(this,t)}}},mounted(){this.indexPaginates(),this.getTotals(),this.indexCategories()}},ie={class:"row"},le={class:"col-lg-3 cursor-pointer"},ce=s("div",{class:"card mini-stats-wid"},[s("div",{class:"card-body"},[s("div",{class:"d-flex flex-wrap"},[s("div",{class:"me-3"},[s("p",{class:"mb-2 placeholder"},"Uzbekistani"),s("br"),s("h5",{class:"mb-0 placeholder"},"201 000 сўм")]),s("div",{class:"avatar-sm ms-auto"},[s("div",{class:"avatar-title bg-light rounded-circle text-primary font-size-20"},[s("i",{class:"bx bx-money"})])])])])],-1),de=[ce],ue=["onClick"],he={class:"card-body"},pe={class:"d-flex flex-wrap"},me={class:"me-3"},ge={class:"text-muted mb-2"},fe={class:"mb-0"},_e=s("div",{class:"avatar-sm ms-auto"},[s("div",{class:"avatar-title bg-light rounded-circle text-primary font-size-20"},[s("i",{class:"bx bx-money"})])],-1),ye={value:"10",selected:""},xe=s("option",{value:"10"},"10",-1),Ce=s("option",{value:"20"},"20",-1),be=s("option",{value:"50"},"50",-1),Pe=s("option",{value:"100"},"100",-1),ve=s("tr",null,null,-1);function we(e,t,y,c,d,u){const v=n("DefaultInput"),w=n("DefaultSelect"),k=n("PrimaryBtn"),x=n("PrimaryIconBtn"),B=n("Paginate"),I=n("GrowingLoader"),S=n("BasicTable"),T=n("Update"),E=n("Create"),D=n("Page");return o(),h(D,{Title:""},{default:p(()=>[s("div",ie,[d.totalLoader?(o(),g(P,{key:0},b(4,a=>s("div",le,de)),64)):(o(!0),g(P,{key:1},b(d.totals,a=>(o(),g("div",{onClick:C=>u.getCurrencies(a.currency_id),class:"col-lg-3 cursor-pointer"},[s("div",{class:W(["card mini-stats-wid",d.totalId==a.currency_id&&"bg-primary-subtle"])},[s("div",he,[s("div",pe,[s("div",me,[s("p",ge,i(a.title=="Sum"?e.$t("Total"):a.title),1),s("h5",fe,i(c.counterStore.formatNumber(a.total_amount))+" "+i(a.sign),1)]),_e])])],2)],8,ue))),256)),m(S,{Th:[e.$t("Id"),e.$t("Title"),e.$t("Amount"),e.$t("Date"),e.$t("ExpensesCategory"),e.$t("Settings")],Title:e.$t("Expenses"),Col:"col-lg-12"},{inputs:p(()=>[m(v,{Class:"col-lg-3 col-sm-2 search_input",Label:"",Name:"name",Type:"text",Pholder:"Search...",onOnInput:t[0]||(t[0]=a=>u.search(a))}),m(w,{Label:"",Class:"col-lg-2 col-sm-2",onOnInput:t[1]||(t[1]=a=>(this.paginateCount=a,this.indexPaginates()))},{default:p(()=>[s("option",ye,i(e.$t("NumberDownloads")),1),xe,Ce,be,Pe]),_:1}),_("   ")]),buttons:p(()=>[c.counterStore.hasRole("Expenses-create")?(o(),h(k,{key:0,role:"button","data-bs-toggle":"modal","data-bs-target":"#expenseCreate"},{default:p(()=>[_(i(e.$t("Create")),1)]),_:1})):f("",!0)]),default:p(()=>[(o(!0),g(P,null,b(d.items,a=>(o(),g("tr",null,[s("td",null," #"+i(a.id),1),s("td",null,i(a.title),1),s("td",null,i(c.counterStore.formatNumber(a.amount)+" "+a.currency.sign),1),s("td",null,i(a.date),1),s("td",null,i(a.category),1),s("td",null,[c.counterStore.hasRole("Expenses-update")?(o(),h(x,{key:0,onClick:C=>this.item=a,Icon:"bx bx-edit-alt",Modal:"expenseUpdate"},null,8,["onClick"])):f("",!0),_("  "),m(x,{onClick:C=>this.$router.push({path:"/admin/expenses/show",query:{id:a.id}}),Icon:"bx bx-show"},null,8,["onClick"]),_("  "),c.counterStore.hasRole("Expenses-delete")?(o(),h(x,{key:1,onClick:C=>this.delete(a.id),class:"bg-danger border-danger",Icon:"bx bx-trash-alt"},null,8,["onClick"])):f("",!0)])]))),256)),d.last_page!=1?(o(),h(B,{key:0,currentPage:this.current_page,totalPages:this.last_page,onChangePage:t[2]||(t[2]=a=>u.indexPaginates(a))},null,8,["currentPage","totalPages"])):f("",!0),d.loader?(o(),h(I,{key:1,Cols:"7"})):f("",!0),ve]),_:1},8,["Th","Title"])]),m(T,{Item:d.item,onOnUpdate:t[3]||(t[3]=a=>(u.indexPaginates(this.current_page),u.getTotals()))},null,8,["Item"]),m(E,{onOnCreate:t[4]||(t[4]=a=>(u.indexPaginates(this.current_page),u.getTotals()))})]),_:1})}const Ue=A(ne,[["render",we]]);export{Ue as default};
