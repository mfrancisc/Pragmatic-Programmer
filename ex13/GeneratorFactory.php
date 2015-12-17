<?php
/**
 * Creates the generator object
 * for the requested language
 *
 */

namespace CodeGenerator;

class GeneratorFactory {

  public function build($lang)
  {
    include_once "languages/" . $lang . ".php"; 
    return new Languages\Generator();
  }

}
