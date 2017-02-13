@extends('layouts.default')
@section('content')


  <h2>{{$akce->nazev}}</h2>
  <table class=eventTable>
    <tr>
      <td>
        Kdy:
        </td>
      <td>
        {{$akce->datum->format("d.m.Y")}}
        </td>
      </tr>
    <tr>
      <td>
        Kde:
        </td>
      <td>
        {{$akce->misto}}
        </td>
      </tr>
    <tr>
      <td>
        Čas:
        </td>
      <td>
        {{$akce->cas}}
        </td>
      </tr>
    <tr>
      <td>
        Detaily:
        </td>
      <td class=\"detaily\">
        {{$akce->popis}}
        </td>
      </tr>

    <tr>
      <td>
        Cena:
        </td>
      <td>
        {{$akce->cena}} Kč
        </td>
      </tr>

    <tr>
      <td>
        Přihlášených:
        </td>
      <td>
        {{$akce->pocetLidi}}/{{$akce->maxLidi}}
        </td>
      </tr>
    </table>

{{$akce->printEventInfoEnd()}}
  
  

@stop
