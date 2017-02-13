<?php


class PokusController extends BaseController {

  /**
   * Controller pro vsechno. Vse co vyzaduje jednu funkci a nezaslouzi si vlastni controller + nejake pokusy.
   */

  private $mm = 0;

  public function show(){
    echo $this->mm."<br>";
    echo link_to('pokus/'.$this->mm, "INC");
  }
  
  public function show2($mm){
    $this->mm = $mm+1;
    $this->show();
  }
  
  
  public function xyz(){
  
    $tempDate = new DateTime("2017-08-01");
    
    echo $tempDate->format("d.m.Y")."<br>";
    
    for($ii=0; $ii < 5; $ii++){
      $tempDate->add(new DateInterval("P1D"));
      echo $tempDate->format("d.m.Y")."<br>";      
    }
    
    $tempDate = new DateTime("2017-08-01");
    echo $tempDate->format("d.m.Y")."<br>";
    
  }
  
  /**
   * Prihlasi uzivatele na event s danym id.
   */
  public function signin($id){
    $attendant = new Participant();
    $attendant->idEvent = $id;
    $attendant->idUser = Auth::User()->id;
    $attendant->save();
    
    $akce = DB::table('Events')->where('id', '=', $id)->first();
    
    $datum = date($akce->datum);
    
    Mail::send('emails.signin', array('jmeno' => $akce->nazev, 'date' => $akce->datum, 'time' => $akce->cas), function($message){
      $message->to(Auth::User()->Email, '')->subject('Přihlášení');
    });
    
    return Redirect::to('/event/'.$id);
    
  }
  
  /**
   * Zkouska posilani mailu
   */
  public function mail(){
    Mail::send('emails.auth.welcome', array('psw' => 'heslo', 'email' => 'email@email.cz'), function($message){
      $message->to('matous.kadrnoska@gmail.com', 'MT')->subject('Welcome');
    });
  }
  
  /**
   * Response na ajax pri prihlasovani.
   */
  public function userValidate(){
    if(Auth::attempt(['Email' => Input::get('email'), 'password' => Input::get('psw')])){
      echo "1";
    }
    else{
      echo "0";
    }
  }
  
  /**
   *  Odhlasi uzivatele z eventu s danym id.
   */
  
  public function unsign($id){
    DB::table('Attending')->where('idEvent', '=', $id)->where('idUser', '=', Auth::User()->id)->delete();
    return Redirect::to('/event/'.$id);
  }

}
