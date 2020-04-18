/**
 * Custom Gallery Setting
 */
( function( $ ) {
	var media = wp.media;

	// Wrap the render() function to append controls
	media.view.Settings.Gallery = media.view.Settings.Gallery.extend({
		render: function() {
			media.view.Settings.prototype.render.apply( this, arguments );

			// Append the custom template
			this.$el.append( media.template( 'penci-custom-gallery-options' ) );

			// Save the setting
			media.gallery.defaults.type = 'justified';
			this.update.apply( this, ['type'] );
			return this;
		}
	} );
} )( jQuery );