import{_ as o,o as l,b as n,e as t,t as u,g as d,n as s,h as c}from"./app-YVDEE9Za.js";const p={props:{Class:{type:String,default:"col-lg-12 col-sm-12"},inputClass:{type:String,default:""},Name:{type:[String],default:""},Label:{type:String,default:"Label title"},Pholder:{type:String,default:"enter here..."},Type:{type:String,default:"text"},Value:{type:[String,Number],default:""},Validated:{type:[Array,Object,String],default:[]}}},f={key:0,class:"form-label"},g={class:"input-group",id:"timepicker-input-group1"},m=["type","value","placeholder"],y={class:"input-group-text"};function _(r,a,e,b,h,S){return l(),n("div",{class:s(e.Class)},[t("div",null,[e.Label!=""?(l(),n("label",f,u(e.Label),1)):d("",!0),t("div",g,[t("input",{class:s(["form-control",e.Validated[e.Name]?"border-danger "+e.inputClass:e.inputClass]),type:e.Type,value:e.Value,placeholder:e.Pholder,onInput:a[0]||(a[0]=i=>this.$emit("onInput",i.target.value))},null,42,m),t("span",y,[c(r.$slots,"default")])])])],2)}const v=o(p,[["render",_]]);export{v as D};
