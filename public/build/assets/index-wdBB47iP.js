import{a as V,M as O,b as L,P as k}from"./Page-k1RhpKxv.js";import{_ as M,u as H,A as c,bG as R,H as m,bh as F,bi as G,bj as j,bk as q,c as g,w as b,r as u,o as h,e as o,a as l,b as f,d as C,t as p,Y as U,F as I,f as Y,g as v}from"./app-tuttM9Io.js";import{B as J}from"./BasicTable-dpWtiJ4i.js";import{G as K}from"./GrowingLoader-ajX8lziD.js";import{P as Q}from"./PrimaryIconBtn-utELPCpc.js";import{D as W}from"./DefaultInput-AnvAhpkM.js";import{P as X}from"./Paginate-YTLkHTO4.js";import{D as Z}from"./DefaultSelect-mJwZsmUq.js";import{I as $,H as ee,R as te,S as se}from"./IconSelect-dOY-yh9s.js";import{U as re,C as S}from"./create-CCEquPtT.js";import{D as ae}from"./DefaultIconInput-8Wk_dPLx.js";import{B as ne,a as oe}from"./BasicSelect-P-Xw6ibJ.js";import"./ImageInput-sm-pHeYj.js";import"./boxCreate-cWFWHM6t.js";import"./boxCreate-pbR3qBWy.js";import"./Loader-Z87gmGUA.js";const ie={components:{BasicSelect:ne,BasicInput:oe,IconSelect:$,DefaultIconInput:ae,Update:re,Create:S,DefaultSelect:Z,Paginate:X,DefaultInput:W,PrimaryBtn:V,ModalCentered:O,PrimaryIconBtn:Q,PrimaryButton:L,GrowingLoader:K,BasicTable:J,Page:k,Header:ee,Report:te,Search:se,CreateMedicine:S},setup(){return{counterStore:H()}},data(){return{change:!1,isChange:!1,items:[],mloader:!1,item:[],boxItem:[],paginateCount:10,last_page:1,current_page:1,boxLast_page:1,boxCurrent_page:1,column:"id",type:"desc",errors:{date:this.$t("dateRequired"),batch_name:this.$t("BatchValidated"),buy_amount:this.$t("buyAmountError"),buy_price:this.$t("buyPriceError")},loader:!1,boxLoader:!1,boxItems:[],warehouses:Object,suppliers:Object,medicineCategories:[],boxSizes:[],drugCompanies:[],sizeTypes:[],medicines:[],dataErrors:[],paymentTypes:[],amount_paid:0,document:[],sortId:1}},methods:{validator(e,t){let a=[];return(e.batch_name==null||e.batch_name.length==0)&&a.push("batch"+e.sortId),(e.expiry_date_finished==null||this.isDateBeforeToday(e.expiry_date_finished))&&a.push("date"+e.sortId),this.isNumber(e.buy_price)||a.push("buy_price"+e.sortId),(!this.isNumber(e.buy_amount)||e.buy_amount<=0)&&a.push("buy_amount"+e.sortId),this.dataErrors=a,dataErrors.length>0||this.medicines==[]?(c("error",this.$t("formError")),!1):this.paid>this.subtotal?(c("error",this.$t("TheIncreased")),!1):this.paid>0&&this.payment_type_id<1?(c("error",this.$t("PaymentTyperequired")),!1):!0},isNumber(e){const t=parseFloat(e);return!isNaN(t)&&typeof t=="number"},isDateBeforeToday(e){const t=new Date(e),a=new Date;return a.setHours(0,0,0,0),t.setHours(0,0,0,0),t<=a},deleteError(e){this.isChange=!this.isChange,this.dataErrors=this.dataErrors.filter(t=>t!="date"+e&&t!="buy_price"+e&&t!="bu_amount"+e)},async show(){try{const e=await R(this.$route.query.id);e.data.status==5&&(c("info",this.$t("SavedDocumentError")),this.$router.push("/admin/documents")),this.document=e.data}catch(e){m(this,e)}},changePrice(e,t){let a={...this.medicines[t]},y=this.counterStore.inputNumberFormat("medicinePrice"+t,a.buy_price,e);a.buy_price=y,a.batch_name="",this.medicines[t]=a},addItem(e){let t=this.sortId+1,a={...e};a.sortId=t,a.buy_amount=1,this.sortId=t,this.medicines.push(a),this.isChange=!this.isChange},async search(e=""){try{if(this.loader=!0,e=="")return this.indexPaginates(),!0;const t=await documentSearch(e);return this.items=t.data,this.loader=!1,t.status?(this.loader=!1,!0):(c("error",this.$t("formError")),this.loader=!1,!1)}catch(t){return m(this,t),this.loader=!1,!1}},async delete(e){try{if(!confirm(this.$t("DeleteAlert")))return!1;if((await documentDelete(e)).status){this.indexPaginates(this.current_page),c("success",this.$t("delete"));return}return c("error",this.$t("formError")),!1}catch(t){return m(this,t),!1}},async indexCategoryActives(){try{this.mloader=!0;const e=await F();this.medicineCategories=e.data,this.mloader=!1}catch(e){m(this,e)}},async indexBoxSizesActives(){try{this.mloader=!0;const e=await G();this.boxSizes=e.data,this.mloader=!1}catch(e){m(this,e)}},async indexCompaniesActives(){try{this.mloader=!0;const e=await j();this.drugCompanies=e.data,this.mloader=!1}catch(e){m(this,e)}},async indexTypesActives(){try{this.mloader=!0;const e=await q();this.sizeTypes=e.data,this.mloader=!1}catch(e){m(this,e)}}},mounted(){this.show(),this.indexCategoryActives(),this.indexBoxSizesActives(),this.indexCompaniesActives(),this.indexTypesActives()}},ue={class:"row"},le={class:"m-0",style:{"text-wrap":"wrap","min-width":"150px"}},de={class:"font-size-10 m-0",style:{"text-wrap":"wrap"}},ce=["value","selected"];function me(e,t,a,y,s,d){const x=u("Header"),B=u("Search"),_=u("BasicInput"),w=u("BasicSelect"),A=u("DefaultIconInput"),P=u("PrimaryIconBtn"),T=u("GrowingLoader"),E=u("BasicTable"),z=u("Report"),D=u("CreateMedicine"),N=u("Page");return h(),g(N,{Title:"",Links:[{path:"/admin/documents",name:e.$t("ImportDocuments"),status:!1},{path:"/",name:e.$t("RegistrationMedicines"),status:!0}]},{default:b(()=>[o("div",ue,[l(x,{document:s.document},null,8,["document"]),l(B,{isChange:s.change,onOnAdd:t[0]||(t[0]=r=>d.addItem(r))},null,8,["isChange"]),l(E,{Th:[e.$t("No"),e.$t("Picture"),e.$t("ModalName"),e.$t("Batch"),e.$t("ExpiryDateFinished"),e.$t("BoxSize"),e.$t("BuyPrice"),e.$t("Amount"),e.$t("Subtotal"),e.$t("Settings")],Title:"",Col:"col-lg-12"},{default:b(()=>[(h(!0),f(I,null,C(s.medicines,(r,i)=>(h(),f("tr",null,[o("td",null,p(i+1),1),o("td",null,[o("div",{class:"table_image",style:U("background-image: url("+r.image[0].url+")")},null,4)]),o("td",null,[o("p",le,p(r.name),1),o("p",de,p(r.generic_name),1)]),o("td",null,[l(_,{Label:"",style:{"max-width":"150px"},Name:"batch_name",Pholder:e.$t("Batch"),Type:"text",Value:s.medicines[i].batch_name,Validated:this.dataErrors.includes("batch"+r.sortId)?s.errors:"",onOnInput:n=>(s.medicines[i].batch_name=n,d.validator(r,i))},null,8,["Pholder","Value","Validated","onOnInput"])]),o("td",null,[l(_,{Label:"",Name:"date",Type:"date",Value:s.medicines[i].expiry_date_finished,Validated:this.dataErrors.includes("date"+r.sortId)?s.errors:"",onOnInput:n=>(s.medicines[i].expiry_date_finished=n,d.validator(r,i))},null,8,["Value","Validated","onOnInput"])]),o("td",null,[l(w,{Label:"",Name:"size_type_id",onOnInput:n=>s.medicines[i].box_size_id=n},{default:b(()=>[(h(!0),f(I,null,C(s.boxSizes,n=>(h(),f("option",{value:n.id,selected:n.id==r.box_size_id},p(n.name),9,ce))),256))]),_:2},1032,["onOnInput"])]),o("td",null,[l(A,{Label:"",Name:"buy_price",Type:"text",Validated:this.dataErrors.includes("buy_price"+r.sortId)?s.errors:"",Value:y.counterStore.formatNumber(r.buy_price),onOnInput:n=>(d.changePrice(n,i),s.isChange=!s.isChange),inputClass:"medicinePrice"+i},{default:b(()=>[Y(p(r.currency.sign),1)]),_:2},1032,["Validated","Value","onOnInput","inputClass"])]),o("td",null,[l(_,{style:{"max-width":"120px"},Label:"",Pholder:e.$t("Amount"),Name:"buy_amount",Validated:this.dataErrors.includes("buy_amount"+r.sortId)?s.errors:"",Type:"number",Value:r.buy_amount,onOnInput:n=>(s.medicines[i].buy_amount=n,s.isChange=!s.isChange)},null,8,["Pholder","Validated","Value","onOnInput"])]),o("td",null,p(y.counterStore.formatNumber((Number(r.buy_price)*Number(r.buy_amount)).toFixed(2)))+" "+p(r.currency.sign),1),o("td",null,[y.counterStore.hasRole("Documents-update")?(h(),g(P,{key:0,onClick:n=>(s.change=r.id,s.medicines.splice(i,1),d.deleteError(r.sortId)),class:"bg-danger border-danger",Icon:"bx bx-trash-alt"},null,8,["onClick"])):v("",!0)])]))),256)),s.loader?(h(),g(T,{key:0,Cols:"8"})):v("",!0)]),_:1},8,["Th"]),l(z,{onDataErrors:t[1]||(t[1]=r=>s.dataErrors=r),medicines:s.medicines,document:s.document,isChange:s.isChange},null,8,["medicines","document","isChange"])]),l(D,{crud:"create",medicineCategories:s.medicineCategories,boxSizes:s.boxSizes,drugCompanies:s.drugCompanies,sizeTypes:s.sizeTypes,onIndexCategoryActives:t[2]||(t[2]=r=>d.indexCategoryActives()),onIndexCompaniesActives:t[3]||(t[3]=r=>d.indexCompaniesActives()),onIndexBoxSizesActives:t[4]||(t[4]=r=>d.indexBoxSizesActives()),onIndexTypesActives:t[5]||(t[5]=r=>d.indexTypesActives()),mloader:s.mloader,onOnCreate:t[6]||(t[6]=()=>{})},null,8,["medicineCategories","boxSizes","drugCompanies","sizeTypes","mloader"])]),_:1},8,["Links"])}const Te=M(ie,[["render",me]]);export{Te as default};
