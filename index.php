<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" type="image/png" href="metamask.png" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="webtoolkit.sha256.js"></script>
    <title>AuthentiForton</title>
  </head>

  <body>
    <h1>Bonjour</h1>
    <div class="container">
      <form class="login">
        <input name="login" id="login" type="text" placeholder="Login" />
        <input name="password" id="password" type="password" placeholder="Password" />
        <input name="ott" id="ott" type="text" placeholder="OTT" />
        <input name="submit" id="submit" type="submit" value="Envoyer" onsubmit="submitForm(this);" />
      </form>
    </div>

    <?php
    header("Content-Type: text/html");

    if (isset($_GET['ott'])) {
      $ott = $_GET['ott'];
      $login = hash('sha256', $_GET['login']);
      $password = hash('sha256', $_GET['password']);

      function beliefmedia_ntp_time() {
        $host = 'europe.pool.ntp.org';
        /* Create a socket and connect to NTP server */
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        socket_connect($sock, $host, 123);
        
        /* Send request */
        $msg = "\010" . str_repeat("\0", 47);
        socket_send($sock, $msg, strlen($msg), 0);
        
        /* Receive response and close socket */
        socket_recv($sock, $recv, 48, MSG_WAITALL);
        socket_close($sock);
      
        /* Interpret response */
        $data = unpack('N12', $recv);
        $timestamp = sprintf('%u', $data[9]);
        
        /* NTP is number of seconds since 0000 UT on 1 January 1900
          Unix time is seconds since 0000 UT on 1 January 1970 */
        $timestamp -= 2208988800;
        
        return substr(hash('sha256', date('dmYHi', $timestamp)), 0, 6);
      }
  
      if (!is_null($ott)){
        if ($ott == beliefmedia_ntp_time()){
          echo "OTT Correct";
        } else {
          echo $ott;
          echo beliefmedia_ntp_time();
          echo "OTT Incorrect";
        }
      }
    }

    ?>

    <div id="result"></div>

    <script type="text/javascript">
      function submitForm(oFormElement) {
        var login = document.getElementById("login").value
        var password = document.getElementById("password").value
        var ott = document.getElementById("ott").value;


        var xhr = new XMLHttpRequest()
        xhr.open ("GET", "index.php", false)
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        xhr.send("login="+SHA256(log)+"&password="+SHA256(passwd)+"&ott="+ott)
       
        xhr.onreadystatechange = function() {
          if (readyState === 4) {
            document.getElementById("result").innerHTML = xhr.response
          }
        }
      }
    </script>
  </body>


</html>
