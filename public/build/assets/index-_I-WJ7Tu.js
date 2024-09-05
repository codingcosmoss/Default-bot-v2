import{a as B,b as T,P as I}from"./Page-oDaSi7Lo.js";import{_ as $,M as v,u as x,cf as L,I as c,cg as N,A as p,by as k,c as d,w as u,r as n,o as l,e as r,a as m,t as s,f as A,b as h,d as E,F as G,g as _}from"./app-YVDEE9Za.js";import{B as V}from"./BasicTable-ZfmzSUNN.js";import{G as F}from"./GrowingLoader-vQyHSln3.js";import{P as M}from"./PrimaryIconBtn-p99sUTrH.js";import{D as O}from"./DefaultInput-p6HHK0Yr.js";import{P as q}from"./Paginate-CHzY4ZgL.js";import{D as j}from"./DefaultSelect-Mq9jguBD.js";const z={components:{DefaultSelect:j,Paginate:q,DefaultInput:O,PrimaryBtn:B,ModalCentered:v,PrimaryIconBtn:M,PrimaryButton:T,GrowingLoader:F,BasicTable:V,Page:I},setup(){return{counterStore:x()}},data(){return{items:[],item:[],boxItem:[],paginateCount:10,last_page:1,current_page:1,boxLast_page:1,boxCurrent_page:1,column:"id",type:"desc",errors:[],loader:!1,boxLoader:!1,boxItems:[]}},methods:{async indexPaginates(e=1,t=!0){try{this.loader=t;const o=await L(50,e);o.status&&(this.current_page=o.data.pagination.current_page,this.last_page=o.data.pagination.last_page,this.items=o.data.items),this.loader=!1}catch(o){c(this,o)}},async search(e=""){try{if(this.loader=!0,e=="")return this.indexPaginates(),!0;const t=await N(e);return this.items=t.data,this.loader=!1,t.status?(this.loader=!1,!0):(p("error",this.$t("formError")),this.loader=!1,!1)}catch(t){return c(this,t),this.loader=!1,!1}},async delete(e){try{if(!confirm(this.$t("DeleteAlert")))return!1;if((await k(e)).status){this.indexPaginates(this.current_page),p("success",this.$t("delete"));return}return p("error",this.$t("formError")),!1}catch(t){return c(this,t),!1}}},mounted(){this.indexPaginates()}},H={class:"row"},J={value:"10",selected:""},K=r("option",{value:"10"},"10",-1),Q=r("option",{value:"20"},"20",-1),R=r("option",{value:"50"},"50",-1),U=r("option",{value:"100"},"100",-1),W=["onClick"];function X(e,t,o,g,i,f){const y=n("DefaultInput"),P=n("DefaultSelect"),C=n("Paginate"),b=n("GrowingLoader"),S=n("BasicTable"),D=n("Page");return l(),d(D,{Title:""},{default:u(()=>[r("div",H,[m(S,{Th:[e.$t("No"),e.$t("Supplier"),e.$t("Employee"),e.$t("Invoice"),e.$t("AmountPaid"),e.$t("PaymentType"),e.$t("PaidDate")],Title:e.$t("SupplierPayments"),Col:"col-lg-12"},{inputs:u(()=>[m(y,{Class:"col-lg-3 col-sm-2 search_input",Label:"",Name:"name",Type:"text",Pholder:"Search...",onOnInput:t[0]||(t[0]=a=>f.search(a))}),m(P,{Label:"",Class:"col-lg-2 col-sm-2",onOnInput:t[1]||(t[1]=a=>(this.paginateCount=a,this.indexPaginates()))},{default:u(()=>[r("option",J,s(e.$t("NumberDownloads")),1),K,Q,R,U]),_:1}),A("   ")]),default:u(()=>[(l(!0),h(G,null,E(i.items,(a,w)=>(l(),h("tr",null,[r("td",null,s((i.current_page-1)*i.paginateCount+w+1),1),r("td",null,s(a.supplier.name),1),r("td",null,s(a.user.name),1),r("td",{class:"text-success cursor-pointer",onClick:Y=>this.$router.push({path:"/admin/document/show",query:{id:a.document_id}})},s(a.document_id),9,W),r("td",null,s(g.counterStore.formatNumber(a.amount))+" "+s(a.currency.sign),1),r("td",null,s(a.payment_type.name),1),r("td",null,s(g.counterStore.formatDate(a.created_at)),1)]))),256)),i.last_page!=1?(l(),d(C,{key:0,Cols:"7",currentPage:this.current_page,totalPages:this.last_page,onChangePage:t[2]||(t[2]=a=>f.indexPaginates(a))},null,8,["currentPage","totalPages"])):_("",!0),i.loader?(l(),d(b,{key:1,Cols:"7"})):_("",!0)]),_:1},8,["Th","Title"])])]),_:1})}const ie=$(z,[["render",X]]);export{ie as default};
