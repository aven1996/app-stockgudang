<?php

session_start();
session_destroy();
session_unset('akun');
header("Location: ../login.php");