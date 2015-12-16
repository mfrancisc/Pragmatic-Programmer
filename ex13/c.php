<?php
/**
 * C conde generator
 *
 */
namespace CodeGenerator;

class Generator {

  private $inputFileName, $outputCode, $outputFileName;

  public function __construct($inputFileName, $outputFileName)
  {
    $this->inputFileName = $inputFileName; 
    $this->outputFileName = $outputFileName; 
  }

  public function output()
  {
    $handle = fopen($this->inputFileName, "r");
    if ($handle) {
      $firstCommentFound = false;
      $newFileContent = "";
      while (($line = fgets($handle)) !== false) {
        $line = str_replace("\n", "", $line);
        $lineArray =explode(" ", $line);
        $lineType = $lineArray[0];

        switch ($lineType) {
        case '#':
        $line = str_replace("#", "", $line);
          $this->outputCode =  $this->outputCode . "/* " . $line . " */" . PHP_EOL;
          break;

        case 'M':
        $line = str_replace("M", "", $line);
        $this->outputCode = $this->outputCode . "typedef struct {" . PHP_EOL;
          $endMsg = "} " . $line . "Msg;";
          break;

        case 'F':
          //searcig for length definition, es: name[30]
          preg_match("/\[[^\]]*\]/", $lineArray[2], $matches);
          $lineArray[2] = preg_replace("/\[[^\]]*\]/", "", $lineArray[2]);

          if(isset($matches[0]) ? $length = $matches[0] : $length = "");
 
          $this->outputCode = $this->outputCode . $lineArray[2] .  " " . $lineArray[1] . $length . ";" . PHP_EOL;
          break;

        }
      }
      $this->outputCode .= $endMsg;

      file_put_contents($this->outputFileName . ".c", $this->outputCode);
    }
  }
}
