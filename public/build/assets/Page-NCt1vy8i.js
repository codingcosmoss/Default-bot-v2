import{_,u as $,o as n,b as a,e,r as u,t as h,F as k,d as w,n as y,f as v,g as M,h as p,a as m,p as S,l as C,w as g,M as L,bQ as x,bR as B,bS as I}from"./app-lWMg9xSA.js";const T={data(){return{darkMode:!0}},setup(){return{counterStore:$()}},methods:{getSession(){let t=sessionStorage.getItem("is_visited"),s=localStorage.getItem("fon");t=="dark-mode-switch"||s=="dark"?this.darkMode=!0:this.darkMode=!1},setting(){const t=document.getElementById("app");t.classList.contains("right-bar-enabled")?t.classList.remove("right-bar-enabled"):t.classList.add("right-bar-enabled")},addSession(t){t=="dark-mode-switch"?(this.darkMode=!0,localStorage.setItem("fon","dark"),document.documentElement.setAttribute("data-bs-theme","dark")):(document.documentElement.setAttribute("data-bs-theme","light"),localStorage.setItem("fon","white"),this.darkMode=!1),sessionStorage.setItem("is_visited",t),document.documentElement.removeAttribute("dir")}},mounted(){this.getSession()}},R={class:"right-bar"},A={"data-simplebar":"",class:"h-100"},N={class:"rightbar-title d-flex align-items-center px-3 py-4"},P=e("h5",{class:"m-0 me-2"},"Settings",-1),E=e("i",{class:"mdi mdi-close noti-icon"},null,-1),F=[E],j=e("hr",{class:"mt-0"},null,-1),D=e("h6",{class:"text-center mb-0"},"Choose Layouts",-1),V={class:"p-4"},z={class:"mb-2"},H=["src"],q={class:"form-check form-switch mb-3"},U=["checked"],Q=e("label",{class:"form-check-label",for:"light-mode-switch"},"Light Mode",-1),G={class:"mb-2"},J=["src"],K={class:"form-check form-switch mb-3"},O=["checked"],W=e("label",{class:"form-check-label",for:"dark-mode-switch"},"Dark Mode",-1);function X(t,s,o,c,r,d){return n(),a("div",R,[e("div",A,[e("div",N,[P,e("a",{onClick:s[0]||(s[0]=i=>d.setting()),style:{cursor:"pointer"},class:"right-bar-toggle ms-auto right_bar_icon"},F)]),j,D,e("div",V,[e("div",z,[e("img",{src:c.counterStore.baseUrl+"/assets/images/layouts/layout-1.jpg",class:"img-thumbnail",alt:"layout images"},null,8,H)]),e("div",q,[e("input",{class:"form-check-input theme-choice",type:"checkbox",id:"light-mode-switch",checked:!r.darkMode,onClick:s[1]||(s[1]=i=>d.addSession("light-mode-switch"))},null,8,U),Q]),e("div",G,[e("img",{src:c.counterStore.baseUrl+"/assets/images/layouts/layout-2.jpg",class:"img-thumbnail",alt:"layout images"},null,8,J)]),e("div",K,[e("input",{class:"form-check-input theme-choice",type:"checkbox",checked:r.darkMode,id:"dark-mode-switch",onClick:s[2]||(s[2]=i=>d.addSession("dark-mode-switch"))},null,8,O),W])])])])}const Y=_(T,[["render",X]]),Z={},tt={class:"site_footer"},et=e("p",null,"2024 © CodingCosmos group ",-1),st=e("p",null,"Program version 1.0.0v",-1),ot=[et,st];function nt(t,s){return n(),a("div",tt,ot)}const at=_(Z,[["render",nt]]),it={components:{Footer:at},props:{Title:{type:[String,Number],default:"Main title"},Links:{type:[Array],default:[{path:"/",name:"Dashboard",status:!1},{path:"/",name:"Menu",status:!0}]}},methods:{isMenuHidden(){const t=document.querySelector(".vertical-menu"),s=document.querySelector(".main-content");t.classList.contains("menuHidden")?s.classList.add("mainContent"):s.classList.remove("mainContent")}},mounted(){this.isMenuHidden()}},dt={class:"main-content data_box"},ct={class:"page-content"},rt={class:"container-fluid"},lt={class:"row"},_t={class:"col-12"},ut={class:"page-title-box d-sm-flex align-items-center justify-content-between"},mt={class:"mb-sm-0 font-size-18"},ht={class:"page-title-right"},pt={class:"breadcrumb m-0"},ft=["onClick"],gt={key:0};function bt(t,s,o,c,r,d){const i=u("Footer");return n(),a("div",dt,[e("div",ct,[e("div",rt,[e("div",lt,[e("div",_t,[e("div",ut,[e("h4",mt,h(o.Title),1),e("div",ht,[e("ol",pt,[(n(!0),a(k,null,w(o.Links,(l,f)=>(n(),a("li",{onClick:b=>!l.status&&this.$router.push(l.path),class:y([l.status?"link_active ":"","cursor-pointer"])},[v(h(l.name)+" ",1),f!=o.Links.length-1?(n(),a("span",gt,"/ ")):M("",!0)],10,ft))),256))])])])])]),p(t.$slots,"default",{},void 0,!0)]),m(i)])])}const $t=_(it,[["render",bt],["__scopeId","data-v-5109ee25"]]),kt={props:{Loader:{type:Boolean,default:!1},isDisabled:{type:Boolean,default:!1}}},yt=t=>(S("data-v-a22b28d7"),t=t(),C(),t),vt={class:"w-100 d-flex justify-content-end mt-3"},St=["disabled"],Ct={key:1,class:"spinner-border text-white m-1",role:"status"},wt=yt(()=>e("span",{class:"sr-only"},"Loading...",-1)),Mt=[wt];function Lt(t,s,o,c,r,d){return n(),a("div",vt,[e("button",{disabled:o.Loader,onClick:s[0]||(s[0]=i=>this.$emit("onButton",!0)),class:y([o.isDisabled?"disabled":"","btn btn-primary w-md"]),type:"button"},[o.Loader?(n(),a("div",Ct,Mt)):p(t.$slots,"default",{key:0},void 0,!0)],10,St)])}const xt=_(kt,[["render",Lt],["__scopeId","data-v-a22b28d7"]]),Bt={props:{Loader:{type:Boolean,default:!1}}},It=t=>(S("data-v-8771995a"),t=t(),C(),t),Tt=["disabled"],Rt={key:1,class:"spinner-border text-white m-1",role:"status"},At=It(()=>e("span",{class:"sr-only"},"Loading...",-1)),Nt=[At];function Pt(t,s,o,c,r,d){return n(),a("button",{disabled:o.Loader,onClick:s[0]||(s[0]=i=>this.$emit("onButton",!0)),type:"button",class:"btn btn-primary w-md"},[o.Loader?(n(),a("div",Rt,Nt)):p(t.$slots,"default",{key:0},void 0,!0)],8,Tt)}const Et=_(Bt,[["render",Pt],["__scopeId","data-v-8771995a"]]),Ft={components:{PrimaryBtn:Et,PrimaryButton:xt},methods:{reload(){window.location.reload()}}},jt={class:"text-center mb-4"},Dt=e("div",{class:"avatar-md mx-auto mb-4"},[e("div",{class:"avatar-title bg-light rounded-circle text-primary h1"},[e("i",{class:"bx bx-info-circle"})])],-1),Vt={class:"row justify-content-center"},zt={class:"col-xl-10"},Ht={class:"text-primary"},qt={class:"text-muted font-size-14 mb-4"};function Ut(t,s,o,c,r,d){const i=u("PrimaryBtn");return n(),a("div",jt,[Dt,e("div",Vt,[e("div",zt,[e("h4",Ht,h(t.$t("ChangeRole")),1),e("p",qt,h(t.$t("ChangeRoleInfo")),1),e("div",null,[m(i,{onClick:s[0]||(s[0]=l=>d.reload())},{default:g(()=>[v(h(t.$t("PageReload")),1)]),_:1})])])])])}const Qt=_(Ft,[["render",Ut]]),Gt={components:{AlertContainer:Qt,ModalCentered:L,MainContent:$t,RightBar:Y,LeftMenu:x,Topbar:B},setup(){return{counterStore:$()}},props:{Title:{type:[String,Number],default:"Main title"},Links:{type:[Array],default:[]}},methods:{isToken(){let t=localStorage.getItem("0008a78764c2");(!t||t==null||t==null)&&this.$router.push("/login")},async isChangeRole(){try{let t=localStorage.getItem("token");(!t||t==null)&&(localStorage.setItem("token",""),t="");const s=await I(this.counterStore.user.role_id);(s.data.user_id==this.counterStore.user.id||s.data.user_id==0)&&s.status&&s.data.token!=t&&new bootstrap.Modal(document.getElementById("changeRole")).show()}catch{this.$router.push("/login")}}},mounted(){setTimeout(()=>{this.isChangeRole()},500),this.isToken()}},Jt={id:"layout-wrapper"};function Kt(t,s,o,c,r,d){const i=u("MainContent"),l=u("RightBar"),f=u("AlertContainer"),b=u("ModalCentered");return n(),a(k,null,[e("div",Jt,[m(i,{Title:o.Title,Links:o.Links},{default:g(()=>[p(t.$slots,"default")]),_:3},8,["Title","Links"])]),m(l),m(b,{ModalName:"changeRole",isModalFooter:!1,Title:t.$t("Alert")},{default:g(()=>[m(f)]),_:1},8,["Title"])],64)}const Wt=_(Gt,[["render",Kt]]);export{Wt as P,Et as a,xt as b};
