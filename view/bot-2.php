<?php

set_time_limit(60);

$filename=__DIR__."/bot2.txt";
$myfile = fopen($filename, "r") or die("Unable to open file!");
$ex1 = fgets($myfile);
fclose($myfile);

if ($ex1 == 0) {
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    fwrite($myfile, '1');
    fclose($myfile);
    $str = file_get_contents('https://hyperhse.com/job-fetch-torob?type=step2');
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    fwrite($myfile, '0');
    fclose($myfile);
}
else
{
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    $count=$ex1+1;
    fwrite($myfile, $count);
    fclose($myfile); 
}

if ($ex1 > 10)
{
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    fwrite($myfile,'0');
    fclose($myfile); 
}


echo 'finish';
