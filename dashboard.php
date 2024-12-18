<?php
	session_start();
		
	if(!$_SESSION["user"]){
    header("location: index.html");
  }
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amat</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- isi sesuai yang anda inginkan. yang akan tanpil setelah user berhasil login -->
   Hello World 
</body>

</html>