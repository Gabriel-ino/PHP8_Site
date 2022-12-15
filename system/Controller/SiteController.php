<?php

namespace system\Controller;

use system\Core\Controller;
use system\Support\Template;

class SiteController extends Controller{

    public function __construct()
    {
        parent::__construct("templates/site/views");
        
    }

    public function index():void{
        echo $this->template->render('index.html', [
            "titulo" => "Teste"
        ]);
    }

    public function about():void{
        echo $this->template->render('about.html', [
            'paragrafo' => 'meu paragrafo'
        ]);
    }

}




