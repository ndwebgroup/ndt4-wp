# Change Log

## [1.0.2] - 2026-04-14

- NEW: Plugin-agnostic layout shell — `.page-primary` wrapper now lives in `header.php`/`footer.php`; theme templates inject `.page-header`/`.page-sidebar` via `ndt4_before_main_content`/`ndt4_after_main_content` hooks
- NEW: `ndt4_register_layout()` helper for templates to declare header/sidebar callbacks and primary class modifiers in one call
- NEW: Blockquote block — `imageAlt` attribute with editor field; alt text auto-seeds from media library and falls back to author name
- FIX: The Events Calendar (and other plugin) archive/single templates now lay out correctly inside the Conductor grid
- FIX: News archive/single templates no longer emit a nested `<main>` element
- FIX: Single posts had `.page-sidebar` rendered before `.page-header` in source order
- FIX: Archive, search, 404, and Posts page now get `page--full-width` body class and `block-center` automatically when no sidebar is rendered
- FIX: Search query output now properly escaped in `search.php`
- FIX: Side-nav walker now matches the same active-class variants as the top-nav walker
- FIX: Schema.org social URLs validated via `esc_url_raw()`
- FIX: Card block background-color class now validated against an allow-list
- CHANGE: Button block default link is `''` instead of `'#'`; editor shows a "Required" hint
- CHANGE: News archive uses `.page-header`/`.page-title-wrapper` markup matching `page.php`
- REMOVE: Dead `ndt4_animate` enqueue and orphan `assets/css/animate.css`
- REMOVE: Unused `nonce` and `ajaxUrl` from `ndt4Data` localized script
- REMOVE: Dead `$root_aria` variable in `nav-subnav.php`

## [1.0.1] - 2026-02-16

- FIX: Sticky nav hover class
- FIX: Remove functions that were disabling default block styles
- CHANGE: Posted/Updated dates visual styles
- CHANGE: Search results heading styles