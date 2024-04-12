<?php
  /*
   * Základní kontroler
   * Načte model a pohled
   */
  class Controller {
    // Načte model
    public function model($model){
      // Knihovny modelu
      require_once '../app/models/' . $model . '.php';

      // Instance modelu
      return new $model();
    }

    // Načte pohled
    public function view($view, $data = []){
      // Zkontrolujte soubor zobrazení
      if(file_exists('../app/views/' . $view . '.php')){
        require_once '../app/views/' . $view . '.php';
      } else {
        // Pohled neexistuje
        die('Pohled neexistuje');
      }
    }
  }