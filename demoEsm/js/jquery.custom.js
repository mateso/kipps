jQuery(document).ready(function($){ 

	$('body').removeClass('no_js').addClass('yes_js'); 
    
    
    $('#nav li, ul.sub-menu, ul.children').each(function(){
        n = $('ul.sub-menu:not(ul.sub-menu li > ul.sub-menu), ul.children:not(ul.children li > ul.children)', this).length;
        
        if(n) $(this).addClass('parent');
    });
        
    $('#nav ul > li').hover(
        function()
        {
            $('ul.sub-menu:not(ul.sub-menu li > ul.sub-menu), ul.children:not(ul.children li > ul.children)', this).stop(true, true).fadeIn(300);    
        },
    
        function()
        {
            $('ul.sub-menu:not(ul.sub-menu li > ul.sub-menu), ul.children:not(ul.children li > ul.children)', this).fadeOut(300);    
        }
    );              
    
    $('#nav ul > li').each(function(){
        if( $('ul', this).length > 0 )
            $(this).children('a').append('<span class="sf-sub-indicator"> &raquo;</span>')
    });  
    
    
    
    $('#nav li:not(.megamenu) ul.sub-menu li, #nav li:not(.megamenu) ul.children li').hover(
        function()
        {
            var options;
            
            winWidth = $(document).width();
            
            subMenuWidth = $(this).parent().outerWidth();
            space = $(this).offset().left + subMenuWidth * 2;
            
            if(space < winWidth) options = {left:subMenuWidth-20};
            else options = {left:subMenuWidth*-1};
            
            $('ul.sub-menu, ul.children', this).hide().css(options).stop(true, true).fadeIn(300);
        },
    
        function()
        {
            $('ul.sub-menu, ul.children', this).fadeOut(300);
        }
    ); 
    
    
    /* megamenu check position 
    $('#nav .megamenu').mouseover(function(){
	
		var main_container_width = $('.inner').width();
		var main_container_offset = $('.inner').offset();
		var parent = $(this);
		var megamenu = $(this).children('ul.sub-menu');
		var width_megamenu = megamenu.outerWidth();
		var position_megamenu = megamenu.offset();
		var position_parent = parent.position();
		
		var position_right_megamenu = position_parent.left + width_megamenu;
		
		// adjust if the right position of megamenu is out of container
		if ( position_right_megamenu > main_container_width ) {
			megamenu.offset( { top:position_megamenu.top, left:main_container_offset.left + ( main_container_width - width_megamenu ) } );		
		}
		
		//alert( 'width_megamenu = ' + width_megamenu + '; position_parent = top:' + position_parent.top + ', left:' + position_parent.left );
		//alert( 'width_megamenu = ' + width_megamenu + '; left = ' + main_container_offset.left + ( main_container_width - width_megamenu ) );
		
	});*/

	function yiw_lightbox()
	{   
	    $('#portfolio-gallery a.thumb').hover(
	                            
	        function()
	        {
	            $('<a class="zoom">zoom</a>').appendTo(this).css({
					dispay:'block', 
					opacity:0, 
					height:$(this).children('img').height(), 
					width:$(this).children('img').width(),
					'top':$(this).css('padding-top'),
					'left':$(this).css('padding-left'),
					//margin:'26px 16px',
					padding:0}).animate({opacity:0.4}, 500);
	        },
	        
	        function()
	        {           
	            $('.zoom').fadeOut(500, function(){$(this).remove()});
	        }
	    );
	    
		jQuery("a[rel^='prettyPhoto']").prettyPhoto({
	        slideshow:5000, 
	        autoplay_slideshow:false,
	        show_title:false
	    });
	}
	
	yiw_lightbox();
	
	
	$('.home_page_item_gallery a.thumb').hover(function(){
        $('<a class="zoom">zoom</a>')
            .appendTo(this)
            .css({
                dispay:'block', 
                opacity:0, 
                height:$(this).children('img').height(), 
                width:$(this).children('img').width(),
                'top':$(this).css('padding-top'),
                'left':$(this).css('padding-left'),
                //margin:'26px 16px',
                padding:0})
            .animate({opacity:0.4}, 500);
	}, function(){
	    $('.zoom').fadeOut(500, function(){$(this).remove()});
	});
	
	// searchform on header    // autoclean labels
	$elements = $('#header #s, .autoclear');
    
	$elements.each(function(){
        if( $(this).val() != '' )	
			$(this).prev().css('display', 'none');
    }); 
    $elements.focus(function(){
        if( $(this).val() == '' )	
			$(this).prev().css('display', 'none');
    }); 
    $elements.blur(function(){ 
        if( $(this).val() == '' )	
        	$(this).prev().css('display', 'block');
    }); 

    $('a.socials, a.socials-small').tipsy({fade:true, gravity:'s'});
    
    $('.toggle-content:not(.opened), .content-tab:not(.opened)').hide();
    $('.toggle-title').click(function(){
        $(this).next().slideToggle(300);
        $(this).children('span.open-toggle').toggleClass('closed');
        $(this).attr('title', ($(this).attr('title') == 'Close') ? 'Open' : 'Close');
        return false; 
    });     
    $('.tab-index a').click(function(){           
        $(this).parent().next().slideToggle(300, 'easeOutExpo');
        $(this).toggleClass('opened');
        $(this).attr('title', ($(this).attr('title') == 'Close') ? 'Open' : 'Close');
        return false;
    });     
    
    $('.tabs-container').yiw_tabs({
        tabNav  : 'ul.tabs',
        tabDivs : '.border-box'
    });
    
    $('#slideshow images img').show();
    
    $("a[rel^='prettyPhoto']").prettyPhoto({theme: 'pp_default'});
    
    $('#content img:not(.icon, .internal), .thumb-project img, .widget_flickrRSS img, .more-projects-widget img').hover(function(){
        $(this).stop().animate({opacity: 0.65}, 700);
    }, function(){
        $(this).stop().animate({opacity: 1});
    });

    
    $('#portfolio a.thumb, .portfolio-slider a.thumb, #portfolio-bigimage a.thumb').hover(function(){
        $('<a class="zoom">zoom</a>').appendTo(this).css({
            dispay:'block', 
            opacity:0, 
            height:$(this).children('img').height(), 
            width:$(this).children('img').width(),
            'top':$(this).css('padding-top'),
            'left':$(this).css('padding-left'),
                    //margin:'26px 16px',
            padding:0}).animate({opacity:0.4}, 500);
    }, function(){           
        $('.zoom').fadeOut(500, function(){$(this).remove()});
    });
    
    
});          

