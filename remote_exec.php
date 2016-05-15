<?php
/*
/*@filename:interface.php
/*@author:Kris Singh<cs15mtech11007@iith.ac.in>
/*@Date:13/05/2016
/*@package name :Iot Server
/*@source:http://kvz.io/blog/2007/07/24/make-ssh-connections-with-php/
*/
/*@remote_exec: exec the remote python script
*/
function remote_exec($file){
    if (!function_exists("ssh2_connect")) die("function ssh2_connect doesn't exist");
    // log in at server1.example.com on port 22
    if(!($con = ssh2_connect("192.168.224.12", 22))){
        echo "fail: unable to establish connection\n";
    } else {
        // try to authenticate with username root, password secretpassword
        if(!ssh2_auth_password($con, "pi", "iithiith")) {
            echo "fail: unable to authenticate\n";
        } else {
            // allright, we're in!
            echo "okay: logged in...\n";

            // execute a command
            if (!($stream = ssh2_exec($con, "ls -al" ))) {
                echo "fail: unable to execute command\n";
            } else {
                // collect returning data from command
                stream_set_blocking($stream, true);
                echo ssh2_exec($con, "python $file");
                fclose($stream);
            }
        }
    }
}
?>