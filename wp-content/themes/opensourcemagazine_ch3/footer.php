<footer>
	<?php if ( is_active_sidebar( 'footer-left-widget-area' ) ) : ?>
		<?php dynamic_sidebar( 'footer-left-widget-area' ); ?>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer-right-widget-area' ) ) : ?>
		<?php dynamic_sidebar( 'footer-right-widget-area' ); ?>
	<?php endif; ?>

	<div class="push"></div>

</footer>
</div><!--//#across-->
<?php wp_footer(); ?>
</body>
</html>