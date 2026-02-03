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
	var TextControl = wp.components.TextControl;
	var ToggleControl = wp.components.ToggleControl;
	var Button = wp.components.Button;
	var __ = wp.i18n.__;

	registerBlockType( 'ndt4/card', {
		edit: function( props ) {
			var attributes = props.attributes;
			var setAttributes = props.setAttributes;
			var isFeatured = attributes.variant === 'featured';
			var showImage = isFeatured || attributes.showImage;

			// Build card classes.
			var cardClasses = 'card';
			switch ( attributes.variant ) {
				case 'horizontal':
					cardClasses += ' card--horizontal';
					break;
				case 'stacked':
					cardClasses += ' card--stacked';
					break;
				case 'featured':
					cardClasses += ' card--featured';
					break;
			}
			if ( attributes.backgroundColor && attributes.backgroundColor !== 'none' ) {
				cardClasses += ' bg--' + attributes.backgroundColor;
			}

			var blockProps = useBlockProps();

			var onSelectImage = function( media ) {
				setAttributes( {
					imageId: media.id,
					imageUrl: media.url,
					imageAlt: media.alt || '',
				} );
			};

			var onRemoveImage = function() {
				setAttributes( {
					imageId: 0,
					imageUrl: '',
					imageAlt: '',
				} );
			};

			// Sidebar controls.
			var inspectorControls = el( InspectorControls, null,
				el( PanelBody, { title: __( 'Card Settings', 'ndt4' ), initialOpen: true },
					el( SelectControl, {
						label: __( 'Variant', 'ndt4' ),
						value: attributes.variant,
						options: [
							{ label: __( 'Default', 'ndt4' ), value: 'default' },
							{ label: __( 'Horizontal', 'ndt4' ), value: 'horizontal' },
							{ label: __( 'Stacked', 'ndt4' ), value: 'stacked' },
							{ label: __( 'Featured', 'ndt4' ), value: 'featured' },
						],
						onChange: function( value ) {
							setAttributes( { variant: value } );
						},
					} ),
					el( SelectControl, {
						label: __( 'Heading Tag', 'ndt4' ),
						value: attributes.headingTag,
						options: [
							{ label: 'H2', value: 'h2' },
							{ label: 'H3', value: 'h3' },
							{ label: 'H4', value: 'h4' },
							{ label: 'H5', value: 'h5' },
							{ label: 'H6', value: 'h6' },
						],
						onChange: function( value ) {
							setAttributes( { headingTag: value } );
						},
					} ),
					el( SelectControl, {
						label: __( 'Background Color', 'ndt4' ),
						value: attributes.backgroundColor,
						options: [
							{ label: __( 'None', 'ndt4' ), value: 'none' },
							{ label: __( 'Sky Blue Light', 'ndt4' ), value: 'sky-blue-light' },
							{ label: __( 'Brand Blue', 'ndt4' ), value: 'brand-blue' },
							{ label: __( 'Green Spring', 'ndt4' ), value: 'green-spring' },
							{ label: __( 'Gold', 'ndt4' ), value: 'gold' },
							{ label: __( 'Warm White', 'ndt4' ), value: 'warm-white' },
						],
						onChange: function( value ) {
							setAttributes( { backgroundColor: value } );
						},
					} ),
					! isFeatured && el( ToggleControl, {
						label: __( 'Show Image', 'ndt4' ),
						checked: attributes.showImage,
						onChange: function( value ) {
							setAttributes( { showImage: value } );
						},
					} ),
					el( TextControl, {
						label: __( 'Card Label', 'ndt4' ),
						value: attributes.label,
						onChange: function( value ) {
							setAttributes( { label: value } );
						},
					} ),
					el( TextControl, {
						label: __( 'Card Link URL', 'ndt4' ),
						value: attributes.link,
						onChange: function( value ) {
							setAttributes( { link: value } );
						},
						type: 'url',
					} )
				),
				showImage && el( PanelBody, { title: __( 'Image', 'ndt4' ), initialOpen: false },
					el( MediaUploadCheck, null,
						el( MediaUpload, {
							onSelect: onSelectImage,
							allowedTypes: [ 'image' ],
							value: attributes.imageId,
							render: function( obj ) {
								return el( Button, {
									onClick: obj.open,
									variant: 'secondary',
								}, attributes.imageId ? __( 'Replace Image', 'ndt4' ) : __( 'Select Image', 'ndt4' ) );
							},
						} )
					),
					attributes.imageId && el( Button, {
						onClick: onRemoveImage,
						variant: 'link',
						isDestructive: true,
						style: { marginTop: '8px', display: 'block' },
					}, __( 'Remove Image', 'ndt4' ) )
				)
			);

			// Image element.
			var imageElement = null;
			if ( showImage ) {
				var imageContent;
				if ( attributes.imageUrl ) {
					imageContent = el( MediaUploadCheck, null,
						el( MediaUpload, {
							onSelect: onSelectImage,
							allowedTypes: [ 'image' ],
							value: attributes.imageId,
							render: function( obj ) {
								return el( 'img', {
									src: attributes.imageUrl,
									alt: attributes.imageAlt || '',
									onClick: obj.open,
									style: { cursor: 'pointer', display: 'block', width: '100%', height: 'auto' },
								} );
							},
						} )
					);
				} else {
					imageContent = el( MediaUploadCheck, null,
						el( MediaUpload, {
							onSelect: onSelectImage,
							allowedTypes: [ 'image' ],
							value: attributes.imageId,
							render: function( obj ) {
								return el( Button, {
									onClick: obj.open,
									className: 'ndt4-card-image-placeholder',
									style: {
										display: 'flex',
										alignItems: 'center',
										justifyContent: 'center',
										minHeight: '150px',
										width: '100%',
										background: '#f0f0f0',
										border: '2px dashed #ccc',
										color: '#666',
										fontSize: '14px',
									},
								}, __( 'Select Image', 'ndt4' ) );
							},
						} )
					);
				}
				imageElement = el( 'figure', { className: 'card-image' }, imageContent );
			}

			// Card body.
			var cardBody = el( 'div', { className: 'card-body' },
				attributes.label && el( 'p', { className: 'card-label' },
					isFeatured ? el( 'span', null, attributes.label ) : attributes.label
				),
				el( RichText, {
					tagName: attributes.headingTag,
					className: 'card-title',
					value: attributes.title,
					allowedFormats: [],
					onChange: function( value ) {
						setAttributes( { title: value } );
					},
					placeholder: __( 'Card Title', 'ndt4' ),
				} ),
				! isFeatured && el( RichText, {
					tagName: 'p',
					className: 'card-summary',
					value: attributes.summary,
					allowedFormats: [],
					onChange: function( value ) {
						setAttributes( { summary: value } );
					},
					placeholder: __( 'Card summary text...', 'ndt4' ),
				} )
			);

			// Full block output.
			return el( 'div', blockProps,
				inspectorControls,
				el( 'div', { className: 'card-container' },
					el( 'div', { className: cardClasses },
						imageElement,
						cardBody
					)
				)
			);
		},

		save: function() {
			return null;
		},
	} );
} )( window.wp );
