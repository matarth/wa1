<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    {{ HTML::style('css/styly.css') }}
  </head>
  <body>
  
    {{ Form::open(['class' => 'loginForm', 'url' => 'root/createevent', 'name' => 'createEventForm']) }}
    
    <table>
      <tr>
        <td colspan=2>
          Vytváření akcí
        </td>
      </tr>
      <tr>
        <td>
          {{Form::label('name','Název:')}}
        </td>
        <td>
          {{Form::text('nazev', '', array('required'))}}
        </td>        
      </tr>
      <tr>
        <td>
          {{Form::label('popisLabel','Popis:')}}
        </td>
        <td>
        {{Form::textarea('popis')}}
        </td>
      </tr>
      <tr>
        <td>
          {{Form::label('kdyLabel','Datum:')}}
        </td>
        <td>
        {{Form::text('den',null,['size' => 2, 'maxlength' => 2, 'placeholder' => "den", 'required'])}}
        {{Form::text('mesic',null,['size' => 3, 'maxlength' => 2, 'placeholder' => "měsíc", 'required'])}}
        {{Form::text('rok',null,['size' => 4, 'maxlength'=> 4, 'placeholder' => "rok", 'required'])}}
        </td>
      </tr>
      
      <tr>
        <td>
          {{Form::label('countLabel','Počet lidí:')}}
        </td>
        <td>
        {{Form::text('pocetlidi', '', array('required'))}}
        </td>
      </tr>
      
      <tr>
        <td>
          {{Form::label('timeLabel','Čas:')}}
        </td>
        <td>
        {{Form::text('cas')}}

        </td>
      </tr>

      <tr>
        <td>
          {{Form::label('placeLabel','Místo:')}}
        </td>
        <td>
        {{Form::text('misto')}}
        </td>
      </tr>
      
      <tr>
        <td>
          {{Form::label('priceLabel','Cena:')}}
        </td>
        <td>
        {{Form::text('cena')}}
        </td>
      </tr>
            
      <tr>
        <td>
          {{Form::label('dokdyLabel','Datum odhlášení:')}}
        </td>
        <td>
        {{Form::text('doDen',null,['size' => 2, 'maxlength' => 2, 'placeholder' => "den", 'required'])}}
        {{Form::text('doMesic',null,['size' => 3, 'maxlength' => 2, 'placeholder' => "měsíc",'required'])}}
        {{Form::text('doRok',null,['size' => 4, 'maxlength'=> 4, 'placeholder' => "rok", 'required'])}}
        </td>
      </tr>
      
      <tr>
         <td colspan=2>
          {{Form::submit('Vytvořit', array('class' => 'formSubmit', 'name' => 'createEventSubmit'))}}
        </td>
      </tr>      
    </table>
    
    {{link_to('root/eventList', 'Seznam akcí')}}
    {{link_to('root/userList', 'Seznam uživatelů')}}
    {{link_to('/', 'Zpět na Ženy sobě')}}

  </body>
</html>
