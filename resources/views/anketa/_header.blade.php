@php
/**
 * User: uluGbek
 * @author Ulugbek Muhammadjonov
 * @email <muhammadjonovulugbek98@gmail.com>
 * Date: 18.08.2023  9:36
 */

/** @var \App\Models\Treatment[] $model */

$settings = \App\Models\CompanySetting::first();
@endphp
<html>

<head>
  <meta http-equiv=Content-Type content="text/html; charset=unicode">
  <meta name=Generator content="Microsoft Word 15 (filtered)">
  <style>
    <!--
    /* Font Definitions */
    @font-face {
      font-family: "Cambria Math";
      panose-1: 2 4 5 3 5 4 6 3 2 4;
    }

    @font-face {
      font-family: "Segoe UI";
      panose-1: 2 11 5 2 4 2 4 2 2 3;
    }

    @font-face {
      font-family: AACADEMY;
    }

    /* Style Definitions */
    p.MsoNormal, li.MsoNormal, div.MsoNormal {
      margin: 0in;
      margin-bottom: .0001pt;
      font-size: 12.0pt;
      font-family: "Times New Roman", serif;
    }

    h1 {
      mso-style-link: "Заголовок 1 Знак";
      margin: 0in;
      margin-bottom: .0001pt;
      page-break-after: avoid;
      font-size: 14.0pt;
      font-family: AACADEMY;
      font-weight: normal;
    }

    h2 {
      mso-style-link: "Заголовок 2 Знак";
      margin: 0in;
      margin-bottom: .0001pt;
      text-align: center;
      page-break-after: avoid;
      font-size: 12.0pt;
      font-family: "Times New Roman", serif;
    }

    p.MsoBodyText, li.MsoBodyText, div.MsoBodyText {
      mso-style-link: "Основной текст Знак";
      margin: 0in;
      margin-bottom: .0001pt;
      text-align: center;
      font-size: 16.0pt;
      font-family: AACADEMY;
      font-weight: bold;
    }

    p.MsoAcetate, li.MsoAcetate, div.MsoAcetate {
      mso-style-link: "Текст выноски Знак";
      margin: 0in;
      margin-bottom: .0001pt;
      font-size: 9.0pt;
      font-family: "Segoe UI", sans-serif;
    }

    span

    .1
    {
      mso-style-name: "Заголовок 1 Знак"
    ;
      mso-style-link: "Заголовок 1"
    ;
      font-family: AACADEMY
    ;
    }
    span

    .2
    {
      mso-style-name: "Заголовок 2 Знак"
    ;
      mso-style-link: "Заголовок 2"
    ;
      font-family: "Calibri Light", sans-serif
    ;
      color: #2E74B5
    ;
    }
    span.a {
      mso-style-name: "Основной текст Знак";
      mso-style-link: "Основной текст";
      font-family: AACADEMY;
      font-weight: bold;
    }

    span.a0 {
      mso-style-name: "Текст выноски Знак";
      mso-style-link: "Текст выноски";
      font-family: "Segoe UI", sans-serif;
    }

    p.Style7, li.Style7, div.Style7 {
      mso-style-name: Style7;
      margin: 0in;
      margin-bottom: .0001pt;
      text-autospace: none;
      font-size: 12.0pt;
      font-family: "Times New Roman", serif;
    }

    p.msochpdefault, li.msochpdefault, div.msochpdefault {
      mso-style-name: msochpdefault;
      margin-right: 0in;
      margin-left: 0in;
      font-size: 14.0pt;
      font-family: "Times New Roman", serif;
    }

    p.msopapdefault, li.msopapdefault, div.msopapdefault {
      mso-style-name: msopapdefault;
      margin-right: 0in;
      margin-bottom: 8.0pt;
      margin-left: 0in;
      line-height: 105%;
      font-size: 12.0pt;
      font-family: "Times New Roman", serif;
    }

    span.FontStyle15 {
      mso-style-name: "Font Style15";
      font-family: "Times New Roman", serif;
    }

    span.FontStyle13 {
      mso-style-name: "Font Style13";
      font-family: "Times New Roman", serif;
      font-variant: small-caps;
      font-weight: bold;
    }

    span.a1 {
      mso-style-name: "Знак Знак";
      font-family: AACADEMY;
    }

    .MsoChpDefault {
      font-size: 14.0pt;
    }

    @page WordSection1 {
      size: 595.3pt 841.9pt;
      margin: 28.4pt 28.3pt 21.3pt 35.45pt;
    }

    div.WordSection1 {
      page: WordSection1;
    }

    -->
  </style>

</head>

<body lang=EN-US>

