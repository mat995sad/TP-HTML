<?php

$mySQLClient = new PDO(
        'mysql:host=localhost;dlname=technowebprojetsimon;charset=utf8',
        'root','',
        [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION],

    );
    


?>
