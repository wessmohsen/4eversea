    <?php
        /**
         * trendytravel_hook_content_after hook.
         * 
         */
        do_action( 'trendytravel_hook_content_after' );
    ?>

        <!-- **Footer** -->
        <footer id="footer">
            <div class="container">
            <?php
                /**
                 * trendytravel_footer hook.
                 * 
                 * @hooked trendytravel_vc_footer_template - 10
                 *
                 */
                do_action( 'trendytravel_footer' );
            ?>
            </div>
        </footer><!-- **Footer - End** -->

    </div><!-- **Inner Wrapper - End** -->
        
</div><!-- **Wrapper - End** -->
<?php
    
    do_action( 'trendytravel_hook_bottom' );

    wp_footer();
?>
</body>
</html>