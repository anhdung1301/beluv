<?php
namespace Ecommage\CommandLineSample\Model;
class Example
{
    public $message = 'Hello Ecommage!';
    public function getHelloMessage()
    {
        return $this->message;
    }
}