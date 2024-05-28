<?php

session_start();

session_destroy();

// encaminha a tela
header('Location: index.php');

?>