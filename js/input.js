(function($){


	function initialize_field( $el ) {
		//$el.doStuff();
    var _fields   = $('.field_type-instagramfeed');
    $('.acf-fc-layout-controlls .acf-button-add', _fields).click(function(event){
      $(_fields).find('.hide').removeClass('hide').addClass('show');
      event.preventDefault();
    });
    $('.acf-fc-layout-controlls .acf-button-remove', _fields).click(function(event){
      $(_fields).find('.show').removeClass('show').addClass('hide');
      event.preventDefault();
    });


	}

	/*
	*  acf/setup_fields (ACF4)
	*
	*  This event is triggered when ACF adds any new elements to the DOM.
	*
	*  @type	function
	*  @since	1.0.0
	*  @date	01/01/12
	*
	*  @param	event		e: an event object. This can be ignored
	*  @param	Element		postbox: An element which contains the new HTML
	*
	*  @return	n/a
	*/

	$(document).live('acf/setup_fields', function(e, postbox){

		$(postbox).find('.field[data-field_type="instagramfeed"]').each(function(){

			initialize_field( $(this) );

		});

	});


})(jQuery);
