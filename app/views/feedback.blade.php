@extends('layouts.default')
@section('content')
 
   <h1>
     Napište nám
   </h1>
   <br>
 
  {{ Form::open(['class' => 'feedbackForm', 'url' => 'feedback']) }}
  <table class=feedBackTable>
    <tr>
    <td>
    {{Form::label('email','Váš email:')}}
    </td>
    <td>
    {{Form::text('email','', array('class' => 'email'))}}
    </td>
    </tr>
    <tr>
    <td>
    {{Form::label('subject','Předmět:')}}
    </td>
    <td>
    {{Form::text('subject','', array('class' => 'subject'))}}
    </td>
    </tr>
    <tr>
    <td colspan=2>
    {{Form::textArea('text','', array('class' => 'body'))}}
      </td>
    </tr>
    <tr>
      <td colspan=2>
        {{Form::submit('Odeslat', array('class' => 'formSubmit'))}}
      </td>
    </tr>

  </table>

  {{Form::close()}}

@stop
