<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="../css/fancybox.min.css">


<script language="javascript" src="../js/jquery.min.js"></script>
<script language="javascript" src="../js/bootstrap.min.js"></script>

<script language="javascript" src="../js/jquery.1.9.0.min.js"></script>

<script language="javaScript" src="../js/jquery-migrate-1.2.1.min.js"></script>
<script language="javaScript" src="../js/jquery.fancybox.min.js"></script>

<script language="javaScript" src="../js/jquery.nicescroll.min.js"></script>
 



<!-- Place inside the <head> of your HTML -->
	<script type="text/javascript" src="../js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	
   tinymce.init({
    selector: "textarea",theme: "modern",language: "pt_BR",	height: 350,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   image_advtab: true ,
   
   external_filemanager_path:"http://localhost/sites/minasbike/js/tinymce/plugins/filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" : "http://localhost/sites/minasbike/js/tinymce/plugins/filemanager/plugin.min.js"}
 });
 </script>
 
 <script>
	function responsive_filemanager_callback(field_id){
		console.log(field_id);
		var url=jQuery('#'+field_id).val();
		alert('update '+field_id+" with "+url);
		//your code
	}

	$(document).ready(
	  function() {  
		$("html").niceScroll({cursorcolor:"#282828"});
	  }
	);
</script>
 
<script> 
 
(function($) {
  $(function() {
    // O seu código com dolar aqui      
  
      $('.iframe-btn').fancybox({
			  'width'	: 880,
			  'height'	: 570,
			  'type'	: 'iframe',
			  'autoScale'   : false
      });
      
 
			//
			// Handles message from ResponsiveFilemanager
			//
			function OnMessage(e){
			  var event = e.originalEvent;
			   // Make sure the sender of the event is trusted
			   if(event.data.sender === 'responsivefilemanager'){
			      if(event.data.field_id){
			      	var fieldID=event.data.field_id;
			      	var url=event.data.url;
							$('#'+fieldID).val(url).trigger('change');
							$.fancybox.close();

							// Delete handler of the message from ResponsiveFilemanager
							$(window).off('message', OnMessage);
			      }
			   }
			}

		  // Handler for a message from ResponsiveFilemanager
			$('.iframe-btn').on('click',function(){
			  $(window).on('message', OnMessage);
			});


      
      $('#download-button').on('click', function() {
	    ga('send', 'event', 'button', 'click', 'download-buttons');      
      });
      $('.toggle').click(function(){
	    var _this=$(this);
	    $('#'+_this.data('ref')).toggle(200);
	    var i=_this.find('i');
	    if (i.hasClass('icon-plus')) {
		  i.removeClass('icon-plus');
		  i.addClass('icon-minus');
	    }else{
		  i.removeClass('icon-minus');
		  i.addClass('icon-plus');
	    }
      });
});
})(jQuery);
function open_popup(url)
{
        var w = 880;
        var h = 570;
        var l = Math.floor((screen.width-w)/2);
        var t = Math.floor((screen.height-h)/2);
        var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
}
    </script>
 

    
    
    
    
    
    
    
    
    
    <input class="form-control" type="text" name="arquivo" id="arquivo" value="" style="width:80%; display:inline;" />
              <a href="../js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=arquivo" class="btn iframe-btn" type="button" style="display:inline;"><button type="button" class="btn btn-primary btn_direita" style="margin-top:0;"><span class="glyphicon glyphicon-picture"></span> Selecionar</button></a>