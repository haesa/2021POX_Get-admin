<!DOCTYPE html>
<html>
  <head></head>
  <body>
    <?
        include './dbconn.php';

        if(preg_match('/\'/i', $_GET['id'])) exit("~~filtering~~");
        if(preg_match('/and|or|substr|ascii/i', $_GET['pw'])) exit("~~filtering~~");
        $id = str_replace("admin","",$_GET['id']);
        $pw = $_GET['pw'];

        $query = "select id from user where id='{$id}';";
        $result = mysqli_fetch_array(mysqli_query($conn, $query));

        if(isset($result['id'])) {
          $query = "select pw from user where id='{$id}' and pw='{$pw}';";
          $result = mysqli_fetch_array(mysqli_query($conn, $query));

          if(isset($result['pw'])) {
            if($pw == $result['pw']) {
              $msg = "Hello {$id} :)<br>";
              if($id=='admin')  $msg = $msg."Problem solved!";
            } else {
              $msg = "You got the results!";
            }
          } else {
            $msg = "You didn't get the results...";
          }
        } else {
          $msg = "ID does not exist...";
        }
     ?>
     <form id="val" action="index.php" method="get">
       <input type="hidden" name="ID" value="<? echo $id; ?>">
       <input type="hidden" name="PW" value="<? echo $pw; ?>">
       <input type="hidden" name="msg" value="<? echo $msg; ?>">
     </form>
     <script>
       document.getElementById('val').submit();
     </script>
     <meta http-equiv='refresh' content='0; url=./index.php'>
  </body>
</html>
