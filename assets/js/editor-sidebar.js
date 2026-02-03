( function( wp ) {
	var PluginDocumentSettingPanel = wp.editPost.PluginDocumentSettingPanel;
	var TextareaControl = wp.components.TextareaControl;
	var useSelect = wp.data.useSelect;
	var useDispatch = wp.data.useDispatch;
	var createElement = wp.element.createElement;
	var registerPlugin = wp.plugins.registerPlugin;
	var __ = wp.i18n.__;

	function PageSettingsPanel() {
		var postType = useSelect( function( select ) {
			return select( 'core/editor' ).getCurrentPostType();
		}, [] );

		var meta = useSelect( function( select ) {
			return select( 'core/editor' ).getEditedPostAttribute( 'meta' ) || {};
		}, [] );

		var editPost = useDispatch( 'core/editor' ).editPost;

		if ( postType !== 'page' ) {
			return null;
		}

		var lede = meta.ndt4_page_lede || '';

		return createElement(
			PluginDocumentSettingPanel,
			{
				name: 'ndt4-page-lede',
				title: __( 'Page Lede', 'ndt4' ),
				className: 'ndt4-page-lede-panel',
			},
			createElement( TextareaControl, {
				label: __( 'Lede Text', 'ndt4' ),
				help: __( 'Introductory text displayed below the page title.', 'ndt4' ),
				value: lede,
				onChange: function( value ) {
					editPost( { meta: { ndt4_page_lede: value } } );
				},
			} )
		);
	}

	registerPlugin( 'ndt4-page-settings', {
		render: PageSettingsPanel,
		icon: null,
	} );
} )( window.wp );
