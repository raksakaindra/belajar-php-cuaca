<?php
  include_once("config.php");
  $urlKec = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "api.php?kabkota=Kab.%20Wonogiri";
  $kec = simplexml_load_file($urlKec) or die("");

  function iconCuaca($ic) {
    switch($ic) {
      case "5":
        $icCuaca = "ic_udara_kabur_";
        break;
      case "10":
        $icCuaca = "ic_asap_kabut_";
        break;
      case "45":
        $icCuaca = "ic_asap_kabut_";
        break;
      case "60":
        $icCuaca = "ic_hujan_ringan_";
        break;
      case "61":
        $icCuaca = "ic_hujan_sedang_";
        break;
      case "63":
        $icCuaca = "ic_hujan_lebat_";
        break;
      case "80":
        $icCuaca = "ic_hujan_lokal_";
        break;
      case "95":
        $icCuaca = "ic_hujan_petir_";
        break;
      case "97":
        $icCuaca = "ic_hujan_petir_";
        break;
      case "0":
        $icCuaca = "ic_cerah_";
        break;
      case "1":
        $icCuaca = "ic_cerah_berawan_";
        break;
      case "2":
        $icCuaca = "ic_cerah_berawan_";
        break;
      case "3":
        $icCuaca = "ic_berawan_";
        break;
      case "4":
        $icCuaca = "ic_berawan_tebal_";
        break;
      default:
        $icCuaca = "ic_cerah_berawan_";
        break;
    }
    return $icCuaca;
  }

  function keteranganCuaca($kc) {
    switch($kc) {
      case "5":
        $ketCuaca = "Udara Kabur";
        break;
      case "10":
        $ketCuaca = "Asap";
        break;
      case "45":
        $ketCuaca = "Kabut";
        break;
      case "60":
        $ketCuaca = "Hujan Ringan";
        break;
      case "61":
        $ketCuaca = "Hujan Sedang";
        break;
      case "63":
        $ketCuaca = "Hujan Lebat";
        break;
      case "80":
        $ketCuaca = "Hujan Lokal";
        break;
      case "95":
        $ketCuaca = "Hujan Petir";
        break;
      case "97":
        $ketCuaca = "Hujan Petir";
        break;
      case "0":
        $ketCuaca = "Cerah";
        break;
      case "1":
        $ketCuaca = "Cerah Berawan";
        break;
      case "2":
        $ketCuaca = "Cerah Berawan";
        break;
      case "3":
        $ketCuaca = "Berawan";
        break;
      case "4":
        $ketCuaca = "Berawan Tebal";
        break;
      default:
        $ketCuaca = "Cerah Berawan";
        break;
    }
    return $ketCuaca;
  }

  function siangMalam($sm) {
    switch($sm) {
      case "00.00":
        $ism = "siang";
        break;
      case "03.00":
        $ism = "siang";
        break;
      case "06.00":
        $ism = "siang";
        break;
      case "09.00":
        $ism = "siang";
        break;
      case "12.00":
        $ism = "malam";
        break;
      case "15.00":
        $ism = "malam";
        break;
      case "18.00":
        $ism = "malam";
        break;
      case "21.00":
        $ism = "malam";
        break;
      default:
        $ism = "siang";
        break;
    }
    return $ism;
  }

  function mataAngin($ma) {
    switch($ma) {
      case "N":
        $mataAngin = "dari U";
        break;
      case "NE":
        $mataAngin = "dari TL";
        break;
      case "E":
        $mataAngin = "dari T";
        break;
      case "SE":
        $mataAngin = "dari TG";
        break;
      case "S":
        $mataAngin = "dari S";
        break;
      case "SW":
        $mataAngin = "dari BD";
        break;  
      case "W":
        $mataAngin = "dari B";
        break;
      case "NW":
        $mataAngin = "dari BL";
        break;
      case "CALM":
        $mataAngin = "CALM";
        break;
    }
    return $mataAngin;
  }
