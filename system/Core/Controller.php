<?php

namespace system\Core;

use system\Support\Template;

class Controller{

    protected Template $template;

    public function __construct(string $directory)
    {
        $this->template = new Template($directory);
        
    }
}




