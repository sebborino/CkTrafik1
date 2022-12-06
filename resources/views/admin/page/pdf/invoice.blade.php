<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktura</title>

    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    <style>
        body{
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            
            
        }

        .header{
            width:100%;
            font-weight: bolder;
            text-align: center;
            font-size: 24px;
        }

        

        .boxes{
            width: 100%;
            display: block;
            clear: both;
        }

        .box{
            display: block;
            float:left;
        }

        .box p {
            font-size: 12px;
        }
        .underline{
            border-bottom:#000 solid 1px;
        }
        ul{
            padding:0;
            margin:0;
        }
        ul li{
            list-style: none;
        }

        table{
            width: 100%;
            height: 100px;
            font-weight: 100;
            font-size:11px;
        }

        .lines{
            border-bottom:#000 solid 1px;
            border-top:#000 solid 1px;
        }
        thead tr th{
            font-size:12px;
        }
         .right{
            text-align: right;
         }
         .left{
            text-align: left;
         }

         footer{
            position: fixed; 
            bottom:-40px;
            border-top:1px solid #000;
            width: 100%;
            height: 40px;
            font-size:8px;
            display:block;
            left:0;
            text-align: center;
         }
    </style>
</head>
<body>
    <h2 class="header">CK Trafik 1 Aps</h2>
    <footer>
        <div style="width:50%;margin:auto;padding-top:10px;text-align: center;">
         CK Trafik 1 - H.C Ørsteds Vej 66, st. 1 - 1879 Frederiksberg C - Danmark - CVR-nr.: 39569418
        - Tlf.: +4555247733 - E-mail: info@iraqi-airways.com
        </div>
    </footer>
        <div class="boxes">
            <div class="box" style="width:60%;height:200px;">
                <div style="font-size:10px;margin-top:20px;line-height:1px;margin:10px; 0 0 10px">
                    <p>Ck Trafik 1</p>
                    <p>H.C Ørsteds Vej 66, st. 1</p>
                    <p>1879 Frederiksberg C</p>
                    <p>39569418</p>
                </div>
                <p style="font-size: 10px;font-weight: bold;margin-top:30px">
                Vedrørende
                </p>
                <div style="font-size:10px;line-height:1px;margin:10px; 0 0 10px">
                    @if(!is_null($agent))
                    <p>{{ $agent }}</p>
                    <p>CVR:{{ $cvr }}</p>
                    <p>{{ $adresse }}</p>
                    @else
                    <p>{{ $name }}</p>
                    @endif
                </div>
                
            </div>
            <div class="box" style="width:30%;margin-left:5%;height:100px;">
            <!--<img src="{{ asset('/img/cktrafik.jpg')}}" />-->
        </div>
            
        </div>

        <div class="boxes">
            <div class="box underline" style="width:60%;height:40px;padding:5px;">
                
            </div>
            <div class="box underline" style="width:30%;margin-left:5%;height:40px;padding:5px 0">
                <h3>FAKTURA</h3>
            </div>
            
        </div>

        <div class="boxes">
            <div class="box" style="width:60%;height:100px;padding:5px;">
                
            </div>
            <div class="box" style="width:30%;margin-left:5%;height:100px;padding:2px 0">
                <ul style="font-size:10px;">
                    <li>Fakture. .................: {{$fak_nr}}</li>
                    <li>Fakturadato. ..........: {{ $dato}}</li>
                    <li>Kundenr. ................:{{$kundenr}}</li>
                    <li>Side. ......................: 1 af 1</li>
                </ul>   
            </div>
        </div>
        <div class="boxes underline">
            <table>
                <thead class="lines">
                    <tr>
                        <th class="left">Tekst</th>
                        <th class="right">Antal Enhed</th>
                        <th class="right">Stk. pris</th>
                        <th class="right">Pris</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="left">
                            Flybillet
                        </td>
                        <td class="right">
                            1 stk.
                        </td>
                        <td class="right">
                            {{ number_format($fare_price , 2 , ',' , '.' )}}
                        </td>
                        <td class="right">
                            {{ number_format($fare_price , 2 , ',' , '.' )}}
                        </td>
                    </tr>
                    <tr>
                        <td class="left">                            
                            073 {{ $e_ticket}} For {{ $name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="left">
                            PNR : {{ $pnr}}
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="underline">
                <tbody>
                    <tr>
                        <th class="left" style="margin-left:25px;">Tax</th>
                        <th class="right" >{{ number_format($tax , 2 , ',' , '.' )}}</th>
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody style="font-size:10px">
                    <tr>
                        <td class="left">(Momsfrit beløb: {{ number_format($total , 2 , ',' , '.' )}} - Momspligtigt beløb: 0,00)</td>
                        <td class="right">Subtotal:</td>
                        <td class="right">{{ number_format($total , 2 , ',' , '.' )}}</td>
                        
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <td></td>
                        <td class="right">0,00% moms</td>
                        <td class="right">0,00</td>
                    </tr>
                    <tr>
                        <th></th>
                        <th class="right font-weight-bold">Total DDK:</th>
                        <th class="right  font-weight-bold">{{ number_format($total , 2 , ',' , '.' )}}</th>
                    </tr>
                </thead>
            </table>
            <div class="boxes">
                <div class="box" style="margin-top:3cm">
                    <p>Betingsbetingelser: Netto 8 dage</p>
                    <p>Beløbet indbetales til vores bank
                    <p>Mypos</p>
                    <p>IBANnr: BG29INTF40015017546744</p>
                    <p>BIC: INTFBGSF</p>
                    <p>Fakturanr. {{$fak_nr}} bedes anført ved bankoverførsel</p>
                    </div>
                <div class="box"></div>
            </div>
        </div>
    </div>
    
</body>
</html>