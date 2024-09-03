import{a as T,M as S,b as B,P as N}from"./Page-k1RhpKxv.js";import{_ as v,u as O,V as x,H as u,P as R,W as $,A as h,S as K,o as m,c as y,w as i,e as a,a as r,b as V,d as D,t as p,F as E,f,r as l,X as A,K as W,M as X,N as Y,O as q,T as Q,U as Z,g as _,Y as ee}from"./app-tuttM9Io.js";import{a as F,B as te}from"./BasicTable-dpWtiJ4i.js";import{G as se}from"./GrowingLoader-ajX8lziD.js";import{P as oe}from"./PrimaryIconBtn-utELPCpc.js";import{D as U}from"./DefaultInput-AnvAhpkM.js";import{I as G}from"./ImageInput-sm-pHeYj.js";import{D as M}from"./DefaultSelect-mJwZsmUq.js";import{P as re}from"./Paginate-YTLkHTO4.js";const ae={components:{DefaultSelect:M,PrimaryBtn:T,BtnBox:F,ModalCentered:S,ImageInput:G,PrimaryButton:B,DefaultInput:U,Page:N},setup(){return{counterStore:O()}},props:{Item:Object},data(){return{items:[],item:[],paginateCount:10,column:"id",type:"desc",errors:[],passwordErrors:[],loader:!1,loaderPass:!1,name:"",login:"",phone:"",email:"",image:"",password:"",repeatPassword:"",position:"",role:"",payable:0,due:0,roles:[],sign:""}},methods:{async roleIndex(){try{this.loader=!0;const e=await x();this.roles=e.data,this.loader=!1}catch(e){u(this,e)}},onPayable(e){this.payable=this.counterStore.inputNumberFormat("payable",this.payable,e)},async show(e){try{const t=await R(e);this.item=t.data,this.name=t.data.name,this.login=t.data.login,this.email=t.data.email,this.phone=t.data.phone,this.position=t.data.position,this.role=t.data.role_id,this.payable=this.counterStore.formatNumber(t.data.payable),this.due=t.data.due,this.image=t.data.image[0].url,this.item.id==this.counterStore.user.id&&(localStorage.setItem("user",JSON.stringify(t.data)),this.counterStore.updateUser(t.data))}catch(t){u(this,t)}},async save(){try{console.log(this.Item),this.sign=this.counterStore.user.currency.sign,this.item=this.Item,this.name=this.Item.name,this.login=this.Item.login,this.email=this.Item.email,this.phone=this.Item.phone,this.role=this.Item.role_id,this.position=this.Item.position,this.payable=this.Item.payable,this.due=this.Item.due,this.item.id==this.counterStore.user.id&&(localStorage.setItem("user",JSON.stringify(response.data)),this.counterStore.updateUser(response.data))}catch(e){u(this,e)}},discharge(){this.item="",this.name="",this.login="",this.email="",this.phone="",this.image="",this.payable=0,this.due=0,this.password="",this.repeatPassword="",this.position="",this.role=""},async update(){try{this.loader=!0;let e={name:this.name,phone:this.phone,login:this.login,email:this.email,image:this.image,role_id:this.role,payable:this.payable,due:this.due,position:this.position};const t=await $(this.item.id,e);return t.status?(h("success",this.$t("update")),this.$emit("onUpdate",!0),this.counterStore.hiddenModal("userUpdate"),this.loader=!1,this.discharge(),this.show(t.data.id),!0):(this.errors=t.errors,h("error",this.$t("formError")),this.loader=!1,!1)}catch(e){return u(this,e),this.loader=!1,!1}},async updatePassword(){try{if(this.loaderPass=!0,this.password.length>0&&this.password!=this.repeatPassword)return this.passwordErrors={password:this.$t("RepeatPasswordAlert")},!1;let e={password:this.password};const t=await K(this.Item.id,e);return console.log(t),t.status?(h("success",this.$t("update")),this.password="",this.repeatPassword="",this.loaderPass=!1,!0):(this.passwordErrors=t.errors,h("error",this.$t("formError")),this.loaderPass=!1,!1)}catch(e){return u(this,e),this.loaderPass=!1,!1}}},mounted(){this.save(),this.roleIndex()},watch:{Item:function(e,t){this.save()}}},le={class:"row"},ne={class:"row"},ie={class:"row"},de={class:"row"},ue=["selected","value"],pe={class:"row"},me={type:"button",class:"btn btn-light","data-bs-dismiss":"modal"},he={type:"button",class:"btn btn-light","data-bs-dismiss":"modal"};function ce(e,t,k,P,s,c){const I=l("ImageInput"),n=l("DefaultInput"),C=l("DefaultSelect"),g=l("PrimaryBtn"),b=l("BtnBox"),w=l("BaseBox"),L=l("ModalCentered");return m(),y(L,{Title:e.$t("Update"),ModalName:"userUpdate",ModalTypes:"modal-xl",isModalFooter:!1},{default:i(()=>[a("div",le,[r(w,{Col:"col-xl-6",Title:e.$t("UserInfo")},{default:i(()=>[r(I,{Title:e.$t("ProfilPhoto"),Name:"userUpdateImage",onUserUpdateImage:t[0]||(t[0]=o=>(s.image=o,delete this.errors.image)),Image:s.image,Validated:s.errors},null,8,["Title","Image","Validated"]),a("div",ne,[r(n,{Label:e.$t("Name"),Name:"name",Type:"text",Validated:s.errors,Value:s.name,onOnInput:t[1]||(t[1]=o=>(s.name=o,delete this.errors.name)),Class:"col-lg-6 col-sm-12"},null,8,["Label","Validated","Value"]),r(n,{Label:e.$t("Login"),Name:"login",Type:"text",Validated:s.errors,Value:s.login,Class:"col-lg-6 col-sm-12",onOnInput:t[2]||(t[2]=o=>(s.login=o,delete this.errors.login))},null,8,["Label","Validated","Value"])]),a("div",ie,[r(n,{Label:e.$t("Phone"),Name:"phone",Type:"text",Validated:s.errors,Value:s.phone,Class:"col-lg-6 col-sm-12",onOnInput:t[3]||(t[3]=o=>(s.phone=o,delete this.errors.phone))},null,8,["Label","Validated","Value"]),r(n,{Label:e.$t("Email"),Name:"email",Type:"text",Validated:s.errors,Value:s.email,Class:"col-lg-6 col-sm-12",onOnInput:t[4]||(t[4]=o=>(s.email=o,delete this.errors.email))},null,8,["Label","Validated","Value"])]),a("div",de,[r(n,{Label:e.$t("Position"),Name:"position",Type:"text",Validated:s.errors,Value:s.position,onOnInput:t[5]||(t[5]=o=>(s.position=o,delete this.errors.position)),Class:"col-lg-6 col-sm-12"},null,8,["Label","Validated","Value"]),r(C,{Label:e.$t("SystemRole"),Name:"role",Type:"text",Validated:s.errors,Value:s.role,onOnInput:t[6]||(t[6]=o=>(s.role=o,delete this.errors.role)),Class:"col-lg-6 col-sm-12"},{default:i(()=>[(m(!0),V(E,null,D(s.roles,o=>(m(),V("option",{selected:s.item.role_id==o.id,value:o.id},p(o.name),9,ue))),256))]),_:1},8,["Label","Validated","Value"])]),a("div",pe,[r(n,{Label:e.$t("Payable")+" ("+s.sign+")",Name:"payable",Type:"text",Validated:s.errors,Value:this.counterStore.formatNumber(s.payable),onOnInput:t[7]||(t[7]=o=>(c.onPayable(o),delete this.errors.payable)),Class:"col-lg-6 col-sm-12 payable"},null,8,["Label","Validated","Value"]),r(n,{Label:e.$t("Due")+" ("+e.$t("Day")+")",Name:"due",Type:"number",Validated:s.errors,Value:s.due,onOnInput:t[8]||(t[8]=o=>(s.due=o,delete this.errors.due)),Class:"col-lg-6 col-sm-12"},null,8,["Label","Validated","Value"])]),r(b,null,{default:i(()=>[a("button",me,p(e.$t("Close")),1),f("   "),r(g,{Loader:s.loader,onOnButton:c.update},{default:i(()=>[f(p(e.$t("Save")),1)]),_:1},8,["Loader","onOnButton"])]),_:1})]),_:1},8,["Title"]),r(w,{Col:"col-xl-6",Title:e.$t("UpdatePassword")},{default:i(()=>[r(n,{Label:e.$t("Password"),Name:"password",Type:"password",Validated:s.passwordErrors,Value:s.password,onOnInput:t[9]||(t[9]=o=>(s.password=o,delete this.passwordErrors.password))},null,8,["Label","Validated","Value"]),r(n,{Label:e.$t("RepeatPassword"),Name:"password",Type:"password",Value:s.repeatPassword,Validated:s.passwordErrors,onOnInput:t[10]||(t[10]=o=>(s.repeatPassword=o,delete this.passwordErrors.password))},null,8,["Label","Value","Validated"]),r(b,null,{default:i(()=>[a("button",he,p(e.$t("Close")),1),f("   "),r(g,{Loader:s.loaderPass,onOnButton:c.updatePassword},{default:i(()=>[f(p(e.$t("Save")),1)]),_:1},8,["Loader","onOnButton"])]),_:1})]),_:1},8,["Title"])])]),_:1},8,["Title"])}const ge=v(ae,[["render",ce]]),ye={components:{ImageInput:G,DefaultSelect:M,PrimaryBtn:T,BtnBox:F,ModalCentered:S,PrimaryButton:B,DefaultInput:U,Page:N},setup(){return{counterStore:O()}},props:{Item:Object},data(){return{items:[],item:[],paginateCount:10,column:"id",type:"desc",errors:[],passwordErrors:[],loader:!1,loaderPass:!1,name:"",login:"",phone:"",email:"",image:"",password:"",repeatPassword:"",position:"",role:"",payable:0,due:0,sign:"",roles:[]}},methods:{async roleIndex(){try{this.loader=!0;const e=await x();this.roles=e.data,this.loader=!1}catch(e){u(this,e)}},onPayable(e){this.payable=this.counterStore.inputNumberFormat("payable",this.payable,e)},async save(){try{this.item="",this.name="",this.login="",this.email="",this.phone="",this.payable=0,this.due=0,this.image="",this.password="",this.repeatPassword="",this.position="",this.role=""}catch(e){u(this,e)}},async create(){try{this.loader=!0;let e={name:this.name,phone:this.phone,login:this.login,email:this.email,image:this.image,payable:this.payable,due:this.due,role_id:this.role,position:this.position,password:this.password};console.log("Data",e);const t=await A(e);return t.status?(h("success",this.$t("create")),this.counterStore.hiddenModal("userCreate"),this.save(),this.loader=!1,this.$emit("onCreate",!0),!0):(this.errors=t.errors,h("error",this.$t("formError")),this.loader=!1,!1)}catch(e){return u(this,e),this.loader=!1,!1}}},mounted(){this.roleIndex(),this.sign=this.counterStore.user.currency.sign},watch:{Item:function(e,t){this.save()}}},fe={class:"row"},be={class:"row"},we={class:"row"},Ve={class:"row"},Pe=a("option",{selected:""},"---",-1),Ie=["value"],Ce={class:"row"},Le={type:"button",class:"btn btn-light","data-bs-dismiss":"modal"};function _e(e,t,k,P,s,c){const I=l("ImageInput"),n=l("DefaultInput"),C=l("DefaultSelect"),g=l("BaseBox"),b=l("PrimaryBtn"),w=l("BtnBox"),L=l("ModalCentered");return m(),y(L,{Title:e.$t("Create"),ModalName:"userCreate",ModalTypes:"modal-xl",isModalFooter:!1},{default:i(()=>[a("div",fe,[r(g,{Col:"col-xl-6",Title:e.$t("UserInfo")},{default:i(()=>[r(I,{Title:e.$t("ProfilPhoto")+"1",Name:"userCreateImage",onUserCreateImage:t[0]||(t[0]=o=>(s.image=o,delete this.errors.image)),Validated:s.errors},null,8,["Title","Validated"]),a("div",be,[r(n,{Label:e.$t("Name"),Name:"name",Type:"text",Validated:s.errors,Value:s.name,onOnInput:t[1]||(t[1]=o=>(s.name=o,delete this.errors.name)),Class:"col-lg-6 col-sm-12"},null,8,["Label","Validated","Value"]),r(n,{Label:e.$t("Login"),Name:"login",Type:"text",Validated:s.errors,Value:s.login,onOnInput:t[2]||(t[2]=o=>(s.login=o,delete this.errors.login)),Class:"col-lg-6 col-sm-12"},null,8,["Label","Validated","Value"])]),a("div",we,[r(n,{Label:e.$t("Phone"),Name:"phone",Type:"text",Validated:s.errors,Value:s.phone,onOnInput:t[3]||(t[3]=o=>(s.phone=o,delete this.errors.phone)),Class:"col-lg-6 col-sm-12"},null,8,["Label","Validated","Value"]),r(n,{Label:e.$t("Email"),Name:"email",Type:"text",Validated:s.errors,Value:s.email,onOnInput:t[4]||(t[4]=o=>(s.email=o,delete this.errors.email)),Class:"col-lg-6 col-sm-12"},null,8,["Label","Validated","Value"])]),a("div",Ve,[r(n,{Label:e.$t("Position"),Name:"position",Type:"text",Validated:s.errors,Value:s.position,onOnInput:t[5]||(t[5]=o=>(s.position=o,delete this.errors.position)),Class:"col-lg-6 col-sm-12"},null,8,["Label","Validated","Value"]),r(C,{Label:e.$t("SystemRole"),Name:"role_id",Type:"text",Validated:s.errors,Value:s.role,onOnInput:t[6]||(t[6]=o=>(s.role=o,delete this.errors.role_id)),Class:"col-lg-6 col-sm-12"},{default:i(()=>[Pe,(m(!0),V(E,null,D(s.roles,o=>(m(),V("option",{value:o.id},p(o.name),9,Ie))),256))]),_:1},8,["Label","Validated","Value"])])]),_:1},8,["Title"]),r(g,{Col:"col-xl-6",Title:""},{default:i(()=>[a("div",Ce,[r(n,{Label:e.$t("Payable")+" ("+s.sign+")",Name:"payable",Type:"text",Validated:s.errors,Value:this.counterStore.formatNumber(s.payable),onOnInput:t[7]||(t[7]=o=>(c.onPayable(o),delete this.errors.payable)),Class:"col-lg-6 col-sm-12 payable"},null,8,["Label","Validated","Value"]),r(n,{Label:e.$t("Due")+" ("+e.$t("Day")+")",Name:"due",Type:"number",Validated:s.errors,Value:s.due,onOnInput:t[8]||(t[8]=o=>(s.due=o,delete this.errors.due)),Class:"col-lg-6 col-sm-12"},null,8,["Label","Validated","Value"])]),r(n,{Label:e.$t("Password"),Name:"password",Type:"password",Validated:s.errors,Value:s.password,onOnInput:t[9]||(t[9]=o=>(s.password=o,delete this.errors.password))},null,8,["Label","Validated","Value"]),r(n,{Label:e.$t("RepeatPassword"),Name:"password",Type:"password",Value:s.repeatPassword,Validated:s.errors,onOnInput:t[10]||(t[10]=o=>(s.repeatPassword=o,delete this.errors.password))},null,8,["Label","Value","Validated"]),r(w,null,{default:i(()=>[a("button",Le,p(e.$t("Close")),1),f("   "),r(b,{Loader:s.loader,onOnButton:c.create},{default:i(()=>[f(p(e.$t("Save")),1)]),_:1},8,["Loader","onOnButton"])]),_:1})]),_:1})])]),_:1},8,["Title"])}const Te=v(ye,[["render",_e]]),Se={components:{DefaultSelect:M,Paginate:re,DefaultInput:U,PrimaryBtn:T,ModalCentered:S,PrimaryIconBtn:oe,PrimaryButton:B,GrowingLoader:se,BasicTable:te,Page:N,Update:ge,Create:Te},setup(){return{counterStore:O()}},data(){return{items:[],item:[],paginateCount:10,last_page:1,current_page:1,column:"id",type:"desc",errors:[],loader:!1}},methods:{async index(){try{const e=await W();this.items=e.data}catch(e){u(this,e)}},async indexActives(){try{const e=await X(this.paginateCount);this.items=e.data}catch(e){u(this,e)}},async indexPaginates(e=1){try{this.loader=!0;const t=await Y(this.paginateCount,e);this.current_page=t.data.pagination.current_page,this.last_page=t.data.pagination.last_page,this.items=t.data.items,this.loader=!1}catch(t){u(this,t)}},async orderBys(){try{const e=await q(this.column,this.type);this.items=e.data}catch(e){u(this,e)}},async show(e){try{const t=await R(e);this.item=t.data}catch(t){u(this,t)}},async create(){try{const t=await A({});return t.status?(h("success",this.$t("create")),!0):(this.errors=t.errors,h("error",this.$t("formError")),!1)}catch(e){return u(this,e),!1}},async update(){try{const t=await $({});return t.status?(h("success",this.$t("update")),!0):(this.errors=t.errors,h("error",this.$t("formError")),!1)}catch(e){return u(this,e),!1}},async search(e=""){try{if(this.loader=!0,e=="")return this.indexPaginates(),!0;const t=await Q(e);return this.items=t.data,this.loader=!1,t.status?(this.loader=!1,!0):(h("error",this.$t("formError")),this.loader=!1,!1)}catch(t){return u(this,t),this.loader=!1,!1}},async delete(e){try{if(!confirm(this.$t("DeleteAlert")))return!1;const t=await Z(e);return this.items=t.data,t.status&&(this.indexPaginates(this.current_page),h("success",this.$t("delete"))),h("error",this.$t("formError")),!1}catch(t){return u(this,t),!1}}},mounted(){this.indexPaginates()}},Be={class:"row"},Ne={value:"10",selected:""},ve=a("option",{value:"10"},"10",-1),Oe=a("option",{value:"20"},"20",-1),De=a("option",{value:"50"},"50",-1),Ee=a("option",{value:"100"},"100",-1);function Ue(e,t,k,P,s,c){const I=l("DefaultInput"),n=l("DefaultSelect"),C=l("PrimaryBtn"),g=l("PrimaryIconBtn"),b=l("Paginate"),w=l("GrowingLoader"),L=l("BasicTable"),o=l("Update"),j=l("Create"),J=l("Page");return m(),y(J,{Title:""},{default:i(()=>[a("div",Be,[r(L,{Th:[e.$t("No"),e.$t("Picture"),e.$t("Name"),e.$t("Position"),e.$t("SystemRole"),e.$t("Login"),e.$t("Phone"),e.$t("Settings")],Title:e.$t("Employees"),Col:"col-lg-12"},{inputs:i(()=>[r(I,{Class:"col-lg-3 col-sm-2 search_input",Label:"",Name:"name",Type:"text",Pholder:"Search...",onOnInput:t[0]||(t[0]=d=>c.search(d))}),r(n,{Label:"",Class:"col-lg-2 col-sm-2",onOnInput:t[1]||(t[1]=d=>(this.paginateCount=d,this.indexPaginates()))},{default:i(()=>[a("option",Ne,p(e.$t("NumberDownloads")),1),ve,Oe,De,Ee]),_:1}),f("   ")]),buttons:i(()=>[P.counterStore.hasRole("Employees-create")?(m(),y(C,{key:0,role:"button","data-bs-toggle":"modal","data-bs-target":"#userCreate"},{default:i(()=>[f(p(e.$t("Create")),1)]),_:1})):_("",!0)]),default:i(()=>[(m(!0),V(E,null,D(s.items,(d,z)=>(m(),V("tr",null,[a("td",null,p((s.current_page-1)*s.paginateCount+z+1),1),a("td",null,[a("div",{class:"table_image",style:ee("background-image: url("+d.image[0].url+")")},null,4)]),a("td",null,p(d.name),1),a("td",null,p(d.position),1),a("td",null,p(d.role),1),a("td",null,p(d.login),1),a("td",null,p(d.phone),1),a("td",null,[P.counterStore.hasRole("Employees-update")&&d.private!=1?(m(),y(g,{key:0,onClick:H=>this.item=d,Icon:"bx bx-edit-alt",Modal:"userUpdate"},null,8,["onClick"])):_("",!0),P.counterStore.hasRole("Employees-delete")&&d.private!=1?(m(),y(g,{key:1,onClick:H=>this.delete(d.id),class:"bg-danger border-danger",Icon:"bx bx-trash-alt"},null,8,["onClick"])):_("",!0)])]))),256)),s.last_page!=1?(m(),y(b,{key:0,currentPage:this.current_page,totalPages:this.last_page,onChangePage:t[2]||(t[2]=d=>c.indexPaginates(d))},null,8,["currentPage","totalPages"])):_("",!0),s.loader?(m(),y(w,{key:1,Cols:"8"})):_("",!0)]),_:1},8,["Th","Title"])]),r(o,{Item:s.item,onOnUpdate:t[3]||(t[3]=d=>c.indexPaginates(this.current_page))},null,8,["Item"]),r(j,{onOnCreate:t[4]||(t[4]=d=>c.indexPaginates(this.current_page))})]),_:1})}const Je=v(Se,[["render",Ue]]);export{Je as default};
