<?php
/**
 * example call:
 * 
 * php addAfterFirstComment.php '/folder/to/php/files' 'require "pippo.php"'
 *
 * @param filesPath  if black it will assume the current folder
 * @param statment   the statment to add after the first comment block
 *
 * will add the "require pippo.php" after the first comment block
 * in all php files of the current folder
 *
 * backup files before changes
 *
 */

if(isset($argv[1]) && $argv[1] != ""){
  $dir = $argv[1];
}else{
  $dir = dirname(__FILE__);
}

if(isset($argv[2])){
  $statment = $argv[2];
}else{
  die("missing statment");
}
$phpScripts = glob($dir . DIRECTORY_SEPARATOR . '*.php');

$thisFileName = basename(__FILE__);
foreach($phpScripts as $script) {

  $fileName = basename($script);

  //excluding current file
  if($fileName == $thisFileName) {
    continue;
  }

  //backup files
  $fileContent = file_get_contents($script);
  file_put_contents($script . "_" . date('YmdHis'), $fileContent);

  $handle = fopen($fileName, "r");
  if ($handle) {
    $firstCommentFound = false;
    $newFileContent = "";
    while (($line = fgets($handle)) !== false) {
      //searching first comment into the file
      if(preg_match("/\/\/|\*/", $line ) && (!$firstCommentFound)){
        $firstCommentFound = true;
      }

      //first line after first comment block
      if(!preg_match("/\/\/|\*/", $line) && ($firstCommentFound)){
        $line = $statment . PHP_EOL . $line;
        $newFileContent .= $line;
        break;
      }

      $newFileContent .= $line;

    }

    //wrinting file with statment
    file_put_contents($script, $newFileContent);

    fclose($handle);
  }
  else {
    die("can\'t read file!");
  } 
}
exit("file processed");
