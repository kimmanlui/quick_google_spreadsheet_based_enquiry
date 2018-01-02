<?php

function IsNullOrEmptyString($question)
{
    return (!isset($question) || trim($question)==='');
}

function showContent($mySubject, $headerRow, $showRow, $content)
{
   echo "<h2 style='color:DodgerBlue;'> $mySubject</h2>"; 
   for ($i = 0; $i < sizeof($showRow); $i++) 
   {
       $showRow[$i]=strtolower(trim($showRow[$i]));
       if ($showRow[$i]=="show")
       {
          echo "$headerRow[$i]: &nbsp; $content[$i] <br>";
       }
   } 
}

function getData($URL)
{
  $data = file_get_contents($URL);
  $retV = explode("\n",$data);
  return ($retV); 
}

function loginHistory($loginID)
{
  date_default_timezone_set('Asia/Hong_Kong');
  
  $file = 'loginHistory.txt';
  $current = $loginID." ".date("Y-m-d")." ".date("h:i:sa")."\r\n";
  file_put_contents($file, $current , FILE_APPEND | LOCK_EX);
}

function getULR($masterURL)
{
  $rows = getData($masterURL);
  $retV = array();
  foreach ($rows as $rowvalue)
  {
    $tmp=explode(",", $rowvalue);
    array_push($retV,$tmp[0]);
  }
  return($retV);
}

?>


