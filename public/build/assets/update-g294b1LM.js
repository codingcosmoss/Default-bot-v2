import{a as D,P as E}from"./Page-k1RhpKxv.js";import{_ as L,a4 as S,u as x,a5 as V,H as f,$ as I,a0 as N,A as C,a1 as U,c as y,w as a,r as h,o as d,e as o,a as n,b as m,d as T,F as _,f as B,t as b}from"./app-tuttM9Io.js";import{a as M,B as q}from"./BasicTable-dpWtiJ4i.js";import{P as F}from"./PrimaryIconBtn-utELPCpc.js";import{G}from"./GrowingLoader-ajX8lziD.js";import{D as z}from"./DefaultInput-AnvAhpkM.js";import{P as H}from"./PrimaryTable-W9yGqBTk.js";const O={components:{BaseCheck:S,PrimaryTable:H,BtnBox:M,DefaultInput:z,PrimaryBtn:D,GrowingLoader:G,PrimaryIconBtn:F,BasicTable:q,Page:E},setup(){return{counterStore:x()}},data(){return{items:[],item:[],paginateCount:10,column:"id",type:"desc",errors:[],loader:!1,menus:[],permissions:[],isAll:!1,name:""}},methods:{async index(){try{this.loader=!0;const s=await V();this.items=s.data,this.loader=!1}catch(s){f(this,s)}},async show(s){try{const e=await I(this.$route.query.id);this.item=e.data,this.name=e.data.name,e.data.permissions.forEach(t=>{this.permissions.push(t.id),this.menus.push(t.menu_id)})}catch(e){f(this,e)}},async create(){try{this.loader=!0;let s={name:this.name,permissions:this.permissions};const e=await N(s);return e.status?(C("success",this.$t("create")),this.loader=!1,this.$router.push("/admin/roles"),!0):(this.errors=e.errors,this.loader=!1,C("error",this.$t("formError")),!1)}catch(s){return f(this,s),this.loader=!1,!1}},async update(){try{this.loader=!0;let s={name:this.name,permissions:this.permissions};const e=await U(this.$route.query.id,s);return console.log(e),e.status?(this.$router.push("/admin/roles"),C("success",this.$t("update")),this.loader=!1,!0):(this.errors=e.errors,C("error",this.$t("formError")),this.loader=!1,!1)}catch(s){return f(this,s),this.loader=!1,!1}},addPermission(s){this.permissions.find(t=>t==s.id)?this.permissions=this.permissions.filter(t=>t!=s.id):(this.menus.push(s.menu_id),this.permissions.push(s.id))},addAllPermission(){this.isAll=!this.isAll,this.isAll?(this.menus=[],this.permissions=[],this.items.forEach(s=>{this.menus.push(s.id),s.permissions.forEach(e=>{this.permissions.push(e.id)})})):(this.menus=[],this.permissions=[]),console.log("Uzenligi:",this.menus.length)},addMenu(s){this.menus.find(t=>t==s.id)?(this.menus=this.menus.filter(t=>t!=s.id),this.permissions=this.permissions.filter(t=>!s.permissions.find(P=>P.id==t))):(this.menus.push(s.id),s.permissions.forEach(t=>{this.permissions.includes(t.id)||this.permissions.push(t.id)}))}},mounted(){this.index(),this.show()}},R={class:"row"},j={class:"col-xl-12"},J=o("br",null,null,-1),K={class:"text-primary"},Q=o("h4",{class:"card-title mb-4 d-none d-xl-block"}," ",-1),W=o("div",{class:"m-xl-5"},null,-1),X=o("br",null,null,-1),Y={class:"text-primary"},Z=o("br",null,null,-1);function ss(s,e,t,P,l,u){const v=h("DefaultInput"),k=h("BaseBox"),c=h("BaseCheck"),$=h("PrimaryTable"),g=h("PrimaryBtn"),w=h("BtnBox"),A=h("Page");return d(),y(A,{Title:""},{default:a(()=>[o("div",R,[o("div",j,[n(k,{Col:"col-xl-6",Title:s.$t("Update")},{default:a(()=>[n(v,{Label:s.$t("RoleName"),Name:"name",Type:"text",Validated:l.errors,Value:l.name,onOnInput:e[0]||(e[0]=i=>(l.name=i,delete this.errors.name))},null,8,["Label","Validated","Value"])]),_:1},8,["Title"])]),n(k,{Col:"col-xl-6",Title:s.$t("Permissions")},{default:a(()=>[n(c,{onClick:e[1]||(e[1]=i=>u.addAllPermission()),isCheck:l.isAll,Title:s.$t("MarkAll")},null,8,["isCheck","Title"]),J,n($,{Th:[s.$t("Sections"),s.$t("Permissions")],Title:"Latest Transaction",Col:"col-lg-12"},{default:a(()=>[(d(!0),m(_,null,T(l.items.slice(0,l.items.length/2),i=>(d(),m("tr",null,[o("td",null,[n(c,{Title:s.$t(i.name),onClick:r=>u.addMenu(i),isCheck:this.menus.find(r=>r==i.id)},null,8,["Title","onClick","isCheck"])]),o("td",K,[(d(!0),m(_,null,T(i.permissions,r=>(d(),y(c,{onClick:p=>u.addPermission(r),isCheck:this.permissions.find(p=>p==r.id),Title:s.$t(r.name.toUpperCase())},null,8,["onClick","isCheck","Title"]))),256))])]))),256))]),_:1},8,["Th"])]),_:1},8,["Title"]),n(k,{Col:"col-xl-6",Title:""},{default:a(()=>[Q,W,X,n($,{Th:[s.$t("Sections"),s.$t("Permissions")],Title:"Latest Transaction",Col:"col-lg-12"},{default:a(()=>[(d(!0),m(_,null,T(l.items.slice(l.items.length/2,l.items.length),i=>(d(),m("tr",null,[o("td",null,[n(c,{Title:s.$t(i.name),onClick:r=>u.addMenu(i),isCheck:this.menus.find(r=>r==i.id)},null,8,["Title","onClick","isCheck"])]),o("td",Y,[(d(!0),m(_,null,T(i.permissions,r=>(d(),y(c,{onClick:p=>u.addPermission(r),isCheck:this.permissions.find(p=>p==r.id),Title:s.$t(r.name.toUpperCase())},null,8,["onClick","isCheck","Title"]))),256))])]))),256))]),_:1},8,["Th"]),Z,n(w,null,{default:a(()=>[n(g,{class:"btn btn-secondary",onClick:e[2]||(e[2]=i=>this.$router.go(-1))},{default:a(()=>[B(b(s.$t("Close")),1)]),_:1}),B("   "),n(g,{onClick:e[3]||(e[3]=i=>u.update()),Loader:l.loader},{default:a(()=>[B(b(s.$t("Save")),1)]),_:1},8,["Loader"])]),_:1})]),_:1})])]),_:1})}const as=L(O,[["render",ss]]);export{as as default};
