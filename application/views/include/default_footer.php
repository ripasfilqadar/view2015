			</div>
		</div>
		<footer>
			<div class="container">
				<p>&copy; 2015 <a href="<?php echo base_url(); ?>">PPDB SIDOARJO 2015</a> | <a href="http://www.dispendiksidoarjo.net/" target="_blank">DINAS KABUPATEN SIDOARJO</a></p>
			</div>
		</footer>
		<script src="<?php echo base_url(); ?>static/js/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>static/js/bootstrap.js"></script>
		<?php if (!empty($footer_scripts)) {
			foreach ($footer_scripts as $url) { ?>
				<script type="text/javascript" src="<?php echo $url; ?>"></script>
				<?php }
			}
		?>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-63931061-1', 'auto');
			ga('send', 'pageview');
		</script>
	</body>
</html>
