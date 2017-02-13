<?php

class SessionsController extends BaseController {

  private $rootId = 25;

  /**
   *  Prihlaseni uzivatele.
   */
  public function store(){
     
    if(Auth::attempt(['Email' => Input::get('email'), 'password' => Input::get('password')])){
      
      if(Auth::user()->id == $this->rootId){
        return Redirect::to('root');
      }
    
      if(Session::has('origURL')){
        return Redirect::to(Session::pull('origURL', 'default'));
      }
      return View::make('about');
    }    
    return Redirect::back();
    
  }
  
  /**
   * Ukaze stranku s loginem.
   */
  public function create(){
    return View::make('sessions/create');
  }
  
  /**
   * Odhlaseni uzivatele.
   */
  public function destroy(){
    Auth::logout();
    return View::make('about');
  }


}
