# Notre Dame Theme 4 for WordPress

A WordPress theme for the University of Notre Dame, featuring a hybrid architecture of PHP templates, block patterns, and custom blocks. All visual styling is provided by the external [NDT4 Webtheme](https://webtheme.nd.edu/).

## Requirements

- PHP 8.0 or higher
- WordPress 6.4 or higher

## Installation

1. Download or clone this theme to your `wp-content/themes/` directory
2. Activate the theme in **Appearance → Themes**
3. Configure theme options in **Appearance → Customize**

---

## For Site Administrators

### Navigation Modes

The theme supports two navigation styles, configured in **Customize → Navigation**:

- **Side Navigation** (default) — Full site menu appears in the sidebar
- **Top Navigation** — Horizontal menu in the header, with page hierarchy subnav in the sidebar

### Customizer Options

#### Navigation (Customize → Navigation)
- Navigation style (side or top)
- Show home icon in top navigation

#### Header (Customize → Site Identity)
- Site title and tagline
- Show/hide tagline
- Logo mark position (left or right)

#### Footer (Customize → Footer)
- Parent organization name and URL
- Grandparent organization name and URL

#### Contact Information (Customize → Contact)
- Address, phone, fax, email

#### Social Media (Customize → Social Media)
- Facebook, Twitter/X, Instagram, YouTube, LinkedIn URLs

#### Content Options (Customize → Content)
- Show images in news lists
- Show back-to-top button
- Default social share image

### Custom Blocks

The theme includes custom blocks available in the block editor under the **NDT4** category:

| Block | Description |
|-------|-------------|
| **Card** | Content card with image, label, title, and summary. Variants: default, horizontal, stacked, featured |
| **Card Grid (2-Up)** | Two-column grid of cards |
| **Card Grid (3-Up)** | Three-column grid of cards |
| **Button** | Styled button link with style options (base, CTA, more) and colors |
| **Button List** | Grouped list of buttons |
| **Blockquote** | Styled quote with attribution and optional avatar. Variants: inline, stacked |

### News

The theme includes a News custom post type accessible at `/news/`. News items support categories via the News Category taxonomy.

### Page Features

- **Page Lede** — Add introductory text below the page title via the Page Lede panel in the editor sidebar
- **Featured Images** — Displayed in the page header when set

---

## For Developers

### Important: Use as a Parent Theme

**Do not edit this theme directly.** Create a child theme for any customizations. This ensures your changes are preserved when the parent theme is updated.

### Creating a Child Theme

1. Create a new directory in `wp-content/themes/` (e.g., `ndt4-child`)

2. Create a `style.css` with the required header:

```css
/*
Theme Name: NDT4 Child
Template: ndt4-wp
Version: 4.0.0
*/
```

3. Create a `functions.php` to enqueue parent styles (if needed) and add customizations:

```php
<?php
declare(strict_types=1);

// Child theme setup
add_action('after_setup_theme', function(): void {
    // Your customizations here
});
```

4. Activate your child theme in **Appearance → Themes**

### Architecture Overview

- **Conductor Framework** — All visual styling comes from the external Conductor CSS/JS loaded from `conductor.nd.edu`. The theme handles structure and markup only. Do not add CSS that conflicts with Conductor classes.
- **No Build Step** — Custom blocks use `wp.element.createElement` directly (no JSX, no webpack)
- **Server-Side Rendering** — Blocks render via PHP (`render.php`) for frontend output
- **Minimal theme.json** — Contains settings only (editor color palette). No styles section.

### File Structure

```
ndt4-wp/
├── functions.php           # Core setup, enqueues, hooks
├── header.php / footer.php # Site header and footer
├── page.php                # Page template with sidebar logic
├── single.php              # Single post template
├── inc/                    # PHP includes (customizer, helpers, CPTs)
├── template-parts/         # Reusable template partials
├── blocks/                 # Custom block definitions
├── patterns/               # Block patterns
└── assets/                 # Theme CSS and JS
```

### Adding Custom Blocks in a Child Theme

1. Create a `blocks/` directory in your child theme
2. Register blocks on `init`:

```php
add_action('init', function(): void {
    register_block_type(__DIR__ . '/blocks/my-block');
});
```

3. Each block needs:
   - `block.json` — Block metadata and attributes
   - `index.js` — Editor script (using `createElement`)
   - `index.asset.php` — Script dependencies
   - `render.php` — Frontend rendering

### Hooks and Filters

The theme provides these for customization:

- `ndt4_body_classes` — Modify body classes
- Standard WordPress hooks for menus, customizer, etc.

### Local Development

Default local development URL: `http://ndt4.local/`

---

## Copyright

This theme and associated files are copyrighted, provided, and maintained by [ND Creative: Web](https://creative.nd.edu/web/) and the [University of Notre Dame](https://www.nd.edu/).