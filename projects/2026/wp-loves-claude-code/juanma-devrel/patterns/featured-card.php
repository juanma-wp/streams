<?php
/**
 * Title: Featured Article Card
 * Slug: juanma-devrel/featured-card
 * Categories: featured
 * Description: Large featured article card with date, title, and description
 */
?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"2rem","right":"2rem"}},"border":{"radius":"0.75rem","width":"1px","color":"var:preset|color|zinc-200"}},"backgroundColor":"zinc-50","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"space-between"}} -->
<div class="wp-block-group has-border-color has-zinc-50-background-color has-background" style="border-color:var(--wp--preset--color--zinc-200);border-width:1px;border-radius:0.75rem;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
    <!-- wp:group {"layout":{"type":"default"}} -->
    <div class="wp-block-group">
        <!-- wp:group {"style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
        <div class="wp-block-group">
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","fontWeight":"500","textTransform":"uppercase"}},"textColor":"zinc-500"} -->
            <p class="has-zinc-500-color has-text-color" style="font-size:0.75rem;font-weight:500;text-transform:uppercase">Featured</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem"}},"textColor":"zinc-300"} -->
            <p class="has-zinc-300-color has-text-color" style="font-size:0.75rem">•</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","textTransform":"uppercase"}},"textColor":"zinc-500"} -->
            <p class="has-zinc-500-color has-text-color" style="font-size:0.75rem;text-transform:uppercase">Dec 3, 2025</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->

        <!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0.75rem","bottom":"1rem"}},"typography":{"fontSize":"1.5rem","fontWeight":"600"}}} -->
        <h2 style="margin-top:0.75rem;margin-bottom:1rem;font-size:1.5rem;font-weight:600">State of the Word 2025</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"style":{"typography":{"fontSize":"1rem","fontWeight":"300","lineHeight":"1.7"}},"textColor":"zinc-500"} -->
        <p class="has-zinc-500-color has-text-color" style="font-size:1rem;font-weight:300;line-height:1.7">Ayer fue el evento "State of the Word", la keynote anual de WordPress. Y hoy nos hemos juntado Álvaro, Moncho y yo para comentar en vivo lo más relevante de los anuncios y el futuro de la comunidad.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->

    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem","fontWeight":"500"},"border":{"bottom":{"color":"var:preset|color|zinc-200","width":"1px"},"top":{},"right":{},"left":{}},"spacing":{"padding":{"bottom":"0.125rem"}}},"textColor":"zinc-900"} -->
    <p class="has-zinc-900-color has-text-color" style="border-bottom-color:var(--wp--preset--color--zinc-200);border-bottom-width:1px;padding-bottom:0.125rem;font-size:0.875rem;font-weight:500"><a href="#">Read full story</a></p>
    <!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
