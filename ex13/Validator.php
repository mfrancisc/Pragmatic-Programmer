<?php
/**
 * Validates the request
 *
 */

namespace CodeGenerator;

class Validator {


  public function validateLanguage($lang)
  {
    $langArray = array('php', 'c', 'js', 'java');

    if(!in_array($lang , $langArray))
    {
      die("Language not supported");

    }
  }
}
