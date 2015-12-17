<?php
/**
 * Pascal code generator
 *
 */
namespace CodeGenerator\Languages;

include_once "BaseGenerator.php";

class Generator extends BaseGenerator{


  public function output($outputFileName)
  {
    parent::output($outputFileName . '.pas'); 

  }
  /**
   * generate comment line
   *
   */
  public function comment()
  {
    $this->removeCommentTag();
    $this->outputCode =  $this->outputCode . "{ " . $this->line . " }" . PHP_EOL;
  }

  public function messageDef()
  {
    $this->removeMessTag();
    $this->outputCode .= $this->line . " = packed record" . PHP_EOL;
  }

  /**
   * type definition
   * simple, array types
   *
   */
  public function typeDef()
  {
    if($this->isSimpleType())
    {
      $typeDef = $this->getSimpleType();
    }else{
      $typeDef = $this->getComplexType();
    }

    $this->outputCode .= $this->lineArray[1] . ": " . $typeDef . ";" . PHP_EOL;
  }

  /**
   * End of message definition
   *
   */
  public function messageEnd()
  {
    $this->outputCode .= "end;";
  }

  private function isSimpleType()
  {
    return preg_match("/int/", $this->lineArray[2]);
  }

  private function getSimpleType()
  {
    return "LongInt";
  }

  private function getComplexType()
  {
    //extracting length definition, es: 30 from char[30]
    preg_match("/[0-9]{2}/", $this->lineArray[2], $lengthMatch);
    $varLength = $lengthMatch[0] - 1;

    // reomoving legth definition 
    $varName = preg_replace("/\[[^\]]*\]/", "", $this->lineArray[2]);

    return "array[0.." . $varLength . "] of " . $varName;
  }
}

