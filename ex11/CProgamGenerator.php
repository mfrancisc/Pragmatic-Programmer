<?php

$myfile = fopen("input.txt", "r") or die("Unable to open file!");
$content= fread($myfile,filesize("input.txt"));
fclose($myfile);

$arrayLines = explode(PHP_EOL, $content);

//reading name form input file
$name = $arrayLines[0];
$nameUpper = strtoupper($name);

//removing the name line
unset($arrayLines[0]);


$extString = "extern ";
$namesDecl = "const char* " . $nameUpper. "_names[]";

//code for header file
$headerContent =  $extString . $namesDecl . ";" . PHP_EOL;
$headerContent .= "typedef enum {" . PHP_EOL;

//code fot C program
$cPgmContent = $namesDecl . " = {" . PHP_EOL;

if($name === ""){
  die("Invalid name");
}

foreach($arrayLines as $line) {
  if($line === ""){
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

$headerContent .= "} ".$nameUpper.";". PHP_EOL;
$cPgmContent .= "};". PHP_EOL;

//header 
file_put_contents($name . ".h", $headerContent ,  LOCK_EX);
echo "Genereated " . $name .".h". PHP_EOL;

//c pgm
file_put_contents($name . ".c", $cPgmContent ,  LOCK_EX);
echo "Genereated " . $name .".c" . PHP_EOL;




