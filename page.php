<?php

class Page{
    public $maxPage;
    public $page;
    public $offset;

    function __construct( $dataTotal, $pageNum){

        if(isset($_GET['page'])){
            $this->page = $_GET['page'];
        }else{
            $this->page = 1;  
        }
        $this->maxPage = ceil($dataTotal / $pageNum); 
        $this->offset = ($this->page - 1) * $pageNum;
    }

    function show(){
        for( $i = 1; $i <= $this->maxPage; $i++ ){
            if($i == $this->page){
                echo "<a class='page-break' href='buy_short.php?page={$i}'>{$i}</a>";
            }else{
                echo "<a class='page-break' href='buy_short.php?page={$i}'>{$i}</a>";
            }
        }
    }
}






?>