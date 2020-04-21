<?php
if (!defined('ABSPATH')) exit;

/*
work with files 
*/

class ALWPDBF_files {
    public $fileName;
    
    public function __construct($name){
        $this->fileName = $name;
    }
    
    /*
    save to file
    @param Array 
    @todo saving Array to file
    */
    public function saveData($data){
        $text = "";
        foreach ($data as $value){
            $text .= $value."\r\n";
        }
        $f = fopen($this->fileName,'w');
        fwrite($f, $text);
        fclose ($f); 
    }
    
    /*
    get data from file
    @return Array
    */
    public function getData(){
        if (file_exists($this->fileName)){
            $f = fopen($this->fileName,'r');
                $i = 0;
                while (!feof($f)){
                    $content[$i] = fgets($f);
                    $i++;
                }
            fclose($f);
            return $content;
        }
        return false;
    }
}