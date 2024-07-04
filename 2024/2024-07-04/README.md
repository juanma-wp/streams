# 2024-07-04

> Como aprovechar al máximo los [Core Blocks](https://developer.wordpress.org/block-editor/reference-guides/core-blocks/) (revisando los que hay disponibles y cómo podemos expandirlos). Block Variations, Block Style Variations y filtros en cliente entre otras cosas

**Recursos**
- Repos que expanden core-blocks
  - https://github.com/ryanwelcher/advanced-query-loop
  - https://github.com/ndiego/enable-button-icons
  - https://github.com/t-hamano/enable-responsive-image 
  
- [Developer Hours](https://www.youtube.com/watch?v=OyYdkXAx7qw&list=PL1pJFUVKQ7ETApyQQlt3pLNjPx2HrQwl5)
  - [Developer Hours: How to extend Core WordPress blocks](https://www.youtube.com/watch?v=M9KKpIgNMNQ&list=PL1pJFUVKQ7ETApyQQlt3pLNjPx2HrQwl5&index=13)
    - Notas del evento: [How to extend core WordPress blocks](https://docs.google.com/document/d/1Dlko3wxaUeIAfh-gBHwUjOORqcaTXx8SiCkyo5-Ke3I/edit#heading=h.d22cu7925a4z)
- Posts en Blogs
  - [How to modify block supports using client-side filters](https://nickdiego.com/how-to-modify-block-supports-using-client-side-filters/)

## Block Styles

### [`register_block_style`](https://developer.wordpress.org/reference/functions/register_block_style/) (PHP)

- https://github.com/WordPress/block-theme-examples/blob/df4445fb96dc18ea54ce8ac91cd2aed8954b3e58/example-block-style-php/functions.php#L21
- https://github.com/WordPress/wordpress-develop/blob/80b7747ef165dd5ed0150003a8c2f957f097609e/src/wp-content/themes/twentytwentyfour/functions.php#L24

### [`registerBlockStyle`](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-styles/) (JS)

- https://github.com/WordPress/block-theme-examples/blob/df4445fb96dc18ea54ce8ac91cd2aed8954b3e58/example-block-style-js/assets/js/block-styles.js#L2

### [`wp_enqueue_block_style`](https://developer.wordpress.org/reference/functions/wp_enqueue_block_style/) (PHP)

- https://github.com/WordPress/block-theme-examples/blob/df4445fb96dc18ea54ce8ac91cd2aed8954b3e58/example-block-stylesheet/functions.php#L22

https://github.com/WordPress/block-theme-examples/blob/df4445fb96dc18ea54ce8ac91cd2aed8954b3e58/example-block-style-js/assets/js/block-styles.js#L2

## Block Variations 

- [Block Editor Handbook > Reference Guides > Block API Reference > Variations](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/)
- [WordPress Hallway Hangout: Let’s explore the power of block variations](https://www.youtube.com/watch?v=nYmPLCNiqzw&list=PL1pJFUVKQ7ESY-3rCwwYSAdNsEj2W7cJi&index=3)

### [`registerBlockVariation`](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/#creating-a-block-variation)

```
wp.blocks.registerBlockVariation( 'core/embed', {
    name: 'custom-embed',
    attributes: { providerNameSlug: 'custom' },
} );
```

- https://github.com/wordpress-juanmaguitar/block-variations-demo/blob/main/variations.js
- https://github.com/ryanwelcher/advanced-query-loop/blob/71a613cd0823a732b38c65ebd17237583fbf9f0a/src/variations/index.js#L15

## Filters

Syntax for filters is:

```
const { addFilter } = wp.hooks;

addFilter( 'hookName', 'namespace', callback, priority );
```

### [`blocks.registerBlockType`](https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#blocks-registerblocktype)

To filter the block settings when registering the block on the client with JavaScript. 

Para aumentar/modificar atributos 

- https://github.com/ndiego/enable-button-icons/blob/main/src/index.js#L191
- https://github.com/ryanwelcher/advanced-query-loop/blob/71a613cd0823a732b38c65ebd17237583fbf9f0a/src/variations/controls.js#L140


### [`editor.BlockEdit`](https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#editor-blockedit)

To modify the block’s edit component.

- https://github.com/ndiego/enable-button-icons/blob/1aa21d072d6ab54afc73a5d694c59291e8c3121f/src/index.js#L269C3-L269C19


### [`editor.BlockListBlock`](https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#editor-blocklistblock)

Para modificar el [wrapper del block ](https://developer.wordpress.org/block-editor/getting-started/fundamentals/block-wrapper/)

- https://github.com/ndiego/enable-button-icons/blob/1aa21d072d6ab54afc73a5d694c59291e8c3121f/src/index.js#L298C3-L298C24