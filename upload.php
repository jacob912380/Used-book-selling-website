<?php
class Upload{
    function __construct(){


    
    }

    function up( $formName ){

        if(isset($_FILES[$formName]) && $_FILES[$formName]['error'] <> 4 ){ // add &&hou no error 4=no file
    
            $file = $_FILES[$formName];  //file1 list[name,type,size,error]
            
            //verify upload wheither success
            if( $file['error']>0){
                header('location: trans_upload_fail.php');
                die('upload file fail');
            }
            //verify extention
            $ext = pathinfo( $file['name'], PATHINFO_EXTENSION); 
            
            if( $ext != 'jpg' & $ext != 'png' & $ext != 'PNG'){
                // die(' extention wrong!'); 
                header('location: trans_upload_fail.php');
                die();
            }
            if( $file['size'] >1024*1024*2){  //1024*1024*2=2M
                die(' 2M limit!');
                
            }
            // var_dump($file);
            //generate reandom file name
            $filename = uniqid() . '.jpg';
            // move_uploaded_file( $file['tmp_name'], "./uploads/a.jpeg" );
            move_uploaded_file( $file['tmp_name'], "./uploads/$filename" );

            return $filename;
        }else{
            return '';
        }
    }    

}

?>