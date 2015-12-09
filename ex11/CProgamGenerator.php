<?php

$myfile = fopen("input.txt", "r") or die("Unable to open file!");
$content= fread($myfile,filesize("input.txt"));
fclose($myfile);

$arrayLines = explode(PHP_EOL, $content);

//creating .h file
$extString = "extern ";
$namesDecl = "const char* NAME_names[]";

$headerContent =  $extString . $namesDecl . ";" . PHP_EOL;
$headerContent .= "typedef enum {" . PHP_EOL;

$cPgmContent = $namesDecl . " = {" . PHP_EOL;

foreach($arrayLines as $line) {
  if($line === "name" || $line === ""){
    continue; 
  }

  if($line !== ": :"){
    $headerContent .= $line . "," . PHP_EOL;
    $cPgmContent .= '"' . $line . '"' . "," . PHP_EOL;
  }else{
    $headerContent .= $line . PHP_EOL;
    $cPgmContent .=  $line . PHP_EOL;
  }
}
$headerContent .= "} NAME;". PHP_EOL;
$cPgmContent .= "};". PHP_EOL;

file_put_contents("name.h", $headerContent ,  LOCK_EX);
file_put_contents("name.c", $cPgmContent ,  LOCK_EX);




