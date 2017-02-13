<?php

class RootController extends BaseController{

  /**
   *  Controller pro rootovske operace.
   */
  
  
  /**
   *  Vypise interface pro vytvareni eventu.
   */
  public function createEvent(){
  
    $e = new Events();
    $e->nazev = Input::get('nazev');
    $e->popis = Input::get('popis');
    $e->datum = date("Ymd",strtotime(Input::get('den').".".Input::get('mesic').".".Input::get('rok')));
    $e->maxLidi = Input::get('pocetlidi');
    $e->cas = Input::get('cas');
    $e->misto = Input::get('misto');
    $e->skupina = "0";
    $e->cena = Input::get('cena');
    
    if(Input::get('doDen') == '' || Input::get('doMesic') == '' || Input::get('doRok') == ''){
      $x = date("d-m-Y",strtotime(Input::get('den').".".Input::get('mesic').".".Input::get('rok'))-60*60*24);
      $e->dodatum = $this->stringToDate($x);
    }
    else{

      $e->dodatum = date("Ymd",strtotime(Input::get('doDen').".".Input::get('doMesic').".".Input::get('doRok')));
    }
    if($e->save() != false){
      echo '<script>alert("Akce vytvorena")</script>';  
    }
    else{
      echo '<script>alert("Akce nevytvorena")</script>';
    }
    return Redirect::to('root');
  }
  
  /**
   *  ukaze seznam vsech eventu
   */
  public function eventList(){
    $akce = DB::table('Events')->paginate(2);
    foreach($akce as $a){
      echo link_to('root/attendants/'.$a->id, $a->nazev).', '.link_to('event/destroy/'.$a->id, "smazat").'<br>';
    }
    echo link_to('root', 'zpět');
    echo $akce->links();
  }
  
  /**
   *  ukaze seznam vsech uzivatelu prihlasenych na event s danym id.
   */
  public function attendants($id){
    $lidi = DB::table('Attending')->where('IdEvent', '=', $id)->get();
    
    echo '<table border=1px solid black>';
    foreach($lidi as $l){
      $c =  DB::table('Users')->where('Id', '=', $l->idUser)->first();
      echo '<tr>';
        echo '<td>';
          echo $c->Jmeno.'<br>';
        echo '</td>';
        echo '<td>';
          echo $c->Email;
        echo '</td>';
      echo '</tr>';
    }
    
    echo '</table>';
    
  }
  
  /**
   * Vypise seznam vsech uzivatelu
   */
  public function userList(){
    echo '<!DOCTYPE html><html><head><meta charset="utf-8"></head><body>';
    $users = DB::table('Users')->get();
    foreach($users as $u){
      echo $u->Jmeno.' - <a href="../user/destroy/'.$u->id.'"">Smazat</a><br>';
    }

    echo link_to("root", "zpět");

  }
  
  /**
   * Vrati datum ve formatu DateTime [aby slo pouzit date->format(..)].
   */
  
  private function stringToDate($string){
    $x = new DateTime($string);
    return($x);
  }

  /**
   * @param $id
   * kaskadove vymaze akci
   */
  public function destroyEvent($id){

    DB::table('Attending')->where('idEvent', '=',  $id)->delete();

    $event = Events::find($id);
    $event->delete();

    return Redirect::to("root/eventList");

  }
}
