import{P as v}from"./Page-kS-htxF1.js";import{C as T}from"./CardBlock-0iXhFgqM.js";import{P as N,D as y}from"./PregBox-QyQAhnwr.js";import{_ as b,o as c,c as r,a as t,n as S,t as a,b as d,d as $,w as n,r as o,e as s,f as _,F as m}from"./app--lA0zENz.js";import{B as D}from"./BasicTable-ceqsBAou.js";import"./DefaultInput-OXMKtQjk.js";const P={props:{Title:{type:[String,Number],default:"Title"},Text:{type:[String,Number],default:"Block desc or text"},Share:{type:[String,Number],default:"+0.2%"},Number:{type:[String,Number],default:"1,200"},Icon:{type:String,default:"bx bx-copy-alt"}}},z={class:"col-sm-4"},I={class:"card"},w={class:"card-body"},R={class:"d-flex align-items-center mb-3"},V={class:"avatar-xs me-3"},F={class:"avatar-title rounded-circle bg-primary-subtle text-primary font-size-18"},E={class:"font-size-14 mb-0"},L={class:"text-muted mt-4"},j=t("i",{class:"mdi mdi-chevron-up ms-1 text-success"},null,-1),q={class:"d-flex"},A={class:"badge badge-soft-success font-size-12"},G={class:"ms-2 text-truncate"};function H(u,p,e,f,x,h){return c(),r("div",z,[t("div",I,[t("div",w,[t("div",R,[t("div",V,[t("span",F,[t("i",{class:S(e.Icon)},null,2)])]),t("h5",E,a(e.Title),1)]),t("div",L,[t("h4",null,[d(a(e.Number)+" ",1),j]),t("div",q,[t("span",A,a(e.Share),1),d(),t("span",G,a(e.Text),1)])])])])])}const J=b(P,[["render",H]]),K={components:{BasicTable:D,CardClassicBlock:J,PregBox:N,Page:v,CardBlock:T,DocsRow:y}},M={class:"col-md-3"};function O(u,p,e,f,x,h){const C=o("CardBlock"),l=o("PregBox"),i=o("DocsRow"),k=o("CardClassicBlock"),B=o("Page");return c(),$(B,{Title:"Dashboard"},{default:n(()=>[s(i,{Title:"1. d_card_block"},{default:n(()=>[(c(),r(m,null,_(4,g=>t("div",M,[s(C,{Title:"Card block title",Number:"$1,200",Icon:"bx bx-copy-alt font-size-24"})])),64)),s(l,{No:"1",Codes:` <div v-for="i in 4" class="col-md-3">
                <CardBlock
                    Title="Card block title"
                    Number="$1,200"
                    Icon="bx bx-copy-alt font-size-24"
                />
             </div>`})]),_:1}),s(i,{Title:"2. classic_card_block"},{default:n(()=>[(c(),r(m,null,_(3,g=>s(k,{Icon:"bx bx-copy-alt",Title:"Card block title",Number:"$1,200",Share:"12.3 %",Text:"Skote Saas Dashboard"})),64)),s(l,{No:"2",Codes:`<CardClassicBlock
                v-for="i in 3"
                Icon="bx bx-copy-alt"
                Title="Card block title"
                Number="$1,200"
                Share="12.3 %"
                Text="Skote Saas Dashboard"
            />`})]),_:1})]),_:1})}const tt=b(K,[["render",O]]);export{tt as default};
