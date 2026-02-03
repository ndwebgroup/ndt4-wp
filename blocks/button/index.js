( function( wp ) {
	var el = wp.element.createElement;
	var registerBlockType = wp.blocks.registerBlockType;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var RichText = wp.blockEditor.RichText;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var PanelBody = wp.components.PanelBody;
	var SelectControl = wp.components.SelectControl;
	var TextControl = wp.components.TextControl;
	var __ = wp.i18n.__;

	registerBlockType( 'ndt4/button', {
		edit: function( props ) {
			var attributes = props.attributes;
			var setAttributes = props.setAttributes;

			// Build button classes.
			var btnClasses = 'btn';
			if ( attributes.style === 'cta' ) {
				btnClasses += ' btn--cta';
			} else if ( attributes.style === 'more' ) {
				btnClasses += ' btn--more';
			}
			if ( attributes.color === 'secondary' ) {
				btnClasses += ' btn--secondary';
			} else if ( attributes.color === 'tertiary' ) {
				btnClasses += ' btn--tertiary';
			} else if ( attributes.color === 'neutral' ) {
				btnClasses += ' btn--neutral';
			}

			var blockProps = useBlockProps();

			return el( 'li', blockProps,
				el( InspectorControls, null,
					el( PanelBody, { title: __( 'Button Settings', 'ndt4' ), initialOpen: true },
						el( SelectControl, {
							label: __( 'Style', 'ndt4' ),
							value: attributes.style,
							options: [
								{ label: __( 'Base', 'ndt4' ), value: 'base' },
								{ label: __( 'CTA', 'ndt4' ), value: 'cta' },
								{ label: __( 'More', 'ndt4' ), value: 'more' },
							],
							onChange: function( value ) {
								setAttributes( { style: value } );
							},
						} ),
						el( SelectControl, {
							label: __( 'Color', 'ndt4' ),
							value: attributes.color,
							options: [
								{ label: __( 'Primary', 'ndt4' ), value: 'primary' },
								{ label: __( 'Secondary', 'ndt4' ), value: 'secondary' },
								{ label: __( 'Tertiary', 'ndt4' ), value: 'tertiary' },
								{ label: __( 'Neutral', 'ndt4' ), value: 'neutral' },
							],
							onChange: function( value ) {
								setAttributes( { color: value } );
							},
						} ),
						el( TextControl, {
							label: __( 'Link URL', 'ndt4' ),
							value: attributes.link,
							onChange: function( value ) {
								setAttributes( { link: value } );
							},
							type: 'url',
						} )
					)
				),
				el( RichText, {
					tagName: 'a',
					className: btnClasses,
					value: attributes.text,
					allowedFormats: [],
					onChange: function( value ) {
						setAttributes( { text: value } );
					},
					placeholder: __( 'Button text…', 'ndt4' ),
				} )
			);
		},

		save: function() {
			return null;
		},
	} );
} )( window.wp );
