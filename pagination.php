<?php
/*
    * code by miyachung
*/


$array = ["Element 1","Element 2","Element 3","Element 4","Element 5","Element 6","Element 7","Element 8","Element 9","Element 10"]; # Array to paginate 


$perPg = 5; // Number of elements to be shown per page
$get   = "page"; // Get value


paginate($array,$perPg,$get); // Call func


function paginate($paginateArray,$perPageElement,$getValue){

    $chunk_array = array_chunk($paginateArray,$perPageElement);  // Chunk array to per page


    $pagination = null;
    
    foreach($chunk_array as $pageID => $page){
        $pagination.= '<a href="?'.$getValue.'='.($pageID+1).'">'.($pageID+1).'</a><br />';
    }
    
    if(isset($_GET["$getValue"])){
        if(is_numeric($_GET["$getValue"])){
    
            $showPage = $_GET["$getValue"];
    
    
            if($chunk_array[$showPage-1]){
                
                foreach($chunk_array[$showPage-1] as $element){
                    print $element."<br />"; // Show elements in page
                }
    
            }else{
            header("Location: {$_SERVER['PHP_SELF']}"); // Redirect to self if there is no valid page number
            }
    
    
        }else{
            header("Location: {$_SERVER['PHP_SELF']}"); // Redirect to self if GET value is not numeric
        }
    }
    print $pagination; // Show pagination
    
}
