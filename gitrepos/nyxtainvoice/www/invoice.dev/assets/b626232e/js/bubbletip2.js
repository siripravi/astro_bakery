/*
	jQuery Version:				jQuery 1.3.2+
	Plugin Name:				aToolTip1 V 1.5
	Plugin by: 					Ara Abcarians: http://ara-abcarians.com
	License:					aToolTip1 is licensed under a Creative Commons Attribution 3.0 Unported License
								Read more about this license at --> http://creativecommons.org/licenses/by/3.0/			
*/
(function($) {
    $.fn.aToolTip1 = function(options) {
    	/**
    		setup default settings
    	*/
    	var defaults = {
    		// no need to change/override
    		closeTipBtn: 'aToolTip1CloseBtn',
    		toolTipId: 'aToolTip1',
    		// ok to override
    		fixed: false,
    		clickIt: false,
    		inSpeed: 600,
    		outSpeed: 100,
    		tipContent: '',
    		toolTipClass: 'defaultTheme',
    		xOffset: 0,
    		yOffset: 0,
    		onShow: null,
    		onHide: null
    	},
    	// This makes it so the users custom options overrides the default ones
    	settings = $.extend({}, defaults, options);
    
		return this.each(function() {
			var obj = $(this);
			/**
				Decide weather to use a title attr as the tooltip content
			*/
			if(obj.attr('title')){
				// set the tooltip content/text to be the obj title attribute
				var tipContent = obj.attr('title');	 
			} else {
				// if no title attribute set it to the tipContent option in settings
				var tipContent = settings.tipContent;
			}
			
			/**
				Build the markup for aToolTip1
			*/
			var buildaToolTip1 = function(){
				$('body').append("<div id='"+settings.toolTipId+"' class='"+settings.toolTipClass+"'><p class='aToolTip1Content'>"+tipContent+"</p><em></em></div>");
				
				if(tipContent && settings.clickIt){
					$('#'+settings.toolTipId+' p.aToolTip1Content')
					.append("<a id='"+settings.closeTipBtn+"' href='#' alt='close'>close</a>");
				}
			},
			/**
				Position aToolTip1
			*/
			positionaToolTip1 = function(){
				$('#'+settings.toolTipId).css({
					top: (obj.offset().top - $('#'+settings.toolTipId).outerHeight() - settings.yOffset) + 'px',
					//left: (obj.offset().left + obj.outerWidth() + settings.xOffset) + 'px'
					left: (obj.offset().left + settings.xOffset) + 'px'
				})
				.stop().fadeIn(settings.inSpeed, function(){
					if ($.isFunction(settings.onShow)){
						settings.onShow(obj);
					}
				});				
			},
			/**
				Remove aToolTip1
			*/
			removeaToolTip1 = function(){
				// Fade out
				$('#'+settings.toolTipId).stop().fadeOut(settings.outSpeed, function(){
				    $(this).remove();
				    if($.isFunction(settings.onHide)){
						settings.onHide(obj);
					}
				});				
			};
			
			/**
				Decide what kind of tooltips to display
			*/
			// Regular aToolTip1
			if(tipContent && !settings.clickIt){	
				// Activate on hover	
				obj.hover(function(){
					// remove already existing tooltip
					$('#'+settings.toolTipId).remove();
					obj.attr({title: ''});
					buildaToolTip1();
					positionaToolTip1();
			    }, function(){ 
					removeaToolTip1();
			    });	
		    } 		    
		    
		    // Click activated aToolTip1
		    if(tipContent && settings.clickIt){
				// Activate on click	
				obj.click(function(el){
					// remove already existing tooltip
					$('#'+settings.toolTipId).remove();
					obj.attr({title: ''});
					buildaToolTip1();
					positionaToolTip1();
					// Click to close tooltip
					$('#'+settings.closeTipBtn).click(function(){
						removeaToolTip1();
						return false;
					});		 
					return false;			
			    });
		    }
		    
		    // Follow mouse if enabled
		    if(!settings.fixed && !settings.clickIt){
				obj.mousemove(function(el){
					$('#'+settings.toolTipId).css({
						top: (el.pageY - $('#'+settings.toolTipId).outerHeight() - settings.yOffset),
						left: (el.pageX + settings.xOffset)
					});
				});			
			}		    
		  
		}); // END: return this
    };
})(jQuery);