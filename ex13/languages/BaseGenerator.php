<?php
/**
 * C conde generator
 *
 */
namespace CodeGenerator\Languages;

abstract class BaseGenerator {

  protected  $outputCode;
  protected $line, $lineArray, $lineType;
  protected $endMsg;


  /**
   * generates the template 
   *
   */
  public function output($outputFileName)
  {
    file_put_contents(__DIR__ . "/../data/output/" . $outputFileName, $this->outputCode);
  }

  public function debug()
  {
    print_r($this->outputCode); 
  }

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
   * removes the comment tag form line
   *
   */
  protected function removeCommentTag()
  {
    $this->line = str_replace("#", "", $this->line);
  }

  /**
   * removes the message tag from line
   *
   */
  protected function removeMessTag()
  {
    $this->line = str_replace("M", "", $this->line);
  }
}
