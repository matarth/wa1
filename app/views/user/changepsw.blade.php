<script>
  function submitValidate(){
    var ret = true;
    
    document.getElementById("newpsw1").innerHTML = "";
    document.getElementById("newpsw2").innerHTML = "";
    
    if(newpass.value != newpass2.value){
      document.getElementById("newpsw2").innerHTML = "Hesla se neshodují";
      ret = false;
    }
    
    return ret;
  }

</script>

@extends('layouts.default')
@section('content')

         {{Form::open(['route' => 'user.changeUserPsw'])}}

   <table class=zmenahesla>
     <tr>
       <td>
        {{Form::label('newpass', 'Nove heslo:')}}
      </td>
      <td>
        {{Form::text('newpass') }}
      </td>
        <td>
          <div class=errorMsg id=newpsw1>
          </div>
        </td>
    </tr>
    <tr>
      <td>
        {{Form::label('newpass2', 'Potvrzení hesla:')}}
      </td>
      <td>
        {{Form::text('newpass2') }}
      </td>
        <td>
          <div class=errorMsg id=newpsw2>
          </div>
        </td>
      </tr>
      <tr>
      <td colspan=2>	
        {{Form::submit('Odeslat')}} 
      </td>
     </tr>
   </table>
        {{Form::close()}}
 
@stop
