<?php
  class Pages extends Controller {
    public function __construct(){}
    
    public function index(){
      if(isLoggedIn()){
        redirect('posts');
      }
      $data = [
        'title' => 'Blog',
        'description' => 'Jednoduchý MVC Blog',
        'info' => 'Pokud se vám můj program líbí a jste ochotni mi nabídnout smlouvu a práci na vašem projektu, můžete mě kontaktovat s následujícími údaji níže',
        'name' => 'Vítězslav Daříček',
        'location' => '',
        'contact' => '',
        'mail' => 'vitezslav.daricek@seznam.cz'
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'O nás',
        'description' => 'Aplikace pro sdílení příspěvků s ostatními uživateli'
      ];

      $this->view('pages/about', $data);
    }

    public function contact(){
      $data = [
          'title' => 'Kontaktujte nás',
          'description' => '',
          'info' => 'Pokud se vám můj program líbí a jste ochotni mi nabídnout smlouvu a práci na vašem projektu, můžete mě kontaktovat s následujícími údaji níže',
          'name' => 'Vítězslav Daříček',
          'location' => '',
          'contact' => '',
          'mail' => 'vitezslav.daricek@seznam.cz'
      ];

      $this->view('pages/contact', $data);
    }
  }