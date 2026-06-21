jQuery( window ).on( 'elementor/frontend/init', function() {
	elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope, $ ) {
		/*setTimeout(function(){
			tm_rearrange_stretched_col( $scope.data('id') );			
			tm_bgimage_class();
			tm_bgcolor_class();
		}, 200);*/
		tm_stretched_col();
		tm_stretched_col_calc();
		tm_bgimage_class();
		tm_bgcolor_class();
		setTimeout(function() {
			tm_stretched_col_calc();
		}, 100);
	} );
} );

