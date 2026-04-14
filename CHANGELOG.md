# Change Log

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