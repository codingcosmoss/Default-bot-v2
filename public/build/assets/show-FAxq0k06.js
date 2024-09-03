import{P as y}from"./Page-k1RhpKxv.js";import{_ as w,u as S,c2 as N,H as P,c as h,w as k,r as m,o as i,e as t,g as u,b as d,t as s,f as c,F as g,d as f}from"./app-tuttM9Io.js";import{L as A}from"./Loader-Z87gmGUA.js";import{S as I}from"./sweetalert2.all-OjWcCphj.js";const T={components:{Loader:A,Page:y},setup(){return{counterStore:S()}},data(){return{loader:!1,invoice:[],company:[],medicines:[],isReturn:!1,return_medicines:[],customer:[],seller:[],sign:[],logo:[],gst:0,igta:0,return_gst:0,return_igta:0,return_subtotal:0}},methods:{printPage(){localStorage.getItem("fon")=="dark"?I.fire({title:this.$t("PrintFon"),text:"",icon:"info"}).then(e=>{e.isConfirmed&&(document.documentElement.setAttribute("data-bs-theme","light"),localStorage.setItem("fon","white"),sessionStorage.setItem("is_visited",val),document.documentElement.removeAttribute("dir"))}):this.$router.push({path:"/invoices/print",query:{id:this.$route.query.id}})},async show(){try{this.loader=!0;const e=await N(this.$route.query.id);this.invoice=e.data,this.company=e.data.company,this.customer=e.data.customer,this.seller=e.data.user,this.sign=e.data.currency.sign,this.logo=e.data.company.logo[0].url,this.medicines=e.data.sold_medicines,e.data.return_medicines.length>0&&(this.isReturn=!0),this.return_medicines=e.data.return_medicines,this.return_medicines.forEach(r=>{let a=r.igta*r.amount,o=r.gst*r.amount;this.return_igta+=a,this.return_gst+=o,this.return_subtotal+=r.subtotal+a+o}),this.igta=e.data.igta,this.gst=e.data.gst,this.loader=!1}catch(e){P(this,e)}}},mounted(){this.show()}},j={class:"row d-flex justify-content-center"},x={class:"col-md-8 col-lg-9 col-xl-6"},C={class:"card"},L={key:1,class:"card-body"},E={class:"text-center"},R=["src"],B=t("hr",null,null,-1),q={class:"row"},F={class:"col-sm-6 print_td_left"},M=t("br",null,null,-1),V=t("br",null,null,-1),z=t("br",null,null,-1),D=t("br",null,null,-1),G={class:"col-sm-6 text-sm-end print_td_right"},H={class:"mt-2 mt-sm-0"},J=t("br",null,null,-1),K=t("br",null,null,-1),O=t("br",null,null,-1),Q=t("br",null,null,-1),U={class:"row"},W={class:"col-sm-6 print_td_left mt-3"},X=t("br",null,null,-1),Y=t("br",null,null,-1),Z=t("br",null,null,-1),$=t("br",null,null,-1),tt={class:"col-sm-6 mt-3 text-sm-end print_td_right"},st=t("br",null,null,-1),et=t("br",null,null,-1),nt=t("br",null,null,-1),ot=t("br",null,null,-1),lt={class:"py-2 mt-3 text-center"},it={class:"font-size-15 fw-bold"},rt={class:"table-responsive"},ct={class:"table table-nowrap"},dt=t("th",{style:{width:"70px"}},"No.",-1),ut={colspan:"5",class:"border-0"},at={class:"d-flex w-100 justify-content-end gap-2"},_t={colspan:"4",class:"text-end m-0"},ht={class:"text-end m-0 fw-bold"},mt={class:"d-flex w-100 justify-content-end gap-2"},gt={colspan:"4",class:"text-end m-0"},ft={class:"text-end m-0 fw-bold"},bt={class:"d-flex w-100 justify-content-end gap-2"},pt={colspan:"4",class:"text-end m-0"},vt={class:"text-end m-0 fw-bold"},yt={key:0,class:"py-2 mt-3 text-center"},wt={class:"font-size-15 fw-bold"},St={key:1,class:"table-responsive"},Nt={class:"table table-nowrap"},Pt=t("th",{style:{width:"70px"}},"No.",-1),kt={colspan:"5",class:"border-0"},At={class:"d-flex w-100 justify-content-end gap-2"},It={colspan:"4",class:"text-end m-0"},Tt={class:"text-end m-0 fw-bold"},jt={class:"d-flex w-100 justify-content-end gap-2"},xt={colspan:"4",class:"text-end m-0"},Ct={class:"text-end m-0 fw-bold"},Lt={class:"d-flex w-100 justify-content-end gap-2"},Et={colspan:"4",class:"text-end m-0"},Rt={class:"text-end m-0 fw-bold"},Bt={class:"d-flex justify-content-center p-2"},qt={class:"m-0"},Ft={class:"d-print-none"},Mt={class:"float-end"},Vt=t("i",{class:"fa fa-print"},null,-1),zt=[Vt];function Dt(e,r,a,o,n,b){const p=m("Loader"),v=m("Page");return i(),h(v,{Title:"",Links:[{path:"/admin/returned/invoices",name:e.$t("ReturnHistory"),status:!1},{path:"/",name:e.$t("Print"),status:!0}]},{default:k(()=>[t("div",j,[t("div",x,[t("div",C,[n.loader?(i(),h(p,{key:0})):u("",!0),n.loader?u("",!0):(i(),d("div",L,[t("div",E,[t("img",{src:n.logo,width:"150px"},null,8,R),t("h2",null,s(n.company.name),1),t("p",null,s(e.$t("Phone"))+": "+s(n.company.phone)+", "+s(e.$t("Email"))+": "+s(n.company.email)+", "+s(e.$t("Address"))+": "+s(n.company.address)+", ",1)]),B,t("div",q,[t("div",F,[t("address",null,[t("strong",null,s(e.$t("Date"))+":",1),M,t("strong",null,s(e.$t("InvoiceId"))+":",1),V,t("strong",null,s(e.$t("Customer"))+":",1),z,t("strong",null,s(e.$t("Seller"))+":",1),D])]),t("div",G,[t("address",H,[c(s(n.invoice.date),1),J,c(" "+s(n.invoice.id),1),K,c(" "+s(n.customer.name),1),O,c(" "+s(n.seller.name),1),Q])])]),t("div",U,[t("div",W,[t("address",null,[t("strong",null,s(e.$t("PaymentType"))+":",1),X,t("strong",null,s(e.$t("Subtotal"))+":",1),Y,t("strong",null,s(e.$t("Paid"))+":",1),Z,t("strong",null,s(e.$t("Indebtedness"))+":",1),$])]),t("div",tt,[t("address",null,[c(s(n.invoice.date),1),st,c(" "+s(o.counterStore.formatNumber(n.invoice.subtotal))+" "+s(n.sign),1),et,c(" "+s(o.counterStore.formatNumber(n.invoice.amount_paid))+" "+s(n.sign),1),nt,c(" "+s(o.counterStore.formatNumber(n.invoice.must_paid))+" "+s(n.sign),1),ot])])]),t("div",lt,[t("h3",it,s(e.$t("Invoice")),1)]),t("div",rt,[t("table",ct,[t("thead",null,[t("tr",null,[dt,t("th",null,s(e.$t("MedicineName")),1),t("th",null,s(e.$t("Amount")),1),t("th",null,s(e.$t("Price")),1),t("th",null,s(e.$t("Total")),1)])]),t("tbody",null,[(i(!0),d(g,null,f(n.medicines,(l,_)=>(i(),d("tr",null,[t("td",null,s(_+1),1),t("td",null,s(l.name),1),t("td",null,s(l.amount),1),t("td",null,s(o.counterStore.formatNumber(l.price))+" "+s(n.sign),1),t("td",null,s(o.counterStore.formatNumber(l.subtotal))+" "+s(n.sign),1)]))),256)),t("tr",null,[t("td",ut,[t("div",at,[t("p",_t,s(e.$t("Igta"))+":",1),t("p",ht,s(o.counterStore.formatNumber(n.igta))+" "+s(n.sign),1)]),t("div",mt,[t("p",gt,s(e.$t("GST/TaxAmount"))+":",1),t("p",ft,s(o.counterStore.formatNumber(n.gst))+" "+s(n.sign),1)]),t("div",bt,[t("p",pt,s(e.$t("Subtotal"))+":",1),t("p",vt,s(o.counterStore.formatNumber(n.invoice.subtotal))+" "+s(n.sign),1)])])])])])]),n.isReturn?(i(),d("div",yt,[t("h3",wt,s(e.$t("ReturnAllMedicines")),1)])):u("",!0),n.isReturn?(i(),d("div",St,[t("table",Nt,[t("thead",null,[t("tr",null,[Pt,t("th",null,s(e.$t("MedicineName")),1),t("th",null,s(e.$t("Amount")),1),t("th",null,s(e.$t("Price")),1),t("th",null,s(e.$t("Total")),1)])]),t("tbody",null,[(i(!0),d(g,null,f(n.return_medicines,(l,_)=>(i(),d("tr",null,[t("td",null,s(_+1),1),t("td",null,s(l.name),1),t("td",null,s(l.amount),1),t("td",null,s(o.counterStore.formatNumber(l.price))+" "+s(n.sign),1),t("td",null,s(o.counterStore.formatNumber(l.subtotal))+" "+s(n.sign),1)]))),256)),t("tr",null,[t("td",kt,[t("div",At,[t("p",It,s(e.$t("Igta"))+":",1),t("p",Tt,s(o.counterStore.formatNumber(n.return_igta))+" "+s(n.sign),1)]),t("div",jt,[t("p",xt,s(e.$t("GST/TaxAmount"))+":",1),t("p",Ct,s(o.counterStore.formatNumber(n.return_gst))+" "+s(n.sign),1)]),t("div",Lt,[t("p",Et,s(e.$t("Subtotal"))+":",1),t("p",Rt,s(o.counterStore.formatNumber(n.return_subtotal))+" "+s(n.sign),1)])])])])])])):u("",!0),t("div",Bt,[t("h4",qt,s(e.$t("Paid"))+": "+s(o.counterStore.formatNumber(n.invoice.amount_paid))+" "+s(n.sign),1)]),t("div",Ft,[t("div",Mt,[t("a",{onClick:r[0]||(r[0]=l=>b.printPage()),class:"btn btn-success waves-effect waves-light me-1"},zt)])])]))])])])]),_:1},8,["Links"])}const Ot=w(T,[["render",Dt]]);export{Ot as default};
