<?php

class seamoonotpclient {

    function SendMessageToServer($serverip, $port, $message){

        set_time_limit(3000);

        $service_port = $port;
        $address = $serverip;

        $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        if ($socket < 0) {
            echo 'socket_create errors';
            return "-7";
        }

        $result2 = socket_connect($socket, $address, $service_port);

        if ($result2 < 0) {
            echo 'socket_connect errors';
            return "-7";
        }

        $in = $message;

        $out = '';

        if (!socket_write($socket, $in, strlen($in))) {
            echo 'socket_write errors';
            return "-7";
        }

        $out = socket_read($socket, 8192);
        //exit();
        socket_close($socket);
        return $out;
    }

    function checkpassword($serverip, $port, $userid, $password){
        //error_reporting(E_ALL);
        $out = '';

        $message = "seamoonotpclient1001" . chr(2) . $userid . chr(2) . $password;

        $out = $this->SendMessageToServer($serverip, $port, $message);

        if (strlen($out) > 3) {

            return -5;
        } else {
            return $out;
        }
    }

    function checkpassword2($serverip, $port, $GroupName, $userid, $password){
        //error_reporting(E_ALL);
        $out = '';

        $message = "seamoonotpclient1002" . chr(2) . $GroupName . chr(2) . $userid . chr(2) . $password;

        $out = $this->SendMessageToServer($serverip, $port, $message);

        if (strlen($out) > 3) {
            return -5;
        } else {
            return $out;
        }
    }
}

?> 
