import{_ as r,o as d,c as a,a as s,t as i,h as u,A as c}from"./app-HuQxhYkh.js";const m={props:{Title:{type:String,default:"Title"}}},f={class:"row mb-4"},y={class:"docs_box"},g={class:"mb-sm-0 font-size-16"};function h(o,e,t,l,_,n){return d(),a("div",f,[s("div",y,[s("h4",g,i(t.Title),1)]),u(o.$slots,"default",{},void 0,!0)])}const b=r(m,[["render",h],["__scopeId","data-v-2c8f6b91"]]),$={props:{No:{type:String,required:!0},Codes:{type:String,default:""}},methods:{copyPreContent(){const o=document.getElementById("contentToCopy"+this.No);if(o){const e=document.createRange();e.selectNode(o),window.getSelection().removeAllRanges(),window.getSelection().addRange(e);try{document.execCommand("copy"),window.getSelection().removeAllRanges(),c("success",this.$t("copySuccess"))}catch(t){console.error("Failed to copy: ",t),c("success",this.$t("copyError"))}}}}},x={class:"preg_box"},C=["id"];function S(o,e,t,l,_,n){return d(),a("div",x,[s("i",{class:"bx bx-copy-alt font-size-15",onClick:e[0]||(e[0]=(...p)=>n.copyPreContent&&n.copyPreContent(...p))}),s("pre",{id:"contentToCopy"+t.No},"            "+i(t.Codes)+`
        `,9,C)])}const v=r($,[["render",S],["__scopeId","data-v-5d5f7ed3"]]);export{b as D,v as P};
