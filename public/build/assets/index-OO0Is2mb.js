import{a as B,M as P,b as v,P as x}from"./Page-kS-htxF1.js";import{_ as S,u as M,b6 as F,l as p,b7 as G,A as f,o as d,d as m,w as n,a as s,e as l,t as i,b as g,r as o,x as R,b8 as j,b9 as q,ba as W,bb as H,g as $,c as D,f as J,n as K,F as Q}from"./app--lA0zENz.js";import{a as L,B as X}from"./BasicTable-ceqsBAou.js";import{G as Y}from"./GrowingLoader-CWiifW_R.js";import{P as Z}from"./PrimaryIconBtn-zZrE_wsa.js";import{D as k}from"./DefaultInput-OXMKtQjk.js";import{D as T}from"./DefaultSelect-uFn2hizB.js";import{I as V}from"./ImageInput-q8VLym8J.js";import{P as ee}from"./Paginate-J0lbL4Dz.js";const te={components:{ImageInput:V,DefaultSelect:T,PrimaryBtn:B,BtnBox:L,ModalCentered:P,PrimaryButton:v,DefaultInput:k,Page:x},setup(){return{counterStore:M()}},props:{Item:Object},data(){return{items:[],item:[],paginateCount:10,column:"id",type:"desc",errors:[],passwordErrors:[],loader:!1,loaderPass:!1,status:1,name:"",address:"",phone:"",email:"",image:""}},methods:{async show(t){try{const e=await F(t);this.item=e.data,this.name=e.data.name,this.status=e.data.status}catch(e){p(this,e)}},save(){this.item=this.Item,this.warehouse_id=this.Item.warehouse_id,this.box_size_id=this.Item.box_size_id,this.drug_company_id=this.Item.drug_company_id,this.name=this.Item.name,this.generic_name=this.Item.generic_name,this.buy_price=this.Item.buy_price,this.price=this.Item.price,this.qr_code=this.Item.qr_code,this.hns_code=this.Item.hns_code,this.desc=this.Item.desc,this.strength=this.Item.strength,this.shelf=this.Item.shelf,this.vat=this.Item.vat,this.igta=this.Item.igta,this.status=this.Item.status,console.log("Item",this.Item)},async update(){try{this.loader=!0;let t={name:this.name,status:Number(this.status)};console.log(t);const e=await G(this.Item.id,t);return e.status?(f("success",this.$t("create")),this.errors=[],this.loader=!1,this.counterStore.hiddenModal("warehouseUpdate"),this.$emit("onUpdate",!0),!0):(this.errors=e.errors,f("error",this.$t("formError")),this.loader=!1,!1)}catch(t){return p(this,t),this.loader=!1,!1}}},mounted(){},watch:{Item:function(t,e){this.save()}}},se={class:"row"},ae={class:"row"},oe={class:"col-12 d-flex flex-column"},re={class:"form-label"},ne=["checked"],ie=s("label",{for:"warehouse_update","data-on-label":"On","data-off-label":"Off"},null,-1),le={type:"button",class:"btn btn-light","data-bs-dismiss":"modal"};function ue(t,e,c,b,a,h){const I=o("DefaultInput"),w=o("BaseBox"),C=o("PrimaryBtn"),_=o("BtnBox"),y=o("ModalCentered");return d(),m(y,{Title:t.$t("Update"),ModalName:"warehouseUpdate",isModalFooter:!1},{default:n(()=>[s("div",se,[l(w,{Col:"col-xl-12",Title:""},{default:n(()=>[s("div",ae,[l(I,{Label:t.$t("ModalName"),Name:"name",Type:"text",Validated:a.errors,Value:a.name,onOnInput:e[0]||(e[0]=u=>(a.name=u,delete this.errors.name))},null,8,["Label","Validated","Value"]),s("div",oe,[s("label",re,i(t.$t("Status")),1),s("input",{type:"checkbox",id:"warehouse_update",switch:"none",onInput:e[1]||(e[1]=u=>a.status=a.status==1?0:1),checked:a.status==1},null,40,ne),ie])])]),_:1}),l(_,null,{default:n(()=>[s("button",le,i(t.$t("Close")),1),g("   "),l(C,{Loader:a.loader,onOnButton:e[2]||(e[2]=u=>h.update())},{default:n(()=>[g(i(t.$t("Save")),1)]),_:1},8,["Loader"])]),_:1})])]),_:1},8,["Title"])}const de=S(te,[["render",ue]]),ce={components:{ImageInput:V,DefaultSelect:T,PrimaryBtn:B,BtnBox:L,ModalCentered:P,PrimaryButton:v,DefaultInput:k,Page:x},setup(){return{counterStore:M()}},props:{Item:Object},data(){return{items:[],item:[],paginateCount:10,column:"id",type:"desc",errors:[],passwordErrors:[],loader:!1,loaderPass:!1,status:1,name:"",address:"",phone:"",email:"",image:""}},methods:{async show(t){try{const e=await R(t);this.item=e.data,this.name=e.data.name,this.status=e.data.status}catch(e){p(this,e)}},async save(){try{this.item="",this.name="",this.status=1}catch(t){p(this,t)}},async create(){try{this.loader=!0;let t={name:this.name,status:this.status};const e=await j(t);return e.status?(f("success",this.$t("create")),this.save(),this.loader=!1,this.errors=[],this.counterStore.hiddenModal("warehouseCreate"),this.$emit("onCreate",!0),!0):(this.errors=e.errors,f("error",this.$t("formError")),this.loader=!1,!1)}catch(t){return p(this,t),this.loader=!1,!1}}},mounted(){},watch:{Item:function(t,e){this.save()}}},he={class:"row"},me={class:"row"},pe={class:"col-12 d-flex flex-column"},fe={class:"form-label"},_e=["checked"],ge=s("label",{for:"warehouse_create","data-on-label":"On","data-off-label":"Off"},null,-1);function be(t,e,c,b,a,h){const I=o("DefaultInput"),w=o("BaseBox"),C=o("PrimaryBtn"),_=o("BtnBox"),y=o("ModalCentered");return d(),m(y,{Title:t.$t("Create"),ModalName:"warehouseCreate",isModalFooter:!1},{default:n(()=>[s("div",he,[l(w,{Col:"col-xl-12",Title:""},{default:n(()=>[s("div",me,[l(I,{Label:t.$t("ModalName"),Name:"name",Type:"text",Validated:a.errors,Value:a.name,onOnInput:e[0]||(e[0]=u=>(a.name=u,delete this.errors.name))},null,8,["Label","Validated","Value"]),s("div",pe,[s("label",fe,i(t.$t("Status")),1),s("input",{type:"checkbox",id:"warehouse_create",switch:"none",onInput:e[1]||(e[1]=u=>a.status=a.status==1?0:1),checked:a.status==1},null,40,_e),ge])])]),_:1}),l(_,null,{default:n(()=>[s("button",{onClick:e[2]||(e[2]=u=>this.$emit("onClose")),type:"button",class:"btn btn-light","data-bs-dismiss":"modal"},i(t.$t("Close")),1),g("   "),l(C,{Loader:a.loader,onOnButton:e[3]||(e[3]=u=>h.create())},{default:n(()=>[g(i(t.$t("Save")),1)]),_:1},8,["Loader"])]),_:1})])]),_:1},8,["Title"])}const Ie=S(ce,[["render",be]]),we={components:{DefaultSelect:T,Paginate:ee,DefaultInput:k,PrimaryBtn:B,ModalCentered:P,PrimaryIconBtn:Z,PrimaryButton:v,GrowingLoader:Y,BasicTable:X,Page:x,Update:de,Create:Ie},setup(){return{counterStore:M()}},data(){return{items:[],item:[],boxItem:[],paginateCount:10,last_page:1,current_page:1,boxLast_page:1,boxCurrent_page:1,column:"id",type:"desc",errors:[],loader:!1,boxLoader:!1,boxItems:[]}},methods:{async indexPaginates(t=1,e=!0){try{this.loader=e;const c=await q(this.paginateCount,t);c.status&&(this.current_page=c.data.pagination.current_page,this.last_page=c.data.pagination.last_page,this.items=c.data.items),this.loader=!1}catch(c){p(this,c)}},async search(t=""){try{if(this.loader=!0,t=="")return this.indexPaginates(),!0;const e=await W(t);return this.items=e.data,this.loader=!1,e.status?(this.loader=!1,!0):(f("error",this.$t("formError")),this.loader=!1,!1)}catch(e){return p(this,e),this.loader=!1,!1}},async delete(t){try{if(!confirm(this.$t("DeleteAlert")))return!1;if((await H(t)).status){this.indexPaginates(this.current_page),f("success",this.$t("delete"));return}return f("error",this.$t("formError")),!1}catch(e){return p(this,e),!1}}},mounted(){this.indexPaginates()}},Ce={class:"row"},ye={value:"10",selected:""},$e=s("option",{value:"10"},"10",-1),Be=s("option",{value:"20"},"20",-1),Pe=s("option",{value:"50"},"50",-1),ve=s("option",{value:"100"},"100",-1);function xe(t,e,c,b,a,h){const I=o("DefaultInput"),w=o("DefaultSelect"),C=o("PrimaryBtn"),_=o("PrimaryIconBtn"),y=o("Paginate"),u=o("GrowingLoader"),N=o("BasicTable"),O=o("Update"),U=o("Create"),E=o("Page");return d(),m(E,{Title:""},{default:n(()=>[s("div",Ce,[l(N,{Th:[t.$t("No"),t.$t("ModalName"),t.$t("ImportMedicines"),t.$t("CurrentMedicinesAmount"),t.$t("Status"),t.$t("Settings")],Title:t.$t("Warehouses"),Col:"col-lg-12"},{inputs:n(()=>[l(I,{Class:"col-lg-3 col-sm-2 search_input",Label:"",Name:"name",Type:"text",Pholder:"Search...",onOnInput:e[0]||(e[0]=r=>h.search(r))}),l(w,{Label:"",Class:"col-lg-2 col-sm-2",onOnInput:e[1]||(e[1]=r=>(this.paginateCount=r,this.indexPaginates()))},{default:n(()=>[s("option",ye,i(t.$t("NumberDownloads")),1),$e,Be,Pe,ve]),_:1}),g("   ")]),buttons:n(()=>[b.counterStore.hasRole("MedicineCategories-create")?(d(),m(C,{key:0,role:"button","data-bs-toggle":"modal","data-bs-target":"#warehouseCreate"},{default:n(()=>[g(i(t.$t("Create")),1)]),_:1})):$("",!0)]),default:n(()=>[(d(!0),D(Q,null,J(a.items,(r,A)=>(d(),D("tr",null,[s("td",null,i((a.current_page-1)*a.paginateCount+A+1),1),s("td",null,i(r.name),1),s("td",null,i(r.impoted_medicines_count),1),s("td",null,i(r.current_medicines_count),1),s("td",null,[s("span",{class:K([r.status==1?"badge-soft-success":"badge-soft-danger","badge badge-pill badge-soft-success font-size-11"])},i(r.status==1?t.$t("Active"):t.$t("InActive")),3)]),s("td",null,[b.counterStore.hasRole("MedicineCategories-update")?(d(),m(_,{key:0,onClick:z=>this.item=r,Icon:"bx bx-edit-alt",Modal:"warehouseUpdate"},null,8,["onClick"])):$("",!0),b.counterStore.hasRole("MedicineCategories-delete")?(d(),m(_,{key:1,onClick:z=>this.delete(r.id),class:"bg-danger border-danger",Icon:"bx bx-trash-alt"},null,8,["onClick"])):$("",!0)])]))),256)),a.last_page!=1?(d(),m(y,{key:0,Cols:"6",currentPage:this.current_page,totalPages:this.last_page,onChangePage:e[2]||(e[2]=r=>h.indexPaginates(r))},null,8,["currentPage","totalPages"])):$("",!0),a.loader?(d(),m(u,{key:1,Cols:"6"})):$("",!0)]),_:1},8,["Th","Title"])]),l(O,{Item:a.item,onOnUpdate:e[3]||(e[3]=r=>h.indexPaginates(this.current_page,!1))},null,8,["Item"]),l(U,{onOnCreate:e[4]||(e[4]=r=>h.indexPaginates(this.current_page,!1))})]),_:1})}const Ue=S(we,[["render",xe]]);export{Ue as default};
