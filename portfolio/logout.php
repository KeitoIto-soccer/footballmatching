<?php
session_start();
//unsetは$session['username']を外すことを表す。
unset($_SESSION['team_name']);
// var_dump($_SESSION['username']);
header('Location:http://localhost/portfolio');

?>