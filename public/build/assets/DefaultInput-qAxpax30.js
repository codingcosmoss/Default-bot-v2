import{_ as r,o as l,c as n,a as t,t as i,g as u,n as s}from"./app-qjkFfopU.js";const o={props:{Class:{type:String,default:"col-lg-12 col-sm-12"},Min:{type:Number,default:0},isDisabled:{type:Boolean,default:!1},inputClass:{type:String,default:""},Name:{type:[String],default:""},Label:{type:String,default:"Label title"},Pholder:{type:String,default:"enter here..."},Type:{type:String,default:"text"},Value:{type:[String,Number],default:""},Validated:{type:[Array,Object,String],default:[]}}},c={key:0,class:"form-label"},f=["disabled","type","value","placeholder","min"],m={class:"form-label text-danger"};function y(b,a,e,g,_,S){return l(),n("div",{class:s(e.Class)},[t("div",null,[e.Label!=""?(l(),n("label",c,i(e.Label),1)):u("",!0),t("input",{disabled:e.isDisabled,class:s(["form-control",e.Validated[e.Name]?"border-danger "+e.inputClass:e.inputClass]),type:e.Type,value:e.Value,placeholder:e.Pholder,onInput:a[0]||(a[0]=d=>this.$emit("onInput",d.target.value)),min:e.Min},null,42,f),t("p",m,i(e.Validated[e.Name]),1)])],2)}const p=r(o,[["render",y]]);export{p as D};
