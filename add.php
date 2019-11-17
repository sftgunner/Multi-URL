<?php
include "customfunctionlibrary.php";
if (!isset($_POST['g-recaptcha-response'])){
    header("Location: https://multiurl.sftg.io/?error=noCaptcha");
    die();
}
$captcharesponse = $_POST['g-recaptcha-response'];

$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array('secret' => getenv('RECAPTCHA_SECRET_MULTIURL'), 'response' => $captcharesponse);

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { 
        header("Location: https://multiurl.sftg.io/?error=captchaError");
        die();
    }
    
    $captcharesult = json_decode($result,1);
    
    //var_dump($captcharesult);
    
    if ($captcharesult["success"]){
        
        $dbserver = getenv('MYSQL_SERVER_MULTIURL');
        $dbusername = getenv('MYSQL_USER_MULTIURL');
        $dbpassword = getenv('MYSQL_PASSWORD_MULTIURL');
        $dbname = getenv('MYSQL_DB_MULTIURL');
        $dbport = getenv('MYSQL_PORT_MULTIURL');
        $dbaccess = true;
        
        $urlsarr = $_POST['url'];
        $urlsarr_sanatized = [];
        
        //Sanatise URLs
        foreach ($urlsarr as $cururl){
            $sanurl = filter_var($url, FILTER_SANITIZE_URL);
            if (!filter_var($sanurl, FILTER_VALIDATE_URL) === false) {
                //All good
                array_push($urlsarr_sanatized,$sanurl);
            } else {        
                header("Location: https://multiurl.sftg.io/?error=invalidURL");
                die();
            }            
        }
        
        $urlnamearr = $_POST['name'];
        $urlnamearr_sanatized = [];
        
        foreach ($urlnamearr as $curname){
            array_push($urlnamearr_sanatized,filter_var($curname, FILTER_SANITIZE_STRING));
        }
        
        //Combine into json
        $urlsjson = json_encode(array_combine($urlsarr_sanatized,$urlnamearr_sanatized));
        
        $title = filter_var($_POST['pagetitle'], FILTER_SANITIZE_STRING);
        
        function generateshortlink(){
            global $dbserver,$dbusername,$dbpassword,$dbname,$dbport;
            //Generate random shortlink
            $newshortlink = substr(md5(microtime()),rand(0,26),7);
            //Check to see whether record with short name already exists
            
            // Create connection
            $mudbconn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname, $dbport);
            
            // Check connection
            if ($mudbconn->connect_error) {
                header("HTTP/1.1 500 Internal Server Error");
                die("Database connection error");
            }
            
            // prepare and bind
            $stmt = $mudbconn->prepare("SELECT id FROM multiurl WHERE shortlink = ?");
            $stmt->bind_param("s", $newshortlink);
            
            
            $getinfoResult = $stmt->execute();
            $mysqlResult = $stmt->get_result();
            $stmt->close();
            $mudbconn->close();
            if ($mysqlResult->num_rows != 0){
                return false;
            }
            else{
                return $newshortlink;
            }
            
        }
        
        $newshortlink = generateshortlink();
        
        while ($newshortlink == false) {
            $newshortlink = generateshortlink();
        }
        
        $uploadresult = upload_to_db('multiurl','shortlink,count,urls,title',"'".$newshortlink."',0,'".$urlsjson."','".$title."'");
        if ($uploadresult == "New record created successfully"){
            header("Location: https://multiurl.sftg.io/".$newshortlink);
            die();
        }
        else{
            header("Location: https://multiurl.sftg.io/?error=".$uploadresult);
        }
    }
    else{
        header("Location: https://multiurl.sftg.io/?error=captchaFailure");
        die();
    }
    
    ?>