<?php
/**
 * Creates the generator object
 * for the requested language
 *
 */

namespace CodeGenerator;

include_once "languages/CGenerator.php"; 
include_once "languages/PasGenerator.php"; 

class GeneratorFactory {

  public function build($lang)
  {
    switch ($lang) {

    case 'c':
      return new Languages\CGenerator();
      break;

    case 'pascal':
    return new Languages\PasGenerator();
      break;

    default:
      die('Unsupported language: ' . $lang);

    }
  }

}
