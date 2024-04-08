import{P as C}from"./Page-mAivDXea.js";import{_ as k,u as x,o as l,c as u,a as t,t as o,n as f,e as I,i as m,a9 as D,r as h,d as U,w as b,K as z,L as K,Z as M,ab as R,A as _,ac as H,ad as q,a1 as S,ae as Z,af as Q,br as Y,ah as G,bs as J,b as c,F as N,v as P,z as W,m as T}from"./app-8i59_tig.js";import{I as X}from"./Input-AJAfOiLl.js";import{I as $}from"./InputDefault-8H7puYZk.js";import{M as E}from"./Switch-aMALSFy7.js";import ee from"./CreateForm-FMLZ0r2-.js";import{_ as te}from"./pagination-01.vue_vue_type_style_index_0_lang-WLTl4Kz3.js";import{P as se}from"./paginate-8X5YIlX3.js";import{i as re}from"./InputText-AWTKh5l3.js";import{T as ae}from"./Textarea-wKIrbfyC.js";import{I as ne,a as oe}from"./InputTime-7iBC3f2i.js";import{T as le}from"./Table-ZWPqNDPs.js";import{S as ie}from"./Select-YcpyyNbB.js";import{P as ue}from"./PrimaryButton2-zUn7s8oD.js";import{D as de}from"./DangerButton-NFp56Med.js";import{C as ce}from"./Checkbox01-rD0XVLDM.js";import"./Input-fJbOcXUa.js";import"./Loader-gbTB4BrO.js";import"./Table-U6DySGSG.js";import"./InputColor-s0cIO5la.js";const me={data(){return{order:"asc",search:"",column:"id"}},methods:{getName(e){return x().getName(e)}}},he={class:"grid grid-cols-7 border-b border-stroke dark:border-strokedark sm:grid-cols-7 overflow-x-auto"},_e={class:"flex items-center justify-center p-2.5 xl:p-5"},pe={class:"font-medium text-black dark:text-white"},fe={class:"flex items-center justify-center p-2.5 xl:p-5"},ge={class:"font-medium text-black dark:text-white"},ye={class:"flex items-center justify-center p-2.5 xl:p-5"},be={class:"font-medium text-black dark:text-white"},ke={class:"flex items-center justify-center p-2.5 xl:p-5"},xe={class:"font-medium text-black dark:text-white"},we={class:"flex items-center justify-center p-2.5 xl:p-5"},ve={class:"font-medium text-black dark:text-white"},Ne={class:"flex items-center justify-center p-2.5 xl:p-5"},Pe={class:"font-medium text-black dark:text-white"},Me={class:"flex items-center justify-center p-2.5 xl:p-5"},Se={class:"font-medium text-black dark:text-white"};function Te(e,r,i,d,a,s){return l(),u("div",he,[t("div",_e,[t("p",pe,o(s.getName("name")),1)]),t("div",fe,[t("p",ge,o(s.getName("last_name")),1)]),t("div",ye,[t("p",be,o(s.getName("Doctor")),1)]),t("div",ke,[t("p",xe,o(s.getName("TreatmentStarted_at")),1)]),t("div",we,[t("p",ve,o(s.getName("status")),1)]),t("div",Ne,[t("p",Pe,o(s.getName("Payment_status")),1)]),t("div",Me,[t("p",Se,o(s.getName("actions")),1)])])}const Ce=k(me,[["render",Te],["__scopeId","data-v-1b759093"]]),Ie={props:{number:{type:Number,default:0},active:{type:Boolean,default:!1},link:{type:String,default:0}}};function De(e,r,i,d,a,s){return l(),u("a",{class:f([i.active?"active":"","cursor-pointer"])},o(i.number),3)}const Ue=k(Ie,[["render",De]]),Ee={props:{Couple:{type:Boolean,default:!0},Label:{type:String,default:"Input label"},Value:{type:[String,Boolean,Number],default:""},Type:{type:String,default:"text"},isError:{type:Boolean,default:!1},isLoginError:{type:Boolean,default:!1},message:{type:String,default:""}}},Le={class:"mb-2.5 block text-black dark:text-white"},je={key:0,class:"text-danger"};function Oe(e,r,i,d,a,s){return l(),u("div",{class:f(i.Couple?"mb-4.5":"w-full xl:w-1/2")},[t("label",Le,o(i.Label),1),t("select",{onInput:r[0]||(r[0]=p=>this.$emit("onSelect",p.target.value)),class:"w-full rounded border-[1.5px] border-stroke bg-transparent px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"},[I(e.$slots,"default")],32),i.isError?(l(),u("p",je,o(i.message),1)):m("",!0)],2)}const Be=k(Ee,[["render",Oe]]),Ve={props:{Couple:{type:Boolean,default:!0},Label:{type:String,default:"Input label"},Value:{type:[String,Boolean,Number],default:""},Type:{type:String,default:"text"},isError:{type:Boolean,default:!1},isLoginError:{type:Boolean,default:!1},message:{type:String,default:""}}},Fe={class:"mb-2.5 block text-black dark:text-white"},Ae=["value","type"],ze={key:0,class:"text-danger"};function Ke(e,r,i,d,a,s){return l(),u("div",{class:f(i.Couple?"mb-4.5":"w-full xl:w-1/2")},[t("label",Fe,o(i.Label),1),t("input",{value:i.Value,type:i.Type,min:"0",class:f([i.isError==!0?"isError":"","w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"]),placeholder:"...",onInput:r[0]||(r[0]=p=>this.$emit("onInput",p.target.value))},null,42,Ae),i.isError?(l(),u("p",ze,o(i.message),1)):m("",!0)],2)}const Re=k(Ve,[["render",Ke]]),He={components:{Select:ie,ModalLayout:E,Input:Re,Page:C},data(){return{status:1,categoryName:"",errorObj:{},Model:[],doctor:[],Patient:[]}},props:{isShowModal:{type:Boolean,default:!1},UpdateId:{type:Number,default:!1}},methods:{getName(e){return x().getName(e)},getClass(e){return e==10?"unmount":e==11?"fullUnmount":""},getStatus(e){if(e==7)return this.getName("New");if(e==8)return this.getName("DoctorFinished");if(e==9)return this.getName("Finished");if(e==10)return this.getName("Unpaint");if(e==11)return this.getName("NotFullPaint");if(e==12)return this.getName("Closed")},hasKey(e){return e in this.errorObj},async getModal(){const e=await D(this.UpdateId);this.Model=e.data,this.doctor=e.data.doctor,this.Patient=e.data.patient}},watch:{UpdateId:function(e,r){this.getModal()}}};function qe(e,r,i,d,a,s){const p=h("ModalLayout");return l(),U(p,{onOnButton:r[0]||(r[0]=y=>this.$emit("onSubmit",!0)),isModal:i.isShowModal,onCloseModal:r[1]||(r[1]=y=>this.$emit("closeModal",y)),Title:a.Patient.last_name!=null?a.Patient.last_name+" "+a.Patient.first_name:""},{default:b(()=>[I(e.$slots,"default",{},void 0,!0)]),_:3},8,["isModal","Title"])}const Ze=k(He,[["render",qe],["__scopeId","data-v-3c80d235"]]),Qe={setup(){const e=x();return{useConterStore:x,counterStore:e}},components:{Checkbox01:ce,DangerButton:de,PrimaryButton2:ue,ShowForm:Ze,Table:le,Paginate:se,InputTime:ne,InputDateTime:oe,Pagination01:te,CreateForm:ee,Textarea:ae,ModalLayout:E,Input:X,VueAwesomePaginate:z,InputDefault:$,PaginateBtn:Ue,TableHeader:Ce,InputText:re,Select:Be},props:{Treatments:{type:[Array,Object],default:[]},Header:{type:Boolean,default:!0}},data(){return{items:[],search:"",column:"updated_at",userPayments:0,order:"asc",paginateCount:10,pagination:{},last_page:0,currentPage:1,password_1:".",password_2:"",isPasswordError:!1,ExitModal:!1,isPaymentModal:!1,Duration:0,service_id:"",PaymentType:"",Amount:"",isShowModal:!1,errorObj:[],UpdateId:0,crud:"",Employees:[],Employee_id:0,DateTime:"",TextData:"",Time:"0",Modal:0,Item:[],patient_id:0,status:1,categoryName:"",Model:[],doctor:[],Patient:[],paymentTypes:[],PatientId:"",debtUser:"doctor",debtData:"",debtText:"",patientPayments:[],discount_percent:0,discount_sum:0,discount_total_sum:0,RealPrice:0,discountError:!1}},methods:{router(){return K},async getEmployee(){const e=await M(null,1e3);this.Employees=e.data.employees},sumInput(e){this.discount_sum=e,this.RealPrice>0?this.discount_percent=100*e/this.RealPrice:this.discount_percent=0},percentInput(e){Number(e)>100?this.discount_percent=100:this.discount_percent=e,this.RealPrice>0?this.discount_sum=this.RealPrice*e/100:this.discount_sum=0},async treatementFinished(e){const r=await R(e);console.log(r),r.status?(_("success","Treatment is complete"),this.getItems()):_("error","Error!")},debtModal(e){this.Item=e,this.debtUser="doctor",this.Modal="debt",this.getDate(),this.UpdateId=e.id,this.isShowModal=!0},discountModal(e){this.Item=e,this.debtUser=e.type_of_discount!=15?"doctor":"polyclinic",this.Modal="discount",this.discount_sum=e.discount_sum,this.discount_percent=e.discount_percent,this.discount_total_sum=Number(e.user_payment),this.RealPrice=e.service_real_price,this.UpdateId=e.id,this.isShowModal=!0,console.log("Item",e)},istoryPaymentModal(e){this.Item=e,this.Modal="istory-payment",this.patientPayments=[],this.getPatientPayments(e.patient_id),this.UpdateId=e.id,this.isShowModal=!0},paymentNumberFormat(e){const r=document.querySelector(".format_input");["0","1","2","3","4","5","6","7","8","9"," ",""].includes(e.slice(e.length-1,e.length))==!0?(r.value=this.counterStore.formatNumber(e),this.Amount=Number(e.replace(/\s+/g,""))):r.value=this.counterStore.formatNumber(this.Amount),console.log("trih",this.Amount)},async getModal(){const e=await D(this.UpdateId);this.Model=e.data,this.doctor=e.data.doctor,this.Patient=e.data.patient},async sendDiscount(){if(this.discount_sum>this.discount_total_sum)return this.discountError=!0,console.log("error fkfr0",this.discount_sum),!0;let e={discount_sum:this.discount_sum,discount_percent:this.discount_percent,discount_total_sum:this.discount_total_sum,discounter:this.debtUser=="doctor"?16:15,treatment_id:this.Item.id};const r=await H(e);console.log("response:",r),r.status?(this.debtUser="",this.discount_sum=0,this.discount_total_sum=0,this.discount_percent=0,this.errorObj=[],this.isShowModal=!1,this.getItems(),_("success","Saved successfully !")):(this.errorObj=r.data,_("error","There is an error in the form"))},async saveOwed(){let e={patient_id:this.Item.patient_id,authorizing:this.debtUser,treatment_id:this.Item.id,return_at:this.debtData,description:this.debtText};const r=await q(e);console.log("Response:->",r),r.status?(this.debtUser="",this.debtData="",this.debtText="",this.isShowModal=!1,_("success","Saved successfully !")):(this.errorObj=r.data,_("error","There is an error in the form"))},async getPatientPayments(e){const r=await S(e);this.patientPayments=r.data.payments.items,console.log("Payment:",r.data.payments.items)},async getPayments(e){return(await Z(e)).data},async getPaymentTypes(){const e=await Q(1,1e3);this.paymentTypes=e.data.items},getDate(){const e=new Date,r=e.getFullYear(),i=("0"+(e.getMonth()+1)).slice(-2),d=("0"+e.getDate()).slice(-2),a=("0"+e.getHours()).slice(-2),s=("0"+e.getMinutes()).slice(-2);var p=`${r}-${i}-${d} ${a}:${s}`,y=`${r}-${i}-${d}`;this.DateTime=p,this.debtData=y},Show(e){this.Model=[],this.Model=e,this.Modal=0,this.UpdateId=e.id,this.isShowModal=!0},paymentModal(e){this.Modal=1,this.UpdateId=e.id,this.PatientId=e.patient_id,this.userPayments=e.user_payment,this.isShowModal=!0,this.Modal="payment"},onClickHandler(e){this.paginate=e,this.currentPage=e,this.getItems()},async getEmployees(){await M(null,1e3)},onModal(e){this.service_id=e,this.isPaymentModal=!0},getName(e){return x().getName(e)},openModal(){document.querySelector(".modal").classList.remove("hidden")},async getItems(){const e=await Y(this.currentPage,this.paginateCount);this.pagination=e.data.pagination,this.last_page=e.data.pagination.last_page,this.current_page=e.data.pagination.currentPage,this.items=e.data.items},async onPayment(){if(this.Modal=="debt")return this.saveOwed(),!0;if(this.Modal=="discount")return this.sendDiscount(),!0;if(this.userPayments<this.Amount)return _("error",this.getName("PaymentError")),!1;const e={patient_id:this.PatientId,payment_type_id:this.PaymentType,treatment_id:this.UpdateId,amount:this.Amount},r=await G(e);console.log("Response:",r),r.status?(this.PaymentType="",this.PatientId="",this.Amount="",this.isShowModal=!1,this.paymentTypes=[],this.getPaymentTypes(),this.getItems(),_("success","The payment was made successfully")):(this.errorObj=r.data,_("error","There is an error in the form"))},async getModel(){(await S(this.$route.query.id)).status},async editPassword(e){this.password_1=e,e==this.password_2},async clickSearch(e,r){this.search=e,this.order=r;var i={search:this.search,order:this.order,column:this.column,paginate:this.paginateCount};const d=await J(i);console.log("respons",d),this.items=d.data.items},async onDelete(e){var r="Вы уверены, что хотите это удалить?";confirm(r)&&(await patientDelete(e)).status==!0&&(_("success","Deleted successfully !"),this.getItems())},onCheck(e){return window.location.origin+"#/check?id="+e},hasKey(e){return this.errorObj.hasOwnProperty(e)},getStatus(e){if(e==7)return this.getName("New");if(e==8)return this.getName("DoctorFinished");if(e==9)return this.getName("Finished");if(e==10)return this.getName("Unpaint");if(e==11)return this.getName("NotFullPaint");if(e==12)return this.getName("Closed")},getClass(e){return e==10?"unmount":e==11||e==7?"fullUnmount":""},onSearch(e){this.order=e,this.clickSearch()},onPaginate(e){this.paginateCount=e,this.getItems()}},watch:{UpdateId:function(e,r){this.getModal()}},mounted(){this.getItems(),this.getEmployee(),this.getDate(),this.getPaymentTypes()}},Ye={class:"col-span-12 xl:col-span-12"},Ge={class:"rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"},Je={class:"mb-6 text-xl font-bold text-black dark:text-white"},We={class:"flex flex-col"},Xe={key:0,class:"grid grid-cols-3 rounded-sm mb-2 sm:grid-cols-5 relative"},$e={selected:"",value:"sort_order"},et=t("option",{value:"id"},"Id",-1),tt={value:"start"},st={value:"first_name"},rt={value:"last_name"},at={value:"status"},nt={value:"created_at"},ot={value:"updated_at"},lt={class:"ml-4 flex btn01"},it=["title"],ut=t("path",{fill:"currentColor",d:"M6 17.59L7.41 19L12 14.42L16.59 19L18 17.59l-6-6z"},null,-1),dt=t("path",{fill:"currentColor",d:"m6 11l1.41 1.41L12 7.83l4.59 4.58L18 11l-6-6z"},null,-1),ct=[ut,dt],mt=["title"],ht=t("path",{fill:"currentColor",d:"M18 6.41L16.59 5L12 9.58L7.41 5L6 6.41l6 6z"},null,-1),_t=t("path",{fill:"currentColor",d:"m18 13l-1.41-1.41L12 16.17l-4.59-4.58L6 13l6 6z"},null,-1),pt=[ht,_t],ft={class:"ml-4"},gt=t("option",{value:"10"},"10",-1),yt=t("option",{value:"20"},"20",-1),bt=t("option",{value:"50"},"50",-1),kt=t("option",{value:"100"},"100",-1),xt=[gt,yt,bt,kt],wt={class:"grid tableBox grid-cols-7 border-b border-stroke dark:border-strokedark sm:grid-cols-7 databes_table"},vt={class:"flex items-center gap-3 p-2.5 xl:p-5"},Nt={class:"font-medium hidden text-black dark:text-white sm:block"},Pt={class:"flex items-center justify-center p-2.5 xl:p-5"},Mt={class:"font-medium text-black dark:text-white"},St={class:"flex items-center justify-center p-2.5 xl:p-5"},Tt={class:"font-medium text-black dark:text-white"},Ct={class:"flex items-center justify-center p-2.5 xl:p-5"},It={class:"font-medium text-black dark:text-white"},Dt={class:"flex items-center justify-center p-2.5 xl:p-5"},Ut={class:"flex items-center justify-center p-2.5 xl:p-5"},Et={class:"hidden button-box0 items-center justify-center p-2.5 sm:flex xl:p-5"},Lt={class:"font-medium text-meta-5 btns"},jt=["onClick"],Ot=["onClick"],Bt=["onClick","title"],Vt=["onClick","title"],Ft=["onClick","title"],At=["onClick","title"],zt=["onClick","title"],Kt=["href"],Rt=["title"],Ht=["onClick","title"],qt={key:0,class:"table01"},Zt={key:1,class:"table01"},Qt={key:2},Yt=t("br",null,null,-1),Gt={class:"flex"},Jt=t("br",null,null,-1),Wt={key:3},Xt=t("br",null,null,-1),$t={key:0,class:"text-danger"},es=t("br",null,null,-1),ts={class:"flex"},ss=t("br",null,null,-1),rs={key:4},as=t("option",{selected:""},"---",-1),ns=["value"];function os(e,r,i,d,a,s){const p=h("TableHeader"),y=h("vue-awesome-paginate"),L=h("Pagination01"),j=h("Paginate"),w=h("Checkbox01"),v=h("Input"),O=h("Textarea"),B=h("DangerButton"),V=h("Select"),F=h("ShowForm");return l(),u("div",Ye,[t("div",Ge,[t("h4",Je,o(s.getName("DebtTreatments")),1),t("div",We,[i.Header?(l(),u("div",Xe,[t("div",null,[t("input",{type:"text",placeholder:"Search",onInput:r[0]||(r[0]=n=>s.clickSearch(n.target.value,a.order)),class:"w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"},null,32)]),t("div",null,[t("select",{placeholder:"Search",onInput:r[1]||(r[1]=n=>a.column=n.target.value),class:"w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"},[t("option",$e,o(s.getName("serial_number")),1),et,t("option",tt,o(s.getName("TreatmentStarted_at")),1),t("option",st,o(s.getName("name")),1),t("option",rt,o(s.getName("last_name")),1),t("option",at,o(s.getName("New")),1),t("option",nt,o(s.getName("Created_at")),1),t("option",ot,o(s.getName("Updated_at")),1)],32)]),t("div",lt,[(l(),u("svg",{onClick:r[2]||(r[2]=n=>s.clickSearch(a.search,"asc")),title:s.getName("growth"),class:f(a.order=="asc"?"active":""),xmlns:"http://www.w3.org/2000/svg",width:"32",height:"32",viewBox:"0 0 24 24"},ct,10,it)),(l(),u("svg",{onClick:r[3]||(r[3]=n=>s.clickSearch(a.search,"desc")),class:f(a.order=="desc"?"active":""),title:s.getName("decrease"),xmlns:"http://www.w3.org/2000/svg",width:"32",height:"32",viewBox:"0 0 24 24"},pt,10,mt))]),t("div",ft,[t("select",{placeholder:"Search",onInput:r[4]||(r[4]=n=>s.onPaginate(n.target.value)),class:"w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"},xt,32)])])):m("",!0),c(p),(l(!0),u(N,null,P(i.Treatments.length>0?i.Treatments:a.items,(n,A)=>(l(),u("div",wt,[t("div",vt,[t("p",Nt,o(A+1)+". "+o(n.patient.first_name),1)]),t("div",Pt,[t("p",Mt,o(n.patient.last_name),1)]),t("div",St,[t("p",Tt,o(n.doctor.name),1)]),t("div",Ct,[t("p",It,o(n.start)+" "+o(n.id),1)]),t("div",Dt,[t("p",{class:f(["font-medium text-black dark:text-white status-text",s.getClass(n.status)])},o(s.getStatus(n.status)),3)]),t("div",Ut,[t("p",{class:f(["font-medium dark:text-white status-text",s.getClass(n.payment_status)])},o(s.getStatus(n.payment_status)),3)]),t("div",Et,[t("p",Lt,[t("i",{onClick:g=>s.Show(n),class:"fa-solid setting-icon fa-eye"},null,8,jt),n.status==8&&n.payment_status!=12?(l(),u("i",{key:0,titile:"Tahrirlash",onClick:g=>this.$router.push({path:"/treatmetns/treatmetn",query:{id:n.patient_id,treatment_id:n.id}}),class:"fa-solid setting-icon fa-pen-to-square"},null,8,Ot)):m("",!0),n.status==7?(l(),u("i",{key:1,onClick:g=>this.$router.push({path:"/treatmetns/treatmetn",query:{id:n.patient_id,treatment_id:n.id}}),title:s.getName("Treatment"),class:"fa-regular setting-icon fa-calendar-plus cursor-pointer"},null,8,Bt)):m("",!0),n.payment_status!=12&&n.status!=7?(l(),u("i",{key:2,onClick:g=>(s.paymentModal(n),a.userPayments=n.user_payment),title:s.getName("Payments"),class:"fa-regular fas fa-donate setting-icon cursor-pointer"},null,8,Vt)):m("",!0),n.payment_status==11||n.payment_status==12?(l(),u("i",{key:3,title:"Tolov tarixi",onClick:g=>s.istoryPaymentModal(n),class:"fa-solid fa-clock-rotate-left setting-icon cursor-pointer"},null,8,Ft)):m("",!0),n.payment_status!=12&&n.status!=9&&n.status!=7?(l(),u("i",{key:4,title:"Chegirma berish",onClick:g=>s.discountModal(n),class:"fa-regular fas fa-percent setting-icon cursor-pointer"},null,8,At)):m("",!0),n.payment_status!=12&&n.status!=9&&n.status!=7?(l(),u("i",{key:5,title:"Qarzga bajarish",onClick:g=>s.debtModal(n),class:"fa-regular fas fa-coins setting-icon cursor-pointer"},null,8,zt)):m("",!0),t("a",{target:"_blank",href:s.onCheck(n.id)},[n.payment_status!=10?(l(),u("i",{key:0,title:"Tolov cheki",class:"fa-regular fas fa-print setting-icon cursor-pointer"},null,8,Rt)):m("",!0)],8,Kt),n.status!=9&&n.status!=7?(l(),u("i",{key:6,title:"Tugatish",onClick:g=>s.treatementFinished(n.id),class:"fa-regular fas fa-square-check setting-icon cursor-pointer"},null,8,Ht)):m("",!0)])])]))),256)),c(j,null,{default:b(()=>[c(L,null,{default:b(()=>[c(y,{"total-items":a.last_page,"items-per-page":1,"max-pages-shown":1,modelValue:a.currentPage,"onUpdate:modelValue":r[5]||(r[5]=n=>a.currentPage=n),"on-click":s.onClickHandler},null,8,["total-items","modelValue","on-click"])]),_:1})]),_:1})]),c(F,{onOnSubmit:r[16]||(r[16]=n=>a.Modal=="0"?a.isShowModal=!1:s.onPayment()),UpdateId:a.UpdateId,onCloseModal:r[17]||(r[17]=n=>(a.isShowModal=n,a.errorObj=[])),isShowModal:a.isShowModal},{default:b(()=>[a.Modal==0&&a.Model!=[]?(l(),u("table",qt,[t("tr",null,[t("th",null,o(s.getName("name"))+":   ",1),t("td",null,o(a.Patient.last_name),1)]),t("tr",null,[t("th",null,o(s.getName("last_name"))+":   ",1),t("td",null,o(a.Patient.first_name),1)]),t("tr",null,[t("th",null,o(s.getName("Doctor"))+":   ",1),t("td",null,o(a.doctor.name),1)]),t("tr",null,[t("th",null,o(s.getName("TreatmentStarted_at"))+":   ",1),t("td",null,o(a.Model.start),1)]),t("tr",null,[t("th",null,o(s.getName("Finished_at"))+":   ",1),t("td",null,o(a.Model.end),1)]),t("tr",null,[t("th",null,o(s.getName("PatientEndPayment"))+":   ",1),t("td",null,o(a.Model.latest_payment!=null?a.Model.latest_payment.amount:"0 UZS"),1)]),t("tr",null,[t("th",null,o(s.getName("AmountOwedType"))+":   ",1),t("td",null,o(a.Model.latest_payment!=null?a.Model.latest_payment.payment_type:"---"),1)]),t("tr",null,[t("th",null,o(s.getName("TreatmentPrice"))+":   ",1),t("td",null,o(d.useConterStore().formatNumber(Number(a.Model.service_real_price)))+" uzs",1)]),t("tr",null,[t("th",null,o(s.getName("PaymentsUser"))+":   ",1),t("td",null,o(d.useConterStore().formatNumber(Number(a.Model.payment_amount)))+" uzs",1)]),t("tr",null,[t("th",null,o(s.getName("AmountOwed"))+":   ",1),t("td",null,o(d.useConterStore().formatNumber(Number(a.Model.user_payment)))+" uzs",1)]),t("tr",null,[t("th",null,o(s.getName("Discount"))+":   ",1),t("td",null,o(d.useConterStore().formatNumber(Number(a.Model.discount_sum)))+" uzs",1)]),t("tr",null,[t("th",null,o(s.getName("Payment_status"))+":   ",1),t("td",null,[t("p",{class:f(["font-medium dark:text-white status-text",s.getClass(a.Model.payment_status)])},o(s.getStatus(a.Model.payment_status)),3)])])])):m("",!0),a.Modal=="istory-payment"&&a.Model!=[]?(l(),u("table",Zt,[t("tr",null,[t("th",null,o(s.getName("Amount")),1),t("th",null,o(s.getName("Created_at")),1),t("th",null,o(s.getName("Type")),1)]),(l(!0),u(N,null,P(a.patientPayments,n=>(l(),u("tr",null,[t("td",null,o(n.amount),1),t("td",null,o(n.created_at),1),t("td",null,[t("p",{class:"font-medium dark:text-white status-text",style:W("background: "+n.color)},o(n.payment_type),5)])]))),256))])):a.Modal=="debt"?(l(),u("div",Qt,[t("h1",null,o(s.getName("DebitTitle")),1),Yt,t("div",Gt,[c(w,{onClick:r[6]||(r[6]=n=>a.debtUser="doctor"),onCheck:a.debtUser=="doctor",Title:s.getName("Doctor")},null,8,["onCheck","Title"]),T("         "),c(w,{onClick:r[7]||(r[7]=n=>a.debtUser="polyclinic"),onCheck:a.debtUser=="polyclinic",Title:s.getName("PolyClinic")},null,8,["onCheck","Title"])]),Jt,c(v,{Label:s.getName("DebitData"),onOnInput:r[8]||(r[8]=n=>a.debtData=n),isError:s.hasKey("debt_data"),message:a.errorObj.debt_data,Type:"date",Value:"2024-03-01"},null,8,["Label","isError","message"]),c(O,{Label:s.getName("Description"),onOnInput:r[9]||(r[9]=n=>a.debtText=n),isError:s.hasKey("debt_text"),message:a.errorObj.debt_text,Value:a.debtText},null,8,["Label","isError","message","Value"])])):a.Modal=="discount"?(l(),u("div",Wt,[t("h1",null,o(s.getName("Summa"))+": "+o(d.counterStore.formatNumber(a.RealPrice))+" uzs",1),t("h1",null,o(s.getName("PaymentSum"))+": "+o(d.counterStore.formatNumber(a.discount_total_sum))+" uzs",1),Xt,c(v,{Label:s.getName("Discount")+" (%)",onOnInput:r[10]||(r[10]=n=>s.percentInput(n)),isError:s.hasKey("discount_percent"),message:a.errorObj.discount_percent,Value:a.discount_percent,Tyoe:"number"},null,8,["Label","isError","message","Value"]),c(v,{Label:s.getName("Discount")+" (sum)",onOnInput:r[11]||(r[11]=n=>s.sumInput(n)),isError:s.hasKey("discount_sum"),message:a.errorObj.discount_sum,Value:a.discount_sum,Tyoe:"number"},null,8,["Label","isError","message","Value"]),a.discountError?(l(),u("p",$t,o(s.getName("DiscountError")),1)):m("",!0),t("h1",null,o(s.getName("DebitTitle")),1),es,t("div",ts,[c(w,{onClick:r[12]||(r[12]=n=>a.debtUser="doctor"),onCheck:a.debtUser=="doctor",Title:s.getName("Doctor")},null,8,["onCheck","Title"]),T("         "),c(w,{onClick:r[13]||(r[13]=n=>a.debtUser="polyclinic"),onCheck:a.debtUser=="polyclinic",Title:s.getName("PolyClinic")},null,8,["onCheck","Title"])]),ss])):a.Modal=="payment"?(l(),u("div",rs,[c(B,{style:{"font-size":"20px"},isActive:a.userPayments<=0,Title:d.useConterStore().formatNumber(Number(a.userPayments))+" uzs"},null,8,["isActive","Title"]),c(v,{Pholder:"0",Class:"format_input",Label:s.getName("Amount"),onOnInput:r[14]||(r[14]=n=>s.paymentNumberFormat(n)),isError:s.hasKey("amount"),message:a.errorObj.amount,Value:d.counterStore.formatNumber(a.Amount)},null,8,["Label","isError","message","Value"]),c(V,{Label:s.getName("PaymentTypes"),isError:s.hasKey("payment_type_id"),message:a.errorObj.payment_type_id,onOnSelect:r[15]||(r[15]=n=>a.PaymentType=n)},{default:b(()=>[as,(l(!0),u(N,null,P(a.paymentTypes,n=>(l(),u("option",{value:n.id},o(n.name),9,ns))),256))]),_:1},8,["Label","isError","message"])])):m("",!0)]),_:1},8,["UpdateId","isShowModal"])])])}const ls=k(Qe,[["render",os]]),Ts={__name:"index",setup(e){return(r,i)=>(l(),U(C,null,{default:b(()=>[c(ls)]),_:1}))}};export{Ts as default};
