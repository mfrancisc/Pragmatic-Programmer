<?php
/**
 * Reads the input file and generates
 * data structure in multiple languages
 *
 */
include_once "InputParameters.php";
include_once "GeneratorFactory.php";

// reading input parameters
$inputParam = new CodeGenerator\InputParameters($argv);
$inputFileName = $inputParam->getInputFileName();
$lang = $inputParam->getLanguage();
$outputFileName = $inputParam->getOuputFileName();

//generator object
$generatorFactory = new CodeGenerator\GeneratorFactory();
$generator = $generatorFactory->build($lang);

//generate code
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
