# Banner Block

A customizable banner component with title, text, optional image, background color, and call-to-action button.

## Files

- `block.json` - Block metadata and configuration
- `fields.php` - ACF field definitions for the block
- `template.php` - Frontend rendering template
- `style.css` - Frontend styles
- `editor.css` - Block editor styles

## Usage

1. The block will automatically appear in the "Seed Components" category in the block inserter
2. Add the block to any post or page
3. Configure the fields in the block sidebar:
   - **Title** (required) - Main heading text
   - **Text** - Description/body text
   - **Image** - Optional banner image
   - **Background Color** - Custom background color (default: white)
   - **Button Text** - Call-to-action button text
   - **Button Link** - URL for the button

## Template Variables

The `template.php` file receives these variables:
- `$fields` - Array of all ACF field values
- `$block` - The block data array
- `$is_preview` - Boolean indicating editor preview mode

## Theme Override

To override this block in your theme, create:
```
your-theme/seed-components/banner/
```

Then copy any files you want to override. The theme version will take precedence over the plugin version.

