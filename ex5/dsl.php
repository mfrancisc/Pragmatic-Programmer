<?php

$commands = array(
  array( "command" => "P", 
  "argRequired" => true, 
  "functionToRun"=>"doSelectPen",
),
array( "command" => "U", 
"argRequired" => false, 
"functionToRun"=>"doPenUp",),
array( "command" => "D", 
"argRequired" => false, 
"functionToRun"=>"doPenDown",),array( "command" => "N", 
"argRequired" => true, 
"functionToRun"=>"doPenDir",),array( "command" => "S", 
"argRequired" => true, 
"functionToRun"=>"doPenDir",),array( "command" => "E", 
"argRequired" => true, 
"functionToRun"=>"doPenDir",),array( "command" => "W", 
"argRequired" => true, 
"functionToRun"=>"doPenDir",));

// param validation
if(!isset($argv[1])){
  die("*** Cmd required ***");
}
if(!isset($argv[2])){
  $argv[2] = "";
}

$cmd = $argv[1];
$param = $argv[2];

echo "cmd: " . $cmd . PHP_EOL;
echo "parameter: " . $param . PHP_EOL;

$validCmd = false;
foreach ($commands as $commandOpt) {

  //cmd validation
  if($commandOpt["command"] == $cmd) {
    $validCmd = true;
    $funcToRun = $commandOpt["functionToRun"];

    //param validation
    if($commandOpt["argRequired"] && $param == ""){
      die("*** Parameter required ***");
    }

  }

}

//cmd execution
if(!$validCmd) {
  die("*** Invalid cmd ***");
}

$funcToRun($param);

function doSelectPen($param) {
  echo "doSelectPen with param :" . $param . PHP_EOL;
}

function doPenUp() {
  echo "doPenUp" . PHP_EOL;
}

function doPenDown() {
  echo "doPenDown" . PHP_EOL;
}

function doPenDir($param) {
  echo "doPenDir with param: "  . $param . PHP_EOL;
}

