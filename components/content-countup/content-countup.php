<?php
/**
 * content countup
 * -----------------------------------------------------------------------------
 *
 * content countup component
 */

$defaults = [
  'sections' => array(
    0 => array(
      'number' => null,
      'append' => null,
      'content' => null
    )
  )
];

$component_data = ll_parse_args($component_data, $defaults);
?>

<?php
/**
 * Any additional classes to apply to the main component container.
 *
 * @var array
 * @see args['classes']
 */
$classes = isset($component_args['classes']) ? $component_args['classes'] : array();

/**
 * ID to apply to the main component container.
 *
 * @var array
 * @see args['id']
 */
$component_id = isset($component_args['id']) ? $component_args['id'] : '';

$sections = $component_data['sections'];
?>

<?php if (ll_empty($component_data))
  return; ?>
<div class="ll-content-countup <?php echo implode(" ", $classes); ?>" <?php echo ($component_id ? 'id="' . $component_id . '"' : '') ?> data-component="content-countup">

  <div class="container ll-content-countup__container row">

    <?php foreach ($sections as $key => $section): ?>

          <?php
          $number = $section['number'];
          $append = $section['append'];
          $content = $section['content'];
          ?>

          <div class="ll-content-countup__content-container col-md-1of3">

            <div class="countup-number-flex"><h6 class="ll-content-countup__number" data-count="<?php echo $number; ?>"><span class="counter-number">0</span></h6><h6><?php echo (! empty($append) ? $append : null); ?></h6></div>
            <p class="ll-content-countup__content"><?php echo $content; ?></p>

          </div>

    <?php endforeach ?>

  </div>

</div>
