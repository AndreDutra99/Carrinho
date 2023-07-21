<?php
session_start();
session_unset();
session_destroy();
header('Location: /Carrinho/views/login.php');