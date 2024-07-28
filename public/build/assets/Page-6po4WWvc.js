import{_ as u,u as g,o as n,c as a,a as t,r as m,t as r,F as y,f as w,n as k,b as v,g as S,h as p,e as h,p as C,k as M,w as f,bz as L,bA as x,bB as B}from"./app-qjkFfopU.js";const I={data(){return{darkMode:!0}},setup(){return{counterStore:g()}},methods:{getSession(){let e=sessionStorage.getItem("is_visited"),s=localStorage.getItem("fon");console.log("Fon:",s),e=="dark-mode-switch"||s=="dark"?this.darkMode=!0:this.darkMode=!1},setting(){const e=document.getElementById("app");e.classList.contains("right-bar-enabled")?e.classList.remove("right-bar-enabled"):e.classList.add("right-bar-enabled")},addSession(e){e=="dark-mode-switch"?(this.darkMode=!0,localStorage.setItem("fon","dark"),document.documentElement.setAttribute("data-bs-theme","dark")):(document.documentElement.setAttribute("data-bs-theme","light"),localStorage.setItem("fon","white"),this.darkMode=!1),sessionStorage.setItem("is_visited",e),document.documentElement.removeAttribute("dir")}},mounted(){this.getSession()}},T={class:"right-bar"},N={"data-simplebar":"",class:"h-100"},A={class:"rightbar-title d-flex align-items-center px-3 py-4"},R=t("h5",{class:"m-0 me-2"},"Settings",-1),F=t("i",{class:"mdi mdi-close noti-icon"},null,-1),P=[F],E=t("hr",{class:"mt-0"},null,-1),j=t("h6",{class:"text-center mb-0"},"Choose Layouts",-1),z={class:"p-4"},V={class:"mb-2"},D=["src"],H={class:"form-check form-switch mb-3"},q=["checked"],U=t("label",{class:"form-check-label",for:"light-mode-switch"},"Light Mode",-1),G={class:"mb-2"},J=["src"],K={class:"form-check form-switch mb-3"},O=["checked"],Q=t("label",{class:"form-check-label",for:"dark-mode-switch"},"Dark Mode",-1);function W(e,s,o,c,l,d){return n(),a("div",T,[t("div",N,[t("div",A,[R,t("a",{onClick:s[0]||(s[0]=i=>d.setting()),style:{cursor:"pointer"},class:"right-bar-toggle ms-auto right_bar_icon"},P)]),E,j,t("div",z,[t("div",V,[t("img",{src:c.counterStore.baseUrl+"/assets/images/layouts/layout-1.jpg",class:"img-thumbnail",alt:"layout images"},null,8,D)]),t("div",H,[t("input",{class:"form-check-input theme-choice",type:"checkbox",id:"light-mode-switch",checked:!l.darkMode,onClick:s[1]||(s[1]=i=>d.addSession("light-mode-switch"))},null,8,q),U]),t("div",G,[t("img",{src:c.counterStore.baseUrl+"/assets/images/layouts/layout-2.jpg",class:"img-thumbnail",alt:"layout images"},null,8,J)]),t("div",K,[t("input",{class:"form-check-input theme-choice",type:"checkbox",checked:l.darkMode,id:"dark-mode-switch",onClick:s[2]||(s[2]=i=>d.addSession("dark-mode-switch"))},null,8,O),Q])])])])}const X=u(I,[["render",W]]),Y={},Z={class:"site_footer"},tt=t("p",null,"2024 © CodingCosmos group ",-1),et=t("p",null,"Program version 0.0.1",-1),st=[tt,et];function ot(e,s){return n(),a("div",Z,st)}const nt=u(Y,[["render",ot]]),at={components:{Footer:nt},props:{Title:{type:[String,Number],default:"Main title"},Links:{type:[Array],default:[{path:"/",name:"Dashboard",status:!1},{path:"/",name:"Menu",status:!0}]}},methods:{isMenuHidden(){const e=document.querySelector(".vertical-menu"),s=document.querySelector(".main-content");e.classList.contains("menuHidden")?s.classList.add("mainContent"):s.classList.remove("mainContent")}},mounted(){this.isMenuHidden()}},it={class:"main-content data_box"},dt={class:"page-content"},ct={class:"container-fluid"},lt={class:"row"},rt={class:"col-12"},ut={class:"page-title-box d-sm-flex align-items-center justify-content-between"},_t={class:"mb-sm-0 font-size-18"},mt={class:"page-title-right"},ht={class:"breadcrumb m-0"},pt=["onClick"],bt={key:0};function ft(e,s,o,c,l,d){const i=m("Footer");return n(),a("div",it,[t("div",dt,[t("div",ct,[t("div",lt,[t("div",rt,[t("div",ut,[t("h4",_t,r(o.Title),1),t("div",mt,[t("ol",ht,[(n(!0),a(y,null,w(o.Links,(_,b)=>(n(),a("li",{onClick:$=>!_.status&&this.$router.push(_.path),class:k([_.status?"link_active ":"","cursor-pointer"])},[v(r(_.name)+" ",1),b!=o.Links.length-1?(n(),a("span",bt,"/ ")):S("",!0)],10,pt))),256))])])])])]),p(e.$slots,"default",{},void 0,!0)]),h(i)])])}const $t=u(at,[["render",ft],["__scopeId","data-v-5109ee25"]]),gt={props:{Title:{type:[String,Number],default:"Title"},isModalFooter:{type:Boolean,default:!0},ModalName:{type:[String,Number],default:"modal"},Icon:{type:String,default:"bx bx-copy-alt font-size-24"},ModalTypes:{type:String,default:""}}},yt={class:"card-body"},kt=["id"],vt={class:"modal-content"},St={class:"modal-header"},Ct={class:"modal-title",id:"staticBackdropLabel"},Mt=t("button",{type:"button",class:"btn-close","data-bs-dismiss":"modal","aria-label":"Close"},null,-1),wt={class:"modal-body"},Lt={key:0,class:"modal-footer"},xt={type:"button",class:"btn btn-light","data-bs-dismiss":"modal"};function Bt(e,s,o,c,l,d){return n(),a("div",yt,[t("div",null,[t("div",{class:"modal fade",id:o.ModalName,"data-bs-backdrop":"static","data-bs-keyboard":"false",tabindex:"-1","aria-labelledby":"staticBackdropLabel","aria-hidden":"true",style:{display:"none"}},[t("div",{class:k(["modal-dialog modal-dialog-centered",o.ModalTypes]),role:"document"},[t("div",vt,[t("div",St,[t("h5",Ct,r(o.Title),1),Mt]),t("div",wt,[p(e.$slots,"default")]),o.isModalFooter?(n(),a("div",Lt,[t("button",xt,r(e.$t("Close")),1),t("button",{onClick:s[0]||(s[0]=i=>this.$emit("onModal",!0)),type:"button",class:"btn btn-primary"},r(e.$t("Submit")),1)])):S("",!0)])],2)],8,kt)])])}const It=u(gt,[["render",Bt]]),Tt={props:{Loader:{type:Boolean,default:!1}}},Nt=e=>(C("data-v-e3fd74db"),e=e(),M(),e),At={class:"w-100 d-flex justify-content-end mt-3"},Rt=["disabled"],Ft={key:1,class:"spinner-border text-white m-1",role:"status"},Pt=Nt(()=>t("span",{class:"sr-only"},"Loading...",-1)),Et=[Pt];function jt(e,s,o,c,l,d){return n(),a("div",At,[t("button",{disabled:o.Loader,onClick:s[0]||(s[0]=i=>this.$emit("onButton",!0)),type:"button",class:"btn btn-primary w-md"},[o.Loader?(n(),a("div",Ft,Et)):p(e.$slots,"default",{key:0},void 0,!0)],8,Rt)])}const zt=u(Tt,[["render",jt],["__scopeId","data-v-e3fd74db"]]),Vt={props:{Loader:{type:Boolean,default:!1}}},Dt=e=>(C("data-v-8771995a"),e=e(),M(),e),Ht=["disabled"],qt={key:1,class:"spinner-border text-white m-1",role:"status"},Ut=Dt(()=>t("span",{class:"sr-only"},"Loading...",-1)),Gt=[Ut];function Jt(e,s,o,c,l,d){return n(),a("button",{disabled:o.Loader,onClick:s[0]||(s[0]=i=>this.$emit("onButton",!0)),type:"button",class:"btn btn-primary w-md"},[o.Loader?(n(),a("div",qt,Gt)):p(e.$slots,"default",{key:0},void 0,!0)],8,Ht)}const Kt=u(Vt,[["render",Jt],["__scopeId","data-v-8771995a"]]),Ot={components:{PrimaryBtn:Kt,PrimaryButton:zt},methods:{reload(){window.location.reload()}}},Qt={class:"text-center mb-4"},Wt=t("div",{class:"avatar-md mx-auto mb-4"},[t("div",{class:"avatar-title bg-light rounded-circle text-primary h1"},[t("i",{class:"bx bx-info-circle"})])],-1),Xt={class:"row justify-content-center"},Yt={class:"col-xl-10"},Zt={class:"text-primary"},te={class:"text-muted font-size-14 mb-4"};function ee(e,s,o,c,l,d){const i=m("PrimaryBtn");return n(),a("div",Qt,[Wt,t("div",Xt,[t("div",Yt,[t("h4",Zt,r(e.$t("ChangeRole")),1),t("p",te,r(e.$t("ChangeRoleInfo")),1),t("div",null,[h(i,{onClick:s[0]||(s[0]=_=>d.reload())},{default:f(()=>[v(r(e.$t("PageReload")),1)]),_:1})])])])])}const se=u(Ot,[["render",ee]]),oe={components:{AlertContainer:se,ModalCentered:It,MainContent:$t,RightBar:X,LeftMenu:L,Topbar:x},setup(){return{counterStore:g()}},props:{Title:{type:[String,Number],default:"Main title"},Links:{type:[Array],default:[]}},methods:{isToken(){let e=localStorage.getItem("0008a78764c2");(!e||e==null||e==null)&&this.$router.push("/login")},async isChangeRole(){try{let e=localStorage.getItem("token");(!e||e==null)&&(localStorage.setItem("token",""),e="");const s=await B(this.counterStore.user.role_id);(s.data.user_id==this.counterStore.user.id||s.data.user_id==0)&&s.status&&s.data.token!=e&&new bootstrap.Modal(document.getElementById("changeRole")).show()}catch{this.$router.push("/login")}}},mounted(){setTimeout(()=>{this.isChangeRole()},500),this.isToken()}},ne={id:"layout-wrapper"};function ae(e,s,o,c,l,d){const i=m("MainContent"),_=m("RightBar"),b=m("AlertContainer"),$=m("ModalCentered");return n(),a(y,null,[t("div",ne,[h(i,{Title:o.Title,Links:o.Links},{default:f(()=>[p(e.$slots,"default")]),_:3},8,["Title","Links"])]),h(_),h($,{ModalName:"changeRole",isModalFooter:!1,Title:e.$t("Alert")},{default:f(()=>[h(b)]),_:1},8,["Title"])],64)}const de=u(oe,[["render",ae]]);export{It as M,de as P,Kt as a,zt as b};
