<?php

class input{
    //data check
        function post ($content ){
            if($content == ''){
                return false;
            }
            $n = ['fuck','damn','shit']; //can not use
            foreach ($n as $name) {
            if($content == $name){
                return false;
            }
        }
    
            return true;
        }
    }


?>