<div class=WordSection1>

  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=0
         style='width:510.9pt;margin-left:19.6pt;border-collapse:collapse'>
    <tr style='height:70.4pt'>
      <td width=357 style='width:267.9pt;border:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt;
  height:70.4pt'>
        <p class=MsoNormal align=center style='text-align:center;line-height:105%'><b><span
              lang=UZ-CYR style='font-size:14.0pt;line-height:105%'>ЎЗБЕКИСТОН РЕСПУБЛИКАСИ</span></b>
        </p>
        <p class=MsoNormal align=center style='text-align:center;line-height:105%'><b><span
              lang=UZ-CYR style='font-size:14.0pt;line-height:105%'>СОҒЛИҚНИ САҚЛАШ
  ВАЗИРЛИГИ</span></b></p>
        <p class=MsoNormal align=center style='text-align:center;line-height:105%'><b><span
              lang=UZ-CYR
              style='font-size:14.0pt;line-height:105%;color:red'>{{$settings->name}}</span></b></p>
        <p class=MsoNormal align=center style='text-align:center;line-height:105%'><b><span
              lang=UZ-CYR style='font-size:14.0pt;line-height:105%'>Масъулияти чекланган
  жамияти</span></b></p>
      </td>
      <td width=324 style='width:243.0pt;border:solid black 1.0pt;border-left:none;
  padding:0in 5.4pt 0in 5.4pt;height:70.4pt'>
        <p class=MsoNormal align=center style='text-align:center;line-height:105%'><b><span
              lang=UZ-CYR style='font-size:14.0pt;line-height:105%'>Ўз.РССВ 777</span></b></p>
        <p class=MsoNormal align=center style='text-align:center;line-height:105%'><b><span
              lang=UZ-CYR style='font-size:14.0pt;line-height:105%'>сонли буйруқ билан
  тасдиқланган</span></b></p>
        <p class=MsoNormal align=center style='text-align:center;line-height:105%'><b><span
              lang=UZ-CYR style='font-size:14.0pt;line-height:105%'>043-рақамли тиббий
  хужжат шакли</span></b></p>
      </td>
    </tr>
  </table>

  <p class=MsoNormal align=center style='text-align:center'><b><span lang=UZ-CYR>&nbsp;</span></b></p>

  <p class=MsoNormal align=center style='text-align:center'><b><span lang=UZ-CYR>&nbsp;</span></b></p>

  <p class=MsoNormal align=center style='text-align:center'><b><span lang=UZ-CYR
                                                                     style='font-size:14.0pt'>Стоматологик &nbsp;беморнинг тиббий картаси</span></b><span
      lang=UZ-CYR> </span></p>

  <p class=MsoNormal><b><span lang=UZ-CYR style='font-size:14.0pt'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
№ {{$model->daily_number}}&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;{{date('d.m.Y',strtotime($model->created_at))}}</span></b></p>

  <p class=MsoNormal><b><span lang=UZ-CYR style='font-size:14.0pt'>&nbsp;</span></b></p>

  <p class=MsoNormal><b><span lang=UZ-CYR style='font-size:14.0pt'>&nbsp;</span></b></p>

  <p class=MsoNormal style='margin-left:14.2pt;line-height:115%'><b><span
        lang=UZ-CYR style='font-size:11.0pt;line-height:115%'>Фамилия, Исми:&nbsp; </span></b><b><u><span
          lang=UZ-CYR>{{$model?->patient->getFullName()}}</span></u></b></p>

  <p class=MsoNormal style='margin-left:14.2pt;line-height:115%'><b><span
        lang=UZ-CYR>Жинси&nbsp; &nbsp;{{$model?->patient->getGenderName()}}&nbsp;&nbsp; &nbsp;ёши {{date('Y',strtotime($model?->patient->birthday))}} й</span></b><span
      lang=UZ-CYR> </span></p>

  <p class=MsoNormal style='margin-left:14.2pt;line-height:115%'><b><span
        lang=UZ-CYR>Яшаш жойи:&nbsp; {{$model?->patient->address}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></b>
  </p>

  <p class=MsoNormal style='margin-left:14.2pt;line-height:115%'><b><span
        lang=UZ-CYR>Касби:&nbsp;&nbsp;&nbsp;&nbsp; <u>{{$model?->patient->job}}</u></span></b></p>

  <p class=MsoNormal style='margin-left:14.2pt;line-height:115%'><b><span
        lang=UZ-CYR>Телефон: {{$model?->patient->phone}}</span></b></p>

  <p class=MsoNormal style='margin-left:14.2pt;line-height:115%'><b><span
        lang=UZ-CYR>Ташхис: {{$model->doctor_description}}</span></b></p>

  <p class=MsoNormal style='margin-left:14.2pt;line-height:115%'><b><span
        lang=UZ-CYR>Шикояти: {{$model->reception_description}}</span></b></p>

  <div style='border:none;border-bottom:solid windowtext 1.5pt;padding:0in 0in 14.0pt 0in;
margin-left:14.2pt'>

    <p class=MsoNormal style='line-height:115%'><b><span lang=UZ-CYR>Айнан шу
ҳасталикнинг ивожланиши:&nbsp;&nbsp;&nbsp; ____________</span></b></p>

  </div>

  <p class=MsoNormal><b><span lang=UZ-CYR style='font-size:11.0pt'>&nbsp;</span></b></p>

  <p class=MsoBodyText align=left style='text-align:left'><span lang=RU
                                                                style='font-size:14.0pt;font-family:"Times New Roman",serif;font-weight:normal'>Шикояти__________________________________________________________________</span>
  </p>
