( function( wp ) {
	var el = wp.element.createElement;
	var registerBlockType = wp.blocks.registerBlockType;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var MediaUpload = wp.blockEditor.MediaUpload;
	var MediaUploadCheck = wp.blockEditor.MediaUploadCheck;
	var RichText = wp.blockEditor.RichText;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var PanelBody = wp.components.PanelBody;
	var SelectControl = wp.components.SelectControl;
	var ToggleControl = wp.components.ToggleControl;
	var Button = wp.components.Button;
	var __ = wp.i18n.__;

	registerBlockType( 'ndt4/blockquote', {
		edit: function( props ) {
			var attributes = props.attributes;
			var setAttributes = props.setAttributes;

			// Build blockquote classes.
			var blockquoteClasses = 'blockquote blockquote--left';
			if ( attributes.variant === 'stacked' ) {
				blockquoteClasses += ' blockquote--stacked';
			}
			if ( attributes.reversed ) {
				blockquoteClasses += ' blockquote--reversed';
			}

			// Avatar classes depend on variant.
			var avatarClass = attributes.variant === 'stacked'
				? 'avatar avatar--sm avatar--quote'
				: 'avatar avatar--md avatar--quote mi-auto';

			var blockProps = useBlockProps( {
				className: 'ndt4-blockquote-wrapper',
			} );

			var onSelectImage = function( media ) {
				setAttributes( {
					imageId: media.id,
					imageUrl: media.url,
				} );
			};

			var onRemoveImage = function() {
				setAttributes( {
					imageId: 0,
					imageUrl: '',
				} );
			};

			// Render inline variant.
			var renderInline = function() {
				return el( 'blockquote', { className: blockquoteClasses },
					el( 'div', { className: 'flex-md align-start' },
						el( 'figure', { className: avatarClass },
							attributes.imageUrl
								? el( 'img', {
									src: attributes.imageUrl,
									alt: attributes.authorName || '',
								} )
								: el( MediaUploadCheck, null,
									el( MediaUpload, {
										onSelect: onSelectImage,
										allowedTypes: [ 'image' ],
										value: attributes.imageId,
										render: function( obj ) {
											return el( Button, {
												onClick: obj.open,
												className: 'button button-large',
											}, __( 'Add Image', 'ndt4' ) );
										},
									} )
								)
						),
						el( RichText, {
							tagName: 'p',
							value: attributes.quote,
							allowedFormats: [ 'core/bold', 'core/italic' ],
							onChange: function( value ) {
								setAttributes( { quote: value } );
							},
							placeholder: __( 'Enter quote text…', 'ndt4' ),
						} )
					),
					el( 'div', { className: 'byline' },
						el( 'div', { className: 'byline-body' },
							el( RichText, {
								tagName: 'p',
								className: 'byline-title person-name',
								value: attributes.authorName,
								allowedFormats: [],
								onChange: function( value ) {
									setAttributes( { authorName: value } );
								},
								placeholder: __( 'Author name', 'ndt4' ),
							} ),
							el( RichText, {
								tagName: 'p',
								className: 'person-title',
								value: attributes.authorTitle,
								allowedFormats: [],
								onChange: function( value ) {
									setAttributes( { authorTitle: value } );
								},
								placeholder: __( 'Author title', 'ndt4' ),
							} )
						)
					)
				);
			};

			// Render stacked variant.
			var renderStacked = function() {
				return el( 'blockquote', { className: blockquoteClasses },
					el( RichText, {
						tagName: 'p',
						value: attributes.quote,
						allowedFormats: [ 'core/bold', 'core/italic' ],
						onChange: function( value ) {
							setAttributes( { quote: value } );
						},
						placeholder: __( 'Enter quote text…', 'ndt4' ),
					} ),
					el( 'div', { className: 'byline' },
						el( 'figure', { className: avatarClass },
							attributes.imageUrl
								? el( 'img', {
									src: attributes.imageUrl,
									alt: attributes.authorName || '',
								} )
								: el( MediaUploadCheck, null,
									el( MediaUpload, {
										onSelect: onSelectImage,
										allowedTypes: [ 'image' ],
										value: attributes.imageId,
										render: function( obj ) {
											return el( Button, {
												onClick: obj.open,
												className: 'button button-small',
											}, __( 'Add', 'ndt4' ) );
										},
									} )
								)
						),
						el( 'div', { className: 'byline-body' },
							el( RichText, {
								tagName: 'p',
								className: 'byline-title person-name',
								value: attributes.authorName,
								allowedFormats: [],
								onChange: function( value ) {
									setAttributes( { authorName: value } );
								},
								placeholder: __( 'Author name', 'ndt4' ),
							} ),
							el( RichText, {
								tagName: 'p',
								className: 'person-title',
								value: attributes.authorTitle,
								allowedFormats: [],
								onChange: function( value ) {
									setAttributes( { authorTitle: value } );
								},
								placeholder: __( 'Author title', 'ndt4' ),
							} )
						)
					)
				);
			};

			return el( 'div', blockProps,
				el( InspectorControls, null,
					el( PanelBody, { title: __( 'Blockquote Settings', 'ndt4' ), initialOpen: true },
						el( SelectControl, {
							label: __( 'Variant', 'ndt4' ),
							value: attributes.variant,
							options: [
								{ label: __( 'Inline', 'ndt4' ), value: 'inline' },
								{ label: __( 'Stacked', 'ndt4' ), value: 'stacked' },
							],
							onChange: function( value ) {
								setAttributes( { variant: value } );
							},
						} ),
						el( ToggleControl, {
							label: __( 'Reversed', 'ndt4' ),
							checked: attributes.reversed,
							onChange: function( value ) {
								setAttributes( { reversed: value } );
							},
						} ),
						attributes.imageUrl && el( 'div', { style: { marginTop: '16px' } },
							el( Button, {
								onClick: onRemoveImage,
								isDestructive: true,
							}, __( 'Remove Image', 'ndt4' ) )
						)
					)
				),
				attributes.variant === 'stacked' ? renderStacked() : renderInline()
			);
		},

		save: function() {
			return null;
		},
	} );
} )( window.wp );
