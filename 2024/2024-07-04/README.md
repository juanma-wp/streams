# 2024-07-04

> Como aprovechar al máximo los [Core Blocks](https://developer.wordpress.org/block-editor/reference-guides/core-blocks/) (revisando los que hay disponibles y cómo podemos expandirlos). Block Variations, Block Style Variations y filtros en cliente entre otras cosas

## Block Variations 

- [Block Editor Handbook > Reference Guides > Block API Reference > Variations](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/)

### [`registerBlockVariation`](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/#creating-a-block-variation)

```
wp.blocks.registerBlockVariation( 'core/embed', {
    name: 'custom-embed',
    attributes: { providerNameSlug: 'custom' },
} );
```

- https://github.com/wordpress-juanmaguitar/block-variations-demo/blob/main/variations.js

## Filters

### [`blocks.registerBlockType`](https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#blocks-registerblocktype)

To filter the block settings when registering the block on the client with JavaScript. 

Para aumentar/modificar atributos 

- https://github.com/ndiego/enable-button-icons/blob/main/src/index.js#L191


### [`editor.BlockEdit`](https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#editor-blockedit)

To modify the block’s edit component.


