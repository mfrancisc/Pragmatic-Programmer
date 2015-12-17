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
    file_put_contents(__DIR__ . "/../data/output/" . $outputFileName . ".c", $this->outputCode);
  }

  public function debug()
  {
    print_r($this->outputCode); 
  }

}
