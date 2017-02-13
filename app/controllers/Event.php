<?php

class Event {

  public $id;
  public $datum;
  public $popis;
  public $nazev;
  public $maxLidi;
  public $skupina;
  public $noEvent = false;
  public $emptyBox = false;
  public $pocetLidi;
  public $cas;
  public $misto;
  public $cena;
  public $doDatum;
  
  /**
   * Konstuktor eventu. $e       - objekt z databazove tabulky Events.
                        $date    - datum ve spravnem formatu nalezici danemu eventu.
                        $boolean - boolean ktery rika jestli se bude tento event vypisovat nebo ne.
   */
  public function __construct($e, $date, $boolean){
  
//	   $this->pocetLidi = DB::table('Attending')->select('*')->count('idUser')->groupBy('idEvent')->where('idEvent', $this->id);
//    $this->pocetLidi = DB::table('Attending')->select('*')->where('idEvent', $this->id)->count('*');
//    $this->pocetLidi = DB::select('SELECT COUNT(*) FROM Attending WHERE idEvent=?', array($this->id));
      
    $this->emptyBox = $boolean;  
    $this->datum = clone($date);
    if(!is_null($e)){
    
      $this->id = $e->id;
      $this->nazev = $e->nazev;
      $this->popis = $e->popis;
      $this->maxLidi = $e->maxLidi;
      $this->skupina = $e->skupina;
      $this->cas = $e->cas;
      $this->misto = $e->misto;
      $this->cena = $e->cena;
      $this->doDatum = $this->stringToDate($e->dodatum);
    }
    else{
      $this->noEvent = true;
    }
        $this->pocetLidi = DB::table('Attending')->where('idEvent','=',$this->id)->count();
        
        if($this->pocetLidi > $this->maxLidi)
          $this->pocetLidi = $this->maxLidi;
  }
  
  /**
   * vraci mesic daneho eventu
   */
  public function getMonth(){
    return $this->datum->format("m");
  }
  
 /**
   * vypise prazdnou kolonku tabulky
   */
  public function printEmptyBox(){
    echo '<td class=neakce>';	
    echo '</td>';
  }
  
  /**
    * vypise kolonku kalendare budto jako prazdnou nebo jako odkaz na detaily k eventu.
    */
  public function printEventLink(){
  
    if($this->emptyBox){
      echo '<td class=neakceWrongMonth>';	
        echo $this->datum->format("d");
      echo '</td>';      
      return;
    }
  
  
    if($this->isNull()){
      echo '<td class=neakce>';	
      echo $this->datum->format("d");
      echo '</td>';
    }
    
    else{
    
      echo '<td class=akce onClick="window.location.href=\'event/'.$this->id.'\'">';
 //       echo '<td class=akce>';
 //       echo $this->datum->format("d");
        //echo '<a href="http://www.w3schools.com">Visit W3Schools.com!</a>';
        echo '<a href="event/'.$this->id.'">'.$this->datum->format("d").'</a>';
        $this->printCheckIcon();
        
        echo '<div class=eventTooltip>';
          echo $this->cas.'<br>';
          echo $this->nazev.'<br>';
          echo $this->pocetLidi."/".$this->maxLidi."<br>";
        echo '</div>';
        
      echo '</td>';
    }
  }
  
  /**
   *  Vypise stranku s detaily a moznosti se prihlasit/odhlasit.
   */
  
  public function printEventInfoEnd(){

    if($this->pocetLidi < $this->maxLidi){
      if(Auth::check()){	
        if(DB::table('Attending')->where('idEvent','=', $this->id)->where('idUser','=', Auth::User()->id)->count() != 0){
          echo "Na tuto akci jste již přihlášen<br>";
          if($this->canUnsign()){
 //           echo '<form><input type="button" value="Odhlásit" onClick="window.location.href=\'../event/unsign/'.$this->id.'\'"></form>';
            echo '<a href="../event/unsign/'.$this->id.'"><button>Odhlásit</button></a>';
          }
        }
        else{
 //         echo '<form><input type="button" value="Přihlásit" onClick="window.location.href=\'../event/sign/'.$this->id.'\'"></form>';
          echo '<a href="../event/sign/'.$this->id.'"><button>Přihlásit</button></a>';
        }
      }
      else{
        $origURL = '/event/sign/'.$this->id;
        Session::put('origURL', $origURL);
 //       echo '<form><input type="button" value="Přihlásit" onClick="window.location.href=\'../session/create\'"></form>';
        echo '<a href="../event/sign/'.$this->id.'"><button>Přihlásit</button></a>';
      }
    }
  }
  
  /**
   * vrati jestli instance reprezentuje skutecnou akci nebo jen prazdny event.
   */
  public function isNull(){
    return($this->noEvent);
  }
  
  /**
   *  Zavola view ve kterem se vola printEventInfo().
   */
  public function makeView(){
    return View::make('event', ['event' => $this]);
  }
  
  /**
   * Zkontroluje jestli je uzivatel prihlasen na danou akci, jestli jo tak do kolonky kalendare nakresli check.
   */
  private function printCheckIcon(){
    if(Auth::check()){
      if(DB::table('Attending')->where('idEvent','=', $this->id)->where('idUser','=', Auth::User()->id)->count() != 0){
        echo HTML::image('img/check.png');
      }
    }
  }
  
  /**
   * Vraci jestli je jeste mozne se z dane akce odhlasit. 
   */
  private function canUnsign(){
  
    $today = getDate();
    $todayString = $today["year"]."-".$today["mon"]."-".$today["mday"];
    $unsignDate = $this->doDatum->format("Y")."-".$this->doDatum->format("m")."-".$this->doDatum->format("d");
    
    $unsignTime = strtotime($unsignDate);
    $todayTime = strtotime($todayString);
    
    if($todayTime >= $unsignTime)
      return(false);
    return(true);
    
  }
  
  /**
   * Vrati datum ve formatu DateTime [aby slo pouzit date->format(..)].
   */
  
  private function stringToDate($string){
    $x = new DateTime($string);
    return($x);
  }
}
