@extends('layouts.default')

@section('content')

  <h1>
    Přihlášení
  </h1>

  {{ Form::open(['class' => 'loginForm', 'url' => 'session/store']) }}
    <table class=login>
      <tr>
        <td colspan=2 class=errorMsg>
          <br>
        </td>
      </tr>
      <tr>
        <td>   
          {{Form::label('email','Email:')}}
        </td>
        <td>
          {{Form::text('email', '',array('class' => 'emailInput', 
            'required', 'pattern' => "^[a-z0-9._%+-]+@[a-z0-9.-]+[a-z]{2,4}$"))}}
        </td>
      </tr>
      <tr>
        <td>
          {{Form::label('password','Heslo:')}}
        </td>
        <td>
         {{Form::password('password', array('class' => 'pswInput', 'required'))}}
        </td>
      </tr>
      <tr>
      <td>
      </td>
        <td>

            <input class="formSubmit" type="submit" value="Přihlásit">
          <a href="../register" class="myButton">
              Nový uživatel
          </a>

        </td>
      </tr>
    </table>
  {{ Form::close() }}


<script>    
  var error = document.querySelector(".errorMsg");
  var email = document.querySelector(".emailInput");
  var submit = document.querySelector(".formSubmit");
  var psw = document.querySelector(".pswInput");
  var form = document.querySelector(".loginForm");
  
  var answer = function(e){
    if(e.target.responseText == "0"){
      error.innerHTML = "Neplatný email nebo heslo";
      psw.value = "";
    }
    else{
      form.submit();
    }
      
  }

  submit.addEventListener("click", function(e){
    e.preventDefault();
    var request  = new XMLHttpRequest();
    request.open("get", "../uservalidate?email="+email.value+"&psw="+psw.value);
    request.addEventListener("load", answer);
    request.send();
  });
 
</script>
@stop

