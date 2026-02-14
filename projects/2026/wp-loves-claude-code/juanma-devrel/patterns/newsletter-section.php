<?php
/**
 * Title: Newsletter Section
 * Slug: juanma-devrel/newsletter-section
 * Categories: call-to-action
 * Description: Newsletter signup section with form
 */
?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"},"margin":{"top":"5rem"}},"border":{"top":{"color":"var:preset|color|zinc-100","width":"1px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--zinc-100);border-top-width:1px;margin-top:5rem;padding-top:4rem;padding-bottom:4rem">
    <!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem","left":"2rem","right":"2rem"}},"border":{"radius":"1rem","width":"1px","color":"var:preset|color|zinc-200"}},"backgroundColor":"zinc-50","layout":{"type":"constrained","contentSize":"32rem"}} -->
    <div class="wp-block-group has-border-color has-zinc-50-background-color has-background" style="border-color:var(--wp--preset--color--zinc-200);border-width:1px;border-radius:1rem;padding-top:3rem;padding-right:2rem;padding-bottom:3rem;padding-left:2rem">
        <!-- wp:html -->
        <div style="text-align: center; margin-bottom: 1rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#18181b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto;"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        </div>
        <!-- /wp:html -->

        <!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"bottom":"0.5rem"}},"typography":{"fontSize":"1.5rem","fontWeight":"600"}}} -->
        <h2 class="has-text-align-center" style="margin-bottom:0.5rem;font-size:1.5rem;font-weight:600">Weekly Updates</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.875rem"}},"textColor":"zinc-500"} -->
        <p class="has-text-align-center has-zinc-500-color has-text-color" style="font-size:0.875rem">Get the latest insights on WordPress development and DevRel strategies delivered to your inbox. No spam, ever.</p>
        <!-- /wp:paragraph -->

        <!-- wp:group {"style":{"spacing":{"margin":{"top":"2rem"}}},"layout":{"type":"constrained","contentSize":"24rem"}} -->
        <div class="wp-block-group" style="margin-top:2rem">
            <!-- wp:html -->
            <form style="display: flex; flex-direction: column; gap: 0.75rem;">
                <input
                    type="email"
                    placeholder="your@email.com"
                    style="flex: 1; background: white; border: 1px solid #e4e4e7; border-radius: 0.5rem; padding: 0.625rem 1rem; font-size: 0.875rem; outline: none;"
                >
                <button
                    type="submit"
                    style="background: #18181b; color: white; font-size: 0.875rem; font-weight: 500; padding: 0.625rem 1.5rem; border-radius: 0.5rem; border: none; cursor: pointer; box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);"
                >
                    Subscribe
                </button>
            </form>
            <!-- /wp:html -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->
