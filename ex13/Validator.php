<?php
/**
 * Validates the request
 *
 */

namespace CodeGenerator;

class Validator {


  public function validateLanguage($lang)
  {
    $langArray = array('c', 'pascal');

    if(!in_array($lang , $langArray))
    {
      die("Language not supported");

    }
  }
}
