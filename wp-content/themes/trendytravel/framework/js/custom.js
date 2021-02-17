jQuery.noConflict();
jQuery(document).ready(function($){
    "use strict";

    var currentWidth = window.innerWidth || document.documentElement.clientWidth;

    // Loader
    if( dttheme_urls.loadingbar === "enable") {
        Pace.on("done", function(){
            $(".loader").fadeOut(500);
            $(".pace").remove();
        });
    }

    // Sticky Row
    if( $("#header-wrapper .apply-sticky-header").length > 0 ){
	    $("#header-wrapper  .apply-sticky-header").sticky({ topSpacing: 0 });
    }
    
    // Mega Menu
        if ( $('li.has-mega-menu').length>0 && $('.dt-no-header-builder-content').length==0 ) {

            jQuery.fn.liCenter = function () {

                var w = $('#header .container').width(),
                    a = $(window).width(),
                    c = $('.dt-header-menu').parents('.wpb_column'),
                    ol = $('.dt-header-tpl').offset().left;

                c.addClass("dt-col-static-position");
                $('.mega-menu-page-equal li.has-mega-menu:not(.mega-menu-custom-width) > ul > li.menu-item-object-dt_mega_menus').css("width", w+"px");

                return this;
            };

            $('.mega-menu-page-equal li.has-mega-menu:not(.mega-menu-custom-width) > ul').liCenter();

            $(window).resize(function(){
                $('.mega-menu-page-equal li.has-mega-menu:not(.mega-menu-custom-width) > ul').liCenter();
            });
        }

    // Mobile Menu    

        // Move Nav as Mobile Nav
        $("div.dt-header-menu").each(function(){
            var d = $(this).data('menu'),
                c = $(this).find('ul[data-menu="'+d+'"]').clone(),
                m = $('body').find('.mobile-menu[data-menu="'+d+'"]');

            // To Remove animation classes
            $('[data-animation]', c ).each(function(ix, ele ){
                var $classes = $(ele).attr("class"),
                    $animation = $(ele).attr("data-animation");

                $classes = $classes.replace($animation, '');
                $(ele).attr("class", $classes);
            });           

            c.prependTo(m);
        });

        // Opening Mobile Nav
        $('.menu-trigger').on('click', function( event ){
            $(this).next('.mobile-menu').toggleClass('nav-is-visible');
            $(this).parent('.mobile-nav-container').find('.overlay').toggleClass('is-visible');
            $('body').toggleClass('nav-is-visible');
        });

        // Closing Mobile Nav
            function closeMobNav() {
                $('body').removeClass('nav-is-visible');
                $('.overlay').removeClass('is-visible');
                $('.mobile-menu').removeClass('nav-is-visible');
                $('.menu-item-has-children a').removeClass('selected');        
                $('.menu-item-has-children ul.sub-menu').addClass('is-hidden');            
            }

            $('li.close-nav').on('click', function(event){
                closeMobNav();
            });

            $('.mobile-nav-container > .overlay').on('click', function(event){
                closeMobNav();
            });

        // Sub Menu in Mobile Menu
        $('.menu-item-has-children > a, .page_item_has_children > a').on('click', function(event) {

            if ( $('body').hasClass('nav-is-visible') ) {
                event.preventDefault();
                var a = $(this).clone();
                $(this).next('.sub-menu').find('.see-all').html(a);
            }

            var selected = $(this);
            if( selected.next('ul').hasClass('is-hidden') ) {
                selected.addClass('selected').next('ul.sub-menu').removeClass('is-hidden');
            } else {
                selected.removeClass('selected').next('ul.sub-menu').addClass('is-hidden');
            }
        });

        // Go Back in Mobile Menu
        $('.go-back').on('click', function(){
            $(this).parent('ul:not(.menu)').addClass('is-hidden');
        });

    // Visual Nav Menu
        if( $('ul.visual-nav').length > 0 ) {

            $('ul.visual-nav').visualNav({
                selectedClass     : 'current_page_item',
                externalLinks     : 'external',
                useHash           : false,
                // offsetTop : 100
            });          
        }

    if( $("div.dt-video-wrap").length ) {
        $("div.dt-video-wrap").fitVids();        
    }

    if( $('a.video-image').length ) {
        $('a.video-image').prettyPhoto({
            animation_speed:'normal',
            theme:'facebook',
            slideshow:3000,
            autoplay_slideshow: false,
            social_tools: false,
            deeplinking:false
        });
    }

    // Container
    if( currentWidth > 767 ){
        if( $('#primary').hasClass('with-both-sidebar') ) {
        if( ( $('#secondary-left > div').is(':empty') && $('#secondary-right > div').is(':empty')) ){
                $('#primary').addClass("content-full-width").removeClass("page-with-sidebar with-both-sidebar");
        }else if( $('#secondary-left > div').is(':empty') ){
                $('#primary').addClass("with-right-sidebar").removeClass("with-both-sidebar");
        }else if( $('#secondary-right > div').is(':empty') ){
                $('#primary').addClass("with-left-sidebar").removeClass("with-both-sidebar");
        }
        } else if( $('#primary').hasClass('with-left-sidebar') ) {
        if( $('#secondary-left > div').is(':empty') ){
                $('#primary').addClass("content-full-width").removeClass("page-with-sidebar with-left-sidebar");
        }
        } else if( $('#primary').hasClass('with-right-sidebar') ) {
        if( $('#secondary-right > div').is(':empty') ){
                $('#primary').addClass("content-full-width").removeClass("page-with-sidebar with-right-sidebar");
        }
        }
    }

    $('#main .sidebar-as-sticky').theiaStickySidebar({
        additionalMarginTop: 70,
        containerSelector: $('#primary').parent('.container')
    });

    if($('.sidenav-sticky').length){
        $('.sidenav-sticky .side-navigation').theiaStickySidebar({
            additionalMarginTop: 90,
            containerSelector: $('#primary')
        });
    }    

    // <select> 
    $("select").each(function(){
        if($(this).css('display') != 'none') {
            $(this).wrap( '<div class="selection-box"></div>' );
        }
    });

    $('.activity-type-tabs > ul >li:first').addClass('selected');
    $('.dir-form > .item-list-tabs > ul > li:first').addClass('selected');

    $('.downcount').each(function(){
        var el = $(this);
        el.downCount({
            date    : el.attr('data-date'),
            offset  : el.attr('data-offset')
        });
    });

    $('p:empty').each(function (){
        $(this).next('br').remove();
        $(this).remove();
    });

    var OriginLeft = true;
    if(dttheme_urls.isRTL == 1) {
        var OriginLeft = false;
    }
    
    //Smart Resize
    $(window).on("resize", function() {

        //Blog Template
        if( $(".apply-isotope").length ) {
            $(".apply-isotope").isotope({itemSelector : '.column',isOriginLeft: OriginLeft, transformsEnabled:false,masonry: { columnWidth: '.grid-sizer' } });
        }
    });

    // Window Load Start
    $(window).on('load', function(){
        
        //Gallery Post Slider
        if( ($("ul.entry-gallery-post-slider").length) && ( $("ul.entry-gallery-post-slider li").length > 1 ) ){
			$("ul.entry-gallery-post-slider").bxSlider({ auto:false, video:true, useCSS:false, autoHover:true, adaptiveHeight:true, pagerCustom: '#entry-gallery-pager' });
        }

        //Blog Template
        if( $(".apply-isotope").length ) {
            $(".apply-isotope").isotope({itemSelector : '.column',isOriginLeft: OriginLeft, transformsEnabled:false,masonry: { columnWidth: '.grid-sizer' } });
        }
    });

    $(".dt-like-this").on('click', function(){

        var el = jQuery(this);

        if( el.hasClass('liked') ) {
            return false;
        }

        var post = {
            action: 'trendytravel_likes_ajax',
            post_id: el.attr('data-id')
        };

        $.post(dttheme_urls.ajaxurl, post, function(data){
            el.find('span').html(data);
            el.addClass('liked');
        });
        return false;
    });

    if( $('input, textarea').length ) {
        $('input, textarea').placeholder();        
    }
	
	//Rating Script...
	$("#dt-rating").hide().before('<p class="stars"><span><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span></p>');
	$("body").on("click", "#commentform p.stars a", function () {
        var b = $(this),
            c = $(this).closest("#commentform").find("#dt-rating");
        return c.val(b.text()), b.siblings("a").removeClass("active"), b.addClass("active"), !1
    });
	
	//Lightbox map...
	if($(".btn-place-review").length) {
		$('#respond').wrap('<div id="dt-sc-respond-wrapper" class="hide"></div>');
		$('.btn-place-review').colorbox({ inline:true, width:"auto" });
	}

    // Toggle store locator advacned options
        $("a.dt-sc-toggle-advanced-options").on('click', function( event ){
            event.preventDefault();
            var $this = $(this);
            $this.parents('.wpsl-search').find( "div.dt-sc-advanced-options" ).slideToggle( "slow", function() {
                $this.toggleClass('expanded');
                if($this.hasClass('expanded')) {
                    $this.html(dttheme_urls.advOptions + ' <span class="fa fa-angle-up"></span>');
                } else {
                    $this.html(dttheme_urls.advOptions + ' <span class="fa fa-angle-down"></span>');
                }
            });
        });

    //Sinle post like btn
    if( $(".single-post").length ) {
        $(".dt_like_btn a").on("click",function() {
            var btn = $(this);
            var post_id = btn.data("postid");
            var act = btn.data("action");

            $.ajax({
                type: "post",
                url: dttheme_urls.ajaxurl,
                data: { action: 'trendytravel_post_rating_like',
                        nonce: dttheme_urls.wpnonce,
                        post_id: post_id,
                        doaction: act
                      },
                success: function(data, textStatus, XMLHttpRequest){
                        btn.find('i').text(data);
                },
                error: function(MLHttpRequest, textStatus, errorThrown){
                    //alert(textStatus);
                }
            });
            return false;
        });
    }

    //Scroll down animate
    $(".dt_scroll_down a").on('click', function(a){
        a.preventDefault();

        var st = 0;
        if(dttheme_urls.stickynav === 'enable') {
            st = 90;
        }

        $("html, body").stop();
        $("html, body").animate({
            scrollTop: $('.entry-details.within-image').offset().top - st
        }, {
            duration: 1000,
            easing: "easeInOutQuart"
        });
    });    

    $('.alignfull').each(function () {
        if($(this).parents('#primary').hasClass('content-full-width')) {

            if($(this).parents('body').hasClass('layout-boxed')) {

                if($('body').hasClass('single-post') && $(this).parents('.blog-entry').hasClass('post-left-date')) {

                    var containerWidth = $('.layout-boxed .wrapper').width();
                    $(this).css('width', containerWidth);
                    
                    var mainLeft = $('#main').offset().left;
                    var primaryLeft = $('#primary').offset().left;

                    var $containerPadding = $(this).parents('.blog-entry.post-left-date').css('padding-left');
                    $containerPadding = $containerPadding.replace('px', '');

                    var sectionMargin = parseInt(primaryLeft, 10) - parseInt(mainLeft, 10) + parseInt($containerPadding, 10);

                    var offset = 0 - sectionMargin;
                    $(this).css('left', offset);

                } else {

                    var containerWidth = $('.layout-boxed .wrapper').width();
                    $(this).css('width', containerWidth);
                    
                    var mainLeft = $('#main').offset().left;
                    var primaryLeft = $('#primary').offset().left;

                    var sectionMargin = parseInt(primaryLeft, 10) - parseInt(mainLeft, 10);

                    var offset = 0 - sectionMargin;
                    $(this).css('left', offset);
                
                }

            } else {

                if($('body').hasClass('single-post') && $(this).parents('.blog-entry').hasClass('post-left-date')) {

                    var windowWidth = $(window).width();
                    $(this).css('width', windowWidth);

                    var $container = '';
                    $container = $(this).parents('.blog-entry');

                    if( !$container.length ) {
                        $container = $(this).parents('.type-page');
                    }
                    var $containerPadding = $(this).parents('.blog-entry.post-left-date').css('padding-left');
                    $containerPadding = $containerPadding.replace('px', '');

                    var offset = 0 - $container.offset().left - $containerPadding;
                    $(this).css('left', offset);

                } else {

                    var windowWidth = $(window).width();
                    $(this).css('width', windowWidth);

                    var $container = '';
                    $container = $(this).parents('.blog-entry');

                    if( !$container.length ) {
                        $container = $(this).parents('.type-page');
                    }

                    var offset = 0 - $container.offset().left;
                    $(this).css('left', offset);
                    
                }

            }

        }
    });

    // Gutenberg - WP Category Widget Fix
    if($('.wp-block-categories-list').length) {
        loopCategories($('.wp-block-categories-list'));
        function loopCategories(item) {
            item.find('li').each(function() {
                var span_text = $(this).find('span').html();
                $(this).find('span').remove()
                $('<span>'+span_text+'</span>').insertAfter($(this).find('a')); 

                if($(this).find('ul.children').length) {
                    loopCategories($(this).find('ul.children'));
                }
            });
        }
    }
          

    // Go To Top
    $().UItoTop({ easingType: 'easeOutQuart' });

    if( $('.dt-sc-icon-box-type9').length ) {
        setTimeout(function(){
            $('.dt-sc-icon-box-type9').each(function(){
                $(this).find('.icon-wrapper').css('height', $(this).find('.icon-content').outerHeight(true) );
            });
        },1000);
    }
        
    if( $('ul.dt-sc-tabs-vertical-frame').length ) {
        $('ul.dt-sc-tabs-vertical-frame').each(function(){
            $(this).css('min-height', $(this).height() );
        });
    }

    if( $('ul.dt-sc-tabs-vertical').length ) {
        $('ul.dt-sc-tabs-vertical').each(function(){
            $(this).css('min-height', $(this).height() );
        });
    }   
});