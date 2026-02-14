<?php
/**
 * Title: Hero Section
 * Slug: juanma-devrel/hero-section
 * Categories: featured
 * Description: Hero section with status badge, heading, description, and social links
 */
?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"8rem","bottom":"5rem"}}},"layout":{"type":"constrained","contentSize":"48rem","justifyContent":"left"}} -->
<div class="wp-block-group" style="padding-top:8rem;padding-bottom:5rem">
    <!-- wp:group {"style":{"spacing":{"padding":{"top":"0.25rem","bottom":"0.25rem","left":"0.625rem","right":"0.625rem"},"blockGap":"0.5rem"},"border":{"radius":"9999px","width":"1px","color":"var:preset|color|zinc-200"}},"backgroundColor":"zinc-50","layout":{"type":"flex","flexWrap":"nowrap"}} -->
    <div class="wp-block-group has-border-color has-zinc-50-background-color has-background" style="border-color:var(--wp--preset--color--zinc-200);border-width:1px;border-radius:9999px;padding-top:0.25rem;padding-right:0.625rem;padding-bottom:0.25rem;padding-left:0.625rem">
        <!-- wp:html -->
        <span style="position: relative; display: flex; height: 0.5rem; width: 0.5rem;">
            <span style="animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite; position: absolute; display: inline-flex; height: 100%; width: 100%; border-radius: 9999px; background-color: #34d399; opacity: 0.75;"></span>
            <span style="position: relative; display: inline-flex; border-radius: 9999px; height: 0.5rem; width: 0.5rem; background-color: #10b981;"></span>
        </span>
        <!-- /wp:html -->

        <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","fontWeight":"500","textTransform":"uppercase","letterSpacing":"0.05em"}},"textColor":"zinc-600"} -->
        <p class="has-zinc-600-color has-text-color" style="font-size:0.75rem;font-weight:500;letter-spacing:0.05em;text-transform:uppercase">Available for speaking</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->

    <!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"1.5rem","bottom":"1.5rem"}},"typography":{"fontSize":"3rem","fontWeight":"500","lineHeight":"1.1"}}} -->
    <h1 style="margin-top:1.5rem;margin-bottom:1.5rem;font-size:3rem;font-weight:500;line-height:1.1">Developer Relations Advocate at Automattic. Exploring the intersection of community, code, and WordPress.</h1>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.125rem","fontWeight":"300","lineHeight":"1.7"}},"textColor":"zinc-500"} -->
    <p class="has-zinc-500-color has-text-color" style="font-size:1.125rem;font-weight:300;line-height:1.7">I help developers build better experiences. Currently focused on the future of block-based editing and contributing to the open web.</p>
    <!-- /wp:paragraph -->

    <!-- wp:social-links {"iconColor":"zinc-400","iconColorValue":"#a1a1aa","style":{"spacing":{"blockGap":"1rem","margin":{"top":"2rem"}}},"className":"is-style-logos-only"} -->
    <ul class="wp-block-social-links has-icon-color is-style-logos-only" style="margin-top:2rem">
        <!-- wp:social-link {"url":"#","service":"twitter"} /-->
        <!-- wp:social-link {"url":"#","service":"github"} /-->
        <!-- wp:social-link {"url":"#","service":"linkedin"} /-->
    </ul>
    <!-- /wp:social-links -->
</div>
<!-- /wp:group -->
