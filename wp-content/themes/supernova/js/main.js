
jQuery(function($){

	"use strict";

	window.Supernova = {

		$window 	 : $( window ),
		$docEl 		 : $( document.documentElement ),
		$slider      : $('#sup-slider'),
		$fontResizer : $('.sup-font-resizer a'),
		$content     : $('.sup-single .entry-content'),
		$tabber      : $('.sup_tabber .sup-tab'),
		$backToTop 	 : $('#sup-back-to-top'),
		$searchIcon  : $('span.sup-header-search-icons'),
		$search 	 : $('div.sup-header-search'),

		init : function(){
			this.createSticky();
			this.createSlider();
			this.createMobileMenu();
			this.changeFontSize();
			this.animateMenu();
			this.events();
			this.fixAdminBar();
			Supernova.Loadmore.init();
		},

		fixAdminBar : function(){
			var $adminBar = $('#wpadminbar');
			$('body').append($adminBar);
		},

		events : function(){
			this.$fontResizer.on( 'click', this.fontResizer );
			this.$tabber.on( 'click', this.tabber );
			$(document).on( 'mouseup' , this.hideSearch );
			this.$window.on( 'scroll', this.onWindowScroll );
			this.$window.on( 'resize', this.updateSticky );
			this.$backToTop.on( 'click', this.backToTop );
			this.$searchIcon.on( 'click', this.showHideSearch );
		},

		createSticky : function()
		{
			if( supVars.settings.sticky_menu != 1 ) return;
			var spacing = $('#wpadminbar').length ? $('#wpadminbar').height() : 0;
			$("#sup-top-most").sticky( { topSpacing : spacing, responsiveWidth : true } );
		},

		updateSticky : function(){
			$("#sup-top-most").sticky('update');
		},

		onWindowScroll : function(){
			Supernova.showHideSearchIcons( $(this) );
			Supernova.showBacktoTop( $(this) );
		},

		showHideSearch : function(){
			var _this = Supernova;

			if( _this.$searchIcon.hasClass('sup-icon-cancel') && _this.$window.scrollTop() < 400 ){
				_this.$searchIcon.hide();
			}

			if( _this.$search.hasClass('active') ){
				_this.$searchIcon.removeClass('sup-icon-cancel');
				_this.$search.removeClass('active').fadeOut();
			}
			else{
				_this.$search.addClass('active').fadeIn();
				_this.$searchIcon.addClass('sup-icon-cancel');
			}
		},

		hideSearch : function(e){

			var _this = Supernova;

		    if ( ! _this.$search.is(e.target) && _this.$search.has(e.target).length === 0 && ! _this.$searchIcon.is(e.target) && _this.$searchIcon.has(e.target).length === 0 )
		    {
		        _this.$searchIcon.removeClass('sup-icon-cancel');
		        _this.$search.removeClass('active').fadeOut();
		    }
		},

		showHideSearchIcons : function( $this ){
			if ( $this.scrollTop() > 400 && ! this.$searchIcon.hasClass('active') ){
				this.$searchIcon.addClass('active').fadeIn();
			}
			if ( $this.scrollTop() < 400 && this.$searchIcon.hasClass('active') && ! this.$searchIcon.hasClass('sup-icon-cancel') ){
				this.$searchIcon.removeClass('active').fadeOut();
			}
		},

		showBacktoTop : function( $this ){
			if ( $this.width() > 960 ){
				if ( $this.scrollTop() > 50 ) this.$backToTop.show();
				else  this.$backToTop.hide();
			}
		},

		backToTop : function(){
	        $("body,html").animate( { scrollTop: 0 }, 600 );
	        return false;
		},

		animateMenu : function(){
			$('#sup-header-nav ul ul, #sup-main-menu ul ul').addClass('animated-menu fadeInUp');
		},

		createSlider : function()
		{
			if( ! this.$slider.length || typeof supVars.slider_options === 'undefined' || supVars.isPro ) return;

			this.sliderUtil();

			supVars.slider_options.customPaging = function( slider, i ){
				return '';
			};

			this.$slider.slick( supVars.slider_options );
		},

		sliderUtil : function()
		{
			var _this = this;

			this.$slider.on('init', function( slick ){
				$('.slick-current .sup-slide-content').show().addClass('animated fadeInLeft');
			});

			this.$slider.on('afterChange', function( event, slick, currentSlide, nextSlide ){
				$('.sup-slide-content').hide().removeClass('animated fadeInLeft');
				$('.slick-current .sup-slide-content').show().addClass('animated fadeInLeft');
			});

		},

		tabber : function(){
			var $tabberContent = $(this).closest('.sup_tabber').find('.sup-tabber-content');

			Supernova.$tabber.removeClass('sup-active');
			$(this).addClass('sup-active');
			$tabberContent.hide().eq( $(this).index() ).fadeIn();
		},

		changeFontSize : function(){
			var fontsize = parseInt(localStorage.getItem( 'sup-fontsize' ));
			this.fontsize = fontsize ? fontsize : parseInt( this.$content.css('font-size') );
			this.$content.css( 'font-size' , this.fontsize + 'px' );
		},

		fontResizer : function(e){
			e.preventDefault();
			var $this = $(this), _this = Supernova;

			if( $this.hasClass('active') ) return;

			$this.addClass('active');

			if( $this.data('type') === 'plus' ){
				if( _this.fontsize < 20 ) _this.fontsize++;
			}
			else{
				if( _this.fontsize > 12 ) _this.fontsize--;
			}

			localStorage.setItem( 'sup-fontsize' , _this.fontsize );

			_this.$content.animate( { 'font-size': _this.fontsize + 'px' }, 300, 'swing', function(){
				$this.removeClass('active');
			});
		},

		/**
		 * Creates mmenu
		 * @param  {id} id  ID of the menu container which is also used in the link
		 * @param  {menuClass} menuClass after the mmenu is created it copies the class of the main container.
		 * @param  {direction} direction "right" or "left"
		 * @return {selector}
		 */
		createMMenu : function( id, menuClass , direction, menuTitle  ){

			var $menu = $('#' + id ).clone();

			$menu.mmenu({
				offCanvas: {
			       position  : direction,
			   },
			   navbar: {
			       title: menuTitle
	     	   }
			}).on( 'opened.mm', function()
						{
							$menu.trigger("open.mm");
						});

			$('#' + id + '.mm-menu').removeClass( menuClass );

			return $menu;
		},

		createMobileMenu : function()
		{
			this.createMMenu( 'sup-main-menu' , 'sup-main-nav' , 'left', supVars.menuText );
			this.createMMenu( 'sup-cat-nav' , 'sup-menu-container' , 'left', supVars.categoriesText );
			this.createMMenu( 'sup-header-nav' , 'sup-left-menu' , 'right', supVars.menuText );
		},

	};

	/*==============================
	          Load More
	===============================*/

	Supernova.Loadmore = {

		//Buttons
		$buttonMain        : $('button.sup-load-main'),
		$buttonPopular     : $('button.sup-load-popular'),
		$buttonRecommended : $('button.sup-load-recommended'),

		//Sections
		$posts 			   : $('.sup-ajax-posts'),
		$mainPosts         : $('#sup-main-posts'),
		$popularPosts      : $('#sup-popular-posts'),
		$recommendedPosts  : $('#sup-recommended-posts'),

		//Tabs
		$latestTab         : $('.sup-latest-tab'),
		$popularTab        : $('.sup-popular-tab'),
		$recommendedTab    : $('.sup-recommended-tab'),

		//Count
		mainCount          : 0,
		popularCount       : 0,
		recommendedCount   : 0,

		init : function()
		{
			if( ! this.$buttonMain.length || typeof supVars === 'undefined' ) return;

			this.updateMainCount();
			this.events();
		},

		events : function()
		{
			this.$buttonMain.on( 'click', this.loadMainPosts );
			this.$buttonPopular.on( 'click', this.loadPopularPosts );
			this.$buttonRecommended.on( 'click', this.loadRecommendedPosts );

			this.$latestTab.on( 'click', this.reloadMainPosts );
			this.$popularTab.on( 'click' , this.reloadPopularPosts );
			this.$recommendedTab.on( 'click', this.reloadRecommendedPosts );
		},

		updateMainCount : function(){
			var $currentPage = $('.page-numbers.current');
			if( $currentPage.length ){
				this.mainCount = parseInt( $currentPage.text() ) - 1;
			}
		},

		loadPosts : function( type, count, $button, $postsContainer )
		{
			var $loader     = $button.find('.sup-loader'),
				$buttonText = $button.find('.sup-text'),
				buttonText  = $buttonText.text(),
				$footer     = $button.closest('.sup-ajax-posts-footer'),
				$markup;

			$button.prop( 'disabled' , true );
			$loader.fadeIn();
			$buttonText.text( supVars.loading );

			$.ajax({
				url: supVars.ajaxurl,
				type: 'POST',
				dataType: 'json',
				data: {
					action     : 'sup_loadmore_posts',
					load_type  : type,
					load_count : count,
				},
			})
			.done(function( resp ) {

				if( typeof resp === 'undefined' ) return;

				$postsContainer.removeClass('sup-first-view');

				if( $.trim(resp.markup) !== "" ){

					$markup = $(resp.markup);
					$footer.before($markup);
					$markup.hide().fadeIn();

					if( type === 'main' ) Supernova.Loadmore.changePaginationIndex( count );

					if( $markup.hasClass('sup-error') ){
						$button.fadeOut('slow', function(){
							$(this).remove();
						});
						if( $postsContainer.find('article').length ){
							$postsContainer.find('.sup-error').html(supVars.nomore_posts);
						}
					}
					else{
						$button.fadeIn();
					}
				}

			})
			.fail(function( error ) {
				alert( supVars.Loadmore_error );
				console.log( error );
			})
			.always(function() {
				$loader.hide();
				$buttonText.text( buttonText );
				$button.prop( 'disabled' , false );
			});
		},

		loadMainPosts : function( e ){
			e.preventDefault();

			var _this = Supernova.Loadmore;

			_this.mainCount++;

			_this.loadPosts( 'main' , _this.mainCount, _this.$buttonMain, _this.$mainPosts );
		},

		loadPopularPosts : function( e )
		{
			e.preventDefault();

			var _this = Supernova.Loadmore;

			_this.popularCount++;

			_this.loadPosts( 'popular' , _this.popularCount , _this.$buttonPopular, _this.$popularPosts );
		},

		loadRecommendedPosts : function( e )
		{
			e.preventDefault();

			var _this = Supernova.Loadmore;

			_this.recommendedCount++;

			_this.loadPosts( 'recommended' , _this.recommendedCount , _this.$buttonRecommended, _this.$recommendedPosts );
		},

		reloadMainPosts : function(){
			var _this = Supernova.Loadmore;

			_this.activateTab( $(this) );

			_this.$posts.hide();
			_this.$mainPosts.fadeIn();
		},

		reloadPopularPosts : function()
		{
			var _this = Supernova.Loadmore;
			var $markup;

			_this.activateTab( $(this) );

			_this.$posts.hide();
			_this.$popularPosts.fadeIn();

			if( _this.$popularPosts.find('article').length || _this.$popularPosts.find('.sup-error').length ) return;

			_this.loadPosts( 'popular' , _this.popularCount, _this.$buttonPopular, _this.$popularPosts );

			_this.popularCount++;

		},

		reloadRecommendedPosts : function(){
			var _this = Supernova.Loadmore;
			var $markup;

			_this.activateTab( $(this) );

			_this.$posts.hide();
			_this.$recommendedPosts.fadeIn();

			if( _this.$recommendedPosts.find('article').length || _this.$recommendedPosts.find('.sup-error').length ) return;

			_this.loadPosts( 'recommended' , _this.recommendedCount, _this.$buttonRecommended, _this.$recommendedPosts );

			_this.recommendedCount++;
		},

		changePaginationIndex : function( mainCount )
		{
			var $pagination = $('.sup-pagination');
			if( $pagination.find('.dots').hasClass('current') ) return;

			$pagination.find('.page-numbers')
			.removeClass('current').eq( mainCount )
			.addClass('current');

		},

		activateTab : function( $this ){
			$('.sup-posts-loader-tabs li').removeClass('sup-active');
			$this.addClass('sup-active');
		},
	};

	window.Supernova.init();

});
