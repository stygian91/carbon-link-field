# Installation

1. Browse to your theme directory
2. Call `composer require htmlburger/carbon-fields`
3. Edit the `functions.php` file
4. Add this code to the top of functions.php:
```
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
    Container::make( 'theme_options', __( 'Theme Options', 'crb' ) )
        ->add_fields( array(
            Field::make( 'link', 'crb_your_custom_field', 'Your Custom Field' ),
        ) );
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}
```
5. Edit the composer.json file to look like this:
```
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:stygian91/carbon-link-field.git"
        }
    ],
    "require": {
        "htmlburger/carbon-fields": "^2.1",
        "htmlburger/carbon-field-link": "dev-master"
    }
}
```
6. Call composer update to install your field from your repo

# Usage

When retrieving the field with the `carbon_get*_meta/theme_option` functions you'll recieve an array with the following strtucture:
```
array(3) {
  ["label"]  => string(12) "example link"
  ["link"]   => string(19) "https://example.com"
  ["target"] => bool(true)
}
```
If there's no value stored in the database an **empty string** will be returned instead of the array.

The link and label values are self-explanatory. The last value - target, signifies if the link should be opened in a new tab or not (`target="_blank/_self"`).

## Helpers
The following helper function has been added to print a link that follows the above data structure:

`crb_render_link( $link, $args )`

Arguments:

* link - an array describing the link with the data structure from above
* args - an array of additional arguments with the following format:
```php
[
    // strings that will be printed before and after the link, useful for wrapping:
    'before_link'  => '',
    'after_link'   => '',
    // strings that will be printed before and after the label, useful for wrapping the label
    'before_label' => '',
    'after_label'  => '',
    // space-separated list of classes that will be used for the `a` tag
    'classes'      => '',
]
```
