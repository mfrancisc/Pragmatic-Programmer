<?php

$doSelectPen = array(
  "command" => "P", 
  "argRequired" => true, 
  "functionToRun"=>"doSelectPen"
);
$doPenUp = array(
  "command" => "U", 
  "argRequired" => false, 
  "functionToRun"=>"doPenUp");

$doPenDown = array(
  "command" => "D", 
  "argrequired" => false, 
  "functiontorun"=>"dopendown"
);
$doPenDirN = array (
  "command" => "n", 
  "argrequired" => true, 
  "functiontorun"=>"dopendir",
);
$doPenDirS = array(
  "command" => "s", 
  "argrequired" => true,
  "functiontorun"=>"dopendir"
);
$doPenDirE = array(
  "command" => "e", 
  "argrequired" => true,
  "functiontorun"=>"dopendir"
);

$commands = [$doSlectPen, $doPenUp, $doPenDown, $doPenDirN, $doPenDirS, $doPenDirE];
// param validation
if(!isset($argv[1])){
  die("*** cmd required ***");
}
if(!isset($argv[2])){
  $argv[2] = "";
}

$cmd = $argv[1];
$param = $argv[2];

echo "cmd: " . $cmd . PHP_EOL;
echo "parameter: " . $param . PHP_EOL;

$validcmd = false;
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

