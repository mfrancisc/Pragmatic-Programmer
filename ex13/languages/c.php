<?php
/**
 * C conde generator
 *
 */
namespace CodeGenerator\Languages;

include_once "BaseGenerator.php";

class Generator extends BaseGenerator{

  /**
   * format line
   *
   */
  public function handleLine($line)
  {
    $this->line = str_replace("\n", "", $line);
    $this->lineArray =explode(" ", $this->line);
    $this->lineType = $this->lineArray[0];
  }

  /**
   * returns line type
   *
   */
  public function getLineType()
  {
    return $this->lineType; 
  }

  /**
   * generate comment line
   *
   */
  public function comment()
  {
    $this->line = str_replace("#", "", $this->line);
    $this->outputCode =  $this->outputCode . "/* " . $this->line . " */" . PHP_EOL;
  }

  public function messageDef()
  {
    $this->line = str_replace("M", "", $this->line);
    $this->outputCode = $this->outputCode . "typedef struct {" . PHP_EOL;
    $this->endMsg = "} " . $this->line . "Msg;";
  }

  /**
   * type definition
   * simple, array types
   *
   */
  public function typeDef()
  {
    //searcig for length definition, es: name[30]
    preg_match("/\[[^\]]*\]/", $this->lineArray[2], $matches);
    $this->lineArray[2] = preg_replace("/\[[^\]]*\]/", "", $this->lineArray[2]);

    if(isset($matches[0]) ? $length = $matches[0] : $length = "");

    $this->outputCode = $this->outputCode . $this->lineArray[2] .  " " . $this->lineArray[1] . $length . ";" . PHP_EOL;
  }

  /**
   * End of message definition
   *
   */
  public function messageEnd()
  {
    $this->outputCode .= $this->endMsg;
  }
}
