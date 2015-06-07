		</div>
		<footer>
			<div class="container">
				<p>&copy; 2015 <a href="<?php echo base_url(); ?>">PPDB SIDOARJO 2015</a> | <a href="http://www.dispendiksidoarjo.net/" target="_blank">DINAS KABUPATEN SIDOARJO</a></p>
			</div>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>static/js/bootstrap.js"></script>
		<?php if (!empty($footer_scripts)) {
			foreach ($footer_scripts as $url) { ?>
				<script type="text/javascript" src="<?php echo $url; ?>"></script>
				<?php }
			}
		?>
	</body>
</html>