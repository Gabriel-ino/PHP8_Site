<?php

namespace system\Support;
use Twig\Lexer;
use Twig\TwigFunction;
use system\Core\Helpers;

class Template{

    private \Twig\Environment $twig;

    public function __construct(string $directory)
    {
        $loader = new \Twig\Loader\FilesystemLoader($directory);
        $this->twig = new \Twig\Environment($loader);
        $lexer = new Lexer(
            $this->twig, [
                $this->helpers()
            ]
            );
        $this->twig->setLexer($lexer);
        
    }

    public function render(string $view, array $data){
        return $this->twig->render($view, $data);

    }

    private function helpers(): void{
        [
            $this->twig->addFunction(
                new TwigFunction('setURL', function (string $url = null){
                    return Helpers::setURL($url);
                })
            ),

            $this->twig->addFunction(
                new TwigFunction('greetings', function (){
                    return Helpers::greetings();
                })
            )
        ];
    }

}


