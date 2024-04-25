import{M as B,C as D,P as M}from"./Page-EAuwfOTr.js";import{_ as g,u as p,o as c,c as l,a as e,t as s,N as I,bp as V,A as j,aP as A,r as u,n as T,h as y,b as m,F as S,C,w as x,bq as U,bd as q,f as N}from"./app-wmakNrFD.js";import{C as W}from"./ContentBox-bf7dlGEG.js";import{C as F}from"./ContentBlock-UJBuZk-s.js";import{P as E}from"./paginate-btn-zbRDmIgD.js";import{I as $}from"./Input-sHi6_j3C.js";import"./InputDefault-Ik0lJLaM.js";import{_ as z}from"./pagination-01.vue_vue_type_style_index_0_lang-Z69Tj-9G.js";import{P as L}from"./paginate-CoOZTaYR.js";import{T as H}from"./Table-riuTczk9.js";import{I as O}from"./Input01-dfRJqBlV.js";import{P as K}from"./Table-wBAXGcpj.js";import{L as R}from"./Loader-mtXqPlpY.js";import"./Switch-cfRwjxIO.js";import"./Select-MhHGqNEH.js";import"./InputColor-vS9SsQ7t.js";import"./CreateForm-fIWWO4D_.js";import"./Input-ptp6Qwrn.js";import"./InputText-6RZcbKqC.js";import"./Textarea-gzzG5tJ2.js";import"./InputTime-ugXbQN2E.js";import"./Table-EiW3ZRf-.js";import"./DangerButton-woQCp7QM.js";import"./Checkbox01-R3umV7Dp.js";const G={data(){return{order:"asc",search:"",column:"id"}},methods:{getName(t){return p().getName(t)}}},J={class:"grid grid-cols-6 border-b border-stroke dark:border-strokedark sm:grid-cols-6 overflow-x-auto media_header"},Q={class:"flex items-center justify-center p-2.5 xl:p-5"},X={class:"font-medium text-black dark:text-white"},Y={class:"flex items-center justify-center p-2.5 xl:p-5"},Z={class:"font-medium text-black dark:text-white"},ee={class:"flex items-center justify-center p-2.5 xl:p-5"},te={class:"font-medium text-black dark:text-white"},se={class:"flex items-center justify-center p-2.5 xl:p-5"},re={class:"font-medium text-black dark:text-white"},oe={class:"flex items-center justify-center p-2.5 xl:p-5"},ae={class:"font-medium text-black dark:text-white"},ne={class:"flex items-center justify-center p-2.5 xl:p-5"},ie={class:"font-medium text-black dark:text-white"};function ce(t,o,i,_,a,r){return c(),l("div",J,[e("div",Q,[e("p",X,s(r.getName("fio")),1)]),e("div",Y,[e("p",Z,s(r.getName("position")),1)]),e("div",ee,[e("p",te,s(r.getName("login")),1)]),e("div",se,[e("p",re,s(r.getName("color")),1)]),e("div",oe,[e("p",ae,s(r.getName("serial_number")),1)]),e("div",ne,[e("p",ie,s(r.getName("actions")),1)])])}const le=g(G,[["render",ce],["__scopeId","data-v-83fec972"]]),de={data(){return{order:"asc",search:"",column:"id"}},methods:{getName(t){return p().getName(t)}}},ue={class:"grid grid-cols-7 border-b border-stroke dark:border-strokedark sm:grid-cols-7 overflow-x-auto media_header"},me={class:"flex items-center justify-content-end p-2.5 xl:p-5"},_e={class:"font-medium text-black dark:text-white"},pe={class:"flex items-center justify-center p-2.5 xl:p-5"},he={class:"font-medium text-black dark:text-white"},fe={class:"flex items-center justify-center p-2.5 xl:p-5"},xe={class:"font-medium text-black dark:text-white"},ge={class:"flex items-center justify-center p-2.5 xl:p-5"},be={class:"font-medium text-black dark:text-white"},ke={class:"flex items-center justify-center p-2.5 xl:p-5"},ve={class:"font-medium text-black dark:text-white"},ye={class:"flex items-center justify-center p-2.5 xl:p-5"},we={class:"font-medium text-black dark:text-white"},Ne={class:"flex items-center justify-center p-2.5 xl:p-5"},Pe={class:"font-medium text-black dark:text-white"};function Se(t,o,i,_,a,r){return c(),l("div",ue,[e("div",me,[e("p",_e,s(r.getName("name_content")),1)]),e("div",pe,[e("p",he,s(r.getName("Bar_code")),1)]),e("div",fe,[e("p",xe,s(r.getName("SizeType")),1)]),e("div",ge,[e("p",be,s(r.getName("Amount")),1)]),e("div",ke,[e("p",ve,s(r.getName("price")),1)]),e("div",ye,[e("p",we,s(r.getName("TotalAmount")),1)]),e("div",Ne,[e("p",Pe,s(r.getName("actions")),1)])])}const Ce=g(de,[["render",Se],["__scopeId","data-v-b1ba0bd8"]]),je={components:{Input01:O,Paginate:L,Pagination01:z,Table:H,Input:$,VueAwesomePaginate:I,PaginateBtn:E,TableHeader:Ce},setup(){return{useConterStore:p}},props:{Treatments:{type:[Array,Object],default:[]},Header:{type:Boolean,default:!0}},data(){return{items:[],search:"",column:"updated_at",order:"asc",paginateCount:10,pagination:{},last_page:0,currentPage:1,password_1:".",password_2:"",isPasswordError:!1,ExitModal:!1,isModal:!1,Duration:0,service_id:"",isShowModal:!1,errorObj:[],UpdateId:0,crud:"",Employees:[],Employee_id:0,DateTime:"",TextData:"",Time:"0",patient_id:0,SearchPrducts:"",Products:[],SearchText:"",Summ:0,isError:"",categoryName:"",price:""}},methods:{router(){return router},removeItem(t){this.Products=this.Products.filter(o=>o.id!=t.id)},validate(){return this.isError=[],this.Summ=0,this.Products.forEach(t=>{let o=t.amount.toString(),i=t.price.toString();o.indexOf("e")!=-1||o.length==0||i.indexOf("e")!=-1||i.length==0?this.isError.push(t.id):parseInt(o)<0||o.slice(0,1)=="0"||parseInt(i)<0||i.slice(0,1)=="0"?this.isError.push(t.id):this.Summ+=Number(t.amount)*Number(t.price)}),this.isError.length==0},async sendData(){if(this.validate()&&this.Products.length!=0){var t={id:this.$route.query.id,products:this.Products};console.log("Products",this.Products);const o=await V(t);console.log(o),o.status?(j("success","Save successfully !"),this.$emit("Created",!0)):this.errorObj=o.data}else j("error","There is an error in the form")},addTodo(t){let o=!1;this.Products.forEach(i=>{if(i.id==t.id){o=!0;return}}),o||this.Products.push({id:t.id,product_document_id:this.$route.query.id,name:t.name,amount:1,price:t.price,bar_code:t.bar_code,size_type:t.size_type})},async productSearch(t){if(this.SearchText=t,t.length==0)return this.SearchPrducts=[],!0;var o={search:t,order:"asc",column:"updated_at",paginate:10};const i=await A(o);console.log(i),this.SearchPrducts=i.data.items},Show(t){this.UpdateId=t,this.isShowModal=!0},onClickHandler(t){this.paginate=t,this.currentPage=t,this.getItems()},getName(t){return p().getName(t)},async getModel(){},async clickSearch(t,o){this.search=t,this.order=o,this.search,this.order,this.column,this.paginateCount},hasKey(t){return this.errorObj.hasOwnProperty(t)},onSearch(t){this.order=t,this.clickSearch()},onPaginate(t){this.paginateCount=t,this.getItems()}},mounted(){}},Te={class:"col-span-12 xl:col-span-12"},Ie={class:"rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"},Ee={class:"mb-6 text-xl font-bold text-black dark:text-white"},$e={class:"flex flex-col table_media_box"},ze={key:0,class:"grid grid-cols-3 rounded-sm mb-2 sm:grid-cols-5 relative media_top_bar"},Le={selected:"",value:"sort_order"},He=e("option",{value:"id"},"Id",-1),Oe={value:"start"},Be={value:"first_name"},De={value:"last_name"},Me={value:"status"},Ve={value:"created_at"},Ae={value:"updated_at"},Ue={class:"ml-4 flex btn01"},qe=["title"],We=e("path",{fill:"currentColor",d:"M6 17.59L7.41 19L12 14.42L16.59 19L18 17.59l-6-6z"},null,-1),Fe=e("path",{fill:"currentColor",d:"m6 11l1.41 1.41L12 7.83l4.59 4.58L18 11l-6-6z"},null,-1),Ke=[We,Fe],Re=["title"],Ge=e("path",{fill:"currentColor",d:"M18 6.41L16.59 5L12 9.58L7.41 5L6 6.41l6 6z"},null,-1),Je=e("path",{fill:"currentColor",d:"m18 13l-1.41-1.41L12 16.17l-4.59-4.58L6 13l6 6z"},null,-1),Qe=[Ge,Je],Xe={class:"ml-4"},Ye=e("option",{value:"10"},"10",-1),Ze=e("option",{value:"20"},"20",-1),et=e("option",{value:"50"},"50",-1),tt=e("option",{value:"100"},"100",-1),st=[Ye,Ze,et,tt],rt={class:"grid tableBox2 grid-cols-7 border-b border-stroke dark:border-strokedark sm:grid-cols-7"},ot={class:"flex items-center gap-3 p-2.5 xl:p-5"},at={class:"font-medium text-black dark:text-white sm:block"},nt={class:"flex items-center justify-center p-2.5 xl:p-5"},it={class:"font-medium text-black dark:text-white"},ct={class:"flex items-center justify-center p-2.5 xl:p-5"},lt={class:"font-medium text-black dark:text-white"},dt={class:"flex items-center justify-center p-2.5 xl:p-5"},ut={class:"flex items-center justify-center p-2.5 xl:p-5"},mt={class:"flex items-center justify-center p-2.5 xl:p-5"},_t={class:"font-medium text-black dark:text-white"},pt={class:"flex items-center justify-center p-2.5 sm:flex xl:p-5"},ht={class:"font-medium text-meta-5"},ft=["onClick"],xt={style:{display:"flex","justify-content":"flex-end"}},gt={style:{color:"#0b7fef","margin-top":"10px","font-size":"25px"}},bt={key:1,style:{color:"#d7123e"}},kt=e("br",null,null,-1),vt={style:{width:"300px"},class:"save_button"},yt={class:"table_search table01"},wt=["onClick"];function Nt(t,o,i,_,a,r){const b=u("TableHeader"),h=u("Input01"),k=u("Input"),v=u("vue-awesome-paginate"),d=u("Pagination01"),P=u("Paginate");return c(),l("div",Te,[e("div",Ie,[e("h4",Ee,s(r.getName("Products")),1),e("div",$e,[i.Header?(c(),l("div",ze,[e("div",null,[e("input",{type:"text",placeholder:"Search",onInput:o[0]||(o[0]=n=>r.clickSearch(n.target.value,a.order)),class:"w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"},null,32)]),e("div",null,[e("select",{placeholder:"Search",onInput:o[1]||(o[1]=n=>a.column=n.target.value),class:"w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"},[e("option",Le,s(r.getName("serial_number")),1),He,e("option",Oe,s(r.getName("TreatmentStarted_at")),1),e("option",Be,s(r.getName("name")),1),e("option",De,s(r.getName("last_name")),1),e("option",Me,s(r.getName("New")),1),e("option",Ve,s(r.getName("Created_at")),1),e("option",Ae,s(r.getName("Updated_at")),1)],32)]),e("div",Ue,[(c(),l("svg",{onClick:o[2]||(o[2]=n=>r.clickSearch(a.search,"asc")),title:r.getName("growth"),class:T(a.order=="asc"?"active":""),xmlns:"http://www.w3.org/2000/svg",width:"32",height:"32",viewBox:"0 0 24 24"},Ke,10,qe)),(c(),l("svg",{onClick:o[3]||(o[3]=n=>r.clickSearch(a.search,"desc")),class:T(a.order=="desc"?"active":""),title:r.getName("decrease"),xmlns:"http://www.w3.org/2000/svg",width:"32",height:"32",viewBox:"0 0 24 24"},Qe,10,Re))]),e("div",Xe,[e("select",{placeholder:"Search",onInput:o[4]||(o[4]=n=>r.onPaginate(n.target.value)),class:"w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"},st,32)])])):y("",!0),m(b),(c(!0),l(S,null,C(a.Products,(n,f)=>(c(),l("div",rt,[e("div",ot,[e("p",at,s(f+1)+". "+s(n.name),1)]),e("div",nt,[e("p",it,s(n.bar_code),1)]),e("div",ct,[e("p",lt,s(n.size_type=="piece"?"dona":n.size_type),1)]),e("div",dt,[m(h,{class:"type_input",type:"number",onInput:w=>(a.Products[f].amount=w.target.value,r.validate()),value:n.amount,isError:a.isError.indexOf(n.id)!=-1},null,8,["onInput","value","isError"])]),e("div",ut,[m(h,{class:"type_input",type:"number",onInput:w=>(a.Products[f].price=w.target.value,r.validate()),value:n.price,isError:a.isError.indexOf(n.id)!=-1},null,8,["onInput","value","isError"])]),e("div",mt,[e("p",_t,s(_.useConterStore().formatNumber(a.Products[f].price*a.Products[f].amount))+" uzs",1)]),e("div",pt,[e("p",ht,[e("i",{onClick:w=>(r.removeItem(n),r.validate()),class:"fa-solid text-danger fa-trash setting-icon"},null,8,ft)])])]))),256)),e("div",xt,[e("p",gt,"Sum: "+s(_.useConterStore().formatNumber(a.Summ))+" uzs",1)]),a.isError.length!=0?(c(),l("p",bt,"There is an error")):y("",!0),kt,e("div",vt,[m(k,{Label:"",Pholder:"Search product...",onOnInput:o[5]||(o[5]=n=>r.productSearch(n)),Value:a.SearchText},null,8,["Value"]),e("button",{onClick:o[6]||(o[6]=n=>r.sendData()),style:{height:"50px"},class:"flex justify-center rounded bg-primary p-3 font-medium text-gray"},s(r.getName("Save")),1)]),e("table",yt,[(c(!0),l(S,null,C(a.SearchPrducts,n=>(c(),l("tr",{onClick:f=>r.addTodo(n)},[e("td",null,s(n.name),1),e("td",null,s(n.price_format)+" uzs",1),e("td",null,s(n.size_type),1)],8,wt))),256))]),m(P,null,{default:x(()=>[m(d,null,{default:x(()=>[m(v,{"total-items":a.last_page,"items-per-page":1,"max-pages-shown":1,modelValue:a.currentPage,"onUpdate:modelValue":o[7]||(o[7]=n=>a.currentPage=n),"on-click":r.onClickHandler},null,8,["total-items","modelValue","on-click"])]),_:1})]),_:1})])])])}const Pt=g(je,[["render",Nt]]),St={data(){return{order:"asc",search:"",column:"id"}},methods:{getName(t){return p().getName(t)}}},Ct={class:"grid grid-cols-6 border-b border-stroke dark:border-strokedark sm:grid-cols-6 overflow-x-auto media_header"},jt={class:"flex items-center justify-content-end p-2.5 xl:p-5"},Tt={class:"font-medium text-black dark:text-white"},It={class:"flex items-center justify-center p-2.5 xl:p-5"},Et={class:"font-medium text-black dark:text-white"},$t={class:"flex items-center justify-center p-2.5 xl:p-5"},zt={class:"font-medium text-black dark:text-white"},Lt={class:"flex items-center justify-center p-2.5 xl:p-5"},Ht={class:"font-medium text-black dark:text-white"},Ot={class:"flex items-center justify-center p-2.5 xl:p-5"},Bt={class:"font-medium text-black dark:text-white"},Dt={class:"flex items-center justify-center p-2.5 xl:p-5"},Mt={class:"font-medium text-black dark:text-white"};function Vt(t,o,i,_,a,r){return c(),l("div",Ct,[e("div",jt,[e("p",Tt,s(r.getName("name_content")),1)]),e("div",It,[e("p",Et,s(r.getName("Bar_code")),1)]),e("div",$t,[e("p",zt,s(r.getName("SizeType")),1)]),e("div",Lt,[e("p",Ht,s(r.getName("Amount")),1)]),e("div",Ot,[e("p",Bt,s(r.getName("price")),1)]),e("div",Dt,[e("p",Mt,s(r.getName("TotalAmount")),1)])])}const At=g(St,[["render",Vt],["__scopeId","data-v-eb1af1ec"]]),Ut={setup(){return{useConterStore:p}},components:{Input01:O,Paginate:L,Pagination01:z,Table:H,Input:$,VueAwesomePaginate:I,PaginateBtn:E,TableHeader:At},props:{Treatments:{type:[Array,Object],default:[]},Header:{type:Boolean,default:!0}},data(){return{items:[],search:"",column:"updated_at",order:"asc",paginateCount:10,pagination:{},last_page:0,currentPage:1,password_1:".",password_2:"",isPasswordError:!1,ExitModal:!1,isModal:!1,Duration:0,service_id:"",isShowModal:!1,errorObj:[],UpdateId:0,crud:"",Employees:[],Employee_id:0,DateTime:"",TextData:"",Time:"0",patient_id:0,SearchPrducts:"",Products:[],SearchText:"",Summ:0,isError:"",categoryName:"",price:""}},methods:{router(){return router},validate(){return this.isError=[],this.Summ=0,this.Products.forEach(t=>{let o=t.amount.toString(),i=t.price.toString();o.indexOf("e")!=-1||o.length==0||i.indexOf("e")!=-1||i.length==0?this.isError.push(t.id):parseInt(o)<0||o.slice(0,1)=="0"||parseInt(i)<0||i.slice(0,1)=="0"?this.isError.push(t.id):this.Summ+=Number(t.amount)*Number(t.price)}),this.isError.length==0},async getDocumentProducts(){const t=await U(this.$route.query.id);this.Products=t.data.items,console.log("Response;",t),this.Products.forEach(o=>{this.Summ+=Number(o.price)*Number(o.amount)})},onClickHandler(t){this.paginate=t,this.currentPage=t,this.getItems()},getName(t){return p().getName(t)},async getModel(){},hasKey(t){return this.errorObj.hasOwnProperty(t)},onSearch(t){this.order=t,this.clickSearch()},onPaginate(t){this.paginateCount=t,this.getItems()}},mounted(){this.getDocumentProducts()}},qt={class:"col-span-12 xl:col-span-12"},Wt={class:"rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"},Ft={class:"mb-6 text-xl font-bold text-black dark:text-white"},Kt={class:"flex flex-col table_media_box"},Rt={class:"grid tableBox2 grid-cols-6 border-b border-stroke dark:border-strokedark sm:grid-cols-6"},Gt={class:"flex items-center gap-3 p-2.5 xl:p-5"},Jt={class:"font-medium text-black dark:text-white sm:block"},Qt={class:"flex items-center justify-center p-2.5 xl:p-5"},Xt={class:"font-medium text-black dark:text-white"},Yt={class:"flex items-center justify-center p-2.5 xl:p-5"},Zt={class:"font-medium text-black dark:text-white"},es={class:"flex items-center justify-center p-2.5 xl:p-5"},ts={class:"font-medium text-black dark:text-white"},ss={class:"flex items-center justify-center p-2.5 xl:p-5"},rs={class:"font-medium text-black dark:text-white"},os={class:"flex items-center justify-center p-2.5 xl:p-5"},as={class:"font-medium text-black dark:text-white"},ns={style:{display:"flex","justify-content":"flex-end"}},is={style:{color:"#0b7fef","margin-top":"10px","font-size":"25px"}};function cs(t,o,i,_,a,r){const b=u("TableHeader"),h=u("vue-awesome-paginate"),k=u("Pagination01"),v=u("Paginate");return c(),l("div",qt,[e("div",Wt,[e("h4",Ft,s(r.getName("Products")),1),e("div",Kt,[m(b),(c(!0),l(S,null,C(a.Products,(d,P)=>(c(),l("div",Rt,[e("div",Gt,[e("p",Jt,s(P+1)+". "+s(d.name),1)]),e("div",Qt,[e("p",Xt,s(d.bar_code),1)]),e("div",Yt,[e("p",Zt,s(d.size_type=="piece"?"dona":d.size_type),1)]),e("div",es,[e("p",ts,s(_.useConterStore().formatNumber(d.amount)),1)]),e("div",ss,[e("p",rs,s(_.useConterStore().formatNumber(d.price))+" uzs ",1)]),e("div",os,[e("p",as,s(_.useConterStore().formatNumber(Number(d.price)*Number(d.amount)))+" uzs",1)])]))),256)),e("div",ns,[e("p",is,"Sum: "+s(_.useConterStore().formatNumber(a.Summ))+" uzs",1)]),m(v,null,{default:x(()=>[m(k,null,{default:x(()=>[m(h,{"total-items":a.last_page,"items-per-page":1,"max-pages-shown":1,modelValue:a.currentPage,"onUpdate:modelValue":o[0]||(o[0]=d=>a.currentPage=d),"on-click":r.onClickHandler},null,8,["total-items","modelValue","on-click"])]),_:1})]),_:1})])])])}const ls=g(Ut,[["render",cs]]),ds={components:{Loader:R,Map01:B,ContentBlock:F,ContentBox:W,Contents:D,TableHeader:le,ProductsTable:Pt,Payments:K,TableIndex:ls},data(){return{Patient:[],search:"",column:"sort_order",order:"asc",paginate:10,pagination:{},current_page:1,Document:null,Name:"",Warehouse:"",User:"",created_at:"",Supplier:"",Status:0}},methods:{router(){return router},getName(t){return p().getName(t)},async getItem(){const t=await q(this.$route.query.id);this.Name=t.data.name,this.Warehouse=t.data.warehouse,this.User=t.data.user,this.created_at=t.data.created_at,this.Supplier=t.data.supplier,this.Status=t.data.status}},mounted(){this.getItem()}},us={class:"col-span-12 xl:col-span-12"},ms={class:"mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between",style:{"justify-content":"flex-end"}},_s={class:"flex items-center gap-2"},ps={class:"font-medium text-primary"},hs={class:"table01 mt-5"},fs=e("br",null,null,-1);function xs(t,o,i,_,a,r){const b=u("Loader"),h=u("Map01"),k=u("ProductsTable"),v=u("TableIndex");return c(),l("div",us,[e("div",ms,[e("nav",null,[e("ol",_s,[e("li",null,[e("a",{class:"font-medium cursor-pointer",onClick:o[0]||(o[0]=d=>this.$router.push("/product-documents"))},s(r.getName("Documents"))+" /",1)]),e("li",ps,s(r.getName("AddProduct")),1)])])]),m(h,{Title:""},{default:x(()=>[e("table",hs,[e("tr",null,[e("th",null,s(r.getName("name_content"))+"   ",1),e("th",null,s(r.getName("Warehouse"))+"   ",1),e("th",null,s(r.getName("CreatedUser"))+"   ",1),e("th",null,s(r.getName("Created_at"))+"  ",1),e("th",null,s(r.getName("Supplier"))+"  ",1)]),e("tr",null,[e("td",null,s(a.Name)+"   ",1),e("td",null,s(a.Warehouse)+"  ",1),e("td",null,s(a.User)+"   ",1),e("td",null,s(a.created_at)+"   ",1),e("td",null,s(a.Supplier)+"   ",1)])]),a.Name==""?(c(),N(b,{key:0})):y("",!0)]),_:1}),fs,a.Status!=13?(c(),N(k,{key:0,onCreated:o[1]||(o[1]=d=>r.getItem()),Header:!1})):y("",!0),a.Status==13?(c(),N(v,{key:1})):y("",!0)])}const gs=g(ds,[["render",xs]]),qs={__name:"index",setup(t){return(o,i)=>(c(),N(M,{Animation:!1},{default:x(()=>[m(gs)]),_:1}))}};export{qs as default};
