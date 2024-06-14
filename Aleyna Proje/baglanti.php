<?php
    $vt = @new mysqli('localhost', 'root', '', 'bitirme_projesi');
    if ($vt->connect_error){
        die("bağlantı hatası : (" . $vt->connect_errno . ")" . $vt->connect_error);
    }
    
    if(isset($_GET["cikis_yap"])){
        
    }

    function get_enum_values( $vt, $table, $field )
    {
        $enumsql = "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'";
        $enumresult = mysqli_query($vt, $enumsql);
        $type =  mysqli_fetch_assoc($enumresult)["Type"];
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }
?>