?>
<html>
  <head>  
    <title>Prakiraan Cuaca Kabupaten | BMKG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="leaflet.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <div id="container">
      <div id="menu">
        <ul id="slide-out" class="side-nav fixed">
          <li class="head-menu"><span class="logo little"></span>Prakiraan Cuaca <?php echo $kec['nama']; ?></li>
          <?php
            $m = 1;
            foreach ($kec->item as $listKec) {
              echo "<li class=\"marker-menu\"><a id=\"" . $listKec['id'] . "\" href=\"#!\"><img src=\"img/cuaca/" . iconCuaca($listKec['weather']) . siangMalam(date("H:i", strtotime($listKec['date']))) . ".svg\"><span class=\"side\">" . $listKec['kecamatan'] . "</span></a></li>\n";
              $m++;
            }
          ?>
          <li class="footer-menu">&#169; <?php echo date('Y');?> &mdash; BMKG</li>
        </ul>
      </div>

      <div id="content">
        <div class="head">
          <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>
          <h1><span class="logo"></span>30 Gempabumi Dirasakan</h1>
        </div>
        <?php
          $wib = date("H:i", strtotime('+ 7 hours', strtotime($kec->item['date'][0])));
          $validCuaca = date("H:i", strtotime('+ 599 minutes', strtotime($kec->item['date'][0])));
        ?>
        <p class="headline-prakicu">Prakiraan untuk Pukul <?php echo $wib . "-" . $validCuaca;?> WIB</p>
        <div id="map"></div> 
        <ul id="cuaca" class="cuaca-detail"></ul>
      </div>  
    </div>
    
    <script src="leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script>
      $('.button-collapse').sideNav({
          menuWidth: 300, // Default is 300
          edge: 'left', // Choose the horizontal origin
          closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
          draggable: true // Choose whether you can drag to open on touch screens,
        }
      );

      var map = L.map('map').setView([-2.4086343,118.545564], 5);
      L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}').addTo(map);
   
      var cuacaIcon = L.Icon.extend({
        options: {
          iconSize: [36, 36],
          iconAnchor: [18, 0]
        }
      });

      var ic_udara_kabur_siang = new cuacaIcon({iconUrl: 'img/cuaca/ic_udara_kabur_siang.svg'}),
          ic_udara_kabur_malam = new cuacaIcon({iconUrl: 'img/cuaca/ic_udara_kabur_malam.svg'}),
          ic_asap_kabut_siang = new cuacaIcon({iconUrl: 'img/cuaca/ic_asap_kabut_siang.svg'}),
          ic_asap_kabut_malam = new cuacaIcon({iconUrl: 'img/cuaca/ic_asap_kabut_malam.svg'}),
          ic_hujan_ringan_siang = new cuacaIcon({iconUrl: 'img/cuaca/ic_hujan_ringan_siang.svg'}),
          ic_hujan_ringan_malam = new cuacaIcon({iconUrl: 'img/cuaca/ic_hujan_ringan_malam.svg'}),
          ic_hujan_sedang_siang = new cuacaIcon({iconUrl: 'img/cuaca/ic_hujan_sedang_siang.svg'}),
          ic_hujan_sedang_malam = new cuacaIcon({iconUrl: 'img/cuaca/ic_hujan_sedang_malam.svg'}),
          ic_hujan_lebat_siang = new cuacaIcon({iconUrl: 'img/cuaca/ic_hujan_lebat_siang.svg'}),
          ic_hujan_lebat_malam = new cuacaIcon({iconUrl: 'img/cuaca/ic_hujan_lebat_malam.svg'}),
          ic_hujan_lokal_siang = new cuacaIcon({iconUrl: 'img/cuaca/ic_hujan_lokal_siang.svg'}),
          ic_hujan_lokal_malam = new cuacaIcon({iconUrl: 'img/cuaca/ic_hujan_lokal_malam.svg'}),
          ic_hujan_petir_siang = new cuacaIcon({iconUrl: 'img/cuaca/ic_hujan_petir_siang.svg'}),
          ic_hujan_petir_malam = new cuacaIcon({iconUrl: 'img/cuaca/ic_hujan_petir_malam.svg'}),
          ic_cerah_siang = new cuacaIcon({iconUrl: 'img/cuaca/ic_cerah_siang.svg'}),
          ic_cerah_malam = new cuacaIcon({iconUrl: 'img/cuaca/ic_cerah_malam.svg'}),
          ic_cerah_berawan_siang = new cuacaIcon({iconUrl: 'img/cuaca/ic_cerah_berawan_siang.svg'}),
          ic_cerah_berawan_malam = new cuacaIcon({iconUrl: 'img/cuaca/ic_cerah_berawan_malam.svg'}),
          ic_berawan_siang = new cuacaIcon({iconUrl: 'img/cuaca/ic_berawan_siang.svg'}),
          ic_berawan_malam = new cuacaIcon({iconUrl: 'img/cuaca/ic_berawan_malam.svg'}),
          ic_berawan_tebal_siang = new cuacaIcon({iconUrl: 'img/cuaca/ic_berawan_tebal_siang.svg'}),
          ic_berawan_tebal_malam = new cuacaIcon({iconUrl: 'img/cuaca/ic_berawan_tebal_malam.svg'})

      L.icon = function (options) {
        return new L.Icon(options);
      };

      var markers = [];
      
      <?php
        $mm = 1;
        foreach($kec->item as $listKec) {
          echo "var marker" . $mm . " = L.marker([" . $listKec['latitude'] . "," . $listKec['longitude'] . "],";
          echo " {title:'" . $listKec['id'] . "', icon:" . iconCuaca($listKec['weather']) . siangMalam(date("H:i", strtotime($listKec['date']))) . ", lat:'" . $listKec['latitude'] . "', lon:'" . $listKec['longitude'] . "'})";
          echo ".bindPopup('<strong>" . $listKec['kecamatan'] . "</strong><br>" . keteranganCuaca($listKec['weather']) . "<br>Suhu: " . $listKec['t'] . "&deg;C<br>Kelembapan: " . $listKec['hu'] . "%<br>Angin: " . $listKec['ws'] . " km/j &ndash; " . mataAngin($listKec['wd']) . "').addTo(map); ";
          echo "markers.push(marker" . $mm . "); ";
          $mm++;
        }
      ?>

      var featureGroup = L.featureGroup(markers).addTo(map);
      map.fitBounds(featureGroup.getBounds());

      function markerFunction(id) {
        for (var i in markers) {
          var markerID = markers[i].options.title;
          if (markerID == id){
            markers[i].openPopup();
            //console.log(markers[i].options.title);
            
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                getXML(this);
              }
            };
            xhttp.open("GET", "http://localhost/cuaca/api.php?id=" + markers[i].options.title, true);
            xhttp.send();

            $(".marker-menu a").click(function(){
              //console.log(markerFunction($(this)[0].id));
              var $carousell = $('.cuaca-detail').flickity('destroy');
            });
          }
        }
      }

      $(".marker-menu a").click(function(){
        markerFunction($(this)[0].id);
        //console.log(markerFunction($(this)[0].id));
      });

      function getXML(xml) {
        var cuacaDetail = "";
        var i;
        var xmlDoc = xml.responseXML;
        var x = xmlDoc.getElementsByTagName("item");
        for (i = 1; i < x.length; i++) {
          var datetime = x[i].getAttribute("date").split(' ');
          var date = datetime[0];
          var time = datetime[1];
          var weather = x[i].getAttribute("weather");
          var t = x[i].getAttribute("t");
          var hu = x[i].getAttribute("hu");
          var ws = x[i].getAttribute("ws");
          var wd = x[i].getAttribute("wd");

          //console.log(weatherIcon(weather) + noonNight(time));
          cuacaDetail += "<li><span class=\"tanggal\">" + moment(date).add(7, 'hours').format("DD MMM YYYY") + "<br>" + moment(date+" "+time).add(7, 'hours').format("HH:mm") + " WIB</span>" +
          "<img src=\"img/cuaca/" + weatherIcon(weather) + noonNight(time) + ".svg\">" + weatherInfo(weather) +
          "<span class=\"temp-hum\"><img src=\"img/cuaca/suhu.svg\">" + t + "&deg;C <img src=\"img/cuaca/kelembapan.svg\">" + hu + "%</span>" +
          "<span class=\"wind\"><img src=\"img/cuaca/angin.svg\">" + ws + " km &ndash; " + windDirection(wd) + "</span>";
        }
        $("#cuaca").html(cuacaDetail);
        document.getElementById("cuaca").innerHTML = cuacaDetail;
        document.getElementById("cuaca").style.display = "block";
        
        var $carousel = $('.cuaca-detail').flickity({
          autoPlay: 2000,
          freeScroll: true,
          contain: true,
          prevNextButtons: false,
          pageDots: false,
          fade: true
        });      
      }

      function weatherIcon(wic) {
        switch(wic) {
          case "5":
            wic = "ic_udara_kabur_";
            break;
          case "10":
            wic = "ic_asap_kabut_";
            break;
          case "45":
            wic = "ic_asap_kabut_";
            break;
          case "60":
            wic = "ic_hujan_ringan_";
            break;
          case "61":
            wic = "ic_hujan_sedang_";
            break;
          case "63":
            wic = "ic_hujan_lebat_";
            break;
          case "80":
            wic = "ic_hujan_lokal_";
            break;
          case "95":
            wic = "ic_hujan_petir_";
            break;
          case "97":
            wic = "ic_hujan_petir_";
            break;
          case "0":
            wic = "ic_cerah_";
            break;
          case "1":
            wic = "ic_cerah_berawan_";
            break;
          case "2":
            wic = "ic_cerah_berawan_";
            break;
          case "3":
            wic = "ic_berawan_";
            break;
          case "4":
            wic = "ic_berawan_tebal_";
            break;
          default:
            wic = "ic_cerah_berawan_";
            break;
        }
        return wic;
      }

      function weatherInfo(wi) {
        switch(wi) {
          case "5":
            wi = "Udara Kabur";
            break;
          case "10":
            wi = "Asap";
            break;
          case "45":
            wi = "Kabut";
            break;
          case "60":
            wi = "Hujan Ringan";
            break;
          case "61":
            wi = "Hujan Sedang";
            break;
          case "63":
            wi = "Hujan Lebat";
            break;
          case "80":
            wi = "Hujan Lokal";
            break;
          case "95":
            wi = "Hujan Petir";
            break;
          case "97":
            wi = "Hujan Petir";
            break;
          case "0":
            wi = "Cerah";
            break;
          case "1":
            wi = "Cerah Berawan";
            break;
          case "2":
            wi = "Cerah Berawan";
            break;
          case "3":
            wi = "Berawan";
            break;
          case "4":
            wi = "Berawan Tebal";
            break;
          default:
            wi = "Cerah Berawan";
            break;
        }
        return wi;
      }

      function noonNight(nn) {
        switch(nn) {
          case "00:00:00":
            nn = "siang";
            break;
          case "03:00:00":
            nn = "siang";
            break;
          case "06:00:00":
            nn = "siang";
            break;
          case "09:00:00":
            nn = "siang";
            break;
          case "12:00:00":
            nn = "malam";
            break;
          case "15:00:00":
            nn = "malam";
            break;
          case "18:00:00":
            nn = "malam";
            break;
          case "21:00:00":
            nn = "malam";
            break;
          default:
            nn = "siang";
            break;
        }
        return nn;
      }

      function windDirection(wd){
        switch(wd){
          case "N":
            wd = "dari U";
            break;
          case "NE":
            wd = "dari TL";
            break;
          case "E":
            wd = "dari T";
            break;
          case "SE":
            wd = "dari TG";
            break;
          case "S":
            wd = "dari S";
            break;
          case "SW":
            wd = "dari BD";
            break;  
          case "W":
            wd = "dari B";
            break;
          case "NW":
            wd = "dari BL";
            break;
          case "CALM":
            wd = "Calm";
            break;
        }
        return wd;
      }
    </script>
  </body>
</html>