$(function()
{ $('#drag-and-drop-zone').dmUploader(
      dndini
  );
});

 var dndini =
{ url: 'backend/upload.php',
 extFilter: [ 'jpg', 'pdf', 'png', 'gif' ],
 maxFileSize: 3000000, 
 onDragEnter: function(){ this.addClass('active');    },    
 onDragLeave: function(){ this.removeClass('active'); },   
 onInit:      function(){     ui_add_log('Penguin initialized :)', 'info'); 
                       },                            
 onComplete : function(){    
                       },    
 onNewFile:   function(id, file){ ui_add_log('New file added #' + id);
                                  ui_multi_add_file(id, file); 
 			                   }, 
  onBeforeUpload: function(id)
 { ui_add_log('Starting the upload of #' + id);
   ui_multi_update_file_status(id, 'uploading', 'Uploading...');
   ui_multi_update_file_progress(id, 0, '', true);
  },  
  onUploadCanceled: function(id) 
 {  ui_multi_update_file_progress(id, 0, 'warning', false);   
  }, 
  onUploadProgress: function(id, percent){ ui_multi_update_file_progress(id, percent); },
  onUploadSuccess: function(id, data)
  { ui_add_log('Server Response for file #' + id + ': ' + JSON.stringify(data));
     ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
    ui_multi_update_file_status(id, 'success', 'Upload Complete');
    ui_multi_update_file_progress(id, 100, 'success', false);
  }, 
  onUploadError: function(id, xhr, status, message)
  { ui_multi_update_file_status(id, 'danger', message);
    ui_multi_update_file_progress(id, 0, 'danger', false);  
  },
  onFallbackMode: function(){ ui_add_log('Plugin cant be used here, running Fallback callback', 'danger'); },
  onFileSizeError: function(file){ /* ui_add_log('File '' + file.name + '' cannot be added: size excess limit', 'danger');*/ } 
}; 


function checkSSactive(id)
 {   const today = getToday();
     const dateE = $( "#ssedate"+ id  ).val();
     const dateS = $( "#sssdate"+ id  ).val();
     const bg1   = "#FFFFFF";
     const bg0   = "#BEBEBE";

     dSactive = true;
     dEactive = true;
     sSactive = true;

     if( dateS <=  today ) { bgS = bg1; } else { bgS = bg0; dSactive = false; }
     if( dateE >=  today ) { bgE = bg1; } else { bgE = bg0; dEactive = false; }
     $( "#ssedate"+ id ).css("background-color", bgE ) ;
     $( "#sssdate"+ id ).css("background-color", bgS ) ;

     if (! $( "#ssactive" + id ).is( ":checked" ) ) { sSactive = false; }

     if( (dSactive == false) || (dEactive == false) || (sSactive == false) )
     {$( "#sslineX" + id ).css( "background-color", bg0 );}
     else
     {$( "#sslineX" + id ).css( "background-color", bg1 );}
 }


function checkNTactive(id)
{   const today = getToday();
    const dateE = $( "#ntedate"+ id  ).val();
    const dateS = $( "#ntsdate"+ id  ).val();
    const bg1   = "#FFFFFF";
    const bg0   = "#BEBEBE";
    dSactive = true;
    dEactive = true;
    sSactive = true;

    if( dateS <=  today ) { bgS = bg1; } else { bgS = bg0; dSactive = false; }
    if( dateE >=  today ) { bgE = bg1; } else { bgE = bg0; dEactive = false; }
    $( "#ntedate"+ id ).css("background-color", bgE ) ;
    $( "#ntsdate"+ id ).css("background-color", bgS ) ;

    if (! $( "#ntactive" + id ).is( ":checked" ) ) { sSactive = false; }

    if( (dSactive == false) || (dEactive == false) || (sSactive == false) )
    {$( "#ntline" + id ).css( "background-color", bg0 ); }
    else
    {$( "#ntline" + id ).css( "background-color", bg1 ); }
}

function setNTBG(color, save= 1)
{
   $( "#bgBlueB"    ).css("border", "solid 5px white" )
   $( "#bgRedB"     ).css("border", "solid 5px white" )
   $( "#bgGreenB"   ).css("border", "solid 5px white" )
   $( "#bgMagentaB" ).css("border", "solid 5px white" )

  if(color == "blue")
  {
     if (save)$( "#result" ).load( "inc/ajax.php", {"update[]": ["NTBGCO", "blue"]} );
     $( "#bgBlueB" ).css("border", "solid 5px black" )
  }

  if(color == "red")
  { if (save) $( "#result" ).load( "inc/ajax.php", {"update[]": ["NTBGCO", "red"]} );
    $( "#bgRedB" ).css("border", "solid 5px black" )
  }
  if(color == "green")
  { if (save) $( "#result" ).load( "inc/ajax.php", {"update[]": ["NTBGCO", "green"]} );
    $( "#bgGreenB" ).css("border", "solid 5px black" )
  }
  if(color == "magenta")
  { if (save) $( "#result" ).load( "inc/ajax.php", {"update[]": ["NTBGCO", "magenta"]} );
    $( "#bgMagentaB" ).css("border", "solid 5px black" )
  }
}

function getToday()
{   var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    return today;
}
