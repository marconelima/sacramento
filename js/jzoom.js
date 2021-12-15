// JavaScript Document
/**
 																		jZoom
 																	Author: Don Vawter
 																Email: donvawter@mac.com
 								
 			jZoom is a plugin allowing you to mouse over a lores image, zooming in to a portion of a hires version of the image. 
 			It is dependent on having both the low and high res versions available. There is no server-side component and hence
 			no resampling of the image is done. The plugin may be attached to multiple images and the "zoom" window may be the same or different for each window.
 			
 			 Options:
 			 Name				Default Value					Purpose
 			 src				"" 								The src of the hires image
 			 id					""								The id of the img tag of the hires image
 			 width				400								The width of the viewport
 			 height				300								The height of the viewport
 			 wrapperClass		""								The class of a generated div which will surround the hires image. Necessary if you want a border around
 			 													the hires image.
 			 hideOnExit			true							If true the hires image will be hidden when you mouse out of the lores image
 			
 			 Methods:
 			 init			Initializes the plugin, sets options and binds mouse events
 			 remove			Removes the wrappers around the hires image, unbinds the mouse events, displays the entire hires image
 			 
 			 Usage
 			 	$(selector).jzoom(method,options)
 			 	where selector is the id of the lores image, options is an object contianing the options.
 			 	
 			 	Example 1:
 			 	
 			 	$("#second").jzoom("init",{src:"coinhires.jpg",id:"view2",width:600,height:400,wrapperClass:"wrapperstyle",hideOnExit:false});
 			 		The lores image has an id of "second", coinhires.jpg is the src of the hires image which has an id of "view2", a 600x400 portion of the hires
 			 		image will be displayed. This portion will have the style "wrapperstyle" applied to the surrounding div and the image will not be hidden when
 			 		you mouse out of the lores image
 			 	Example 2:
 			 	
 			 	$("#second").jzoom("remove")
 			 		The entire hires image will display and mousing over the lores image will no longer have any effect. If you want to enable zooming again you would
 			 		have to initialize the plugin again.
 			 		
 			Version
 				v1.0	01/19/2012
 				
 			Notes:
 				IF you wrap the hires image in a container with absolute positioning this will prevent the page from reflowing when the hires image is toggled
 				between hidden and shown.
 				
 				It is useless to apply a border to the hire image because it will only appear if you remove the zoom capability.
 				
 				If you set hideOnExit false and then click on the lores image you will "freeze" the hires image and further mouse movents will be of no effect
 				
 				
 */
(function($){
	$.fn.extend({
  		jzoom:function(method,_options){
  			var options={};
			var config={
				src:"",
				id:"",
				width:400,
				height:300,
				wrapperClass:"",
				hideOnExit:true
				}
			var me = $(this);
			var wrapdiv=null;
			var posdiv=null;
			var setPosition=function(x,y){
					$("#"+options.id).parent().css("left",-1*x).css("top",-1*y);
				}
			var unwrap=function(){
				//removes the wrappers around the hires image and displays the entire image
				options=me.data("theOptions");
				if($("#"+options.id).parent().parent().hasClass("_zoomclip")){
					$("#"+options.id).parent().parent().replaceWith($("#"+options.id));
				}
				me.unbind();
				$("#"+options.id).show();
			}
			var init =function(_options){
				options=$.extend(options,_options);
				var el = $("#"+options.id);
				//checks for the existence of wrapping divs and if not present creates them
				var needWrap =!el.parent().hasClass("_zoompos")||!el.parent().parent().hasClass("_zoomclip");
				if (needWrap) {
					wrapdiv = $(document.createElement('div'));
					wrapdiv.css('overflow', 'hidden').addClass('_zoomclip');
					wrapdiv.css('width',options.width+"px").css("height",options.height+"px");
					posdiv = $(document.createElement('div'));
					posdiv.css('position', 'relative').addClass('_zoompos');
					el.wrap(wrapdiv).wrap(posdiv);
				}else{
					wrapdiv=el.parent();
					posdiv=wrapdiv.parent();
				}
				//bind mouse events now
				me.bind("mouseenter",function(){
					// sets the width and height of viewport, styles it if appropriate, and makes sure we have the correct src
					$("#"+options.id).parent().parent().width(options.width).height(options.height).css('position', 'relative').addClass(options.wrapperClass);
					var target=$("#" + options.id);
					if (target.attr("src") != options.src) {
						target.attr("src", options.src)
					}
					target.show();
					
				});
				me.bind("mouseleave",function(){
					//hide things if required
					if(options.hideOnExit){
						$("#"+options.id).parent().parent().removeClass(options.wrapperClass);
						$("#"+options.id).hide();
					}
					
				});
				me.bind("mousemove",function(event){
					var window = $( window );
					var viewOffset=me.offset();
					var windowScrollTop = window.scrollTop();
					var windowScrollLeft = window.scrollLeft();
 					var w=me.width();
					var h=me.height();
					var target=$("#" +options.id);
					var hw=target.width();
					var hh=target.height();
					var vw=options.width;
					var vh=options.height;
					var ol=event.clientX - viewOffset.left + windowScrollLeft;
					var ot=event.clientY - viewOffset.top + windowScrollTop;
					//Determines the point in the hires image which should be centered in viewport
					var posLeft=Math.floor(ol*hw/w -vw/2);
					var posTop=Math.floor(ot*hh/h -vh/2);
					
					//Adjusts the poition if we are too near the edge so that we always fill the viewport
					if(posLeft <0){
						posLeft=0;
					}
					if(posLeft > hw-vw){
						posLeft=hw-vw;
					}
					if(posTop <0){
						posTop=0;
					}
					if(posTop>hh-vh){
						posTop=hh-vh;
					}
					//moves the image 
					setPosition(posLeft,posTop);
				});
				if(!options.hideOnExit){
					me.bind("click",function(){
						me.unbind();
;					})
				}
				//end binding
				//store the options so we can retrieve later
				me.data("theOptions",options);
			}; //end the init method				
			
			//entry point	
			$.extend(options,config);
			return this.each(function(){
				if(method=="init"){
					init(_options);
				}
				if(method=="remove"){
					unwrap();
				}
			});
		}
	})
})(jQuery);