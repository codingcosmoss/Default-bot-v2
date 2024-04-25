import{P as N}from"./Page-8n99lQGG.js";import{_ as h,u as v,o as n,c as m,a,t as d,k as W,n as F,X as K,A as k,r as i,f as x,w as p,b as l,V as D,W as H,L as q,M as z,ap as X,aq as G,ar as J,as as Q,at as R,au as Y,av as Z,aw as $,h as y,F as w,D as L,s as O}from"./app-TemNFbnf.js";import{I as ee}from"./InputDefault-tLeF0Vsp.js";import{_ as te}from"./pagination-01.vue_vue_type_style_index_0_lang-ZvTme92P.js";import{S as j,M}from"./Switch-ytQAvUOl.js";import{S as C}from"./Select-2LcnBieZ.js";import{I}from"./Input-kd4mt6Nc.js";import{L as se}from"./Loader-rZq7vIO3.js";import{W as ae}from"./WarehouseTopbar-ZNY-viIW.js";const oe={data(){return{order:"asc",search:"",column:"id"}},methods:{getName(e){return v().getName(e)}}},re={class:"grid grid-cols-5 border-b border-stroke dark:border-strokedark sm:grid-cols-5 databes_table overflow-x-auto"},ne={class:"flex items-center justify-content-end p-2.5 xl:p-5"},ie={class:"font-medium text-black dark:text-white"},le={class:"flex items-center justify-center p-2.5 xl:p-5"},de={class:"font-medium text-black dark:text-white"},ce={class:"flex items-center justify-center p-2.5 xl:p-5"},ue={class:"font-medium text-black dark:text-white"},me={class:"flex items-center justify-center p-2.5 xl:p-5"},pe={class:"font-medium text-black dark:text-white"},_e={class:"flex items-center justify-center p-2.5 xl:p-5"},he={class:"font-medium text-black dark:text-white"};function ge(e,t,c,_,o,s){return n(),m("div",re,[a("div",ne,[a("p",ie,d(s.getName("name_content")),1)]),a("div",le,[a("p",de,d(s.getName("Address")),1)]),a("div",ce,[a("p",ue,d(s.getName("Filial")),1)]),a("div",me,[a("p",pe,d(s.getName("category")),1)]),a("div",_e,[a("p",he,d(s.getName("actions")),1)])])}const fe=h(oe,[["render",ge],["__scopeId","data-v-9eb35740"]]),be={},ye={class:"box"},xe={class:"pagination"};function ke(e,t){return n(),m("div",ye,[a("div",xe,[W(e.$slots,"default")])])}const ve=h(be,[["render",ke]]),we={props:{number:{type:Number,default:0},active:{type:Boolean,default:!1},link:{type:String,default:0}}};function Ne(e,t,c,_,o,s){return n(),m("a",{class:F([c.active?"active":"","cursor-pointer"])},d(c.number),3)}const Me=h(we,[["render",Ne]]),Ce={components:{Switch:j,Input:I,Select:C,ModalLayout:M,Page:N},data(){return{status:1,categoryName:"",errorObj:{}}},props:{isCreateModal:{type:Boolean,default:!1},isUpdateModal:{type:Boolean,default:!1}},methods:{getName(e){return v().getName(e)},hasKey(e){return e in this.errorObj},async createCategory(){var e={name:this.categoryName,status:this.status};const t=await K(e);console.log(t),t.status?(this.categoryName="",this.$emit("closeModal",!1),this.$emit("Created",!0),k("success","Created successfully !")):this.errorObj=t.data}}},Ie=a("option",{value:1}," Active",-1),Se=a("option",{value:0}," Inactive",-1);function Le(e,t,c,_,o,s){const g=i("Input"),f=i("Select"),b=i("ModalLayout");return n(),x(b,{onOnButton:s.createCategory,isModal:c.isCreateModal,onCloseModal:t[2]||(t[2]=u=>this.$emit("closeModal",u)),Title:s.getName("create")},{default:p(()=>[l(g,{Label:s.getName("name_content"),onOnInput:t[0]||(t[0]=u=>o.categoryName=u),isError:s.hasKey("name"),message:o.errorObj.name,Value:o.categoryName},null,8,["Label","isError","message","Value"]),l(f,{Label:s.getName("status"),onOnSelect:t[1]||(t[1]=u=>this.status=u)},{default:p(()=>[Ie,Se]),_:1},8,["Label"])]),_:1},8,["onOnButton","isModal","Title"])}const Oe=h(Ce,[["render",Le]]),je={components:{Input:I,Select:C,ModalLayout:M,Page:N},data(){return{status:1,categoryName:"",errorObj:{}}},props:{isUpdateModal:{type:Boolean,default:!1},Updated_Id:{type:Number,default:0}},methods:{getName(e){return v().getName(e)},hasKey(e){return e in this.errorObj},async getModel(){console.log(this.isUpdateModal);const e=await D(this.Updated_Id);this.categoryName=e.data.name,this.status=e.data.status},async updateCategory(){var e={name:this.categoryName,status:this.status};const t=await H(this.Updated_Id,e);t.status?(this.categoryName="",this.$emit("closeModal",!1),this.$emit("Created",!0),k("success","Update successfully !")):this.errorObj=t.data}},watch:{Updated_Id:function(e,t){this.getModel()}}},Pe=["selected"],Ue=["selected"];function Ve(e,t,c,_,o,s){const g=i("Input"),f=i("Select"),b=i("ModalLayout");return n(),x(b,{onOnButton:s.updateCategory,isModal:c.isUpdateModal,onCloseModal:t[2]||(t[2]=u=>this.$emit("closeUpdatedModal",!1)),Title:s.getName("update")},{default:p(()=>[l(g,{Label:s.getName("name_content"),onOnInput:t[0]||(t[0]=u=>o.categoryName=u),isError:s.hasKey("name"),message:o.errorObj.name,Value:o.categoryName},null,8,["Label","isError","message","Value"]),l(f,{Label:s.getName("status"),onOnSelect:t[1]||(t[1]=u=>o.status=u)},{default:p(()=>[a("option",{selected:o.status==1,value:1}," Active",8,Pe),a("option",{selected:o.status!=1,value:0}," Inactive",8,Ue)]),_:1},8,["Label"])]),_:1},8,["onOnButton","isModal","Title"])}const Ae=h(je,[["render",Ve]]),Be={components:{WarehouseTopbar:ae,Loader:se,Switch:j,Select:C,Input:I,CreateForm:Oe,ModalLayout:M,Pagination01:te,UpdateForm:Ae,VueAwesomePaginate:q,InputDefault:ee,PaginateBtn:Me,Paginate:ve,TableHeader:fe},data(){return{items:[],search:"",column:"updated_at",order:"asc",paginateCount:10,pagination:{},last_page:0,currentPage:1,UpdatedId:0,isModal:!1,ExitModal:!1,status:!0,Name:"",filial_id:"",Filials:"",Address:"",Categories:"",category_id:"",errorObj:{},crud:""}},methods:{router(){return z},onClickHandler(e){this.paginate=e,this.currentPage=e,this.getItems()},onModal(e){e==null?(this.crud="created",this.Name="",this.Address="",this.category_id="",this.filial_id=""):(this.crud="",this.UpdatedId=e,this.getModel()),this.errorObj={},this.isModal=!0},async getModel(){const e=await X(this.UpdatedId);this.Name=e.data.name,this.Address=e.data.address,this.category_id=e.data.category_id,this.filial_id=e.data.filial_id,this.status=e.data.status==1},onUpdateModal(e){this.UpdatedId=e,this.isUpdateModal=!0},hasKey(e){return e in this.errorObj},async crudCategory(){var e=[],t={name:this.Name,address:this.Address,status:this.status==!0?1:0,filial_id:this.filial_id,warehouse_category_id:this.category_id};this.crud=="created"?e=await G(t):e=await J(this.UpdatedId,t),e.status?(this.Name="",this.category_id="",this.filial_id="",this.Address="",this.status=!0,this.UpdatedId=null,this.isModal=!1,this.getItems(),k("success","Created successfully !")):this.errorObj=e.data},getName(e){return v().getName(e)},openModal(){document.querySelector(".modal").classList.remove("hidden")},async getItems(){const e=await Q(this.currentPage,this.paginateCount);this.pagination=e.data.pagination,this.last_page=e.data.pagination.last_page,this.current_page=e.data.pagination.currentPage,this.items=e.data.items,console.log(e)},async getFilials(){const e=await R(1,1e3);this.Filials=e.data.items},async getCategories(){const e=await Y(1,1e3);this.Categories=e.data.items},async clickSearch(e,t){if(this.search=e,this.order=t,e!=""){var c={search:this.search,order:this.order,column:this.column,paginate:this.paginateCount};const _=await Z(c);console.log(_),this.items=_.data.items}else this.getItems()},async onDelete(e){var t="Вы уверены, что хотите это удалить?";confirm(t)&&(await $(e)).status==!0&&(k("success","Deleted successfully !"),this.getItems())},hasPermission(e){return!!localStorage.getItem("permissions").split(",").includes(e)},onPaginate(e){this.paginateCount=e,this.getItems()}},mounted(){this.getItems(),this.getCategories(),this.getFilials()}},Te={class:"col-span-12 xl:col-span-12"},Ee={class:"rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"},We={class:"flex flex-col table_media_box"},Fe={class:"grid grid-cols-3 rounded-sm mb-2 sm:grid-cols-5 relative media_top_bar"},Ke={class:"ml-4"},De=a("option",{value:"10"},"10",-1),He=a("option",{value:"20"},"20",-1),qe=a("option",{value:"50"},"50",-1),ze=a("option",{value:"100"},"100",-1),Xe=[De,He,qe,ze],Ge={key:0,class:"flex flex-wrap gap-5 xl:gap-20",style:{position:"absolute",right:"0px",top:"0"}},Je={class:"grid grid-cols-5 border-b border-stroke dark:border-strokedark sm:grid-cols-5 databes_table"},Qe={class:"flex justify-content-end gap-3 p-2.5 xl:p-5"},Re={class:"font-bold text-black dark:text-white sm:block cursor-pointer",style:{color:"#0a91f1"}},Ye={class:"flex items-center justify-center p-2.5 xl:p-5"},Ze={class:"font-medium text-black dark:text-white"},$e={class:"flex items-center justify-center p-2.5 xl:p-5"},et={class:"font-medium text-black dark:text-white"},tt={class:"flex items-center justify-center p-2.5 xl:p-5"},st={class:"font-medium text-black dark:text-white"},at={class:"flex items-center justify-center p-2.5 sm:flex xl:p-5"},ot={class:"font-medium text-meta-5"},rt=["onClick"],nt=["onClick"],it=a("option",null,"---",-1),lt=["value","selected"];function dt(e,t,c,_,o,s){const g=i("WarehouseTopbar"),f=i("TableHeader"),b=i("Loader"),u=i("vue-awesome-paginate"),P=i("Pagination01"),U=i("Paginate"),S=i("Input"),V=i("Select"),A=i("Switch"),B=i("ModalLayout");return n(),m(w,null,[a("div",Te,[a("div",Ee,[l(g),a("div",We,[a("div",Fe,[a("div",null,[a("input",{type:"text",placeholder:"Search",onInput:t[0]||(t[0]=r=>s.clickSearch(r.target.value,o.order)),class:"w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"},null,32)]),a("div",Ke,[a("select",{placeholder:"Search",onInput:t[1]||(t[1]=r=>s.onPaginate(r.target.value)),class:"w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"},Xe,32)]),s.hasPermission("Warehouse-create")?(n(),m("div",Ge,[a("span",{onClick:t[2]||(t[2]=r=>s.onModal(null)),class:"cursor-pointer inline-flex items-center justify-center rounded-md bg-primary py-3 px-10 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10"},d(s.getName("create")),1)])):y("",!0)]),l(f),(n(!0),m(w,null,L(o.items,(r,T)=>(n(),m("div",Je,[a("div",Qe,[O(d(T+1)+". ",1),a("p",Re,d(r.name),1)]),a("div",Ye,[a("p",Ze,d(r.address),1)]),a("div",$e,[a("p",et,d(r.filial),1)]),a("div",tt,[a("p",st,d(r.category),1)]),a("div",at,[a("p",ot,[s.hasPermission("Warehouse-update")?(n(),m("i",{key:0,onClick:E=>s.onModal(r.id),class:"fa-solid setting-icon fa-pen-to-square"},null,8,rt)):y("",!0),O("   "),s.hasPermission("Warehouse-delete")?(n(),m("i",{key:1,onClick:E=>s.onDelete(r.id),class:"fa-solid text-danger fa-trash setting-icon"},null,8,nt)):y("",!0)])])]))),256)),o.items.length==0&&o.search==""?(n(),x(b,{key:0})):y("",!0),l(U,null,{default:p(()=>[l(P,null,{default:p(()=>[l(u,{"total-items":o.last_page,"items-per-page":1,"max-pages-shown":1,modelValue:o.currentPage,"onUpdate:modelValue":t[3]||(t[3]=r=>o.currentPage=r),"on-click":s.onClickHandler},null,8,["total-items","modelValue","on-click"])]),_:1})]),_:1})])])]),s.hasPermission("Warehouse-create")&&s.hasPermission("Warehouse-update")?(n(),x(B,{key:0,onOnButton:t[8]||(t[8]=r=>s.crudCategory()),isModal:o.isModal,onCloseModal:t[9]||(t[9]=r=>o.isModal=!1),Title:o.crud=="created"?s.getName("create"):s.getName("update")},{default:p(()=>[l(S,{Label:s.getName("name_content"),onOnInput:t[4]||(t[4]=r=>o.Name=r),isError:s.hasKey("name"),message:o.errorObj.name,Value:o.Name},null,8,["Label","isError","message","Value"]),l(S,{Label:s.getName("Address"),onOnInput:t[5]||(t[5]=r=>o.Address=r),isError:s.hasKey("address"),message:o.errorObj.address,Value:o.Address},null,8,["Label","isError","message","Value"]),l(V,{Label:s.getName("Categories"),isError:s.hasKey("warehouse_category_id"),message:o.errorObj.warehouse_category_id,onOnSelect:t[6]||(t[6]=r=>o.category_id=r)},{default:p(()=>[it,(n(!0),m(w,null,L(o.Categories,r=>(n(),m("option",{value:r.id,selected:r.id==o.category_id},d(r.name),9,lt))),256))]),_:1},8,["Label","isError","message"]),l(A,{isSwitch:o.status==1,onOnClick:t[7]||(t[7]=r=>o.status=r)},null,8,["isSwitch"])]),_:1},8,["isModal","Title"])):y("",!0)],64)}const ct=h(Be,[["render",dt]]),xt={__name:"index",setup(e){return(t,c)=>(n(),x(N,{Animation:!1},{default:p(()=>[l(ct)]),_:1}))}};export{xt as default};
