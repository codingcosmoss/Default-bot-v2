import{a as B,M as P,b as v,P as x}from"./Page-X_CL2XrS.js";import{_ as S,u as k,b6 as z,l as p,b7 as F,A as f,o as d,d as m,w as n,a as s,e as i,t as l,b as _,r as o,x as G,b8 as R,b9 as j,ba as q,bb as W,g as $,c as D,f as H,F as J,n as K}from"./app-HuQxhYkh.js";import{a as L,B as Q}from"./BasicTable-yOAfWnez.js";import{P as X,G as Y}from"./GrowingLoader-hxei4TSu.js";import{D as M}from"./DefaultInput-8EaRomtX.js";import{D as T}from"./DefaultSelect-6fsBvJhD.js";import{I as V}from"./ImageInput-2jWvBMRc.js";import{P as Z}from"./Paginate-a87pEyqc.js";const ee={components:{ImageInput:V,DefaultSelect:T,PrimaryBtn:B,BtnBox:L,ModalCentered:P,PrimaryButton:v,DefaultInput:M,Page:x},setup(){return{counterStore:k()}},props:{Item:Object},data(){return{items:[],item:[],paginateCount:10,column:"id",type:"desc",errors:[],passwordErrors:[],loader:!1,loaderPass:!1,status:1,name:"",address:"",phone:"",email:"",image:""}},methods:{async show(t){try{const e=await z(t);this.item=e.data,this.name=e.data.name,this.status=e.data.status}catch(e){p(this,e)}},save(){this.item=this.Item,this.warehouse_id=this.Item.warehouse_id,this.box_size_id=this.Item.box_size_id,this.drug_company_id=this.Item.drug_company_id,this.name=this.Item.name,this.generic_name=this.Item.generic_name,this.buy_price=this.Item.buy_price,this.price=this.Item.price,this.qr_code=this.Item.qr_code,this.hns_code=this.Item.hns_code,this.desc=this.Item.desc,this.strength=this.Item.strength,this.shelf=this.Item.shelf,this.vat=this.Item.vat,this.igta=this.Item.igta,this.status=this.Item.status,console.log("Item",this.Item)},async update(){try{this.loader=!0;let t={name:this.name,status:Number(this.status)};console.log(t);const e=await F(this.Item.id,t);return e.status?(f("success",this.$t("create")),this.errors=[],this.loader=!1,this.counterStore.hiddenModal("warehouseUpdate"),this.$emit("onUpdate",!0),!0):(this.errors=e.errors,f("error",this.$t("formError")),this.loader=!1,!1)}catch(t){return p(this,t),this.loader=!1,!1}}},mounted(){},watch:{Item:function(t,e){this.save()}}},te={class:"row"},se={class:"row"},ae={class:"col-12 d-flex flex-column"},oe={class:"form-label"},re=["checked"],ne=s("label",{for:"warehouse_update","data-on-label":"On","data-off-label":"Off"},null,-1),ie={type:"button",class:"btn btn-light","data-bs-dismiss":"modal"};function le(t,e,c,b,a,h){const I=o("DefaultInput"),w=o("BaseBox"),y=o("PrimaryBtn"),g=o("BtnBox"),C=o("ModalCentered");return d(),m(C,{Title:t.$t("Update"),ModalName:"warehouseUpdate",isModalFooter:!1},{default:n(()=>[s("div",te,[i(w,{Col:"col-xl-12",Title:""},{default:n(()=>[s("div",se,[i(I,{Label:t.$t("ModalName"),Name:"name",Type:"text",Validated:a.errors,Value:a.name,onOnInput:e[0]||(e[0]=u=>(a.name=u,delete this.errors.name))},null,8,["Label","Validated","Value"]),s("div",ae,[s("label",oe,l(t.$t("Status")),1),s("input",{type:"checkbox",id:"warehouse_update",switch:"none",onInput:e[1]||(e[1]=u=>a.status=a.status==1?0:1),checked:a.status==1},null,40,re),ne])])]),_:1}),i(g,null,{default:n(()=>[s("button",ie,l(t.$t("Close")),1),_("   "),i(y,{Loader:a.loader,onOnButton:e[2]||(e[2]=u=>h.update())},{default:n(()=>[_(l(t.$t("Save")),1)]),_:1},8,["Loader"])]),_:1})])]),_:1},8,["Title"])}const ue=S(ee,[["render",le]]),de={components:{ImageInput:V,DefaultSelect:T,PrimaryBtn:B,BtnBox:L,ModalCentered:P,PrimaryButton:v,DefaultInput:M,Page:x},setup(){return{counterStore:k()}},props:{Item:Object},data(){return{items:[],item:[],paginateCount:10,column:"id",type:"desc",errors:[],passwordErrors:[],loader:!1,loaderPass:!1,status:1,name:"",address:"",phone:"",email:"",image:""}},methods:{async show(t){try{const e=await G(t);this.item=e.data,this.name=e.data.name,this.status=e.data.status}catch(e){p(this,e)}},async save(){try{this.item="",this.name="",this.status=1}catch(t){p(this,t)}},async create(){try{this.loader=!0;let t={name:this.name,status:this.status};const e=await R(t);return e.status?(f("success",this.$t("create")),this.save(),this.loader=!1,this.errors=[],this.counterStore.hiddenModal("warehouseCreate"),this.$emit("onCreate",!0),!0):(this.errors=e.errors,f("error",this.$t("formError")),this.loader=!1,!1)}catch(t){return p(this,t),this.loader=!1,!1}}},mounted(){},watch:{Item:function(t,e){this.save()}}},ce={class:"row"},he={class:"row"},me={class:"col-12 d-flex flex-column"},pe={class:"form-label"},fe=["checked"],_e=s("label",{for:"warehouse_create","data-on-label":"On","data-off-label":"Off"},null,-1);function ge(t,e,c,b,a,h){const I=o("DefaultInput"),w=o("BaseBox"),y=o("PrimaryBtn"),g=o("BtnBox"),C=o("ModalCentered");return d(),m(C,{Title:t.$t("Create"),ModalName:"warehouseCreate",isModalFooter:!1},{default:n(()=>[s("div",ce,[i(w,{Col:"col-xl-12",Title:""},{default:n(()=>[s("div",he,[i(I,{Label:t.$t("ModalName"),Name:"name",Type:"text",Validated:a.errors,Value:a.name,onOnInput:e[0]||(e[0]=u=>(a.name=u,delete this.errors.name))},null,8,["Label","Validated","Value"]),s("div",me,[s("label",pe,l(t.$t("Status")),1),s("input",{type:"checkbox",id:"warehouse_create",switch:"none",onInput:e[1]||(e[1]=u=>a.status=a.status==1?0:1),checked:a.status==1},null,40,fe),_e])])]),_:1}),i(g,null,{default:n(()=>[s("button",{onClick:e[2]||(e[2]=u=>this.$emit("onClose")),type:"button",class:"btn btn-light","data-bs-dismiss":"modal"},l(t.$t("Close")),1),_("   "),i(y,{Loader:a.loader,onOnButton:e[3]||(e[3]=u=>h.create())},{default:n(()=>[_(l(t.$t("Save")),1)]),_:1},8,["Loader"])]),_:1})])]),_:1},8,["Title"])}const be=S(de,[["render",ge]]),Ie={components:{DefaultSelect:T,Paginate:Z,DefaultInput:M,PrimaryBtn:B,ModalCentered:P,PrimaryIconBtn:X,PrimaryButton:v,GrowingLoader:Y,BasicTable:Q,Page:x,Update:ue,Create:be},setup(){return{counterStore:k()}},data(){return{items:[],item:[],boxItem:[],paginateCount:10,last_page:1,current_page:1,boxLast_page:1,boxCurrent_page:1,column:"id",type:"desc",errors:[],loader:!1,boxLoader:!1,boxItems:[]}},methods:{async indexPaginates(t=1,e=!0){try{this.loader=e;const c=await j(this.paginateCount,t);c.status&&(this.current_page=c.data.pagination.current_page,this.last_page=c.data.pagination.last_page,this.items=c.data.items),this.loader=!1}catch(c){p(this,c)}},async search(t=""){try{if(this.loader=!0,t=="")return this.indexPaginates(),!0;const e=await q(t);return this.items=e.data,this.loader=!1,e.status?(this.loader=!1,!0):(f("error",this.$t("formError")),this.loader=!1,!1)}catch(e){return p(this,e),this.loader=!1,!1}},async delete(t){try{if(!confirm(this.$t("DeleteAlert")))return!1;if((await W(t)).status){this.indexPaginates(this.current_page),f("success",this.$t("delete"));return}return f("error",this.$t("formError")),!1}catch(e){return p(this,e),!1}}},mounted(){this.indexPaginates()}},we={class:"row"},ye={value:"10",selected:""},Ce=s("option",{value:"10"},"10",-1),$e=s("option",{value:"20"},"20",-1),Be=s("option",{value:"50"},"50",-1),Pe=s("option",{value:"100"},"100",-1);function ve(t,e,c,b,a,h){const I=o("DefaultInput"),w=o("DefaultSelect"),y=o("PrimaryBtn"),g=o("PrimaryIconBtn"),C=o("Paginate"),u=o("GrowingLoader"),N=o("BasicTable"),O=o("Update"),U=o("Create"),E=o("Page");return d(),m(E,{Title:""},{default:n(()=>[s("div",we,[i(N,{Th:[t.$t("Id"),t.$t("ModalName"),t.$t("Status"),t.$t("Settings")],Title:t.$t("Warehouses"),Col:"col-lg-12"},{inputs:n(()=>[i(I,{Class:"col-lg-3 col-sm-2 search_input",Label:"",Name:"name",Type:"text",Pholder:"Search...",onOnInput:e[0]||(e[0]=r=>h.search(r))}),i(w,{Label:"",Class:"col-lg-2 col-sm-2",onOnInput:e[1]||(e[1]=r=>(this.paginateCount=r,this.indexPaginates()))},{default:n(()=>[s("option",ye,l(t.$t("NumberDownloads")),1),Ce,$e,Be,Pe]),_:1}),_("   ")]),buttons:n(()=>[b.counterStore.hasRole("MedicineCategories-create")?(d(),m(y,{key:0,role:"button","data-bs-toggle":"modal","data-bs-target":"#warehouseCreate"},{default:n(()=>[_(l(t.$t("Create")),1)]),_:1})):$("",!0)]),default:n(()=>[(d(!0),D(J,null,H(a.items,r=>(d(),D("tr",null,[s("td",null," #"+l(r.id),1),s("td",null,l(r.name),1),s("td",null,[s("span",{class:K([r.status==1?"badge-soft-success":"badge-soft-danger","badge badge-pill badge-soft-success font-size-11"])},l(r.status==1?t.$t("Active"):t.$t("InActive")),3)]),s("td",null,[b.counterStore.hasRole("MedicineCategories-update")?(d(),m(g,{key:0,onClick:A=>this.item=r,Icon:"bx bx-edit-alt",Modal:"warehouseUpdate"},null,8,["onClick"])):$("",!0),_("  "),b.counterStore.hasRole("MedicineCategories-delete")?(d(),m(g,{key:1,onClick:A=>this.delete(r.id),class:"bg-danger border-danger",Icon:"bx bx-trash-alt"},null,8,["onClick"])):$("",!0)])]))),256)),a.last_page!=1?(d(),m(C,{key:0,currentPage:this.current_page,totalPages:this.last_page,onChangePage:e[2]||(e[2]=r=>h.indexPaginates(r))},null,8,["currentPage","totalPages"])):$("",!0),a.loader?(d(),m(u,{key:1,Cols:"4"})):$("",!0)]),_:1},8,["Th","Title"])]),i(O,{Item:a.item,onOnUpdate:e[3]||(e[3]=r=>h.indexPaginates(this.current_page,!1))},null,8,["Item"]),i(U,{onOnCreate:e[4]||(e[4]=r=>h.indexPaginates(this.current_page,!1))})]),_:1})}const Ne=S(Ie,[["render",ve]]);export{Ne as default};
