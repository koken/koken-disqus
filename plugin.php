<?php

class KokenDisqus extends KokenPlugin {

    function __construct()
	{
		$this->require_setup = true;
		$this->register_hook('before_closing_body', 'render_js');
		$this->register_hook('discussion', 'render_div');
	}

	function render_div()
	{
		echo '<div id="disqus_thread"></div>';
	}

	function render_js()
	{
		echo <<<OUT
<script type="text/javascript">
	(function() {
		var disqus = function() {
			if ($('#disqus_thread').length) {
				(function() {
					var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
					dsq.src = 'http://{$this->data->shortname}.disqus.com/embed.js';
					(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
				})();
			}
		}

		$(function() {
			if ($.pjax) {
				$(document).on('pjax.success', function() {
					window.setTimeout(function() {
						if (window.DISQUS && $('#disqus_thread').length) {
							window.DISQUS.reset({
								reload: true,
								config: function() {
									this.page.url = window.location.href;
								}
							});
						} else {
							disqus();
						}
					}, 250)
				});
			}
			disqus();
		});
	}());
</script>
OUT;

	}
}
