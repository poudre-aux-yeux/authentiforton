<?php
function beliefmedia_ntp_time($host) {
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
    
    return $timestamp;
}

function generate_ott($ts) {
    return substr(hash('sha256', date('dmYHi', $ts)), 0, 6);
}

$h = 'europe.pool.ntp.org';
$h1 = "0.au.pool.ntp.org";

echo generate_ott(beliefmedia_ntp_time($h));
?>
