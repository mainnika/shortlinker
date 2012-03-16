<?php

class config {
    public $dbhost = "127.0.0.1";
    public $dbname = "short";
    public $dbuser = "root";
    public $dbpass = "";
    //put your code here
}

class shorter {
    private $config;
    function __construct() {
        $this->config = new config;
    }
    function hashtoid($hash) {
        $db = new mysqli($this->config->dbhost,$this->config->dbuser,$this->config->dbpass,$this->config->dbname);
        if ($result = $db->query("SELECT `id` FROM `links` WHERE `hash` = '".$db->real_escape_string($hash)."' LIMIT 1")){
            if ($result->num_rows>0){
                if ($obj = $result->fetch_object()){
                    $db->close();
                    return "http://".$_SERVER['HTTP_HOST']."/?g=".$obj->id;
                }else{
                    $db->close();
                    return NULL;
                }
            }else{
                $db->close();
                return -1;
            }
        }else{
            $db->close();
            return NULL;
        }
        
    }
    
    function mklink($url) {
        $safelink = base64_encode($url);
        if (strlen($safelink)>4096)
            return NULL;
        $hashlink = md5($safelink);
        $pre = $this->hashtoid($hashlink);
        if (!$pre)
            return NULL;
        if ($pre>-1)
            return $pre;
        $db = new mysqli($this->config->dbhost,$this->config->dbuser,$this->config->dbpass,$this->config->dbname);
        if ($db->errno)
            return NULL;
        if ($db->query("INSERT INTO `links` (`orig`,`hash`) VALUES ('".$db->real_escape_string($safelink)."','".$db->real_escape_string($hashlink)."')") === TRUE){
            $id = $this->hashtoid($hashlink);
            if ($id>-1){
                return $id;
            }else{
                return NULL;
            }        
        }
    }
    function idtolink($id){
        $db = new mysqli($this->config->dbhost,$this->config->dbuser,$this->config->dbpass,$this->config->dbname);
        if ($db->errno)
            return NULL;
        if ($result = $db->query("SELECT `orig` FROM `links` WHERE `id`='".$db->real_escape_string($id)."' LIMIT 1")){
            if ($obj = $result->fetch_object()){
                $orig = base64_decode($obj->orig);
                return $orig;
            }else{
                $db->close();
                return NULL;
            }
        }else{
            return NULL;
        }
    }
}
?>
