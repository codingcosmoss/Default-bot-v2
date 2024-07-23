import{a as w,P as E}from"./Page-X_CL2XrS.js";import{_ as L,Q as S,u as V,S as N,l as p,M as I,A as m,N as x,d as y,w as a,r as o,o as l,a as h,e as i,b as f,t as _,c as C,f as $,F as A}from"./app-HuQxhYkh.js";import{a as M,B as F}from"./BasicTable-yOAfWnez.js";import{G,P as U}from"./GrowingLoader-hxei4TSu.js";import{D as O}from"./DefaultInput-8EaRomtX.js";import{P as Q}from"./PrimaryTable-05LQ_C3y.js";const R={components:{BaseCheck:S,PrimaryTable:Q,BtnBox:M,DefaultInput:O,PrimaryBtn:w,GrowingLoader:G,PrimaryIconBtn:U,BasicTable:F,Page:E},setup(){return{counterStore:V()}},data(){return{items:[],item:[],paginateCount:10,column:"id",type:"desc",errors:[],loader:!1,menus:[],permissions:[],isAll:!1}},methods:{async index(){try{this.loader=!0;const e=await N();this.items=e.data,this.loader=!1}catch(e){p(this,e)}},async create(){try{this.loader=!0;let e={name:this.name,permissions:this.permissions};const s=await I(e);return s.status?(m("success",this.$t("create")),this.loader=!1,this.$router.push("/admin/roles"),!0):(this.errors=s.errors,this.loader=!1,m("error",this.$t("formError")),!1)}catch(e){return p(this,e),this.loader=!1,!1}},async update(){try{const s=await x({});return s.status?(m("success",this.$t("update")),!0):(this.errors=s.errors,m("error",this.$t("formError")),!1)}catch(e){return p(this,e),!1}},addPermission(e){this.permissions.find(t=>t==e.id)?this.permissions=this.permissions.filter(t=>t!=e.id):(this.menus.push(e.menu_id),this.permissions.push(e.id))},addAllPermission(){this.isAll=!this.isAll,this.isAll?this.items.forEach(e=>{this.menus.push(e.id),e.permissions.forEach(s=>{this.permissions.push(s.id)})}):(this.menus=[],this.permissions=[]),console.log(this.permissions)},addMenu(e){this.menus.find(t=>t==e.id)?(this.menus=this.menus.filter(t=>t!=e.id),this.permissions=this.permissions.filter(t=>!e.permissions.find(B=>B.id==t))):(this.menus.push(e.id),e.permissions.forEach(t=>{this.permissions.includes(t.id)||this.permissions.push(t.id)}))}},mounted(){this.index()}},j={class:"row"},q=h("br",null,null,-1),z={class:"text-primary"};function H(e,s,t,B,d,u){const b=o("DefaultInput"),T=o("PrimaryBtn"),g=o("BtnBox"),k=o("BaseBox"),c=o("BaseCheck"),D=o("PrimaryTable"),v=o("Page");return l(),y(v,{Title:""},{default:a(()=>[h("div",j,[i(k,{Col:"col-xl-6",Title:e.$t("Create")},{default:a(()=>[i(b,{Label:e.$t("RoleName"),Name:"name",Type:"text",Validated:d.errors,Value:e.name,onOnInput:s[0]||(s[0]=r=>(e.name=r,delete this.errors.name))},null,8,["Label","Validated","Value"]),i(g,null,{default:a(()=>[i(T,{class:"btn btn-secondary",onClick:s[1]||(s[1]=r=>this.$router.go(-1))},{default:a(()=>[f(_(e.$t("Close")),1)]),_:1}),f("   "),i(T,{onClick:s[2]||(s[2]=r=>u.create()),Loader:d.loader},{default:a(()=>[f(_(e.$t("Save")),1)]),_:1},8,["Loader"])]),_:1})]),_:1},8,["Title"]),i(k,{Col:"col-xl-6",Title:e.$t("Permissions")},{default:a(()=>[i(c,{onClick:s[3]||(s[3]=r=>u.addAllPermission()),isCheck:d.isAll,Title:e.$t("MarkAll")},null,8,["isCheck","Title"]),q,i(D,{Th:[e.$t("Sections"),e.$t("Permissions")],Title:"Latest Transaction",Col:"col-lg-12"},{default:a(()=>[(l(!0),C(A,null,$(d.items,r=>(l(),C("tr",null,[h("td",null,[i(c,{Title:e.$t(r.name),onClick:n=>u.addMenu(r),isCheck:this.menus.find(n=>n==r.id)},null,8,["Title","onClick","isCheck"])]),h("td",z,[(l(!0),C(A,null,$(r.permissions,n=>(l(),y(c,{onClick:P=>u.addPermission(n),isCheck:this.permissions.find(P=>P==n.id),Title:e.$t(n.name.toUpperCase())},null,8,["onClick","isCheck","Title"]))),256))])]))),256))]),_:1},8,["Th"])]),_:1},8,["Title"])])]),_:1})}const ee=L(R,[["render",H]]);export{ee as default};
