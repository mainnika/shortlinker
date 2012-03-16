<?php
if (isset($_GET['g'])){
    require_once 'short.php';
    $sh = new shorter();
    $tested = strtolower(preg_replace("/[^0-9]/", "", $_GET['g']));
    if ($tested == $_GET['g'])
        if ($link = $sh->idtolink($tested))
            header("Location: ".$link);
    die();    
}
if (isset($_POST['c'])){
    require_once 'short.php';
    $c = $_POST['c'];
    $c = str_replace(" ", "%20", $c);
    if (preg_match("/((mailto\:|(news|(ht|f)tp(s?))\:\/\/)\S+\..*)/", $c)>0){
        $sh = new shorter();
        if ($id = $sh->mklink($_POST['c'])){
            echo $id;
        }
    }
    die();  
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.cookie.min.js"></script>       
        <script type="text/javascript" src="js/short.js"></script>
    </head>
    <body>
        <div id="page" class="page">
            <div id="quickshort" class="form">
                <form id="quickshortform" action="short.php">
                    <input type="text" class="form text" name="c" />
                    <input type="submit" class="form submit" />
                </form>
            </div>
            <div id="quickresult" class="result">
            
            </div>
        </div>
    </body>
</html>