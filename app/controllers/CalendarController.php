<?php

include_once 'Event.php';

class CalendarController extends BaseController {

  /** @var int Definuje v jakem roce se zrovna nachazi uzivatel kalendare. */
  private $rok = -1;
  /** @var int Definuje v jakem mesici se zrovna nachazi uzivatel kalendare. */
  private $mesic = -1;
  /** @var date Definuje pocatecni datum vypisu kalendare v danem mesici/roku. */
  private $zacatek;
  
  /**
   * Pokud neni nastaveno tak nastavi rok a mesic na aktualni datum a ukaze stranku s kalendarem.
   */
  
  public function show(){
  
    $mesice = array(
      '1' => 'Leden',
      '2' => 'Únor',
      '3' => 'Březen',
      '4' => 'Duben',
      '5' => 'Květen',
      '6' => 'Červen',
      '7' => 'Červenec',
      '8' => 'Srpen',
      '9' => 'Září',
      '10' => 'Říjen',
      '11' => 'Listopad',
      '12' => 'Prosinec'
    );
  
  
    $begDate = $this->getBeginning();
    $this->zacatek = clone($begDate);
    
//    echo $begDate->format("d.m.Y");
    
    $events = DB::table('Events')->get();
    $calenderEvents = array();

    for($ii = 0; $ii < 42; $ii++){
      array_push($calenderEvents, new Event($this->ex($events, $begDate), $begDate, $this->mesic != $begDate->format("m") ));
      $begDate->add(new DateInterval('P1D'));  
    }
    
/* ************ vygenerovani linku na pohybovani v kalendari ******************************** */
    if($this->mesic == 12){
      $monthInc = link_to('calendar/01/'.($this->rok+1), $mesice[1]);
    }
    else{
      $monthInc = link_to('calendar/'.($this->mesic+1).'/'.$this->rok, $mesice[$this->mesic+1]);
    }
    
    if($this->mesic == 1){
      $monthDec = link_to('calendar/12/'.($this->rok-1), $mesice[12]);
    }
    else{
      $monthDec = link_to('calendar/'.($this->mesic-1).'/'.$this->rok, $mesice[$this->mesic-1]);
    }
    
    
        
    
    return View::Make("calendar")->with("events", $calenderEvents)->with('monthDec', $monthDec)->with('monthInc', $monthInc)->with('mesic', $mesice[(integer)$this->mesic])->with('rok', $this->rok)->with('month', $this->mesic);
        
 /*   
    $tempDate = clone($begDate);
    foreach($calenderEvents as $ce){
      if(!$ce->isNull()){
        $ce->printEventLink();
        }
      else{
        echo $tempDate->format("d.m.Y")."<br>";
      }
      $tempDate->add(new DateInterval('P1D'));
    }  
    
    */    
  }
  
  /**
   *  Vrati datum od kteryho se bude zobrazovat kalendar
   */
  private function getBeginning(){  
  
    $today = getdate();
    
    if($this->rok == -1)
      $this->rok = $today["year"];
    if($this->mesic == -1)
      $this->mesic = $today["mon"];    
    
    
//    $tempDate = new DateTime($today["year"]."-".$today["mon"]."-01");

      $tempDate = new DateTime($this->rok."-".$this->mesic."-01");
  
//  $tempDate = new DateTime("2017-08-01");
    $offSet = $tempDate->format('w');
  
    if($offSet <= 0)
      $offSet = $offSet + 7;
    
    $offSet--;
  
    $tempDate->sub(new DateInterval('P'.$offSet.'D'));  
    return($tempDate);
  }
  
  /**
   * Natavi privatni promenne rok a mesic na specificke hodnoty a pak zavola funkci show.
   */
  public function setSpecific($month, $year){
    $this->rok = $year;
    $this->mesic = $month;
    return($this->show());
  }

  /**
   * Puvodni funkce show(). Ted uz nepouzita.
   */
  function show2(){
    
/* Nastaveni data do $this->den/mesic/rok */  
    $today = getdate();
    
    echo "Calendar constructor<br>";

    $this->den = $today["mday"];
    $this->mesic = $today["mon"];
    $this->rok = $today["year"];
    
//    $this->den = 22;
//    $this->mesic = 03;
//    $this->rok = 1991;
/* -----------------------------------------------------------------------------*/
    $tempDate = date($this->rok."-".$this->mesic."-".$this->den);
            	
    echo "Ted je $this->den. $this->mesic. $this->rok<br>";
    
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $this->mesic, $this->rok);
    
    echo "V tomhle mesici je ". $daysInMonth ." dni<br>";
        
/* Vypocet jaky je den prvniho v danym mesici */ 
    $firstWDay = (date('N', strtotime($tempDate)) - ($this->den % 7) + 1);
    if($firstWDay < 0)
      $firstWDay = $firstWDay + 7;
    echo "Prvniho v tomhle mesici je: $firstWDay <br>";
/* -----------------------------------------------------------------------------*/


/* ulozeni obsahu databaze */  
  $events = DB::table('Events')->get();
  $events2 = array();
  
  for($ii = -$firstWDay + 1; $ii <= $daysInMonth; $ii++){
    $events2[] = new Event($this->eventExists($events, $ii));
  }
/* Vypis kalendare na tento mesic */
    $day = 2 - $firstWDay;
    echo "<table border=1>";
    for($ii = 0; $ii < 5; $ii++){
      echo "<tr>";
      for($jj = 0; $jj < 7; $jj++){
      
       if($day > $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $this->mesic, $this->rok))
         $day = 1;

        echo "<td>";
        if($day <= 0)
          echo ".";
        else{
          $events2[$day]->printEventLink($day);
        } 
        $day++;
        echo "</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
    
    foreach($events2 as $event){
      if(!$event->isNull())
        $event->printEventInfo();
    }
    
/* -----------------------------------------------------------------------------*/
      
  }
  
  /**
   * Funkce bere 2 parametry (pole eventu, datum z kalendare). Jestlize existuje event ktery se kona v dane datum, vrati event. Jestlize ne, vrati NULL.
   */ 
  
  private function ex($events, $datum){
    foreach($events as $event){
      $tempDate = new DateTime($event->datum);
//      echo $event->datum." ?= ".$datum->format("Y-m-d")."<br>";
      if($tempDate == $datum){
//      echo "VYHOVUJICI DATUM<brd>";
//        echo $datum->format("d.m.Y")."<br>";
        return($event);
      }
    }
    return NULL;
  }
  
  /**
   * To same jako ex($events, $datum) jen pouzivane ve starem show(). Ted uz nepouzivana.
   */
  private function eventExists($events, $day){
  
    foreach($events as $event){
//      echo date("d",strtotime($event->datum))." compared to ".$day."<br>";
      if(date("d",strtotime($event->datum)) == $day){
        echo "vyhovujici event s datem ".$day."<br>";
        return $event;
      }
    }
    return NULL;
  
  }
}
