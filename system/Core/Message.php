<?php

namespace system\Core;

class Message{
    private $text;
    private $css;

    public function __toString()
    {
        return $this->render();
    }

    /**
     * Function that sets the message and CSS style to the alert-success from bootstrap
     * @param string $message Text that is set to the Message class
     * @return $this  
     * @author Gabriel Chaves Martins
     */
    public function success(string $message): Message{
        $this->css = 'alert alert-success'; 
        $this->text = $this->filter($message);

        return $this;

    }

    public function alert_danger(string $message): Message{
        $this->css = 'alert alert-danger';
        $this->text = $this->filter($message);

        return $this;
    }

    public function alert_warning(string $message): Message{
        $this->css = 'alert alert-warning';
        $this->text = $this->filter($message);

        return $this;
    }

    public function alert_info(string $message): Message{
        $this->css = 'alert alert-primary';
        $this->text = $this->filter($message);

        return $this;

    }


    public function render(): string{
        return "<div class='{$this->css}'>{$this->text}</div>";

    }

    private function filter(string $message): string{
        return filter_var($message, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}





