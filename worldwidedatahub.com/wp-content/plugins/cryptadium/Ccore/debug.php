<?php
namespace Ccore;

class Ccore_debug {
    private $errors = array();
    function __construct($write_log=false) {
        if($write_log) {
            
        }
    }
    function addError($code=0000,$text='Unknown error') {
        if (empty($code))
            $code='0000';
        if (is_array($code))
            $code=$code[0];
        if (empty($text))
            $text='Unknown error';
        if (is_array($text))
            $text=$text[0];
        $this->errors[] = ['code'=>$code,'text'=>$text];
    }
    function writeLogToFile($file = CmAdress.'\errors.txt') {
        if (!empty($this->errors)) {
            $date = date('m/d/Y h:i:s a', time());
            foreach ($this->errors as $error) {
                $current = file_get_contents($file);
                $current .= $date." Code: ".$error['code'].". Error: ".$error['text'].""."; \n";
                file_put_contents($file, $current);
            }
        }
    }
    function getErrors() {
        $date = date('m/d/Y h:i:s a', time());
        if (!empty($this->errors)) {
            $current = "";
            foreach ($this->errors as $error) {
                $current .= $date." Code: ".$error['code'].". Error: ".$error['text'].""."; \n";
            }
        } else {
            $current = "no errors";
        }
        return $current;
    }
}