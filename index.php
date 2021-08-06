<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Blind SQL Injection</title>
    </head>
    <body>
        <div class="wrap">
          <h2 class="tit">Blind SQL Injection</h2>
          <form action="index.php" method="GET">
              <input type="text" name="id" placeholder="ID">
              <input type="text" name="pw" placeholder="PW">
              <input type="submit" value="Login">
          </form>
          <div class="msg">Login to admin account.</div>
        </div>
<?
if(isset($_GET['id']) || isset($_GET['pw'])){
    include './dbconn.php';

    if(preg_match('/\'/i', $_GET['id'])) exit("~~filtering~~");
    if(preg_match('/and|or|substr|ascii|=/i', $_GET['pw'])) exit("~~filtering~~");
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
    <script type="text/javascript">
      document.getElementsByClassName("msg")[0].innerHTML = "<? echo $msg; ?>"
    </script>
<?
}
?>
    </body>
</html>
