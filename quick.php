<html>
<head>
<style>
body { font-family: "Arial";}
</style>
</head>
<body>

<?php

$mylogin=$_POST["loginID"]; 
$mypassword=$_POST["password"]; 

#print($mylogin);
#print($mypassword);

include 'quick_lib.php';

$ini_array = parse_ini_file("setup.txt");
$masterUrl=$ini_array["masterUrl"];

#$masterUrl="https://docs.google.com/spreadsheets/d/e/2PACX-1vQo2_1N7wOb-tUOynxDFky5ZA8HUBMlGIGmCt7C5snWY91-6SSLBl5HlWxPzRKFRP2ywPDSDXgG8nXW/pub?gid=0&single=true&output=csv";

$URLS=getULR($masterUrl);


#$URLS=array(
#"https://docs.google.com/spreadsheets/d/e/2PACX-1vSBFt6_imCy0oX3YSkKZJVbZfMZjZdMGsZSKknJcSD0g0yZxwn6lLfQK9imJRZJ6MCOZVaZ-KU9Ke-f/pub?gid=484051783&single=true&output=csv",
#"https://docs.google.com/spreadsheets/d/e/2PACX-1vSBFt6_imCy0oX3YSkKZJVbZfMZjZdMGsZSKknJcSD0g0yZxwn6lLfQK9imJRZJ6MCOZVaZ-KU9Ke-f/pub?gid=1042086915&single=true&output=csv"
#);

$loginStatus= 0;

foreach($URLS as $URL)
{
  $rows = getData($URL);
  $headerRow  = explode(",", $rows[0]);
  $showRow    = explode(",", $rows[1]);
  $atLeastOne = 0;

  foreach($rows as $rowvalue) 
  {
    $row=explode(",", $rowvalue); 
    if (!IsNullOrEmptyString($row[1])) 
    { 
      if ($row[0]==$mylogin AND $row[1]==$mypassword)
      {
        $loginStatus=1;
        $content=$row; 
      }
    }
  }
 
  if ( $loginStatus==1) 
  {
    $atLeastOne=$atLeastOne+1;
    $mySubject=$headerRow[0];
    showContent($mySubject, $headerRow, $showRow, $content); 
  }
}


if ($atLeastOne==0)
{
  echo "<h1>Login Failed</h1>";
} else
{
  loginHistory($mylogin); 
}

?>




</body>
</html>
