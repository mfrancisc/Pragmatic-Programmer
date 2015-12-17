<?php
/**
 * Reads a input file and generates
 * data structure in multiple languages
 *
 */

// reading input parameters
include_once "InputParameters.php";

$inputParam = new CodeGenerator\InputParameters($argv);
$inputFileName = $inputParam->getInputFileName();
$lang = $inputParam->getLanguage();
$outputFileName = $inputParam->getOuputFileName();

//validation
$langArray = array('php', 'c', 'js', 'java');

if(!in_array($lang , $langArray))
{
  die("Language not supported");

}


include_once $lang .".php";

$generator = new CodeGenerator\Generator();
$handle = fopen($inputFileName, "r");
if ($handle) {
  while (($line = fgets($handle)) !== false) {
    $generator->handleLine($line);

    switch ($generator->getLineType()) {
    case '#':
      $generator->comment();
      break;

    case 'M':
      $generator->messageDef();
      break;

    case 'F':
      $generator->typeDef();
      break;

    case 'E':
      $generator->messageEnd();
      break;

    }
  }

  $generator->output($outputFileName);
}
exit("Template generated: ". $outputFileName);
