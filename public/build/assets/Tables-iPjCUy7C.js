import{a as D,P as T}from"./Page-NCt1vy8i.js";import{_ as S,u as x,c as r,w as s,r as e,o,a as i,e as n,t as c,f as k,g as u,b as g,d as w,F as N}from"./app-lWMg9xSA.js";import{P as $,D as L}from"./PregBox-q60FPFFJ.js";import{B as R}from"./BasicTable-ogQmHKq1.js";import{D as G}from"./DefaultSelect-G7Ix1xfW.js";import{D as M}from"./DefaultInput-eaIS2-ET.js";import{P as V}from"./PrimaryIconBtn-NpjfOHT_.js";import{P as O}from"./Paginate-arsfl-F6.js";import{G as q}from"./GrowingLoader--NO59BdZ.js";const z={setup(){return{counterStore:x()}},components:{PrimaryBtn:D,GrowingLoader:q,Paginate:O,PrimaryIconBtn:V,DefaultInput:M,DefaultSelect:G,BasicTable:R,PregBox:$,Page:T,DocsRow:L},data(){return{tableItems3:[{id:1,name:"Neal Matthews",date:"2023-21-21",total:"100,00 uzs",status:"active",headers:["Order ID","Billing Name","Date","Payment Status","Settings"]},{id:2,name:"Neal Matthews",date:"2023-21-21",total:"100,00 uzs",status:"active"}]}}},F={value:"10",selected:""},U=n("option",{value:"10"},"10",-1),E=n("option",{value:"20"},"20",-1),j=n("option",{value:"50"},"50",-1),A=n("option",{value:"100"},"100",-1);function H(a,l,J,d,h,K){const b=e("DefaultInput"),P=e("DefaultSelect"),_=e("PrimaryBtn"),p=e("PrimaryIconBtn"),f=e("Paginate"),v=e("GrowingLoader"),C=e("BasicTable"),B=e("PregBox"),I=e("DocsRow"),y=e("Page");return o(),r(y,{Title:"Tables"},{default:s(()=>[i(I,{Title:"1. Basic Table"},{default:s(()=>[i(C,{Th:a.headers,Title:"Latest Transaction",Col:"col-lg-12"},{inputs:s(()=>[i(b,{Class:"col-lg-3 col-sm-2 search_input",Label:"",Name:"name",Type:"text",Pholder:"Search...",onOnInput:l[0]||(l[0]=t=>a.search(t))}),i(P,{Label:"",Class:"col-lg-2 col-sm-2",onOnInput:l[1]||(l[1]=t=>(this.paginateCount=t,this.indexPaginates()))},{default:s(()=>[n("option",F,c(a.$t("NumberDownloads")),1),U,E,j,A]),_:1})]),buttons:s(()=>[d.counterStore.hasRole("public")?(o(),r(_,{key:0,role:"button","data-bs-toggle":"modal","data-bs-target":"#userCreate"},{default:s(()=>[k(c(a.$t("Create")),1)]),_:1})):u("",!0)]),default:s(()=>[(o(!0),g(N,null,w(h.tableItems3,t=>(o(),g("tr",null,[n("td",null,c(t.id),1),n("td",null,c(t.name),1),n("td",null,c(t.date),1),n("td",null,c(t.total),1),n("td",null,[d.counterStore.hasRole("public")?(o(),r(p,{key:0,onClick:m=>this.item=t,Icon:"bx bx-edit-alt",Modal:"userUpdate"},null,8,["onClick"])):u("",!0),i(p,{onClick:m=>this.$router.push({path:"path",query:{id:t.id}}),Icon:"bx bx-show"},null,8,["onClick"]),d.counterStore.hasRole("public")?(o(),r(p,{key:1,onClick:m=>this.delete(t.id),class:"bg-danger border-danger",Icon:"bx bx-trash-alt"},null,8,["onClick"])):u("",!0)])]))),256)),a.last_page!=1?(o(),r(f,{key:0,currentPage:this.current_page,totalPages:this.last_page,onChangePage:l[2]||(l[2]=t=>a.indexPaginates(t))},null,8,["currentPage","totalPages"])):u("",!0),a.loader?(o(),r(v,{key:1,Cols:a.headers.length()},null,8,["Cols"])):u("",!0)]),_:1},8,["Th"]),i(B,{No:"1",Codes:` <BasicTable
                :Th="headers"
                Title="Latest Transaction"
                Col="col-lg-12"
            >
                <template v-slot:inputs>
                    <DefaultInput
                        Class="col-lg-3 col-sm-2 search_input"
                        Label=""
                        Name="name"
                        Type="text"
                        Pholder="Search..."
                        @onInput="search($event)"
                    />

                    <DefaultSelect
                        Label=""
                        Class="col-lg-2 col-sm-2"
                        @onInput="this.paginateCount = $event, this.indexPaginates()"
                    >
                        <option value="10" selected >{{$t('NumberDownloads')}}</option>
                        <option value="10" >10</option>
                        <option value="20" >20</option>
                        <option value="50" >50</option>
                        <option value="100" >100</option>
                    </DefaultSelect>
                </template>
                <template v-slot:buttons>
                    <PrimaryBtn v-if="counterStore.hasRole('public')" role="button" data-bs-toggle="modal" data-bs-target="#userCreate" >{{$t('Create')}}</PrimaryBtn>
                </template>

                <tr v-for="item in items" >

                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.date }}</td>
                    <td>{{ item.total }}</td>
                    <td>
                        <PrimaryIconBtn v-if="counterStore.hasRole('public')" @click="this.item = item" Icon="bx bx-edit-alt" Modal="userUpdate"/>&nbsp;
                        <PrimaryIconBtn  @click="this.$router.push({path:'path', query:{id: item.id}})" Icon="bx bx-show"/>&nbsp;
                        <PrimaryIconBtn v-if="counterStore.hasRole('public')" @click="this.delete(item.id)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
                    </td>
                </tr>
                <Paginate
                    v-if="last_page != 1"
                    :currentPage="this.current_page"
                    :totalPages="this.last_page"
                    @changePage="indexPaginates($event)"
                />
                <GrowingLoader v-if="loader" :Cols="headers.length()"/>
            </BasicTable>`})]),_:1})]),_:1})}const ot=S(z,[["render",H]]);export{ot as default};
