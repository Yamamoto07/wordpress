( function( api ) {

	// Extends our custom "glowline-1" section.
	api.sectionConstructor['glowline-1'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
