<?php
    function upload_to_db($table,$item,$values){
        global $dbserver,$dbusername,$dbpassword,$dbname,$dbport,$dbaccess;
        if ($dbaccess == false){
            return 'Unable to access database';
        }
        else{
            $gundbcon = new mysqli($dbserver,$dbusername,$dbpassword,$dbname,$dbport);
            $uploaddataSQL = "INSERT INTO ".mysqli_real_escape_string($gundbcon,$table)." (".$item.") VALUES (".$values.")";
            //$uploaddataSQL = "SELECT ".mysqli_real_escape_string($gundbcon,$item)." FROM ".mysqli_real_escape_string($gundbcon,$table)." WHERE ".mysqli_real_escape_string($gundbcon,$cat)." = '".mysqli_real_escape_string($gundbcon,$id)."';";
            
            //$uploaddataResult = $gundbcon->query($uploaddataSQL);
            // Fetch all
            
            if (mysqli_query($gundbcon, $uploaddataSQL)) {
                return "New record created successfully";
            } else {
                return "Error: " . $uploaddataSQL . "---" . mysqli_error($gundbcon);
            }
            mysqli_close($gundbcon);
        }
    }
    
    function get_arr_from_db($item,$id,$cat,$table){
        global $dbserver,$dbusername,$dbpassword,$dbname,$dbport,$dbaccess;
        if ($dbaccess == false){
            return 'Unable to access database'.$dbserver.$dbusername.$dbpassword.$dbname.$dbport;
        }
        else{
            $gundbcon = new mysqli($dbserver,$dbusername,$dbpassword,$dbname,$dbport);
            $getinfoSQL = "SELECT ".mysqli_real_escape_string($gundbcon,$item)." FROM ".mysqli_real_escape_string($gundbcon,$table)." WHERE ".mysqli_real_escape_string($gundbcon,$cat)." = '".mysqli_real_escape_string($gundbcon,$id)."';";
            $getinfoResult = $gundbcon->query($getinfoSQL);
            // Fetch all
            
            if ($getinfoResult != ''){
                $getinfoarray = mysqli_fetch_all($getinfoResult,MYSQLI_NUM);
                if ($getinfoarray != NULL){
                mysqli_close($gundbcon);
                
                //return $getinfoarray;
                return $getinfoarray;
                }
                else{
                    mysqli_close($gundbcon);
                    return 'No results';
                }
            }
            else{
                mysqli_close($gundbcon);
                return 'No results';
            }
        }
    }
    #-----ENDFUNCTIONLIBRARY-----#
    ?>
