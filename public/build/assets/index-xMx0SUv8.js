import{P as K}from"./Page-WY9jM6QH.js";import{q as Q,s as $,v as ee,x as te,y as se,z as ie,B as ae,C as T,D as re,E as oe,_ as j,o as p,b as m,k as ne,M as le,H as de,u as ce,I as ue,J as O,K as he,N as pe,c as me,w as _,r as C,e as s,d as k,F as D,g as S,a as c,t as h}from"./app-NOWLkVVR.js";import{A as M}from"./apexcharts.common-Nl0D2Tct.js";import{C as be}from"./CardBlock-dMeUT4-J.js";import{C as fe}from"./CardClassicBlock-m8MGPBiw.js";const I=["animationEnd","beforeMount","mounted","updated","click","mouseMove","mouseLeave","legendClick","markerClick","selection","dataPointSelection","dataPointMouseEnter","dataPointMouseLeave","beforeZoom","beforeResetZoom","zoomed","scrolled","brushScrolled"],B=Q({name:"apexchart",props:{options:{type:Object},type:{type:String},series:{type:Array,required:!0},width:{default:"100%"},height:{default:"auto"}},emits:I,setup(e,{emit:a}){const n=$(null),r=$(null),t=i=>i&&typeof i=="object"&&!Array.isArray(i)&&i!=null,y=(i,o)=>{typeof Object.assign!="function"&&function(){Object.assign=function(l){if(l==null)throw new TypeError("Cannot convert undefined or null to object");let E=Object(l);for(let v=1;v<arguments.length;v++){let N=arguments[v];if(N!=null)for(let z in N)N.hasOwnProperty(z)&&(E[z]=N[z])}return E}}();let f=Object.assign({},i);return t(i)&&t(o)&&Object.keys(o).forEach(l=>{t(o[l])?l in i?f[l]=y(i[l],o[l]):Object.assign(f,{[l]:o[l]}):Object.assign(f,{[l]:o[l]})}),f},d=async()=>{if(await oe(),r.value)return;const i={chart:{type:e.type||e.options.chart.type||"line",height:e.height,width:e.width,events:{}},series:e.series},o=e.options.chart.events;I.forEach(l=>{let E=(...v)=>a(l,...v);i.chart.events[l]=(...v)=>{E(...v),o&&o.hasOwnProperty(l)&&o[l](...v)}});const f=y(e.options,i);return r.value=new M(n.value,f),r.value.render()},x=()=>(b(),d()),b=()=>{r.value.destroy()},w=(i,o)=>r.value.updateSeries(i,o),g=(i,o,f,l)=>r.value.updateOptions(i,o,f,l),L=i=>r.value.toggleSeries(i),P=i=>{r.value.showSeries(i)},u=i=>{r.value.hideSeries(i)},R=(i,o)=>r.value.appendSeries(i,o),q=()=>{r.value.resetSeries()},V=(i,o)=>{r.value.toggleDataPointSelection(i,o)},F=i=>r.value.appendData(i),U=(i,o)=>r.value.zoomX(i,o),J=i=>r.value.dataURI(i),X=i=>r.value.setLocale(i),Y=(i,o)=>{r.value.addXaxisAnnotation(i,o)},G=(i,o)=>{r.value.addYaxisAnnotation(i,o)},W=(i,o)=>{r.value.addPointAnnotation(i,o)},Z=(i,o)=>{r.value.removeAnnotation(i,o)},H=()=>{r.value.clearAnnotations()};ee(()=>{window.ApexCharts=M}),te(()=>{n.value=se().proxy.$el,d()}),ie(()=>{r.value&&b()});const A=ae(e);return T(A.options,()=>{!r.value&&e.options?d():r.value.updateOptions(e.options)}),T(A.series,()=>{!r.value&&e.series?d():r.value.updateSeries(e.series)},{deep:!0}),T(A.type,()=>{x()}),T(A.width,()=>{x()}),T(A.height,()=>{x()}),{chart:r,init:d,refresh:x,destroy:b,updateOptions:g,updateSeries:w,toggleSeries:L,showSeries:P,hideSeries:u,resetSeries:q,zoomX:U,toggleDataPointSelection:V,appendData:F,appendSeries:R,addXaxisAnnotation:Y,addYaxisAnnotation:G,addPointAnnotation:W,removeAnnotation:Z,clearAnnotations:H,setLocale:X,dataURI:J}},render(){return re("div",{class:"vue-apexcharts"})}}),ve=e=>{e.component(B.name,B)};B.install=ve;const Ce={},ye={class:"col-sm-3"},xe=ne('<div class="card"><div class="card-body"><div class="d-flex align-items-center mb-3"><div class="avatar-xs me-3"><span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18"><i class="bx bx-copy-alt placeholder"></i></span></div><h5 class="font-size-14 mb-0 placeholder">Mijozlarga sotilgan dorilar</h5></div><div class="text-muted mt-4"><h4 class="placeholder">1,452 </h4><div class="d-flex placeholder"><span class="badge badge-soft-success font-size-12"></span> <span class="ms-2 text-truncate">From previous period</span></div></div></div></div>',1),ge=[xe];function _e(e,a){return p(),m("div",ye,ge)}const Se=j(Ce,[["render",_e]]),Me={components:{ModalCentered:le,CardClassicBlockLoader:Se,apexchart:B,CardClassicBlock:fe,CardBlock:be,BaseBox:de,Page:K},setup(){return{counterStore:ce()}},data(){return{items:[],item:[],isChart0:!1,paginateCount:10,cardClassicLoader:!1,column:"id",type:"desc",errors:[],loader:!1,cardLoader:!1,sellings:[],purchases:[],registeredMedicines:0,expiredMedicines:[],importedMedicines:0,realMedicines:0,expiredMedicinesCount:0,medicinesSoldCustomers:[],medicinesSoldCustomersAmount:0,importedSubtotalMedicines:[],importedSubtotalMedicinesAmount:0,expenses:[],netProfit:[],totalNetProfit:[],isChart2:!1,bestSellerEmployees:[],bestSellerEmployeesAmount:[],chart2Data:{series:[{data:[]}],chartOptions:{chart:{type:"bar",height:380},plotOptions:{bar:{borderRadius:4,borderRadiusApplication:"end",horizontal:!0}},dataLabels:{enabled:!1},xaxis:{categories:[]}}},chart0Data:{series:[{data:[]}],chartOptions:{chart:{type:"bar",height:380},plotOptions:{bar:{borderRadius:4,borderRadiusApplication:"end",horizontal:!0}},dataLabels:{enabled:!1},xaxis:{categories:[]}}},realMedicineNumbers:[],realMedicineArr:[],outdatedDrugs:[],expiredDrugs:[]}},methods:{chart0(){var e={chart:{height:380,width:"100%",type:"bar",animations:{initialAnimation:{enabled:!1}}},series:this.bestSellerEmployees,labels:this.bestSellerEmployeesAmount},a=new M(document.querySelector("#dashboardChart0"),e);a.render()},chart1(){var e={chart:{height:380,width:"100%",type:"area",zoom:!1,animations:{zoom:!1,initialAnimation:{enabled:!1}}},series:[{name:this.$t("Selling"),data:this.sellings},{name:this.$t("Purchase"),data:this.purchases}],xaxis:{type:"datetime"}},a=new M(document.querySelector("#dashboardChart1"),e);a.render()},chart3(){var e={chart:{height:380,width:"100%",type:"pie",animations:{initialAnimation:{enabled:!1}}},series:this.realMedicineNumbers,labels:this.realMedicineArr},a=new M(document.querySelector("#dashboardChart3"),e);a.render()},chart4(){var e={chart:{height:350,type:"line",zoom:{enabled:!1}},series:[{name:this.$t("Amount"),data:[10,41,35,51,49,62,69,91,148]}],dataLabels:{enabled:!1},stroke:{curve:"straight"},grid:{row:{colors:["#f3f3f3","transparent"],opacity:0}},xaxis:{categories:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep"]}},a=new M(document.querySelector("#dashboardChart4"),e);a.render()},async quantityVerification(){try{this.loader=!0;const e=await ue();this.loader=!1}catch(e){O(this,e)}},async dashboardCart1(){try{this.cardLoader=!0;const e=await he();let a=e.data;if(e.status){a.bestSellerEmployees.forEach(t=>{this.bestSellerEmployees.push(t.name),this.bestSellerEmployeesAmount.push(t.total_amount)}),this.chart0Data.chartOptions.xaxis.categories=this.bestSellerEmployees,this.chart0Data.series[0].data=this.bestSellerEmployeesAmount,this.isChart0=!0,this.registeredMedicines=a.medicines_count,this.realMedicinesArr=a.realMedicinesCount,this.realMedicines=0,a.realMedicinesCount.forEach(t=>{this.realMedicines+=t.amount,t.amount>0?(this.realMedicineNumbers.push(t.amount),this.realMedicineArr.push(t.name)):(t.amount=0,this.outdatedDrugs.push(t))}),this.expiredMedicinesCount=0,a.expiredMedicines.forEach(t=>{this.expiredMedicinesCount+=t.amount,this.expiredDrugs.push(t)}),(this.outdatedDrugs.length>0||this.expiredDrugs.length)&&new bootstrap.Modal(document.getElementById("dashboardAlert")).show(),this.chart3(),a.importedMedicines.forEach(t=>{this.importedMedicines+=t.amount});let n=[],r=[];a.bestSellers.forEach(t=>{n.push(t.name),r.push(t.total_amount)}),this.chart2Data.chartOptions.xaxis.categories=n,this.chart2Data.series[0].data=r,this.isChart2=!0,this.expiredMedicines=a.expiredMedicines}this.cardLoader=!1}catch(e){O(this,e)}},async dashboardCart2(){try{this.cardClassicLoader=!0;const e=await pe();let a=e.data;e.status&&(this.medicinesSoldCustomers=a.medicinesSoldCustomers,this.importedSubtotalMedicines=a.importedSubtotalMedicines,this.expenses=a.expenses,a.medicinesSoldCustomers.forEach(n=>{this.medicinesSoldCustomersAmount+=Number(n.total_amount)}),a.importedSubtotalMedicines.forEach(n=>{this.importedSubtotalMedicinesAmount+=Number(n.amount)}),a.sellings.forEach(n=>{this.sellings.push({x:n.date.split("-")[1]+"-"+n.date.split("-")[2]+"-"+n.date.split("-")[0]+" GMT",y:n.subtotal.toFixed(2)})}),a.purchases.forEach(n=>{this.purchases.push({x:n.date.split("-")[1]+"-"+n.date.split("-")[2]+"-"+n.date.split("-")[0]+" GMT",y:n.subtotal.toFixed(2)})}),this.medicinesSoldCustomers.forEach((n,r)=>{let t=0;a.importedSubtotalMedicines.forEach(d=>{d.currency_id==n.currency_id&&(t+=Number(d.total_cost))}),a.expenses.forEach(d=>{d.currency_id==n.currency_id&&(t+=Number(d.total_cost))});let y=0;n.total_cost-t>0&&(y=n.total_cost-t),this.totalNetProfit.push({total_cost:y,sign:n.sign})}),this.cardClassicLoader=!1),this.cardClassicLoader=!1,this.chart1()}catch(e){O(this,e)}}},mounted(){this.dashboardCart1(),this.dashboardCart2(),this.quantityVerification()}},Ae={class:"row"},Te={class:"col-lg-3 cursor-pointer"},we=s("div",{class:"card mini-stats-wid"},[s("div",{class:"card-body"},[s("div",{class:"d-flex flex-wrap"},[s("div",{class:"me-3"},[s("p",{class:"mb-2 placeholder"},"Uzbekistani Uzbekistani"),s("br"),s("h5",{class:"mb-0 placeholder"},"201 000 сўм")]),s("div",{class:"avatar-sm ms-auto"},[s("div",{class:"avatar-title bg-light rounded-circle text-primary font-size-20"},[s("i",{class:"bx bx-money placeholder"})])])])])],-1),Ee=[we],Ne={key:0,class:"row"},ke={key:1,class:"row"},De={key:2,class:"row"},Be={class:"row"},Le={key:0,id:"dashboardChart0"},Pe=s("div",{id:"dashboardChart1"},null,-1),ze={key:0,id:"dashboardChart2"},Oe=s("div",{id:"dashboardChart3"},null,-1),$e={class:"col-xl-12"},Ie={class:"card"},je={class:"card-body p-0"},Re={class:"card-title text-center"},qe={class:"table-responsive"},Ve={class:"table mb-0"},Fe={class:"table-light"},Ue={class:"font-size-12 text-wrap"},Je={class:"col-xl-12"},Xe={class:"card"},Ye={class:"card-body p-0 text-center"},Ge={class:"card-title"},We={class:"table-responsive"},Ze={class:"table mb-0"},He={class:"table-light"};function Ke(e,a,n,r,t,y){const d=C("CardBlock"),x=C("CardClassicBlockLoader"),b=C("CardClassicBlock"),w=C("apexchart"),g=C("BaseBox"),L=C("ModalCentered"),P=C("Page");return p(),me(P,{Title:""},{default:_(()=>[s("div",Ae,[t.cardLoader?(p(),m(D,{key:0},k(4,u=>s("div",Te,Ee)),64)):S("",!0)]),t.cardLoader?S("",!0):(p(),m("div",Ne,[s("div",{class:"col-md-3 cursor-pointer",onClick:a[0]||(a[0]=u=>this.$router.push("/admin/medicines"))},[c(d,{Title:e.$t("RegisteredMedicines"),Number:r.counterStore.formatNumber(t.registeredMedicines),Icon:"bx bx-copy-alt font-size-24"},null,8,["Title","Number"])]),s("div",{class:"col-md-3 cursor-pointer",onClick:a[1]||(a[1]=u=>this.$router.push("/admin/expired-medicines"))},[c(d,{Title:e.$t("ExpiredMedicines"),Number:r.counterStore.formatNumber(t.expiredMedicinesCount),Icon:"bx bx-time font-size-24"},null,8,["Title","Number"])]),s("div",{class:"col-md-3 cursor-pointer",onClick:a[2]||(a[2]=u=>this.$router.push("/admin/import/medicines"))},[c(d,{Title:e.$t("ImportedDrugs"),Number:r.counterStore.formatNumber(t.importedMedicines),Icon:"bx bx-import font-size-24"},null,8,["Title","Number"])]),s("div",{class:"col-md-3 cursor-pointer",onClick:a[3]||(a[3]=u=>this.$router.push("/admin/medicines"))},[c(d,{Title:e.$t("WarehouseAvailableMedicines"),Number:r.counterStore.formatNumber(t.realMedicines),Icon:"bx bx-pie-chart-alt-2 font-size-24"},null,8,["Title","Number"])])])),t.cardClassicLoader?(p(),m("div",ke,[(p(),m(D,null,k(4,u=>c(x)),64))])):S("",!0),t.cardClassicLoader?S("",!0):(p(),m("div",De,[c(b,{Icon:"bx bx-export",Title:e.$t("TotalPaid"),Currencies:t.medicinesSoldCustomers,Share:t.medicinesSoldCustomersAmount,Text:e.$t("SubtotalAmount")+":"},null,8,["Title","Currencies","Share","Text"]),c(b,{Icon:"bx bx-import",Title:e.$t("ImportPaid"),Currencies:t.importedSubtotalMedicines,Share:t.importedSubtotalMedicinesAmount,Text:e.$t("SubtotalAmount")+":"},null,8,["Title","Currencies","Share","Text"]),c(b,{Icon:"bx bx-collection",Title:e.$t("TotalCosts"),Currencies:t.expenses,Share:"",Text:""},null,8,["Title","Currencies"]),c(b,{Icon:"bx bx-collection",Title:e.$t("TotalNetProfit"),Currencies:t.totalNetProfit,Share:"",Text:""},null,8,["Title","Currencies"])])),s("div",Be,[c(g,{Col:"col-xl-6",Title:e.$t("BestSellers")},{default:_(()=>[t.isChart0?(p(),m("div",Le,[c(w,{type:"bar",height:"345",options:t.chart0Data.chartOptions,series:t.chart0Data.series},null,8,["options","series"])])):S("",!0)]),_:1},8,["Title"]),c(g,{Col:"col-xl-6",Title:e.$t("SalesandPurchasestatistics")},{default:_(()=>[Pe]),_:1},8,["Title"]),c(g,{Title:e.$t("MostSoldMedicines")},{default:_(()=>[t.isChart2?(p(),m("div",ze,[c(w,{type:"bar",height:"345",options:t.chart2Data.chartOptions,series:t.chart2Data.series},null,8,["options","series"])])):S("",!0)]),_:1},8,["Title"]),c(g,{Title:e.$t("CurrentMedicinesAmount")},{default:_(()=>[Oe]),_:1},8,["Title"])]),c(L,{isSubmit:!1,ModalName:"dashboardAlert",Title:e.$t("Info")},{default:_(()=>[s("div",$e,[s("div",Ie,[s("div",je,[s("h4",Re,h(e.$t("ExpiredMedicines")),1),s("div",qe,[s("table",Ve,[s("thead",Fe,[s("tr",null,[s("th",null,h(e.$t("MedicineName")),1),s("th",null,h(e.$t("Collection")),1),s("th",null,h(e.$t("Amount")),1),s("th",null,h(e.$t("ExpirationDate")),1)])]),s("tbody",null,[(p(!0),m(D,null,k(t.expiredDrugs,u=>(p(),m("tr",null,[s("td",null,[s("p",Ue,h(u.medicine.name),1)]),s("td",null,h(u.name),1),s("td",null,h(u.amount),1),s("td",null,h(u.expiry_date_finished),1)]))),256))])])])])])]),s("div",Je,[s("div",Xe,[s("div",Ye,[s("h4",Ge,h(e.$t("WarehouseNotAmount")),1),s("div",We,[s("table",Ze,[s("thead",He,[s("tr",null,[s("th",null,h(e.$t("MedicineName")),1),s("th",null,h(e.$t("Amount")),1)])]),s("tbody",null,[(p(!0),m(D,null,k(t.outdatedDrugs,u=>(p(),m("tr",null,[s("td",null,h(u.name),1),s("td",null,h(u.amount),1)]))),256))])])])])])])]),_:1},8,["Title"])]),_:1})}const at=j(Me,[["render",Ke]]);export{at as default};
