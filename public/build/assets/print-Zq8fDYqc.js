import{P as p}from"./Page-oDaSi7Lo.js";import{_ as b,u as f,c4 as v,I as y,b as i,e as t,c as w,g as d,t as s,f as c,F as h,d as m,o as r,r as S}from"./app-YVDEE9Za.js";import{L as N}from"./Loader-iEAqJYPH.js";import"./sweetalert2.all-rdIQaPL0.js";const P={components:{Loader:N,Page:p},setup(){return{counterStore:f()}},data(){return{loader:!1,invoice:[],company:[],medicines:[],isReturn:!1,return_medicines:[],customer:[],seller:[],sign:[],logo:[],gst:0,igta:0,return_gst:0,return_igta:0,return_subtotal:0}},methods:{printPage(){window.onafterprint=()=>{this.$router.go(-1)},setTimeout(()=>{window.print()},1e3)},async show(){try{this.loader=!0;const e=await v(this.$route.query.id);this.invoice=e.data,this.company=e.data.company,this.customer=e.data.customer,this.seller=e.data.user,this.sign=e.data.currency.sign,this.logo=e.data.company.logo[0].url,this.medicines=e.data.sold_medicines,e.data.return_medicines.length>0&&(this.isReturn=!0),this.return_medicines=e.data.return_medicines,this.return_medicines.forEach(u=>{let a=u.igta*u.amount,o=u.gst*u.amount;this.return_igta+=a,this.return_gst+=o,this.return_subtotal+=u.subtotal+a+o}),this.igta=e.data.igta,this.gst=e.data.gst,this.loader=!1,this.printPage()}catch(e){y(this,e)}}},mounted(){this.show()}},T={class:"row d-flex justify-content-center m-0"},j={class:"col-lg-12 p-0"},k={class:"card"},A={key:1,class:"card-body"},I={class:"text-center"},x=["src"],L=t("hr",null,null,-1),R={class:"row"},B={class:"col-sm-6 print_td_left"},C=t("br",null,null,-1),E=t("br",null,null,-1),M=t("br",null,null,-1),V=t("br",null,null,-1),z={class:"col-sm-6 text-sm-end print_td_right"},D={class:"mt-2 mt-sm-0"},F=t("br",null,null,-1),G=t("br",null,null,-1),q=t("br",null,null,-1),H=t("br",null,null,-1),J={class:"row"},K={class:"col-sm-6 print_td_left mt-3"},O=t("br",null,null,-1),Q=t("br",null,null,-1),U=t("br",null,null,-1),W=t("br",null,null,-1),X={class:"col-sm-6 mt-3 text-sm-end print_td_right"},Y=t("br",null,null,-1),Z=t("br",null,null,-1),$=t("br",null,null,-1),tt=t("br",null,null,-1),st={class:"py-2 mt-3 text-center"},et={class:"font-size-15 fw-bold"},nt={class:"table-responsive"},ot={class:"table table-nowrap"},lt=t("th",{style:{width:"70px"}},"No.",-1),rt={colspan:"5",class:"border-0"},it={class:"d-flex w-100 justify-content-end gap-2"},ct={colspan:"4",class:"text-end m-0"},ut={class:"text-end m-0 fw-bold"},dt={class:"d-flex w-100 justify-content-end gap-2"},at={colspan:"4",class:"text-end m-0"},_t={class:"text-end m-0 fw-bold"},ht={class:"d-flex w-100 justify-content-end gap-2"},mt={colspan:"4",class:"text-end m-0"},gt={class:"text-end m-0 fw-bold"},pt={key:0,class:"py-2 mt-3 text-center"},bt={class:"font-size-15 fw-bold"},ft={key:1,class:"table-responsive"},vt={class:"table table-nowrap"},yt=t("th",{style:{width:"70px"}},"No.",-1),wt={colspan:"5",class:"border-0"},St={class:"d-flex w-100 justify-content-end gap-2"},Nt={colspan:"4",class:"text-end m-0"},Pt={class:"text-end m-0 fw-bold"},Tt={class:"d-flex w-100 justify-content-end gap-2"},jt={colspan:"4",class:"text-end m-0"},kt={class:"text-end m-0 fw-bold"},At={class:"d-flex w-100 justify-content-end gap-2"},It={colspan:"4",class:"text-end m-0"},xt={class:"text-end m-0 fw-bold"},Lt={class:"d-flex justify-content-center p-2"},Rt={class:"m-0"};function Bt(e,u,a,o,n,Ct){const g=S("Loader");return r(),i("div",T,[t("div",j,[t("div",k,[n.loader?(r(),w(g,{key:0})):d("",!0),n.loader?d("",!0):(r(),i("div",A,[t("div",I,[t("img",{src:n.logo,width:"150px"},null,8,x),t("h2",null,s(n.company.name),1),t("p",null,s(e.$t("Phone"))+": "+s(n.company.phone)+", "+s(e.$t("Email"))+": "+s(n.company.email)+", "+s(e.$t("Address"))+": "+s(n.company.address)+", ",1)]),L,t("div",R,[t("div",B,[t("address",null,[t("strong",null,s(e.$t("Date"))+":",1),C,t("strong",null,s(e.$t("InvoiceId"))+":",1),E,t("strong",null,s(e.$t("Customer"))+":",1),M,t("strong",null,s(e.$t("Seller"))+":",1),V])]),t("div",z,[t("address",D,[c(s(n.invoice.date),1),F,c(" "+s(n.invoice.id),1),G,c(" "+s(n.customer.name),1),q,c(" "+s(n.seller.name),1),H])])]),t("div",J,[t("div",K,[t("address",null,[t("strong",null,s(e.$t("PaymentType"))+":",1),O,t("strong",null,s(e.$t("Subtotal"))+":",1),Q,t("strong",null,s(e.$t("Paid"))+":",1),U,t("strong",null,s(e.$t("Indebtedness"))+":",1),W])]),t("div",X,[t("address",null,[c(s(n.invoice.date),1),Y,c(" "+s(o.counterStore.formatNumber(n.invoice.subtotal))+" "+s(n.sign),1),Z,c(" "+s(o.counterStore.formatNumber(n.invoice.amount_paid))+" "+s(n.sign),1),$,c(" "+s(o.counterStore.formatNumber(n.invoice.must_paid))+" "+s(n.sign),1),tt])])]),t("div",st,[t("h3",et,s(e.$t("Invoice")),1)]),t("div",nt,[t("table",ot,[t("thead",null,[t("tr",null,[lt,t("th",null,s(e.$t("MedicineName")),1),t("th",null,s(e.$t("Amount")),1),t("th",null,s(e.$t("Price")),1),t("th",null,s(e.$t("Total")),1)])]),t("tbody",null,[(r(!0),i(h,null,m(n.medicines,(l,_)=>(r(),i("tr",null,[t("td",null,s(_+1),1),t("td",null,s(l.name),1),t("td",null,s(l.amount),1),t("td",null,s(o.counterStore.formatNumber(l.price))+" "+s(n.sign),1),t("td",null,s(o.counterStore.formatNumber(l.subtotal))+" "+s(n.sign),1)]))),256)),t("tr",null,[t("td",rt,[t("div",it,[t("p",ct,s(e.$t("Igta"))+":",1),t("p",ut,s(o.counterStore.formatNumber(n.igta))+" "+s(n.sign),1)]),t("div",dt,[t("p",at,s(e.$t("GST/TaxAmount"))+":",1),t("p",_t,s(o.counterStore.formatNumber(n.gst))+" "+s(n.sign),1)]),t("div",ht,[t("p",mt,s(e.$t("Subtotal"))+":",1),t("p",gt,s(o.counterStore.formatNumber(n.invoice.subtotal))+" "+s(n.sign),1)])])])])])]),n.isReturn?(r(),i("div",pt,[t("h3",bt,s(e.$t("ReturnAllMedicines")),1)])):d("",!0),n.isReturn?(r(),i("div",ft,[t("table",vt,[t("thead",null,[t("tr",null,[yt,t("th",null,s(e.$t("MedicineName")),1),t("th",null,s(e.$t("Amount")),1),t("th",null,s(e.$t("Price")),1),t("th",null,s(e.$t("Total")),1)])]),t("tbody",null,[(r(!0),i(h,null,m(n.return_medicines,(l,_)=>(r(),i("tr",null,[t("td",null,s(_+1),1),t("td",null,s(l.name),1),t("td",null,s(l.amount),1),t("td",null,s(o.counterStore.formatNumber(l.price))+" "+s(n.sign),1),t("td",null,s(o.counterStore.formatNumber(l.subtotal))+" "+s(n.sign),1)]))),256)),t("tr",null,[t("td",wt,[t("div",St,[t("p",Nt,s(e.$t("Igta"))+":",1),t("p",Pt,s(o.counterStore.formatNumber(n.return_igta))+" "+s(n.sign),1)]),t("div",Tt,[t("p",jt,s(e.$t("GST/TaxAmount"))+":",1),t("p",kt,s(o.counterStore.formatNumber(n.return_gst))+" "+s(n.sign),1)]),t("div",At,[t("p",It,s(e.$t("Subtotal"))+":",1),t("p",xt,s(o.counterStore.formatNumber(n.return_subtotal))+" "+s(n.sign),1)])])])])])])):d("",!0),t("div",Lt,[t("h4",Rt,s(e.$t("Paid"))+": "+s(o.counterStore.formatNumber(n.invoice.amount_paid))+" "+s(n.sign),1)])]))])])])}const Dt=b(P,[["render",Bt]]);export{Dt as default};
