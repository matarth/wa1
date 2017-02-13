<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ženy sobě</title>
    {{ HTML::style('css/styly.css') }}
  </head>
  <body>
  
     <a href="/about">{{ HTML::image('img/header.jpg', '', array('class' => 'logoImg', 'alt' => 'Logo'))}}</a>
  <div class="header_table_div"> 
  <table class="header_table">
    <tr>
      <td>
        {{link_to("/about","O nás")}}
      </td>
      
      <td>
        {{link_to("/calendar", "Kalendář akcí")}}
      </td>
      
      <td>
        {{link_to("/gallery", "Galerie")}}
      </td>
      <td>
        {{link_to("/contact", "Kontakt")}}
      </td>
      <td>
        {{link_to("/feedback", "Napište nám")}}
      </td>
      
      <?php
      echo "<td>";
        if(Auth::check()){
          echo link_to("/session/destroy","Odhlásit");
        }
        else
          echo link_to("/session/create","Přihlásit");
      echo "</td>";
      
      ?>
      
    </tr>  
  </table>
  </div>
  
  <div class=spodek>
    <br>
    <br>
    @yield('content')
  </div>
  <div class=zapati>
  <a href="http://www.vinohruska.cz/">  {{ HTML::image('img/vino_hruska.jpg', '', array('alt' => 'odkaz_vino_hruska')) }}</a>
  <a href="http://www.aplaus-liberec.cz/">  {{ HTML::image('img/logo_vp.jpg', '', array('alt' => 'odkaz_vytvarne&hobby_potreby')) }}</a>
  <a href="https://www.facebook.com/pages/Studio-Oriflame-Pal%C3%A1c-Koruna/197031570322716">  {{ HTML::image('img/Oriflame.jpg', '', array('alt' => 'odkaz_oriflame')) }}</a>
  </div>
  </body>
</html>
