<?php
$password = "123";

// Hash password menggunakan bcrypt
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Tampilkan hasil hash
echo "Password: " . $password . "<br>";
echo "Hashed Password: " . $hashedPassword;
?>
