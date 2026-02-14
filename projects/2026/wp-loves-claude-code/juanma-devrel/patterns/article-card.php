<?php
/**
 * Title: Article Card
 * Slug: juanma-devrel/article-card
 * Categories: featured
 * Description: Standard article card with date, title, excerpt, and link
 */
?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"0.75rem","width":"1px","color":"var:preset|color|zinc-200"}},"backgroundColor":"white","layout":{"type":"default"}} -->
<div class="wp-block-group has-border-color has-white-background-color has-background" style="border-color:var(--wp--preset--color--zinc-200);border-width:1px;border-radius:0.75rem;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","textTransform":"uppercase"}},"textColor":"zinc-400"} -->
    <p class="has-zinc-400-color has-text-color" style="font-size:0.75rem;text-transform:uppercase">Dec 3, 2025</p>
    <!-- /wp:paragraph -->

    <!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"1rem","bottom":"0.5rem"}},"typography":{"fontSize":"1.125rem","fontWeight":"600"}}} -->
    <h3 style="margin-top:1rem;margin-bottom:0.5rem;font-size:1.125rem;font-weight:600">WordPress 6.9 "Gene"</h3>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem","lineHeight":"1.7"}},"textColor":"zinc-500"} -->
    <p class="has-zinc-500-color has-text-color" style="font-size:0.875rem;line-height:1.7">Ayer se lanzó oficialmente la nueva versión de WordPress. Enhorabuena a los más de 900 contributors que la han hecho posible.</p>
    <!-- /wp:paragraph -->

    <!-- wp:group {"style":{"spacing":{"blockGap":"0.5rem","margin":{"top":"1rem"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
    <div class="wp-block-group" style="margin-top:1rem">
        <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","fontWeight":"500"}},"textColor":"zinc-900"} -->
        <p class="has-zinc-900-color has-text-color" style="font-size:0.75rem;font-weight:500"><a href="#">Release Notes</a></p>
        <!-- /wp:paragraph -->

        <!-- wp:html -->
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
        <!-- /wp:html -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->
