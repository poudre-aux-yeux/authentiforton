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



  
<script>
  function showCD(str) {
    if (str=="") {
      document.getElementById("txtHint").innerHTML="";
      return;
    } 
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("txtHint").innerHTML=this.responseText;
      }
    }
    xmlhttp.open("GET","getcd.php?q="+str,true);
    xmlhttp.send();
  }
  </script>
  </head>
  <body>
  
  <form>
  Select a CD:
  <select name="cds" onchange="showCD(this.value)">
  <option value="">Select a CD:</option>
  <option value="Bob Dylan">Bob Dylan</option>
  <option value="Bee Gees">Bee Gees</option>
  <option value="Cat Stevens">Cat Stevens</option>
  </select>
  </form>
  <div id="txtHint"><b>CD info will be listed here...</b></div>
</html>