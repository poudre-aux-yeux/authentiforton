<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" type="image/png" href="metamask.png" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>AuthentiForton</title>
  </head>

  <body>
    <h1>Bonjour</h1>
    <div class="container">
      <form class="login" method="GET" action="post-handler.php" onsubmit="submitForm(this);">
        <input name="login" id="login" type="text" placeholder="Login" />
        <input name="password" id="password" type="password" placeholder="Password" />
        <input name="submit" id="submit" type="submit" value="Envoyer" />
      </form>
    </div>
    <div>
      <p>Login : </p>
      <p>Password : </p>
    </div>

    <script src="webtoolkit.sha256.js"></script>
    <script>
      function submitForm(oFormElement) {
        var xhr = new XMLHttpRequest();
        xhr.onload = function(){ alert (xhr.responseText); }
        xhr.open (oFormElement.method, oFormElement.action, true);
        xhr.send (new FormData (oFormElement));
        console.log(xhr);
        console.log(SHA256("motdepasse"));
        return false;
      }
    </script>
  </body>


</html>