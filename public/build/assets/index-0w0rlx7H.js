import{a as z,M as W,b as J,P as K}from"./Page-X_CL2XrS.js";import{_ as v,u as V,bo as Q,l as f,o as a,c as d,a as t,t as o,n as C,g as _,h as T,bp as X,e as p,w as h,b,F as x,f as N,r as l,bq as Y,b0 as Z,d as B,I as M,A,b2 as ee,b3 as te,b4 as ne,b5 as se}from"./app-HuQxhYkh.js";import{a as O,B as oe}from"./BasicTable-yOAfWnez.js";import{G as j,P as re}from"./GrowingLoader-hxei4TSu.js";import{D as k}from"./DefaultInput-8EaRomtX.js";import{P as ae}from"./Paginate-a87pEyqc.js";import{D as $}from"./DefaultSelect-6fsBvJhD.js";import{U as ie,C as D}from"./create-QvPmTJh-.js";import"./ImageInput-2jWvBMRc.js";import"./create-XOpOH6E7.js";import"./boxCreate-3yNddXQP.js";const le={setup(){return{counterStore:V()}},data(){return{document:[]}},methods:{async show(){try{const e=await Q(this.$route.query.id);console.log(e),this.document=e.data}catch(e){f(this,e)}}},mounted(){this.show()}},de={class:"col-xl-12"},ue={class:"card"},ce={class:"card-body"},me={class:"table-responsive"},pe={class:"table table-bordered mb-0"},he={key:0};function _e(e,n,r,i,s,m){return a(),d("div",de,[t("div",ue,[t("div",ce,[t("div",me,[t("table",pe,[t("thead",null,[t("tr",null,[t("th",null,o(e.$t("Id")),1),t("th",null,o(e.$t("Warehouse")),1),t("th",null,o(e.$t("Supplier")),1),t("th",null,o(e.$t("ImportedDate")),1),t("th",null,o(e.$t("Subtotal")),1),t("th",null,o(e.$t("AmountPaid")),1),t("th",null,o(e.$t("Indebtedness")),1),t("th",null,o(e.$t("Status")),1)])]),t("tbody",null,[s.document.length!=0?(a(),d("tr",he,[t("td",null," #"+o(s.document.id),1),t("td",null,o(s.document.warehouse.name),1),t("td",null,o(s.document.supplier.name),1),t("td",null,o(s.document.date),1),t("td",null,o(i.counterStore.formatNumber(s.document.subtotal))+" "+o(s.document.currency.sign),1),t("td",null,o(i.counterStore.formatNumber(s.document.amount_paid))+" "+o(s.document.currency.sign),1),t("td",null,o(Number(s.document.subtotal)-Number(s.document.amount_paid))+" "+o(s.document.currency.sign),1),t("td",null,[t("span",{class:C([s.document.status==5?"badge-soft-success":"badge-soft-warning","badge badge-pill font-size-11"])},o(s.document.status==5?e.$t("Saved"):e.$t("NotSaved")),3)])])):_("",!0)])])])])])])}const ge=v(le,[["render",_e]]),ye={props:{Class:{type:String,default:"col-lg-12 col-sm-12"},inputClass:{type:String,default:""},Name:{type:[String],default:""},Label:{type:String,default:"Label title"},Pholder:{type:String,default:"enter here..."},Type:{type:String,default:"text"},Value:{type:[String,Number],default:""},Validated:{type:[Array,Object,String],default:[]}}},fe={key:0,class:"form-label"},be={class:"input-group",id:"timepicker-input-group1"},Se=["type","value","placeholder"],Ce={class:"input-group-text"},ve={key:1,class:"form-label text-danger"};function Ie(e,n,r,i,s,m){return a(),d("div",{class:C(r.Class)},[t("div",null,[r.Label!=""?(a(),d("label",fe,o(r.Label),1)):_("",!0),t("div",be,[t("input",{class:C(["form-control",r.Validated[r.Name]?"border-danger "+r.inputClass:r.inputClass]),type:r.Type,value:r.Value,placeholder:r.Pholder,onInput:n[0]||(n[0]=y=>this.$emit("onInput",y.target.value))},null,42,Se),t("span",Ce,[T(e.$slots,"default")])]),r.Validated[r.Name]?(a(),d("p",ve,o(r.Validated[r.Name]),1)):_("",!0)])],2)}const E=v(ye,[["render",Ie]]),we={components:{DefaultSelect:$,DefaultIconInput:E,DefaultInput:k,PrimaryBtn:z,BtnBox:O},setup(){return{counterStore:V()}},props:{medicines:[Object,Array],isChange:Boolean},data(){return{subtotal:0,errors:[],loader:!1,paid:0,paymentTypes:[],payment_type_id:null}},methods:{report(){let e=0;this.medicines.forEach(n=>{e+=n.buy_price*n.buy_amount}),this.subtotal=e},addPrice(e){let n=this.counterStore.inputNumberFormat("reportPrice",this.paid,e);this.paid=n},async indexPaymentTypes(){try{this.loader=!0;const e=await X();this.paymentTypes=e.data,this.loader=!1}catch(e){f(this,e)}}},watch:{isChange:function(e,n){this.report()}},mounted(){this.indexPaymentTypes()}},Pe={class:"w-100 d-flex justify-content-end"},Be={class:"col-xl-5"},xe={class:"card"},Ne={class:"card-body"},Ve={class:"table-responsive"},Ae={class:"table table-nowrap mb-0"},Te={scope:"row"},ze={scope:"row"},ke={scope:"row"},Le={scope:"row"},De=t("option",{selected:""},"---",-1),Me=["value"],Oe=t("br",null,null,-1);function je(e,n,r,i,s,m){const y=l("DefaultIconInput"),I=l("DefaultSelect"),w=l("PrimaryBtn"),P=l("BtnBox");return a(),d("div",Pe,[t("div",Be,[t("div",xe,[t("div",Ne,[t("div",Ve,[t("table",Ae,[t("tbody",null,[t("tr",null,[t("th",Te,o(e.$t("Subtotal"))+" :",1),t("td",null,o(i.counterStore.formatNumber(s.subtotal))+" "+o(i.counterStore.user.currency.sign),1)]),t("tr",null,[t("th",ze,o(e.$t("AmountToPaid"))+" :",1),t("td",null,o(i.counterStore.formatNumber(s.subtotal))+" "+o(i.counterStore.user.currency.sign),1)]),t("tr",null,[t("th",ke,o(e.$t("Paid"))+" :",1),t("td",null,[p(y,{DefaultIconInput:"",Label:"",Name:"warehouse_id",Type:"text",Validated:s.errors,onOnInput:n[0]||(n[0]=c=>m.addPrice(c)),inputClass:"reportPrice",Value:i.counterStore.formatNumber(s.paid)},{default:h(()=>[b(o(i.counterStore.user.currency.sign),1)]),_:1},8,["Validated","Value"])])]),t("tr",null,[t("th",Le,o(e.$t("PaymentType"))+" :",1),t("td",null,[p(I,{Label:"",Name:"payment_type_id",Validated:s.errors,Value:s.payment_type_id,onOnInput:n[1]||(n[1]=c=>(s.payment_type_id=c,delete this.errors.payment_type_id))},{default:h(()=>[De,(a(!0),d(x,null,N(s.paymentTypes,c=>(a(),d("option",{value:c.id},o(c.name),9,Me))),256))]),_:1},8,["Validated","Value"])])])])])]),Oe,p(P,null,{default:h(()=>[p(w,null,{default:h(()=>[b(o(e.$t("Save")),1)]),_:1})]),_:1})])])])])}const $e=v(we,[["render",je]]),Ee={components:{GrowingLoader:j,BtnBox:O,BaseBox:Y,DefaultInput:k,PrimaryBtn:z},props:{tableMedicines:Object,isChange:Object},watch:{isChange:function(e,n){console.log("oke",this.tableMedicines),this.medicines=this.medicines.filter(r=>r.id!=this.isChange)}},setup(){return{counterStore:V()}},data(){return{items:[],loader:!1,medicines:[]}},methods:{hasMedicines(e){return!!this.medicines.find(r=>r.id==e.id)},addMedicines(e){this.medicines.push(e),this.$emit("onAdd",e)},async search(e=""){try{this.loader=!0;const n=await Z(e);return this.items=n.data,this.loader=!1,n.status?(this.loader=!1,!0):(Alert("error",this.$t("formError")),this.loader=!1,!1)}catch(n){return f(this,n),this.loader=!1,!1}}}},Ge={class:"w-100 d-flex mb-2"},Re={class:"col-5",style:{"z-index":"100"}},Fe={class:"dropdown"},He={class:"dropdown-menu col-lg-12 col-sm-12","aria-labelledby":"dropdownMenuButton",style:{"z-index":"1000"}},qe=["onClick"],Ue={key:0,class:"dropdown-item d-flex justify-content-center"};function We(e,n,r,i,s,m){const y=l("DefaultInput"),I=l("GrowingLoader"),w=l("PrimaryBtn"),P=l("BtnBox");return a(),d("div",Ge,[t("div",Re,[t("div",Fe,[p(y,{id:"dropdownMenuButton","data-bs-toggle":"dropdown","aria-expanded":"false",Class:"col-lg-12 col-sm-12   search_input",Label:"",Name:"name",Type:"text",Pholder:e.$t("SearchMedicines"),onOnInput:n[0]||(n[0]=c=>m.search(c))},null,8,["Pholder"]),t("div",He,[(a(!0),d(x,null,N(s.items,c=>(a(),d("a",{class:C(["dropdown-item d-flex align-items-center",m.hasMedicines(c)?"bg-success-subtle":""]),onClick:L=>m.addMedicines(c)},[t("div",{class:"table_image search_medicines_img",style:M("background-image: url("+c.image[0].url+")")},null,4),b(" "+o(c.name)+" ("+o(c.drug_company)+") ",1)],10,qe))),256)),s.loader?(a(),d("a",Ue,[p(I)])):_("",!0)])])]),p(P,null,{default:h(()=>[i.counterStore.hasRole("Medicines-create")?(a(),B(w,{key:0,role:"button","data-bs-toggle":"modal","data-bs-target":"#medicineCreate"},{default:h(()=>[b(o(e.$t("CreateMedicine")),1)]),_:1})):_("",!0)]),_:1})])}const Je=v(Ee,[["render",We]]),Ke={props:{isButton:{type:Boolean,default:!1},Class:{type:String,default:"col-lg-12 col-sm-12"},ModalName:{type:String,default:"modal"},Name:{type:[String],default:""},Label:{type:String,default:"Label title"},Pholder:{type:String,default:"enter here..."},Type:{type:String,default:"text"},Value:{type:[String,Number],default:""},Validated:{type:[Array,Object,String],default:[]}}},Qe={key:0,class:"form-label"},Xe=["data-bs-target"],Ye={class:"input-group",id:"timepicker-input-group1"},Ze={class:"input-group-text"},et={key:1,class:"form-label text-danger"};function tt(e,n,r,i,s,m){return a(),d("div",{class:C(r.Class)},[t("div",null,[r.Label!=""?(a(),d("label",Qe,[b(o(r.Label)+" ",1),r.isButton?(a(),d("a",{key:0,class:"btn btn-primary waves-effect waves-light",role:"button","data-bs-toggle":"modal","data-bs-target":"#"+r.ModalName,style:{padding:"0px 5px","font-size":"10px"}},o(e.$t("Create")),9,Xe)):_("",!0)])):_("",!0),t("div",Ye,[t("select",{class:C(["form-select",r.Validated[r.Name]?"border-danger":""]),onInput:n[0]||(n[0]=y=>this.$emit("onInput",y.target.value))},[T(e.$slots,"default")],34),t("span",Ze,[T(e.$slots,"icon")])]),r.Validated[r.Name]?(a(),d("p",et,o(r.Validated[r.Name]),1)):_("",!0)])],2)}const nt=v(Ke,[["render",tt]]),st={components:{IconSelect:nt,DefaultIconInput:E,Update:ie,Create:D,DefaultSelect:$,Paginate:ae,DefaultInput:k,PrimaryBtn:z,ModalCentered:W,PrimaryIconBtn:re,PrimaryButton:J,GrowingLoader:j,BasicTable:oe,Page:K,Header:ge,Report:$e,Search:Je,CreateMedicine:D},setup(){return{counterStore:V()}},data(){return{change:!1,isChange:!1,items:[],mloader:!1,item:[],boxItem:[],paginateCount:10,last_page:1,current_page:1,boxLast_page:1,boxCurrent_page:1,column:"id",type:"desc",errors:[],loader:!1,boxLoader:!1,boxItems:[],warehouses:Object,suppliers:Object,medicineCategories:[],boxSizes:[],drugCompanies:[],sizeTypes:[],medicines:[]}},methods:{changePrice(e,n){let r={...this.medicines[n]},i=this.counterStore.inputNumberFormat("medicinePrice"+n,r.buy_price,e);r.buy_price=i,this.medicines[n]=r},addItem(e){console.log("item",e),e.buy_amount=1,this.medicines.push(e),this.isChange=!this.isChange},async search(e=""){try{if(this.loader=!0,e=="")return this.indexPaginates(),!0;const n=await documentSearch(e);return this.items=n.data,this.loader=!1,n.status?(this.loader=!1,!0):(A("error",this.$t("formError")),this.loader=!1,!1)}catch(n){return f(this,n),this.loader=!1,!1}},async delete(e){try{if(!confirm(this.$t("DeleteAlert")))return!1;if((await documentDelete(e)).status){this.indexPaginates(this.current_page),A("success",this.$t("delete"));return}return A("error",this.$t("formError")),!1}catch(n){return f(this,n),!1}},async indexCategoryActives(){try{this.mloader=!0;const e=await ee();this.medicineCategories=e.data,this.mloader=!1}catch(e){f(this,e)}},async indexBoxSizesActives(){try{this.mloader=!0;const e=await te();this.boxSizes=e.data,this.mloader=!1}catch(e){f(this,e)}},async indexCompaniesActives(){try{this.mloader=!0;const e=await ne();this.drugCompanies=e.data,this.mloader=!1}catch(e){f(this,e)}},async indexTypesActives(){try{this.mloader=!0;const e=await se();this.sizeTypes=e.data,this.mloader=!1}catch(e){f(this,e)}}},mounted(){this.indexCategoryActives(),this.indexBoxSizesActives(),this.indexCompaniesActives(),this.indexTypesActives()}},ot={class:"row"},rt=["value","selected"];function at(e,n,r,i,s,m){const y=l("Header"),I=l("Search"),w=l("IconSelect"),P=l("DefaultIconInput"),c=l("DefaultInput"),L=l("PrimaryIconBtn"),G=l("Paginate"),R=l("GrowingLoader"),F=l("BasicTable"),H=l("Report"),q=l("CreateMedicine"),U=l("Page");return a(),B(U,{Title:"",Links:[{path:"/admin/documents",name:e.$t("ImportDocuments"),status:!1},{path:"/",name:e.$t("RegistrationMedicines"),status:!0}]},{default:h(()=>[t("div",ot,[p(y),p(I,{isChange:s.change,onOnAdd:n[0]||(n[0]=u=>m.addItem(u))},null,8,["isChange"]),p(F,{Th:[e.$t("No"),e.$t("Picture"),e.$t("ModalName"),e.$t("BoxSize"),e.$t("BuyPrice"),e.$t("Amount"),e.$t("Subtotal"),e.$t("Settings")],Title:"",Col:"col-lg-12"},{default:h(()=>[(a(!0),d(x,null,N(s.medicines,(u,S)=>(a(),d("tr",null,[t("td",null,o(S+1),1),t("td",null,[t("div",{class:"table_image",style:M("background-image: url("+u.image[0].url+")")},null,4)]),t("td",null,o(u.name),1),t("td",null,[p(w,{Label:"",Name:"size_type_id",Type:"text",Validated:s.errors,onOnInput:g=>s.medicines[S].box_size_id==g},{icon:h(()=>[b(o(u.size_type),1)]),default:h(()=>[(a(!0),d(x,null,N(s.boxSizes,g=>(a(),d("option",{value:g.id,selected:g.id==u.box_size_id},o(g.size),9,rt))),256))]),_:2},1032,["Validated","onOnInput"])]),t("td",null,[p(P,{Label:"",Name:"warehouse_id",Type:"text",Validated:s.errors,Value:i.counterStore.formatNumber(u.buy_price),onOnInput:g=>(m.changePrice(g,S),s.isChange=!s.isChange),inputClass:"medicinePrice"+S},{default:h(()=>[b(o(u.currency.sign),1)]),_:2},1032,["Validated","Value","onOnInput","inputClass"])]),t("td",null,[p(c,{Label:"",Name:"warehouse_id",Type:"number",Validated:s.errors,Value:i.counterStore.formatNumber(u.buy_amount),onOnInput:g=>(s.medicines[S].buy_amount=g,s.isChange=!s.isChange)},null,8,["Validated","Value","onOnInput"])]),t("td",null,o(i.counterStore.formatNumber(Number(u.buy_price)*Number(u.buy_amount)))+" "+o(u.currency.sign),1),t("td",null,[i.counterStore.hasRole("Documents-update")?(a(),B(L,{key:0,onClick:g=>(s.change=u.id,s.medicines.splice(S,1),s.isChange=!s.isChange),class:"bg-danger border-danger",Icon:"bx bx-trash-alt"},null,8,["onClick"])):_("",!0)])]))),256)),s.last_page!=1?(a(),B(G,{key:0,Cols:"8",currentPage:this.current_page,totalPages:this.last_page,onChangePage:n[1]||(n[1]=u=>e.indexPaginates(u))},null,8,["currentPage","totalPages"])):_("",!0),s.loader?(a(),B(R,{key:1,Cols:"8"})):_("",!0)]),_:1},8,["Th"]),p(H,{medicines:s.medicines,isChange:s.isChange},null,8,["medicines","isChange"])]),p(q,{crud:"create",medicineCategories:s.medicineCategories,boxSizes:s.boxSizes,drugCompanies:s.drugCompanies,sizeTypes:s.sizeTypes,onIndexCategoryActives:n[2]||(n[2]=u=>m.indexCategoryActives()),onIndexCompaniesActives:n[3]||(n[3]=u=>m.indexCompaniesActives()),onIndexBoxSizesActives:n[4]||(n[4]=u=>m.indexBoxSizesActives()),onIndexTypesActives:n[5]||(n[5]=u=>m.indexTypesActives()),mloader:s.mloader,onOnCreate:n[6]||(n[6]=()=>{})},null,8,["medicineCategories","boxSizes","drugCompanies","sizeTypes","mloader"])]),_:1},8,["Links"])}const ft=v(st,[["render",at]]);export{ft as default};
