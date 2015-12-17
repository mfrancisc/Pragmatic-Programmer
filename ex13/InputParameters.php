<?php
/**
 * Handle all the inputs for the CodeGenerator
 *
 */

namespace CodeGenerator;

class InputParameters {

  private $input;

  public function __construct(array $input)
  {
    $this->input = $input; 
  }

  /**
   * get configuration file name
   *
   */
  function getInputFileName()
  {
    if(isset($this->input[1]))
    {
      if(file_exists("data/input/" . $this->input[1])){
        return  "data/input/" .$this->input[1]; 
      }else{
        die('File not found : ' . $this->input[1]); 
      }
    }else{
      die('missing input file name');
    }
  }

  /**
   * get requested language
   *
   */
  public function getLanguage()
  {
    if(isset($this->input[2])){
      return  $this->input[2];
    }else{

      die('Missing language to generate');
    }
  }

  /**
   * get name of the file to be generated
   *
   */
  public function getOuputFileName()
  {
    if(isset($this->input[3])){
      $outputFileName = $this->input[3];
    }else{
      $outputFileName = date('Ymd') . "_" . date("His") . "_Template";
    }
    return $outputFileName;
  }
}
