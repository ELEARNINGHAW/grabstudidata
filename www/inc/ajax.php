<?php
$db = new SQLite3('../../db/hallmonitor.db' );
$post = $_POST;

if( isset( $post['delete'] ) )
{ if( ( $post['delete'][0] == 'SSDELE' ) )  ## Slideshow BG PIC Header
  { $ssid  = $post[ 'delete' ][ 1 ];
    $sstxt = $post[ 'delete' ][ 2 ];
  
    $stmt = $db->prepare( 'DELETE FROM slidescreen WHERE id = ?' );
    $stmt->bindValue( 1 , $ssid , SQLITE3_INTEGER );
    $res = $stmt->execute();
  }
}

if( isset( $post['update'] ) )
{
  if( ( $post['update'][0] == 'SSPICH' ) )  ## Slideshow BG PIC Header
  { $ssid  = $post[ 'update' ][ 1 ];
    $imgNr = $post[ 'update' ][ 2 ];
  
    $stmt = $db->prepare( 'UPDATE slidescreen SET img = ?  WHERE id = ?' );
    $stmt->bindValue( 1 , $imgNr , SQLITE3_TEXT );
    $stmt->bindValue( 2 , $ssid ,  SQLITE3_INTEGER );
    $res = $stmt->execute();
   }
  
  if( ( $post['update'][0] == 'SSCONT' ) )  ## Slideshow Content
  { $ssid  = $post[ 'update' ][ 1 ];
    $imgNr = $post[ 'update' ][ 2 ];
  
    $stmt = $db->prepare( 'UPDATE slidescreen SET content = ?  WHERE id = ?' );
    $stmt->bindValue( 1 , $imgNr , SQLITE3_TEXT );
    $stmt->bindValue( 2 , $ssid ,  SQLITE3_INTEGER );
    $res = $stmt->execute();
  }
  
  if( ( $post['update'][0] == 'SSHEAD' ) )  ## Slideshow HEADER
  { $ssid  = $post[ 'update' ][ 1 ];
    $imgNr = $post[ 'update' ][ 2 ];
  
    $stmt = $db->prepare( 'UPDATE slidescreen SET header = ?  WHERE id = ?' );
    $stmt->bindValue( 1 , $imgNr , SQLITE3_TEXT );
    $stmt->bindValue( 2 , $ssid ,  SQLITE3_INTEGER );
    $res = $stmt->execute();
   }
  
  if( ( $post['update'][0] == 'SSACTIV' ) )  ## Slideshow BG PIC Header
  { $ssid  = $post[ 'update' ][ 1 ];
    $imgNr = $post[ 'update' ][ 2 ];
  
    $stmt = $db->prepare( 'UPDATE slidescreen SET active = ?  WHERE id = ?' );
    $stmt->bindValue( 1 , $imgNr , SQLITE3_TEXT );
    $stmt->bindValue( 2 , $ssid ,  SQLITE3_INTEGER );
    $res = $stmt->execute();
  }
  
  if( ( $post['update'][0] == 'SSEDATE' ) )  ## Slideshow BG PIC Header
  { $ssid  = $post[ 'update' ][ 1 ];
    $imgNr = $post[ 'update' ][ 2 ];
  
    $stmt = $db->prepare( 'UPDATE slidescreen SET best_before = ?  WHERE id = ?' );
    $stmt->bindValue( 1 , $imgNr , SQLITE3_TEXT );
    $stmt->bindValue( 2 , $ssid ,  SQLITE3_INTEGER );
    $res = $stmt->execute();
  }
  
  if( ( $post['update'][0] == 'SSSDATE' ) )  ## Slideshow BG PIC Header
  { $ssid  = $post[ 'update' ][ 1 ];
    $imgNr = $post[ 'update' ][ 2 ];
    
    $stmt = $db->prepare( 'UPDATE slidescreen SET start_on = ?  WHERE id = ?' );
    $stmt->bindValue( 1 , $imgNr , SQLITE3_TEXT );
    $stmt->bindValue( 2 , $ssid ,  SQLITE3_INTEGER );
    $res = $stmt->execute();
  }
  
  if( ( $post[ 'update' ][ 0 ] == 'NTACTIV' ) )  ## Slideshow BG PIC Header
  { $ntid  = $post[ 'update' ][ 1 ];
    $imgNr = $post[ 'update' ][ 2 ];
    #print_r($post);
    $stmt = $db->prepare( 'UPDATE newsticker SET active = ?  WHERE id = ?' );
    $stmt->bindValue( 1 , "$imgNr" , SQLITE3_TEXT );
    $stmt->bindValue( 2 , $ntid ,  SQLITE3_INTEGER );
    $res = $stmt->execute();
  }
  
  if( ( $post[ 'update' ][ 0 ] == 'NTTEXT' ) )  ## Slideshow BG PIC Header
  { $ntid  = $post[ 'update' ][ 1 ];
    $imgNr = $post[ 'update' ][ 2 ];
    
    $stmt = $db->prepare( 'UPDATE newsticker SET text = ?  WHERE id = ?' );
    $stmt->bindValue( 1 , $imgNr , SQLITE3_TEXT );
    $stmt->bindValue( 2 , $ntid ,  SQLITE3_INTEGER );
    $res = $stmt->execute();
  }
  
  if( ( $post[ 'update' ][ 0 ] == 'NTEDATE' ) )  ## Slideshow BG PIC Header
  { $ntid  = $post[ 'update' ][ 1 ];
    $imgNr = $post[ 'update' ][ 2 ];
    
    $stmt = $db->prepare( 'UPDATE newsticker SET best_before = ?  WHERE id = ?' );
    $stmt->bindValue( 1 , $imgNr , SQLITE3_TEXT );
    $stmt->bindValue( 2 , $ntid ,  SQLITE3_INTEGER );
    $res = $stmt->execute();
  }
  
  if( ( $post['update'][0] == 'NTSDATE' ) )  ## Slideshow BG PIC Header
  { $ntid  = $post[ 'update' ][ 1 ];
    $imgNr = $post[ 'update' ][ 2 ];
    
    $stmt = $db->prepare( 'UPDATE newsticker SET start_on = ?  WHERE id = ?' );
    $stmt->bindValue( 1 , $imgNr , SQLITE3_TEXT );
    $stmt->bindValue( 2 , $ntid ,  SQLITE3_INTEGER );
    $res = $stmt->execute();
  }
  
  if( ( $post['update'][0] == 'NTBGCO' ) )  ## Slideshow BG PIC Header
  { $ntid  = $post[ 'update' ][ 1 ];
    
    $stmt = $db->prepare( 'UPDATE html SET value = ?  WHERE name = "ntbg"' );
    $stmt->bindValue( 1 , $ntid , SQLITE3_TEXT );
    $res = $stmt->execute();
  }
}


if( isset( $post['load'] ) )
{ if (($post['load'][0] == 'SSCONT'))  ## Slideshow BG PIC Header
  { $ssid = $post['load'][1];
  
    $stmt = $db->prepare( 'SELECT content from slidescreen WHERE id = ?' );
    $stmt->bindValue( 1 , $ssid , SQLITE3_INTEGER );
    $res = $stmt->execute();
  
    while ( $row = $res -> fetchArray( ) )
    { echo "<p>". $row[ 'content' ]."</p>" ;
    }
  }
}
  
  
  ?>