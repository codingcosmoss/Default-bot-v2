import{P as C}from"./Page-EAuwfOTr.js";import{_,u as y,o as l,c as m,a as s,t as n,k as z,n as A,Z as D,A as N,r as c,f as S,w as h,b as d,X as K,Y as H,N as F,O as W,aP as q,b8 as X,b9 as Y,ba as Z,S as G,bb as J,bc as Q,F as k,C as M,x as I,h as T}from"./app-wmakNrFD.js";import{I as R}from"./InputDefault-Ik0lJLaM.js";import{_ as $}from"./pagination-01.vue_vue_type_style_index_0_lang-Z69Tj-9G.js";import{S as j,M as P}from"./Switch-cfRwjxIO.js";import{S as w}from"./Select-MhHGqNEH.js";import{I as O}from"./Input-ptp6Qwrn.js";import{L as ee}from"./Loader-mtXqPlpY.js";import{W as te}from"./WarehouseTopbar-3_ZLmVU-.js";import{T as se}from"./Table-riuTczk9.js";import{I as ae}from"./Input01-dfRJqBlV.js";import"./Input-sHi6_j3C.js";import"./InputColor-vS9SsQ7t.js";import"./paginate-CoOZTaYR.js";const oe={data(){return{order:"asc",search:"",column:"id"}},methods:{getName(e){return y().getName(e)}}},re={class:"grid grid-cols-5 border-b border-stroke dark:border-strokedark sm:grid-cols-5 databes_table overflow-x-auto"},ne={class:"flex items-center justify-content-end p-2.5 xl:p-5"},ie={class:"font-medium text-black dark:text-white"},le={class:"flex items-center justify-center p-2.5 xl:p-5"},ce={class:"font-medium text-black dark:text-white"},de={class:"flex items-center justify-center p-2.5 xl:p-5"},ue={class:"font-medium text-black dark:text-white"},me={class:"flex items-center justify-center p-2.5 xl:p-5"},pe={class:"font-medium text-black dark:text-white"};function he(e,t,i,p,o,a){return l(),m("div",re,[s("div",ne,[s("p",ie,n(a.getName("name_content")),1)]),s("div",le,[s("p",ce,n(a.getName("price")),1)]),s("div",de,[s("p",ue,n(a.getName("Created_at")),1)]),s("div",me,[s("p",pe,n(a.getName("actions")),1)])])}const _e=_(oe,[["render",he],["__scopeId","data-v-e55d42fb"]]),ge={},fe={class:"box"},be={class:"pagination"};function ye(e,t){return l(),m("div",fe,[s("div",be,[z(e.$slots,"default")])])}const xe=_(ge,[["render",ye]]),ve={props:{number:{type:Number,default:0},active:{type:Boolean,default:!1},link:{type:String,default:0}}};function ke(e,t,i,p,o,a){return l(),m("a",{class:A([i.active?"active":"","cursor-pointer"])},n(i.number),3)}const Ne=_(ve,[["render",ke]]),Se={components:{Switch:j,Input:O,Select:w,ModalLayout:P,Page:C},data(){return{status:1,categoryName:"",errorObj:{}}},props:{isCreateModal:{type:Boolean,default:!1},isUpdateModal:{type:Boolean,default:!1}},methods:{getName(e){return y().getName(e)},hasKey(e){return e in this.errorObj},async createCategory(){var e={name:this.categoryName,status:this.status};const t=await D(e);console.log(t),t.status?(this.categoryName="",this.$emit("closeModal",!1),this.$emit("Created",!0),N("success","Created successfully !")):this.errorObj=t.data}}},Me=s("option",{value:1}," Active",-1),Ie=s("option",{value:0}," Inactive",-1);function Ce(e,t,i,p,o,a){const g=c("Input"),f=c("Select"),b=c("ModalLayout");return l(),S(b,{onOnButton:a.createCategory,isModal:i.isCreateModal,onCloseModal:t[2]||(t[2]=u=>this.$emit("closeModal",u)),Title:a.getName("create")},{default:h(()=>[d(g,{Label:a.getName("name_content"),onOnInput:t[0]||(t[0]=u=>o.categoryName=u),isError:a.hasKey("name"),message:o.errorObj.name,Value:o.categoryName},null,8,["Label","isError","message","Value"]),d(f,{Label:a.getName("status"),onOnSelect:t[1]||(t[1]=u=>this.status=u)},{default:h(()=>[Me,Ie]),_:1},8,["Label"])]),_:1},8,["onOnButton","isModal","Title"])}const Pe=_(Se,[["render",Ce]]),we={components:{Input:O,Select:w,ModalLayout:P,Page:C},data(){return{status:1,categoryName:"",errorObj:{}}},props:{isUpdateModal:{type:Boolean,default:!1},Updated_Id:{type:Number,default:0}},methods:{getName(e){return y().getName(e)},hasKey(e){return e in this.errorObj},async getModel(){console.log(this.isUpdateModal);const e=await K(this.Updated_Id);this.categoryName=e.data.name,this.status=e.data.status},async updateCategory(){var e={name:this.categoryName,status:this.status};const t=await H(this.Updated_Id,e);t.status?(this.categoryName="",this.$emit("closeModal",!1),this.$emit("Created",!0),N("success","Update successfully !")):this.errorObj=t.data}},watch:{Updated_Id:function(e,t){this.getModel()}}},Oe=["selected"],Le=["selected"];function Te(e,t,i,p,o,a){const g=c("Input"),f=c("Select"),b=c("ModalLayout");return l(),S(b,{onOnButton:a.updateCategory,isModal:i.isUpdateModal,onCloseModal:t[2]||(t[2]=u=>this.$emit("closeUpdatedModal",!1)),Title:a.getName("update")},{default:h(()=>[d(g,{Label:a.getName("name_content"),onOnInput:t[0]||(t[0]=u=>o.categoryName=u),isError:a.hasKey("name"),message:o.errorObj.name,Value:o.categoryName},null,8,["Label","isError","message","Value"]),d(f,{Label:a.getName("status"),onOnSelect:t[1]||(t[1]=u=>o.status=u)},{default:h(()=>[s("option",{selected:o.status==1,value:1}," Active",8,Oe),s("option",{selected:o.status!=1,value:0}," Inactive",8,Le)]),_:1},8,["Label"])]),_:1},8,["onOnButton","isModal","Title"])}const je=_(we,[["render",Te]]),Ue={setup(){return{counterStore:y()}},components:{Input01:ae,Table:se,WarehouseTopbar:te,Loader:ee,Switch:j,Select:w,Input:O,CreateForm:Pe,ModalLayout:P,Pagination01:$,UpdateForm:je,VueAwesomePaginate:F,InputDefault:R,PaginateBtn:Ne,Paginate:xe,TableHeader:_e},data(){return{items:[],search:"",column:"updated_at",isError:"",order:"asc",paginateCount:10,pagination:{},last_page:0,currentPage:1,UpdatedId:0,isModal:!1,ExitModal:!1,categoryName:"",errorObj:{},crud:"",SearchPrducts:"",Products:[],SearchText:"",Summ:0}},methods:{router(){return W},removeItem(e){this.Products=this.Products.filter(t=>t.id!=e.id)},closeModal(){this.isModal=!1,this.Products=[],this.SearchText="",this.SearchPrducts=[],this.isError=[],this.Summ=0},validate(){return this.isError=[],this.Summ=0,this.Products.forEach(e=>{let t=e.amount.toString();t.indexOf("e")!=-1||t.length==0?this.isError.push(e.id):parseInt(t)<0||t.slice(0,1)=="0"?this.isError.push(e.id):this.Summ+=Number(e.amount)*Number(e.price)}),this.isError.length==0},addTodo(e){let t=!1;this.Products.forEach(i=>{if(i.id==e.id){t=!0;return}}),t||this.Products.push({id:e.id,name:e.name,amount:0,price:e.price,size_type:e.size_type})},async productSearch(e){if(this.SearchText=e,e.length==0)return this.SearchPrducts=[],!0;var t={search:e,order:"asc",column:"updated_at",paginate:10};const i=await q(t);console.log(i),this.SearchPrducts=i.data.items},onClickHandler(e){this.paginate=e,this.currentPage=e,this.getItems()},onModal(e){e==null?(this.crud="created",this.categoryName=""):(this.crud="",this.UpdatedId=e,this.getModel()),this.errorObj={},this.isModal=!0},async getModel(){const e=await X(this.UpdatedId);this.categoryName=e.data.name,this.Products=[],this.Summ=0,e.data.products.forEach(t=>{this.Summ+=Number(t.amount)*Number(t.price),this.Products.push({id:t.product_id,name:t.name,amount:t.amount,price:t.price,size_type:t.size_type})})},onUpdateModal(e){this.UpdatedId=e,this.isUpdateModal=!0},hasKey(e){return e in this.errorObj},async crudCategory(){if(!this.validate())return console.log("Products",this.Products),!1;var e={name:this.categoryName,products:this.Products,product_total_sum:this.Summ},t="";this.crud=="created"?t=await Y(e):t=await Z(this.UpdatedId,e),t.status?(this.categoryName="",this.Products=[],this.UpdatedId=null,this.isModal=!1,this.closeModal(),this.getItems(),N("success","Created successfully !")):(this.errorObj=t.data,console.log(t))},getName(e){return y().getName(e)},openModal(){document.querySelector(".modal").classList.remove("hidden")},async getItems(){const e=await G(this.currentPage,this.paginateCount);this.pagination=e.data.pagination,this.last_page=e.data.pagination.last_page,this.current_page=e.data.pagination.currentPage,this.items=e.data.items},async clickSearch(e,t){if(this.search=e,this.order=t,e!=""){var i={search:this.search,order:this.order,column:this.column,paginate:this.paginateCount};const p=await J(i);console.log(p),this.items=p.data.items}else this.getItems()},async onDelete(e){var t="Вы уверены, что хотите это удалить?";confirm(t)&&(await Q(e)).status==!0&&(N("success","Deleted successfully !"),this.getItems())},onPaginate(e){this.paginateCount=e,this.getItems()}},mounted(){this.getItems()}},Ee={class:"col-span-12 xl:col-span-12"},Ve={class:"rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"},Be={class:"flex flex-col table_media_box"},ze={class:"grid grid-cols-3 rounded-sm mb-2 sm:grid-cols-5 relative media_top_bar"},Ae={class:"ml-4"},De=s("option",{value:"10"},"10",-1),Ke=s("option",{value:"20"},"20",-1),He=s("option",{value:"50"},"50",-1),Fe=s("option",{value:"100"},"100",-1),We=[De,Ke,He,Fe],qe={class:"flex flex-wrap gap-5 xl:gap-20",style:{position:"absolute",right:"0px",top:"0"}},Xe={class:"databes_table grid grid-cols-5 border-b border-stroke dark:border-strokedark sm:grid-cols-5 databes_table"},Ye={class:"flex justify-content-end gap-3 p-2.5 xl:p-5"},Ze={class:"font-bold text-black dark:text-white sm:block cursor-pointer",style:{color:"#0a91f1"}},Ge={class:"flex items-center justify-center p-2.5 xl:p-5"},Je={class:"font-medium text-black dark:text-white"},Qe={class:"flex items-center justify-center p-2.5 xl:p-5"},Re={class:"font-medium text-black dark:text-white"},$e={class:"flex items-center justify-center p-2.5 sm:flex xl:p-5"},et={class:"font-medium text-meta-5"},tt=["onClick"],st=["onClick"],at={class:"table01"},ot=s("th",null,null,-1),rt=["onClick"],nt={style:{display:"flex","justify-content":"flex-end"}},it={style:{color:"#0b7fef","margin-top":"10px","font-size":"25px"}},lt={key:0,style:{color:"#d7123e"}},ct=s("br",null,null,-1),dt={class:"table_search table01"},ut=["onClick"];function mt(e,t,i,p,o,a){const g=c("WarehouseTopbar"),f=c("TableHeader"),b=c("Loader"),u=c("vue-awesome-paginate"),U=c("Pagination01"),E=c("Paginate"),L=c("Input"),V=c("Input01"),B=c("ModalLayout");return l(),m(k,null,[s("div",Ee,[s("div",Ve,[d(g),s("div",Be,[s("div",ze,[s("div",null,[s("input",{type:"text",placeholder:"Search",onInput:t[0]||(t[0]=r=>a.clickSearch(r.target.value,o.order)),class:"w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"},null,32)]),s("div",Ae,[s("select",{placeholder:"Search",onInput:t[1]||(t[1]=r=>a.onPaginate(r.target.value)),class:"w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"},We,32)]),s("div",qe,[s("span",{onClick:t[2]||(t[2]=r=>a.onModal(null)),class:"cursor-pointer inline-flex items-center justify-center rounded-md bg-primary py-3 px-10 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10"},n(a.getName("create")),1)])]),d(f),(l(!0),m(k,null,M(o.items,(r,x)=>(l(),m("div",Xe,[s("div",Ye,[I(n(x+1)+". ",1),s("p",Ze,n(r.name),1)]),s("div",Ge,[s("p",Je,n(p.counterStore.formatNumber(r.summ))+" uzs ",1)]),s("div",Qe,[s("p",Re,n(r.created_at),1)]),s("div",$e,[s("p",et,[s("i",{onClick:v=>a.onModal(r.id),class:"fa-solid setting-icon fa-pen-to-square"},null,8,tt),I("   "),s("i",{onClick:v=>a.onDelete(r.id),class:"fa-solid text-danger fa-trash setting-icon"},null,8,st)])])]))),256)),o.items.length==0&&o.search==""?(l(),S(b,{key:0})):T("",!0),d(E,null,{default:h(()=>[d(U,null,{default:h(()=>[d(u,{"total-items":o.last_page,"items-per-page":1,"max-pages-shown":1,modelValue:o.currentPage,"onUpdate:modelValue":t[3]||(t[3]=r=>o.currentPage=r),"on-click":a.onClickHandler},null,8,["total-items","modelValue","on-click"])]),_:1})]),_:1})])])]),d(B,{onOnButton:t[6]||(t[6]=r=>a.crudCategory()),isModal:o.isModal,onCloseModal:t[7]||(t[7]=r=>a.closeModal()),Title:o.crud=="created"?a.getName("create"):a.getName("update")},{default:h(()=>[d(L,{Label:a.getName("name_content"),onOnInput:t[4]||(t[4]=r=>o.categoryName=r),isError:a.hasKey("name"),message:o.errorObj.name,Value:o.categoryName},null,8,["Label","isError","message","Value"]),s("table",at,[s("tr",null,[s("th",null,n(a.getName("name_content")),1),s("th",null,n(a.getName("Amount")),1),s("th",null,n(a.getName("price")),1),ot]),(l(!0),m(k,null,M(o.Products,(r,x)=>(l(),m("tr",null,[s("td",null,n(r.name),1),s("td",null,[d(V,{class:"type_input",type:"number",onInput:v=>(o.Products[x].amount=v.target.value,a.validate()),value:r.amount,isError:o.isError.indexOf(r.id)!=-1},null,8,["onInput","value","isError"]),I(" "+n(r.size_type=="piece"?"dona":r.size_type),1)]),s("td",null,n(r.price)+" uzs",1),s("td",null,[s("i",{onClick:v=>(a.removeItem(r),a.validate()),class:"fa-solid text-danger fa-trash setting-icon"},null,8,rt)])]))),256))]),s("div",nt,[s("p",it,"Sum: "+n(p.counterStore.formatNumber(o.Summ))+" uzs",1)]),o.isError.length!=0?(l(),m("p",lt,"There is an error")):T("",!0),ct,d(L,{Label:a.getName("Search"),onOnInput:t[5]||(t[5]=r=>a.productSearch(r)),Value:o.SearchText},null,8,["Label","Value"]),s("table",dt,[(l(!0),m(k,null,M(o.SearchPrducts,r=>(l(),m("tr",{onClick:x=>a.addTodo(r)},[s("td",null,n(r.name),1),s("td",null,n(r.price_format)+" uzs",1),s("td",null,n(r.size_type),1)],8,ut))),256))])]),_:1},8,["isModal","Title"])],64)}const pt=_(Ue,[["render",mt]]),Pt={__name:"index",setup(e){return(t,i)=>(l(),S(C,{Animation:!1},{default:h(()=>[d(pt)]),_:1}))}};export{Pt as default};
