import{_ as i,o as l,c as n,a as t,t as s,g as o,n as r}from"./app-vet2y67C.js";const u={props:{Class:{type:String,default:"col-lg-12 col-sm-12"},inputClass:{type:String,default:""},Name:{type:[String],default:""},Label:{type:String,default:"Label title"},Pholder:{type:String,default:"enter here..."},Type:{type:String,default:"text"},Value:{type:[String,Number],default:""},Validated:{type:[Array,Object,String],default:[]}}},c={key:0,class:"form-label"},f=["type","value","placeholder"],m={class:"form-label text-danger"};function y(g,a,e,_,b,p){return l(),n("div",{class:r(e.Class)},[t("div",null,[e.Label!=""?(l(),n("label",c,s(e.Label),1)):o("",!0),t("input",{class:r(["form-control",e.Validated[e.Name]?"border-danger "+e.inputClass:e.inputClass]),type:e.Type,value:e.Value,placeholder:e.Pholder,onInput:a[0]||(a[0]=d=>this.$emit("onInput",d.target.value))},null,42,f),t("p",m,s(e.Validated[e.Name]),1)])],2)}const h=i(u,[["render",y]]);export{h as D};
