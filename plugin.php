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
	$(function() {
		if ($('#disqus_thread').length) {
			var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			dsq.src = 'http://{$this->data->shortname}.disqus.com/embed.js';
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		}
	});
</script>
OUT;

	}
}
