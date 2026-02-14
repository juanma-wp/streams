# JuanMa DevRel - WordPress Block Theme

A minimalist, modern block theme designed for developer relations professionals and technical content creators. Features a clean bento grid layout, sophisticated typography, and a focus on content presentation.

## Features

- ✅ **Full Site Editing (FSE)**: Built entirely with blocks
- 🎨 **Modern Design System**: Zinc-based color palette with careful attention to typography
- 📱 **Fully Responsive**: Mobile-first design that works on all devices
- ⚡ **Performance Focused**: Minimal dependencies, optimized assets
- 🎯 **Accessible**: Semantic HTML and ARIA-compliant markup
- 🔧 **Customizable**: Extensive theme.json configuration

## Design System

### Typography
- **Font Family**: Inter (fallback to system fonts)
- **Font Sizes**: 7 preset sizes from 0.75rem to 3rem
- **Font Weights**: 300, 400, 500, 600

### Colors
- **Zinc Palette**: 8 shades for neutral tones (50, 100, 200, 300, 400, 500, 600, 900)
- **Accent Colors**: Emerald for status indicators, Blue for interactive elements
- **High Contrast**: Ensures WCAG AA compliance

### Spacing
- **Content Width**: 72rem (1152px)
- **Spacing Scale**: 6 preset sizes from 0.5rem to 5rem
- **Consistent Gaps**: 1.5rem grid system

## Patterns

The theme includes several reusable patterns:

- **Hero Section**: Large heading with status badge and social links
- **Featured Card**: Prominent article card spanning 2 columns
- **Stack Card**: Dark-themed card for showcasing tech stack
- **Article Card**: Standard blog post card
- **Newsletter Section**: Email subscription form

## Templates

- `index.html` - Main homepage template with bento grid layout
- `parts/header.html` - Sticky header with navigation
- `parts/footer.html` - Simple footer with copyright and links

## Installation

1. Download or clone this theme to your WordPress themes directory:
   ```
   wp-content/themes/juanma-devrel/
   ```

2. Activate the theme in WordPress Admin:
   - Go to **Appearance → Themes**
   - Find **JuanMa DevRel**
   - Click **Activate**

3. (Optional) Import demo content:
   - Go to **Appearance → Editor**
   - Customize patterns and templates as needed

## Customization

### Site Editor
The entire theme can be customized through the WordPress Site Editor:
- **Appearance → Editor** to access templates and patterns
- **Styles** to modify colors, typography, and spacing
- **Templates** to edit page layouts
- **Patterns** to modify reusable content blocks

### theme.json
For advanced customization, edit `theme.json` to modify:
- Color palette
- Typography scale
- Spacing presets
- Block settings
- Global styles

### Custom CSS
Additional styles can be added in:
- `functions.php` (via `wp_add_inline_style`)
- **Appearance → Customize → Additional CSS**

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Requirements

- WordPress 6.7 or higher
- PHP 7.4 or higher

## Converting to Query Loops

The article cards are currently hardcoded patterns. To convert to dynamic post queries:

1. Replace the hardcoded article cards in `templates/index.html` with a **Query Loop** block
2. Style the Query Loop using the same design tokens from theme.json
3. Create a post template part for consistent article card styling

## Credits

- **Design Inspiration**: Modern portfolio sites and developer-focused content platforms
- **Font**: [Inter](https://rsms.me/inter/) by Rasmus Andersson
- **Icons**: Inline SVGs adapted from Lucide Icons

## Support

For theme support, customization requests, or bug reports:
- Open an issue on GitHub
- Contact: [Your contact info]

## License

This theme is licensed under the GNU General Public License v2 or later.

## Changelog

### 1.0.0
- Initial release
- Full Site Editing support
- Bento grid homepage layout
- 5 reusable patterns
- Responsive design
- Modern design system with Inter typography
