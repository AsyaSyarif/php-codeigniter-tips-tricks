<?php
$firstname = isset($_GET['firstname']) ? $_GET['firstname'] : '';
if ($firstname == 'Jeff') {
  header("Content-Type: application/json");
  $data = array('fullname' => 'Jeff Hansen', 'message' => '\a aaâ " ^><*&@');
  //echo $_GET['callback'] . '(' . "{'fullname' : 'Jeff Hansen'}" . ')';
  echo $_GET['callback'] . '(' . json_encode($data) . ')';
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>jsonp example</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
      $.getJSON('./jsonp.php?callback=?', 'firstname=Jeff', function(res) {
        alert('Your name is ' + res.fullname);
        alert('Bullshit data is: ' + res.message);
      });
    </script>
  </head>
  <body>
  </body>
</html>
