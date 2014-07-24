/*
*
* ResponsiNav Plugin
* @author - Kent Safranski - http://www.fluidbyte.net
*
*/

(function( $ ){
    $.fn.responsinav = function(o){
    
        var o = jQuery.extend({ breakpoint : 480 },o);
        
        var curz = 1000;
        
        // 0 = Full, 1 = Mobile
        rn_mode = undefined; 
        sub_nav_bind = false /* init */
        
        // Bind to load and resize
        $(window).bind('load resize', function(){
            // Run mode by width
            if ( $(window).width() <=o.breakpoint ) {
                if ( rn_mode == 0 || rn_mode == undefined ) { nav.reset(); nav.mobile(); } 
            }else{
                if ( rn_mode == 1 || rn_mode == undefined ) { nav.reset(); nav.full(); } 
            }
        });
        
        nav = {
        
            reset : function(){ 
                $('.menu-primary- > ul li').unbind('mouseenter mouseleave click');
                $('.menu-primary- .sub_nav').unbind('click').remove();
            },
    
            full : function(){
                // Set mode
                rn_mode = 0;
                // Ensure nav is visible, hide sub
                $('.menu-primary- > ul').show(); 
                $('.menu-primary- .nicholls-menu-contents').hide();

                // Behavior
                $(".menu-primary- > ul li").hover(function() {
					var timeout = $(this).data("timeout");
					if (timeout) clearTimeout(timeout);
					
					$(this).children(".nicholls-menu-contents").slideDown(300).css({ 'z-index':curz++ });

                }, function() {
                   $(this).data("timeout", setTimeout($.proxy(function() {
                   
                   $(this).find(".nicholls-menu-contents").slideUp(300);
                   
                 }, this), 300));
               });
            },
            
            mobile : function(){            
                
                // Set mode
                rn_mode = 1;
                
                /* - this as written hides navigation for small screens?
                
                // Start nav hidden
                $('.menu-primary- > ul').hide();
                // Create mobile handle
                if($('.menu-primary- > a.mobile_handle').length==0){ $('<a class="mobile_handle">Navigation</a>').appendTo('.menu-primary-'); }
                
                // Mobile handle toggle
                $('.menu-primary- > a.mobile_handle').unbind('click');
                $('.menu-primary- > a.mobile_handle').click(function(){ $('.menu-primary- > ul').slideToggle(300); });
                
                // Arrows
                if($('.sub_nav').length==0){
                    $('.menu-primary- ul li').each(function(){
                        if($(this).children('ul').length>0){ $('<a class="sub_nav"><div class="arrow_down"></div></a>').appendTo(this); }
                    });
                }
                
                // Sub-Nav
                if(sub_nav_bind==false){              
                    $('.menu-primary- > ul').delegate('.sub_nav', 'click', function(e) {               
                        $(this).siblings('ul').slideToggle(300);               
                        if ($(this).children('div').hasClass('arrow_down')){
                            $(this).children('div').attr('class', 'arrow_up');
                        }else{
                            $(this).children('div').attr('class', 'arrow_down');
                        }
                    });
                    sub_nav_bind = true;
                }
                */
                
            }      
        };       
    };
})( jQuery );