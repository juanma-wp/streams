=== PHP Version Ability ===
Contributors: your-username
Tags: abilities, php, version, system-info, rest-api
Requires at least: 6.9
Tested up to: 6.9
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Registers an ability that returns the PHP version running on the WordPress instance.

== Description ==

This plugin uses the WordPress Abilities API to register a system information ability that exposes the PHP version running on your WordPress instance.

The ability is:
- **ID**: `system-info/php-version`
- **Category**: `system-info` (System Information)
- **Readonly**: Yes (informational only)
- **REST Exposed**: Yes

= REST API Access =

Once activated, you can retrieve the PHP version via the REST API:

**Get all abilities:**
`GET /wp-json/wp-abilities/v1/abilities`

**Get the PHP version ability:**
`GET /wp-json/wp-abilities/v1/abilities/system-info/php-version`

The response will include the PHP version in the ability's data.

= JavaScript Usage =

You can also access this ability from JavaScript using the `@wordpress/abilities` package:

```javascript
import { useAbility } from '@wordpress/abilities';

function PhpVersionDisplay() {
    const phpVersion = useAbility('system-info/php-version');
    return <div>PHP Version: {phpVersion}</div>;
}
```

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/php-version-ability` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. The ability will be automatically registered and available via the REST API at `/wp-json/wp-abilities/v1/abilities/system-info/php-version`

== Frequently Asked Questions ==

= What is the WordPress Abilities API? =

The WordPress Abilities API is a core feature introduced in WordPress 6.9 that allows plugins and themes to register capabilities and information that can be queried by clients via REST API or JavaScript.

= Can I modify the PHP version through this ability? =

No, this ability is marked as `readonly: true`, which means it's for informational purposes only. It simply reports the current PHP version running on the server.

= What endpoints are available? =

- `/wp-json/wp-abilities/v1/abilities` - Lists all registered abilities
- `/wp-json/wp-abilities/v1/abilities/system-info/php-version` - Gets the PHP version ability
- `/wp-json/wp-abilities/v1/categories` - Lists all ability categories
- `/wp-json/wp-abilities/v1/categories/system-info` - Gets the system-info category

== Changelog ==

= 1.0.0 =
* Initial release
* Register PHP version ability
* Register system-info category
* Expose via REST API
