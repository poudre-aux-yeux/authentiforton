<?php

header("Content-Type: text/html");

$val = $_POST['val'];
$log1 = $_POST['log'];
$pwd1 = $_POST['pass'];
$log = hash('sha256', $_POST['log']);
$pwd = hash('sha256', $_POST['pass']);

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

if (!is_null($val)){
	if ($val == beliefmedia_ntp_time()){
		echo "CODE BON";
	} else {
		echo $val;
		echo beliefmedia_ntp_time();
		echo "CODE FAUX";
	}
}

?>


<form method="POST" action="verif.php">
	<input type="text" name="val">
	<input type="submit" name="">
</form>