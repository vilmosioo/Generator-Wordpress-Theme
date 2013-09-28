			</div>
		</div><!--#main-->

		<footer role="contentinfo">
			<div class='container clearfix'>
				<?php dynamic_sidebar('Footer'); ?>
				<div class='clear'></div>
				<hr/>
				<div class='fright'>
					<?php wp_nav_menu( array('menu' => 'Main', 'container' => false, )); ?>
				</div>
				<p>Copyright Vilmos Ioo <?php echo date('Y');?></p>
			</div>
		</footer>

		<!--[if lt IE 7 ]>
		  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); ?>
		
		<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo THEME_PATH; ?>/components/jquery/jquery.min.js"%3E%3C/script%3E'))</script>
		<script> // Change UA-XXXXX-X to be your site's ID
			window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
			Modernizr.load({
			  load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
			});
		</script>
	</body>
</html>
