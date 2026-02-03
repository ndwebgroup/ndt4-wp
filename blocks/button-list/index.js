( function( wp ) {
	var el = wp.element.createElement;
	var registerBlockType = wp.blocks.registerBlockType;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var useInnerBlocksProps = wp.blockEditor.useInnerBlocksProps;

	var TEMPLATE = [
		[ 'ndt4/button', {} ],
		[ 'ndt4/button', {} ],
		[ 'ndt4/button', {} ],
	];

	registerBlockType( 'ndt4/button-list', {
		edit: function() {
			var blockProps = useBlockProps( {
				className: 'no-bullets btn-list',
			} );

			var innerBlocksProps = useInnerBlocksProps(
				{ className: 'btn-list' },
				{
					allowedBlocks: [ 'ndt4/button' ],
					template: TEMPLATE,
				}
			);

			return el( 'div', blockProps,
				el( 'ul', innerBlocksProps )
			);
		},

		save: function() {
			return null;
		},
	} );
} )( window.wp );
