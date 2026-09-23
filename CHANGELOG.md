# Change Log

## [1.0.5] 2026-09-23

- NEW: Define `window.NDTConductorHost` before `ndt.js` loads, for Conductor's cookie handling
- NEW: Back to Top button is output in the footer when enabled in **Customize → Content Options** (now off by default)
- NEW: `ndt4_register_layout()` accepts `has_sidebar`, and `ndt4_layout_has_sidebar()` is filterable
- FIX: Button List block now saves its inner Button blocks; previously they were lost on save and nothing rendered on the front end
- FIX: Card block shows the image on the Featured variant to match the editor, skips an empty title, and no longer shows a stray "0" in the Image panel
- FIX: Button block no longer renders with an empty `href`, and can only be inserted inside a Button List
- FIX: Customizer live preview for the site title and tagline; settings whose markup is omitted when empty (tagline toggle, footer, contact, social) now refresh the preview
- FIX: Home icon setting defaults to on, matching what the header already rendered
- FIX: Address is saved as plain text and keeps its line breaks in the footer and JSON-LD
- FIX: Top-nav section subnav no longer nests child pages inside an unclosed `<li>`
- FIX: Duplicate menu and menu item IDs from the global-menu copy of the side nav
- FIX: Posts page menu item is no longer highlighted on search results and 404 pages
- FIX: Single posts and pages no longer render an empty `.page-sidebar`
- FIX: X and Email share buttons pointed to icons that don't exist
- FIX: `ndt4_entry_footer()` left its `<ul>` unclosed
- FIX: Breadcrumbs showed a literal `<span>` on custom post type and custom taxonomy archives
- FIX: Skip-to-navigation link is only output when its target exists
- FIX: Sidebar search form submitted to `/search/` instead of the site root
- FIX: Global-menu dialog has an accessible name; dialog and search form strings are translatable
- FIX: Smooth scroll works with IDs that start with a digit (e.g. footnotes) and is no longer cancelled by focus
- FIX: Full-width blocks no longer cause horizontal scroll when the scrollbar takes up space
- FIX: `NDT4_VERSION` reads the parent theme's version, so assets are cache-busted under a child theme
- FIX: Editor sidebar script no longer loads in the block widgets editor
- FIX: JSON-LD organization name no longer contains HTML entities
- FIX: Top-nav Home item is detected by URL instead of the title "Home"
- FIX: Default widgets no longer overwrite existing widget instances on theme activation
- CHANGE: Requires WordPress 6.6, matching theme.json version 3
- REMOVE: Default Social Share Image Customizer setting, which was never used
- REMOVE: Unused templates and template parts (`sidebar.php`, `template-parts/content/*`, `template-parts/header/*`, `template-parts/footer/*`, `nav-mobile.php`, `nav-global-menu.php`) and `assets/js/navigation.js`, which targeted markup the theme doesn't render

## [1.0.4] 2026-08-07

- FIX: Side navigation now renders in the sidebar on the Posts page, archives, search results, and 404. `do_action()` with no arguments passes an empty string to callbacks, which overrode `ndt4_render_nav_sidebar()`'s `$nav_part` default on templates registering it by name; layout hooks now register with `accepted_args = 0`
- REMOVE: Unused `template-parts/navigation/nav-side.php`, which contained a duplicate `NDT4_Side_Nav_Walker` definition that would fatal if the file were ever loaded

## [1.0.3] 2026-07-14

- FIX: Add .page-image style to theme.css to prevent WordPress base styles from breaking margin on container-sized feature images

## [1.0.2] - 2026-04-14

- NEW: Single post template now emits schema-rich `NewsArticle` markup — outer `<article typeof="NewsArticle">` spans header/primary/footer/sidebar, with `property="headline"`, `datePublished`, author, `image`, `dateModified`, publisher, `mainEntityOfPage`, and a `.page-secondary.article-footer` share block between `.page-primary` and `.page-sidebar`
- NEW: Posts page (`index.php`) listing cards include a `.article-meta` block with `datePublished`, linked author, image, `dateModified`, and publisher schema between the card title and excerpt; `typeof="Article"` on the listing wrapper
- NEW: `ndt4_register_layout()` now accepts `primary_attrs` (associative array) which flows through a new `ndt4_page_primary_attrs` filter rendered by `header.php`; used by single posts to add `property="mainEntityOfPage"` directly to `.page-primary`
- NEW: `.article-page-wrapper { display: contents }` keeps the outer `<article>` semantic without breaking Conductor's grid, which operates on direct children of `.site-content`
- NEW: Post navigation and comment consent label style tweaks
- NEW: Plugin dark-mode opt-out — popular plugins (The Events Calendar, WooCommerce, Contact Form 7, Gravity Forms, WPForms, Ninja Forms, MailChimp, bbPress, BuddyPress, Elementor, LearnDash, EDD, Smash Balloon, Beaver Builder, Jetpack Forms, WP Recipe Maker, TablePress) now render against a white panel with `color-scheme: light` when the site is in dark mode, since most plugins don't honor light/dark themes
- REMOVE: News CPT (`ndt4_news`), News Category taxonomy (`ndt4_news_category`), and all related templates, template parts, customizer setting, pattern, and pattern category. Themes shouldn't define content types — switching themes orphans CPT content. Sites that need a "News" stream should use built-in Posts (rename the menu label if desired) or a companion plugin.
- CHANGE: `ndt4-news-thumb` image size renamed to `ndt4-list-thumb` (now used by generic post lists in `index.php` / `archive.php`)
- CHANGE: 404 page's "Recent News" widget now shows recent Posts
- FIX: CPT singles (e.g. an individual event) now mark the menu item pointing at the CPT archive as `current-menu-ancestor` so the parent nav item highlights correctly
- FIX: Posts page menu item no longer falsely flagged as the active parent on CPT archives, CPT singles, and custom-taxonomy archives
- FIX: Suppress Conductor's auto-detected external-link icon on links that aren't explicitly marked external (`target="_blank"`, `rel="external"`, or `.external-link`); avoids false positives on absolute internal URLs emitted by WordPress and plugins
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