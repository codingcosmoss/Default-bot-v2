import{P as I}from"./Page-s6HucaFA.js";import{_ as f,e as _,w as a,f as t,o as u,g as e,c as B,r as x,F as V}from"./app-KIduKiR5.js";import{P as D,D as N}from"./PregBox-Y5W84FPQ.js";import{B as P}from"./BasicTable-Q6STW7Df.js";import{D as T}from"./DefaultInput-s717lcsR.js";import{I as w}from"./ImageInput-iUHCgkgR.js";const C={components:{ImageInput:w,DefaultInput:T,BasicTable:P,PregBox:D,Page:I,DocsRow:N},data(){return{errors:[],image:location.origin+"/Photos/file.png",tableItems3:[{id:1,name:"Neal Matthews",date:"2023-21-21",total:"100,00 uzs",status:"active"},{id:2,name:"Neal Matthews",date:"2023-21-21",total:"100,00 uzs",status:"active"}]}}};function v(s,n,b,h,o,k){const p=t("DefaultInput"),r=t("BaseBox"),m=t("PregBox"),l=t("DocsRow"),g=t("ImageInput"),d=t("Page");return u(),_(d,{Title:"Tables"},{default:a(()=>[e(l,{Title:"1. Input"},{default:a(()=>[e(r,{Col:"col-xl-12"},{default:a(()=>[(u(),B(V,null,x(2,i=>e(p,{Label:"Input name",Name:"name",Type:"text",Validated:o.errors,Value:s.name,onOnInput:n[0]||(n[0]=c=>(s.name=c,delete this.errors.name))},null,8,["Validated","Value"])),64))]),_:1}),e(m,{No:"1",Codes:`    <DefaultInput
                    v-for="i in 2"
                    Label="Input name"
                    Name="name"
                    Type="text"
                    :Validated="errors"
                    :Value="name"
                    @onInput="name = $event,  delete this.errors.name"
                />`})]),_:1}),e(l,{Title:"2. Image Input"},{default:a(()=>[e(r,{Col:"col-xl-12"},{default:a(()=>[e(g,{Title:"Image input",Name:"image",onOnImage:n[1]||(n[1]=i=>(o.image=i,delete this.errors.image)),Image:o.image,Validated:o.errors},null,8,["Image","Validated"])]),_:1}),e(m,{No:"2",Codes:`<BaseBox Col="col-xl-12" >
                <ImageInput
                    Title="Image input"
                    Name="image"
                    @onImage="image = $event,  delete this.errors.image"
                    :Image="image"
                    :Validated="errors"
                />
            </BaseBox>`})]),_:1})]),_:1})}const O=f(C,[["render",v]]);export{O as default};
