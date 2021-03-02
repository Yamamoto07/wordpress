jQuery(document).ready(function() {

  /* === Checkbox Multiple Control === */
    jQuery( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on(
        'change',
        function() {
   // alert('');
            checkbox_values = jQuery( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
                function() {
                    return this.value;
                }
            ).get().join( ',' );

            jQuery( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        }
    );
	
jQuery(function () {
jQuery( '.customize-control input[type="number"]' ).change(function() {
      var max = parseInt(jQuery(this).attr('max'));
      var min = parseInt(jQuery(this).attr('min'));
      if (jQuery(this).val() > max)
      {
          jQuery(this).val(max);
      }
      else if (jQuery(this).val() < min)
      {
          jQuery(this).val(min);
      }       
    }); 
});
});