@extends('layouts.default')
@section('content')


    <h1>
        Registrace
    </h1>
    <br>
    <br>


    {{Form::open(['route' => 'user.store', 'onsubmit' => 'return submitValidate()', 'class' => 'registrationForm'])}}
    <table class=registrace>
        <tr>
            <td>
                <div>
                    {{Form::label('jmeno', 'Jméno:')}}
                </div>
            </td>
            <td>
                <div>
                    {{Form::text('jmeno', '', array('required', "class" => "usernameInput")) }}
                </div>
            </td>
            <td>
                <div class=errorMsg id=nameErr>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <div>
                    {{Form::label('prijmeni', 'Příjmení:')}}
                </div>
            </td>
            <td>
                <div>
                    {{Form::text('prijmeni', '', array('required')) }}
                </div>
            </td>
            <td>
                <div class=errorMsg id=surnameErr>
                </div>
            </td>
        </tr>


        <tr>
            <td>
                <div>
                    {{Form::label('email', 'Přihlašovací email:')}}
                </div>
            </td>
            <td>
                <div>
                    {{Form::email('email', '', array('required', "onBlur" => "emailValidate()")) }}
                </div>
            </td>
            <td>
                <div class=errorMsg id=emailErr>
                </div>
            </td>
        </tr>


        <tr>
            <td>
                <div>
                    {{Form::label('ulice', 'Ulice:')}}
                </div>
            </td>
            <td>
                <div>
                    {{Form::text('ulice', '', array('required')) }}
                </div>
            </td>
            <td>
                <div class=errorMsg id=streetErr>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <div>
                    {{Form::label('mesto', 'Město:')}}
                </div>
            </td>
            <td>
                <div>
                    {{Form::text('mesto', '', array('required')) }}
                </div>
            </td>
            <td>
                <div class=errorMsg id=cityErr>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <div>
                    {{Form::label('psc', 'PSČ:')}}
                </div>
            </td>
            <td>
                <div>
                    {{Form::text('psc', '', array('required')) }}
                </div>
            </td>
            <td>
                <div class=errorMsg id=pscErr>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <div>
                    {{Form::label('telefon', 'Telefon:')}}
                </div>
            </td>
            <td>
                <div>
                    {{Form::text('telefon', '', array('required')) }}
                </div>
            </td>
            <td>
                <div class=errorMsg id=telErr>
                </div>
            </td>
        </tr>


        <tr>
            <td>
                <div>
                    {{Form::label('den', 'Datum narození:')}}
                </div>
            </td>
            <td>
                <div>
                    {{Form::text('den',null,['size' => 4, 'maxlength' => 2, 'placeholder' => "den", 'id' => 'den', 'required'])}}
                    {{Form::text('mesic',null,['size' => 4, 'maxlength' => 2, 'placeholder' => "měsíc", 'id' => 'mesic', 'required'])}}
                    {{Form::text('rok',null,['size' => 4, 'maxlength' => 4, 'placeholder' => "rok", 'id' => 'rok', 'required'])}}
                </div>
            </td>
            <td>
                <div class=errorMsg id=bdErr>
                </div>
            </td>
        </tr>


        <tr>
            <td>
                <div>
                    {{Form::label('password', 'Heslo:')}}
                </div>
            </td>
            <td>
                <div>
                    {{Form::password('password', array('required')) }}
                </div>
            </td>
            <td>
                <div class=errorMsg id=pswErr>
                </div>
            </td>
        </tr>


        <tr>
            <td>
                <div>
                    {{Form::label('password2', 'Potvrzení hesla:')}}
                </div>
            </td>
            <td>
                <div>
                    {{Form::password('password2', array('required')) }}
                </div>
            </td>
            <td>
                <div class=errorMsg id=pswErr2>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                {{Form::checkbox('podminky','', null, ['id' => 'checkbox'])}}
            </td>
            <td>
                Souhlasím s {{link_to(asset('files/podminky.pdf'),'podmínkami')}}
            </td>
            <td>
                <div class=errorMsg id=termErr>
                </div>
            </td>

        </tr>

        <tr>
            <td>
            </td>
            <td>
                {{Form::submit('Registrovat',['id' => 'registerbutton'])}}
            </td>
            <td>
            </td>
        </tr>

    </table>

    {{Form::close()}}





    <script>

        function wzParseJson(str){
            var parsedString = '-1';
            while(bracketIdx = str.indexOf('{') != -1){
                try{
                    parsedString = JSON.parse(str.substr(bracketIdx, str.length));
                }
                catch(err){
                    console.log("catched");
                    continue;
                }
                break;
            }

            if(parsedString != '-1'){
                console.log(parsedString);
            }
            else{
                console.log("Nepovedlo se naparsovat");
            }

            return(parsedString);

        }

        function emailValidate() {


            var request = new XMLHttpRequest();

            request.onreadystatechange = function () {

                if(request.readyState==4 && request.status==200) {
                    json = request.responseText;
                    var obj = JSON.parse(json.substring(json.lastIndexOf('{'), json.length));
                    document.getElementById("emailErr").innerHTML = obj.msg;
                }

            };
            request.open('GET', "emailValidate?email=" + email.value);
            request.send();
        }

        function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);

        }

        function submitValidate() {
            var ret = true;


            document.getElementById("nameErr").innerHTML = "";
            document.getElementById("surnameErr").innerHTML = "";
            document.getElementById("emailErr").innerHTML = "";
            document.getElementById("streetErr").innerHTML = "";
            document.getElementById("cityErr").innerHTML = "";
            document.getElementById("pscErr").innerHTML = "";
            document.getElementById("telErr").innerHTML = "";
            document.getElementById("bdErr").innerHTML = "";
            document.getElementById("pswErr").innerHTML = "";
            document.getElementById("telErr").innerHTML = "";
            document.getElementById("termErr").innerHTML = "";


            if (den.value == "" || mesic.value == "" || rok.value == "") {
                document.getElementById("bdErr").innerHTML = "Zadejte datum narození";
                ret = false;
            }

            if (jmeno.value == "") {
                document.getElementById("nameErr").innerHTML = "Zadejte jméno";
                ret = false;
            }

            if (prijmeni.value == "") {
                document.getElementById("surnameErr").innerHTML = "Zadejte přijmení";
                ret = false;
            }

            if (!validateEmail(email.value)) {
                document.getElementById("emailErr").innerHTML = "Zadejte platný email";
                ret = false;
            }

            if (ulice.value == "") {
                document.getElementById("streetErr").innerHTML = "Zadejte ulici";
                ret = false;
            }

            if (mesto.value == "") {
                document.getElementById("cityErr").innerHTML = "Zadejte město";
                ret = false;
            }

            if (psc.value == "") {
                document.getElementById("pscErr").innerHTML = "Zadejte platné PSČ";
                ret = false;
            }


            if (telefon.value.length != 9) {
                document.getElementById("telErr").innerHTML = "Zadejte platný telefon";
                ret = false;
            }

            var re = /^\d{9}$/;
            if (!re.test(telefon.value)) {
                document.getElementById("telErr").innerHTML = "Zadejte platný telefon";
                ret = false;
            }

            if (password2.value != password.value) {
                document.getElementById("pswErr2").innerHTML = "Hesla se neshodují";
                ret = false;
            }

            if (document.getElementById("checkbox").checked == false) {
                document.getElementById("termErr").innerHTML = "Musíte souhlasit s podmínkami";
                ret = false;
            }


            return (ret);
        }

    </script>



@stop



