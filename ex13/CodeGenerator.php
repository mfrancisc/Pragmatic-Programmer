<?php
/**
 * Reads a input file and generates
 * data structure in multiple languages
 *
 */
if(isset($argv[1]))
{
  if(file_exists($argv[1])){
    $inputFileName = $argv[1]; 
  }else{
    die('File not found : ' . $agrv[1]); 
  }
}else{
  die('missing input file name');
}

if(isset($argv[2])){
  $lang = $argv[2];
}else{

  die('Missing language to generate');
}

if(isset($argv[3])){
  $outputFileName = $argv[3];
}else{
  $outputFileName = date('Ymd') . "_" . date("His") . "_Template";
}

$langArray = array('php', 'c', 'js', 'java');

if(!in_array($lang , $langArray))
{
  die("Language not supported");

}

include_once $lang .".php";

$generator = new CodeGenerator\Generator($inputFileName, $outputFileName);
$generator->output();

exit("Template generated: ". $outputFileName);
