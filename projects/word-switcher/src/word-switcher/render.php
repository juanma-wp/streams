<?php

/*
$content
$attributes
$block_instance
*/

$processor = new WP_HTML_Tag_Processor($content);

if ($processor->next_tag(['tag_name' => 'div', 'class_name' => 'wp-block-streams-april-word-switcher'])) {

	$processor->set_bookmark("parent");

	$words = [];

	while ($processor->next_tag(['tag_name' => 'span', 'class_name' => 'word-switcher'])) {
		$processor->set_attribute("data-wp-text", "state.currentWord");
		$processor->set_attribute("data-wp-class--fade", "context.isFading");

		if ($processor->next_token()) {
			$text_content = $processor->get_modifiable_text();
			if ($text_content) {
				$words = array_map('trim', explode(',', $text_content));
				$words = array_filter($words);
			}
		}
	}

	$processor->seek("parent");

	$processor->set_attribute("data-wp-interactive", "streams-april/word-switcher");
	$processor->set_attribute("data-wp-init", "callbacks.init");
	$processor->set_attribute("data-wp-context", json_encode([
		"words" => $words,
		"currentIndex" => 0,
		"isFading" => false
	]));
}
?>
<pre>
<?php
echo $content;
echo $attributes;
?>
</pre>
<?php
echo $processor->get_updated_html();
