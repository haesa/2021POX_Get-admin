<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Blind SQL Injection</title>
    </head>
    <body>
        <div class="wrap">
          <h2 class="tit">Blind SQL Injection</h2>
          <form action="code.php" method="GET">
              <input type="text" name="id" placeholder="ID">
              <input type="text" name="pw" placeholder="PW">
              <input type="submit" value="Login">
          </form>
          <div class="msg">Login to admin account.</div>
        </div>
    </body>
</html>
<script type="text/javascript">
  document.getElementsByName('id')[0].value = "<? echo $_GET['ID']; ?>";
  document.getElementsByName('pw')[0].value = "<? echo $_GET['PW']; ?>";
  document.getElementsByClassName("msg")[0].innerHTML = "<? echo $_GET['msg']; ?>";
</script>
