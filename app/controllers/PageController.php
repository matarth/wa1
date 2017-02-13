<?php

class PageController extends BaseController {


  /**
   *  Ukaze stranku 'O nas'
   */
  public function about(){
    return View::make('about');
  }

  /**
   *  Ukaze stranku 'Kalendar'
   */  
  public function calendar(){
    return View::make('calendar');
  }
  
  /**
   *  Ukaze stranku 'novinky' - Uz neplati
   */    
  public function news(){
    return View::make('news');
  }
  
  /**
   *  Ukaze stranku 'Galerie'
   */    
  public function gallery(){
    return View::make('gallery');

  }
  
  /**
   *  Ukaze stranku 'Kontakt'
   */  
  public function contact(){
    return View::make('contact');
  }

}