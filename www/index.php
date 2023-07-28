<?php
session_start();
header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Cache-Control: post-check=0, pre-check=0", false);
include ( 'inc/functions.php' ) ;
include ( 'inc/data.php' ) ;

$db =  new SQLite3('../db/studidata.db' );
$hit = false;


if( isset( $_POST[ 'logout' ] ) )
{
  session_unset();
  unset($_SESSION[ 'id' ]);
}

if( isset( $_POST[ 'datasave' ] ) )
{
  $user_email      = trim( $_POST[ 'user_email'    ] );
  $user_wkennung   = trim( $_POST[ 'user_wkennung' ] );
  $error = 0;

  if(!$error)
  {
  $stmt = $db -> prepare( 'INSERT INTO users ( email, wkennung, time, sessionid ) VALUES( ?, ?, datetime( "now" ), ? )' );
  $stmt -> bindValue( 1 , $user_email    , SQLITE3_TEXT );
  $stmt -> bindValue( 2 , $user_wkennung , SQLITE3_TEXT );
  $stmt -> bindValue( 3 , $_SESSION["id"] , SQLITE3_TEXT );
  $res = $stmt -> execute();
  $res -> finalize();
  
  $stmt = $db -> prepare( 'SELECT email, wkennung FROM users WHERE wkennung = ?' );
  $stmt -> bindValue( 1 , $user_wkennung , SQLITE3_TEXT );
  $res = $stmt -> execute();
  $res -> finalize();
  while ( ($row = $res -> fetchArray(SQLITE3_ASSOC ) ) )
  { $hit = true;  $r = $row;
  }
  
  if( $hit );
  {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>STUDIDATA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link  href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/jquery-1.11.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <style type="text/css">
    body{ background-color: lightgrey; }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="jumbotron" style="margin-top:30%">
                <h2 style="text-align:center">Gespeichert wurde:</h2>
                <form action="index.php" method="POST">
                    <div class="form-group" style="text-align: center;">
                         <?php { echo $user_email; } ?>
                    </div>
                    <div class="form-group" style="text-align: center;">
                      <?php { echo $user_wkennung; } ?>
                    </div>
                    <input type="submit" name="datanew" value="Neuer Versuch" class="btn btn-primary" style="float: left;">
                    <input type="submit" name="logout" value="Beenden" class="btn btn-primary" style="float: right;">
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
 <?php
  }
  }
  $stmt -> close();
}


else if( isset( $_POST[ 'datacheck' ] ) )
{
$user_email      = $_POST[ 'user_email'    ];
$user_wkennung   = $_POST[ 'user_wkennung' ];
  
$okwk = preg_match('/[W|w]\w{5}/',$user_wkennung);
$okem = filter_var($user_email,FILTER_VALIDATE_EMAIL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>STUDIDATA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link  href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/jquery-1.11.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <style>
      body{ background-color: lightgrey; }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="jumbotron" style="margin-top:30%">
                <h2 style="text-align:center">Sind diese Angaben korrekt?</h2>
                <h3 style="text-align:center">(eventuell korrigieren)</h3><br>
                <form action="index.php" method="POST">
                    <div class="form-group">
                        <label>email-Adresse: <?php if (!$okem) {echo "<span style='color: #bd2130;'>nicht korrekt!</span>"; } ?></label>
                        <input type="email" name="user_email" class="form-control"  value="<?php if(isset($user_email)) { echo $user_email; } ?>" required>
                    </div>
                    <div class="form-group">
                        <label>W-Kennung: <?php if (!$okwk) {echo "<span style='color: #bd2130;'>nicht korrekt!</span>"; } ?></label>
                        <input type="text" name="user_wkennung" class="form-control" value="<?php if(isset($user_wkennung)) { echo $user_wkennung; } ?>" required>
                    </div>
                    <input type="submit" name="datasave" value="Ja, Daten sind korrekt" class="btn btn-primary" style="float: right;">
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
  <?php
  }
else
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>STUDIDATA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/jquery-1.11.0.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <style type="text/css">
    body{ background-color: lightblue; }
  </style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="jumbotron" style="margin-top:30%">
       <h2 style="text-align:center">Bitte geben Sie ein:<br> <br>Ihre <br><bold>HAW-email-Adresse</bold><br>und ihre <br>W-Kennung</h2>
        <h2 style="text-align:center"><br>KEIN PASSWORT!</h2>
          <br>
        <form action="index.php" method="POST">
          <div class="form-group">
            <label>email-Adresse:</label>
            <input type="email" name="user_email" class="form-control"  value="<?php if(isset($_COOKIE["user_email"])) { echo $_COOKIE["user_email"]; } ?>" required>
          </div>
          <div class="form-group">
            <label>W-Kennung:</label>
            <input type="text" name="user_wkennung" class="form-control" value="<?php if(isset($_COOKIE["user_wkennung"])) { echo $_COOKIE["user_wkennung"]; } ?>" required>
          </div>
          <input type="submit" name="datacheck" value="Test" class="btn btn-primary" style="float: right;">
        </form>
      </div>
    </div>
    <div class="col-md-4"></div>
  </div>
 <?php
 #$_SESSION['id'] = session_id();
 if (! isset($_SESSION[ 'id' ] )) {  $_SESSION[ 'id' ] = mt_rand( 1000000000, 2000000000 ); }
}
?>