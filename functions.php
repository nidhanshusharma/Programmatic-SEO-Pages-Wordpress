<?php
function generate_author_rewrite_rules() {
  global $wp_rewrite;
  $new_rules = array(
	'(wppagename)/(.*?)/?$' => 'index.php?pagename='.
    $wp_rewrite->preg_index(1).'&varname='.
    $wp_rewrite->preg_index(2)
  );
  $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
  return $wp_rewrite->rules;
}

function query_vars($query_vars)
{
$query_vars[] = "varname";
return $query_vars;
}

add_filter( 'generate_rewrite_rules', 'generate_author_rewrite_rules' );
add_filter('query_vars', 'query_vars');
?>
