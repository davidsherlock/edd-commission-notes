jQuery(document).ready(function ($) {

	/**
	 * Commission note management screen JS
	 */
	var EDD_Commission_Note = {

		vars: {
			commission_note: $( '#commission-note' ),
		},
		init : function() {
			this.add_note();
		},
		add_note : function() {
			$( document.body ).on( 'click', '#add-commission-note', function( e ) {
				e.preventDefault();
				var postData = {
					edd_action : 'add-commission-note',
					commission_id : $( '#commission-id' ).val(),
					commission_note : EDD_Commission_Note.vars.commission_note.val(),
					add_commission_note_nonce: $( '#add_commission_note_nonce' ).val()
				};

				if( postData.commission_note ) {

					$.ajax({
						type: "POST",
						data: postData,
						url: ajaxurl,
						success: function ( response ) {
							$( '#edd-commission-notes' ).prepend( response );
							$( '.edd-no-commission-notes' ).hide();
							EDD_Commission_Note.vars.commission_note.val( '' );
						}
					}).fail( function ( data ) {
						if ( window.console && window.console.log ) {
							console.log( data );
						}
					});

				} else {
					var border_color = EDD_Commission_Note.vars.commission_note.css( 'border-color' );
					EDD_Commission_Note.vars.commission_note.css( 'border-color', 'red' );
					setTimeout( function() {
						EDD_Commission_Note.vars.commission_note.css( 'border-color', border_color );
					}, 500 );
				}
			});
		},

	};
	EDD_Commission_Note.init();

	$(document.body).on('keydown', '#commission-note', function(e) {
		if(e.keyCode == 13 && (e.metaKey || e.ctrlKey)) {
			$('#add-commission-note').click();
		}
	});

});
