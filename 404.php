<?php
  ll_include_component(
    'one-column',
    array(
      'columns' => array(
        0 => array(
          'content' => "<h1 class='h2'>Sorry, but the page you were trying to view does not exist.</h1><p>It looks like this was the result of either:</p><ul><li>a mistyped address</li><li>an out-of-date link</li></ul>"
        ),
      ),
      'alignment' => 'left',
      'size' => 'small',
      'indent' => false
    ),
    array(
      'classes' => array( 'is-first', 'spacing-top-medium', 'spacing-bottom-medium' )
    )
  );
?>