// tabs plugin
(function($) {
    $.fn.yiw_tabs = function(options) {
        // valori di default
        var config = {
            'tabNav': 'ul.tabs',
            'tabDivs': '.containers',
            'currentClass': 'current'
        };      
 
        if (options) $.extend(config, options);
    	
    	this.each(function() {   
        	var tabNav = $(config.tabNav, this);
        	var tabDivs = $(config.tabDivs, this);
        	var activeTab;
        	
            tabDivs.children('div').hide();
    	
    	    if ( $('li.'+config.currentClass+' a', tabNav).length > 0 )
               activeTab = $('li.'+config.currentClass+' a', tabNav).attr('href'); 
        	else
        	   activeTab = $('li:first-child a', tabNav).attr('href');
                        
        	$(activeTab).show().addClass('showing');
            $('a[href="'+activeTab+'"]', tabNav).parents('li').addClass(config.currentClass);
        	
        	$('a', tabNav).click(function(){
        		var id = $(this).attr('href');
        		var thisLink = $(this);
        		
        		$('li.'+config.currentClass, tabNav).removeClass(config.currentClass);
        		$(this).parents('li').addClass(config.currentClass);
        		
        		$('.showing', tabDivs).fadeOut(200, function(){
        			$(this).removeClass('showing');
        			$(id).fadeIn(200).addClass('showing');
        		});
        		
        		return false;
        	});   
        });
    }
})(jQuery);

// portfolio filterable
(function($) {                                     
        
    $.fn.sorted = function(customOptions) {
        var options = {
            reversed: false,
            by: function(a) {
                return a.text();
            }
        };

        $.extend(options, customOptions);

        $data = jQuery(this);
        arr = $data.get();
        arr.sort(function(a, b) {

            var valA = options.by($(a));
            var valB = options.by($(b));
    
            if (options.reversed) {
                return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;              
            } else {        
                return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;  
            }
    
        });

        return $(arr);

    };

})(jQuery);

