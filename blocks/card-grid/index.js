( function( wp ) {
	var el = wp.element.createElement;
	var registerBlockType = wp.blocks.registerBlockType;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var InnerBlocks = wp.blockEditor.InnerBlocks;

	registerBlockType( 'ndt4/card-grid', {
		edit: function( props ) {
			var columns = props.attributes.columns;

			var blockProps = useBlockProps( {
				className: 'grid grid-ml-' + columns,
			} );

			var template = [];
			for ( var i = 0; i < columns; i++ ) {
				template.push( [ 'ndt4/card', {} ] );
			}

			return el( 'div', blockProps,
				el( InnerBlocks, {
					allowedBlocks: [ 'ndt4/card' ],
					template: template,
				} )
			);
		},

		save: function() {
			return el( InnerBlocks.Content );
		},
	} );
} )( window.wp );
