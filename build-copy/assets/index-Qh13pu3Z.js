import{M as m,P as y}from"./Page-mAivDXea.js";import{C as v}from"./ContentBox-Os9z8ybv.js";import{C as T}from"./ContentBlock-5PYRXiaV.js";import{_ as d,r as n,o as u,c as b,a as x,b as e,F as k,u as B,g as D,d as N,w as i}from"./app-8i59_tig.js";const I={components:{Map01:m},data(){return{barchartdata:[{date:2019,Utilities:21,Rent:16,Insurance:22},{date:2020,Utilities:19,Rent:10,Insurance:17}]}},methods:{sendData(){}}},P={class:"col-span-6 xl:col-span-6"};function R(o,t,f,h,s,a){const r=n("StackedBarChart"),c=n("Map01");return u(),b(k,null,[x("div",P,[e(r,{"plot-data":s.barchartdata,"x-key":"date"},null,8,["plot-data"]),e(r,{"plot-data":s.barchartdata,"x-key":"date"},null,8,["plot-data"])]),e(c)],64)}const S=d(I,[["render",R]]),w={components:{Charts:S,Page:y,Map01:m,ContentBlock:T,ContentBox:v},methods:{getName(o){return B().getName(o)},async getData(){const o=await D();o.status?(this.ReportData=o.data,o.data.debtorPatients.forEach(t=>{t.payment_status==11&&(this.deptorPatients+=1)}),o.data.allServices.forEach(t=>{this.topServices.push({date:t.name,Amount:t.amount})})):this.ReportData={users:0,patients:0,services:0}}},data(){return{ReportData:{users:0,patients:0,services:0},deptorPatients:0,topServices:[],services:[{date:"Service",Amount:10}],plotData2:[{date:"2019",Utilities:5921,Rent:1026,Insurance:2324},{date:"2020",Utilities:5921,Rent:1026,Insurance:2324}]}},mounted(){this.getData()}},A={style:{display:"flex","justify-content":"space-between",gap:"30px"},class:"chart_box"};function M(o,t,f,h,s,a){const r=n("ContentBlock"),c=n("ContentBox"),_=n("GroupedBarChart"),p=n("Map01"),g=n("AreaChart"),C=n("Page");return u(),N(C,{Classes:!1},{default:i(()=>[e(c,{style:{"margin-bottom":"25px"}},{default:i(()=>[e(r,{Title:a.getName("employees"),Text:s.ReportData.users,Icon:"fa-solid fa-users",Item:"",onClick:t[0]||(t[0]=l=>this.$router.push("/employees"))},null,8,["Title","Text"]),e(r,{Title:a.getName("Patients"),Text:s.ReportData.patients,Icon:"fa-solid fa-user-group",Item:"",onClick:t[1]||(t[1]=l=>this.$router.push("/patients"))},null,8,["Title","Text"]),e(r,{Title:a.getName("services"),Text:s.ReportData.services,Icon:"fa-solid fa-users-gear",Item:"",onClick:t[2]||(t[2]=l=>this.$router.push("/services"))},null,8,["Title","Text"]),e(r,{Title:a.getName("DeptorPatient"),Text:s.deptorPatients,Icon:"fa-solid fa-users-line",onClick:t[3]||(t[3]=l=>this.$router.push("/debt-treatments")),Item:""},null,8,["Title","Text"])]),_:1}),x("span",A,[e(p,{Title:a.getName("TopServices"),class:"chart_item"},{default:i(()=>[e(_,{"plot-data":s.topServices,"x-key":"date",width:450,height:300,margin:{top:20,bottom:35,left:55,right:20},colors:["#ac58e5","#E0488B"],"x-axis-label":a.getName("services"),"y-axis-label":a.getName("ActivedCount"),"y-tick-format":l=>`${l}`},null,8,["plot-data","x-axis-label","y-axis-label","y-tick-format"])]),_:1},8,["Title"]),e(p,{Title:a.getName("Payments"),class:"chart_item"},{default:i(()=>[e(g,{"plot-data":s.plotData2,width:500,height:300,"x-key":"date",margin:{top:20,bottom:30,left:55,right:20},colors:["#ac58e5","#E0488B"],"x-axis-label":a.getName("Payments"),"y-axis-label":a.getName("Amount"),"y-tick-format":l=>`$${l}`},null,8,["plot-data","x-axis-label","y-axis-label","y-tick-format"])]),_:1},8,["Title"])])]),_:1})}const G=d(w,[["render",M],["__scopeId","data-v-2cc89076"]]);export{G as default};
