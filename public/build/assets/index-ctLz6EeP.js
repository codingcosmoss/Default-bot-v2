import{a as T,M as k,b as D,P as N}from"./Page-kS-htxF1.js";import{_ as M,u as U,aV as E,l as i,aW as L,aX as G,aY as O,aZ as V,a_ as $,A as c,a$ as R,b0 as F,b1 as q,b2 as W,b3 as X,b4 as Y,b5 as Z,d as u,w as m,r as l,o as d,a,e as p,t as o,b as f,g as h,c as v,f as j,I as H,n as J,F as K}from"./app--lA0zENz.js";import{B as Q}from"./BasicTable-ceqsBAou.js";import{G as ee}from"./GrowingLoader-CWiifW_R.js";import{P as te}from"./PrimaryIconBtn-zZrE_wsa.js";import{U as se,C as re}from"./create-0xKqR-az.js";import{D as ae}from"./DefaultInput-OXMKtQjk.js";import{P as ie}from"./Paginate-J0lbL4Dz.js";import{D as ne}from"./DefaultSelect-uFn2hizB.js";import"./ImageInput-q8VLym8J.js";import"./boxCreate-ItwNuwUw.js";import"./boxCreate-cCLV8FGc.js";import"./Loader-lMoZoIfD.js";const oe={components:{DefaultSelect:ne,Paginate:ie,DefaultInput:ae,PrimaryBtn:T,ModalCentered:k,PrimaryIconBtn:te,PrimaryButton:D,GrowingLoader:ee,BasicTable:Q,Page:N,Update:se,Create:re},setup(){return{counterStore:U()}},data(){return{items:[],item:[],paginateCount:10,headers:[1,2,3,4,5,6,7,8,9,10],last_page:1,current_page:1,column:"id",type:"desc",errors:[],loader:!1,medicineCategories:[],boxSizes:[],drugCompanies:[],sizeTypes:[],mloader:!1,crud:"create"}},methods:{async index(){try{const e=await E();this.items=e.data}catch(e){i(this,e)}},async indexActives(){try{const e=await L(this.paginateCount);this.items=e.data}catch(e){i(this,e)}},async indexPaginates(e=1){try{this.loader=!0;const t=await G(this.paginateCount,e);this.current_page=t.data.pagination.current_page,this.last_page=t.data.pagination.last_page,this.items=t.data.items,this.loader=!1}catch(t){i(this,t)}},async orderBys(){try{const e=await O(this.column,this.type);this.items=e.data}catch(e){i(this,e)}},async show(e){try{const t=await V(e);this.item=t.data}catch(t){i(this,t)}},async create(){try{const t=await $({});return t.status?(c("success",this.$t("create")),!0):(this.errors=t.errors,c("error",this.$t("formError")),!1)}catch(e){return i(this,e),!1}},async update(){try{const t=await R({});return t.status?(c("success",this.$t("update")),!0):(this.errors=t.errors,c("error",this.$t("formError")),!1)}catch(e){return i(this,e),!1}},async search(e=""){try{if(this.loader=!0,e=="")return this.indexPaginates(),!0;const t=await F(e);return this.items=t.data,this.loader=!1,t.status?(this.loader=!1,!0):(c("error",this.$t("formError")),this.loader=!1,!1)}catch(t){return i(this,t),this.loader=!1,!1}},async delete(e){try{if(!confirm(this.$t("DeleteAlert")))return!1;const t=await q(e);return this.items=t.data,t.status&&(this.indexPaginates(this.current_page),c("success",this.$t("delete"))),c("error",this.$t("formError")),!1}catch(t){return i(this,t),!1}},async indexCategoryActives(){try{this.mloader=!0;const e=await W();this.medicineCategories=e.data,this.mloader=!1}catch(e){i(this,e)}},async indexBoxSizesActives(){try{this.mloader=!0;const e=await X();this.boxSizes=e.data,this.mloader=!1}catch(e){i(this,e)}},async indexCompaniesActives(){try{this.mloader=!0;const e=await Y();this.drugCompanies=e.data,this.mloader=!1}catch(e){i(this,e)}},async indexTypesActives(){try{this.mloader=!0;const e=await Z();this.sizeTypes=e.data,this.mloader=!1}catch(e){i(this,e)}}},mounted(){this.indexPaginates(),this.indexCategoryActives(),this.indexBoxSizesActives(),this.indexCompaniesActives(),this.indexTypesActives()}},le={class:"row"},de={value:"10",selected:""},ce=a("option",{value:"10"},"10",-1),ue=a("option",{value:"20"},"20",-1),me=a("option",{value:"50"},"50",-1),pe=a("option",{value:"100"},"100",-1),ge={style:{"text-wrap":"wrap"}},he={style:{"text-wrap":"wrap"}};function ye(e,t,Ce,g,r,n){const x=l("DefaultInput"),b=l("DefaultSelect"),A=l("PrimaryBtn"),y=l("PrimaryIconBtn"),P=l("Paginate"),S=l("GrowingLoader"),_=l("BasicTable"),w=l("Update"),z=l("Create"),B=l("Page");return d(),u(B,{Title:""},{default:m(()=>[a("div",le,[p(_,{Th:[e.$t("Id"),e.$t("Picture"),e.$t("ModalName"),e.$t("GenericName"),e.$t("Amount"),e.$t("SellingPrice"),e.$t("BuyPrice"),e.$t("Category"),e.$t("Status"),e.$t("Settings")],Title:e.$t("Medicines"),Col:"col-lg-12"},{inputs:m(()=>[p(x,{Class:"col-lg-3 col-sm-2 search_input",Label:"",Name:"name",Type:"text",Pholder:"Search...",onOnInput:t[0]||(t[0]=s=>n.search(s))}),p(b,{Label:"",Class:"col-lg-2 col-sm-2",onOnInput:t[1]||(t[1]=s=>(this.paginateCount=s,this.indexPaginates()))},{default:m(()=>[a("option",de,o(e.$t("NumberDownloads")),1),ce,ue,me,pe]),_:1}),f("   ")]),buttons:m(()=>[g.counterStore.hasRole("Medicines-create")?(d(),u(A,{key:0,onClick:t[2]||(t[2]=s=>r.crud="create"),role:"button","data-bs-toggle":"modal","data-bs-target":"#medicineCreate"},{default:m(()=>[f(o(e.$t("Create")),1)]),_:1})):h("",!0)]),default:m(()=>[(d(!0),v(K,null,j(r.items,(s,I)=>(d(),v("tr",null,[a("td",null,o((r.current_page-1)*r.paginateCount+I+1),1),a("td",null,[a("div",{class:"table_image",style:H("background-image: url("+s.image[0].url+")")},null,4)]),a("td",ge,o(s.name),1),a("td",he,o(s.generic_name),1),a("td",null,o(s.amount),1),a("td",null,o(g.counterStore.formatNumber(s.price))+" "+o(s.currency.sign),1),a("td",null,o(g.counterStore.formatNumber(s.buy_price))+" "+o(s.currency.sign),1),a("td",null,o(s.medicine_category_name),1),a("td",null,[a("span",{class:J([s.status==1?"badge-soft-success":"badge-soft-danger","badge badge-pill badge-soft-success font-size-11"])},o(s.status==1?e.$t("Active"):e.$t("InActive")),3)]),a("td",null,[g.counterStore.hasRole("Medicines-update")?(d(),u(y,{key:0,onClick:C=>(this.item=s,r.crud="update"),Icon:"bx bx-edit-alt",Modal:"medicineUpdate"},null,8,["onClick"])):h("",!0),p(y,{onClick:C=>this.$router.push({path:"/admin/medicines/show",query:{id:s.id}}),Icon:"bx bx-show"},null,8,["onClick"]),g.counterStore.hasRole("Medicines-delete")?(d(),u(y,{key:1,onClick:C=>this.delete(s.id),class:"bg-danger border-danger",Icon:"bx bx-trash-alt"},null,8,["onClick"])):h("",!0)])]))),256)),r.last_page!=1?(d(),u(P,{key:0,currentPage:this.current_page,totalPages:this.last_page,onChangePage:t[3]||(t[3]=s=>n.indexPaginates(s)),Cols:r.headers.length},null,8,["currentPage","totalPages","Cols"])):h("",!0),r.loader?(d(),u(S,{key:1,Cols:r.headers.length},null,8,["Cols"])):h("",!0)]),_:1},8,["Th","Title"])]),p(w,{crud:r.crud,Item:r.item,medicineCategories:r.medicineCategories,boxSizes:r.boxSizes,drugCompanies:r.drugCompanies,sizeTypes:r.sizeTypes,onIndexCategoryActives:t[4]||(t[4]=s=>n.indexCategoryActives()),onIndexCompaniesActives:t[5]||(t[5]=s=>n.indexCompaniesActives()),onIndexBoxSizesActives:t[6]||(t[6]=s=>n.indexBoxSizesActives()),onIndexTypesActives:t[7]||(t[7]=s=>n.indexTypesActives()),onOnUpdate:t[8]||(t[8]=s=>n.indexPaginates(this.current_page)),mloader:r.mloader},null,8,["crud","Item","medicineCategories","boxSizes","drugCompanies","sizeTypes","mloader"]),p(z,{medicineCategories:r.medicineCategories,boxSizes:r.boxSizes,drugCompanies:r.drugCompanies,sizeTypes:r.sizeTypes,onIndexCategoryActives:t[9]||(t[9]=s=>n.indexCategoryActives()),onIndexCompaniesActives:t[10]||(t[10]=s=>n.indexCompaniesActives()),onIndexBoxSizesActives:t[11]||(t[11]=s=>n.indexBoxSizesActives()),onIndexTypesActives:t[12]||(t[12]=s=>n.indexTypesActives()),onOnCreate:t[13]||(t[13]=s=>n.indexPaginates(this.current_page)),mloader:r.mloader},null,8,["medicineCategories","boxSizes","drugCompanies","sizeTypes","mloader"])]),_:1})}const ke=M(oe,[["render",ye]]);export{ke as default};
