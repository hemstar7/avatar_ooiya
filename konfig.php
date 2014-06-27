<?php
session_start();
$konek = mysql_connect('localhost', 'root','1234');
mysql_select_db('avatar_ooiya', $konek);
if($profile != 1)
    echo '<!-- coded by hemstar7 ide gambar dari KolbyArt -->';
