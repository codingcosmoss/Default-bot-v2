import{_ as o,o as r,c as n,a,t as s,n as i}from"./app-KIduKiR5.js";const u={props:{Label:{type:[String],default:"Label..."},Type:{type:[String],default:"text"},Value:{type:[String],default:null},Pholder:{type:[String],default:"Placeholder..."},isError:{type:Boolean,default:!1}}},c={class:"mb-3"},d={for:"username",class:"form-label"},p=["type","value","placeholder"];function f(_,t,e,m,y,h){return r(),n("div",c,[a("label",d,s(e.Label),1),a("input",{class:i([e.isError&&"input_error","form-control"]),type:e.Type,value:e.Value,placeholder:e.Pholder,onInput:t[0]||(t[0]=l=>this.$emit("onInput",l.target.value))},null,42,p)])}const b=o(u,[["render",f]]);export{b as L};
