<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$db =  new SQLite3('../../gsd.db/login.db' );

if( isset( $_POST[ 'login' ] ) )
{ $username      = $_POST[ 'user_email' ];
  $user_password = md5($_POST[ 'user_password' ]) ;

  if( isset($_POST[ "remember" ]) AND ( $_POST[ "remember" ] == '1' || $_POST[ "remember" ] == 'on' ))
  { $hour = time() + 3600 * 24 * 30;
    setcookie( 'user_email'    , $username      , $hour );
    setcookie( 'user_password' , $user_password , $hour );
  }
  else
  {  if( isset( $_COOKIE[ "user_email"    ] ) ) { setcookie ( "user_email"    ,"" ); }
     if( isset( $_COOKIE[ "user_password" ] ) ) { setcookie ( "user_password" ,"" ); }
  }

  $stmt = $db->prepare( 'SELECT user_email, user_password FROM users WHERE user_email = ? AND user_password = ?' );
  $stmt->bindValue( 1 , $username      , SQLITE3_TEXT );
  $stmt->bindValue( 2 , $user_password , SQLITE3_TEXT );
  $res = $stmt->execute();

  $hit = false;
  while (($row = $res->fetchArray(SQLITE3_ASSOC))) 
  {
    $hit = true;
  }
  if( $hit )
  { $_SESSION['user_email'] = $username;
    header("location:../editor.php");
  }
  else
  { $_SESSION['invalid_details']="INVALID USERNAME/PASSWORD Combination!";
    header('location:index.php');
  }
  $stmt->close();
}

?>