jQuery(function($) {

    function yiw_lightbox()
    {   
        $('a.thumb').hover(
                                
            function()
            {
                $('<a class="zoom">zoom</a>').appendTo(this).css({
                    dispay:'block', 
                    opacity:0, 
                    height:$(this).children('img').height(), 
                    width:$(this).children('img').width(),
                    'top':$(this).css('padding-top'),
                    'left':$(this).css('padding-left'),
                    //margin:'26px 16px',
                    padding:0}).animate({opacity:0.4}, 500);
            },
            
            function()
            {           
                $('.zoom').fadeOut(500, function(){$(this).remove()});
            }
        );
        
        jQuery("a[rel^='prettyPhoto']").prettyPhoto({
            slideshow:5000, 
            autoplay_slideshow:false,
            show_title:false
        });
        
    }
    
    yiw_lightbox();


    var read_button = function(class_names) {
        
        var r = {
            selected: false,
            type: 0
        };
        
        for (var i=0; i < class_names.length; i++) {
            
            if (class_names[i].indexOf('selected-') == 0) {
                r.selected = true;
            }
        
            if (class_names[i].indexOf('segment-') == 0) {
                r.segment = class_names[i].split('-')[1];
            }
        };
        
        return r;
        
    };

    var determine_sort = function($buttons) {
        var $selected = $buttons.parent().filter('[class*="selected-"]');
        return $selected.find('a').attr('data-value');
    };

    var determine_kind = function($buttons) {
        var $selected = $buttons.parent().filter('[class*="selected-"]');
        return $selected.find('a').attr('data-value');
    };

    var $preferences = {
        duration: 500,
        adjustHeight: 'auto'
    }

    var $list = jQuery('.gallery-wrap');
    var $data = $list.clone();

    var $controls = jQuery('.portfolio-categories');

    $controls.each(function(i) {

        var $control = jQuery(this);
        var $buttons = $control.find('a');
        var height_list = $list.height();

        $buttons.bind('click', function(e) {

            var $button = jQuery(this);
            var $button_container = $button.parent();
            var button_properties = read_button($button_container.attr('class').split(' '));      
            var selected = button_properties.selected;
            var button_segment = button_properties.segment;

            if (!selected) {

                $buttons.parent().removeClass();
                $button_container.addClass('selected-' + button_segment);

                var sorting_type = determine_sort($controls.eq(1).find('a'));
                var sorting_kind = determine_kind($controls.eq(0).find('a'));

                if (sorting_kind == 'all') {
                    var $filtered_data = $data.find('li');
                } else {
                    var $filtered_data = $data.find('li.' + sorting_kind);
                }

                var $sorted_data = $filtered_data.sorted({
                    by: function(v) {
                        return $(v).find('strong').text().toLowerCase();
                    }
                });

                $list.quicksand($sorted_data, $preferences, function () {
                        yiw_lightbox();
                        //Cufon.replace('#portfolio-gallery h6');   
                        
                        var current_height = $list.height();       
                        $('.hentry-post').animate( { 'min-height':$list.height() }, 300 );
                        
                        
                        
                        var postsPerRow = ( $('.layout-sidebar-right').length > 0 || $('.layout-sidebar-left').length > 0 ) ? 3 : 4;
                        
                        $('.gallery-wrap li')
                            .removeClass('group')
                            .each(function(i){
                                $(this).find('div')
                                    //.removeClass('internal_page_item_first') 
                                    .removeClass('internal_page_item_last');
                                
                                if( (i % postsPerRow) == 0 ) {
                                    //$(this).addClass('group');
                                    //$(this).find('div').addClass('internal_page_item_first'); 
                                } else if((i % postsPerRow) == 2) {
                                    $(this).find('div').addClass('internal_page_item_last');
                                }
                            });
                            
                        $('.gallery-wrap:first').css('height',0);
                        
                });
    
            }
    
            e.preventDefault();
            
        });
    
    }); 
    
});