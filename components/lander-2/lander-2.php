<?php
/**
 * Lander 2
 * -----------------------------------------------------------------------------
 *
 * Lander 2 component
 */

$defaults = [
  'content' => null,
  'image' => null,
  'video' => null
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
$classes = $component_args['classes'] ?: array();

/**
 * ID to apply to the main component container.
 *
 * @var array
 * @see args['id']
 */
$component_id = isset($component_args['id']) ? $component_args['id'] : '';


if ($component_data['image']) {
  $style = 'style="background-image: url( ' . $component_data['image']['url'] . ' );"';
} else {
  $style = '';
}

$hover_class = get_field('hover_style', 'option');

?>

<?php if (ll_empty($component_data))
  return; ?>
<div class="ll-lander-2 full-screen <?php echo implode(" ", $classes); ?>" <?php echo ($component_id ? 'id="' . $component_id . '"' : '') ?> data-component="lander-2">
  <div class="ll-lander-2__image" <?php echo $style; ?>>
      <?php if ($component_data['video']): ?>
          <?php
          ll_include_component(
            'loop-video',
            array(
              'video' => $component_data['video'],
              'fallback' => ''
            )
          );
          ?>
      <?php endif; ?>

  </div>
  <div class="ll-lander-2__content-wrap">
    <div class="container">

      <div class="ll-lander-2__content row row-justify-center" style="text-align:center;">
        <div class="col-full not-animated">
          <?php echo $component_data['content']; ?>
        </div>
      </div>

      <?php if ($component_data['blocks']): ?>
        <div class="ll-lander-2__blocks row animated-row">
          <?php foreach ($component_data['blocks'] as $key => $block): ?>
              <?php
              if ($hover_class == 'none' || (! $block['link'] && ! $block['text'])) {
                $hover_class = '';
              }
              ?>
              <div class="col-sm-1of3">
                <div class="ll-lander-2__block hover-image <?php echo $hover_class; ?>">
                  <div class="ll-lander-2__block__img hover-image__img animated-image" style="background-image: url( <?php echo $block['image']['url']; ?> );"></div>

                  <?php if ($hover_class == 'image-switch'): ?>
                      <div class="ll-lander-2__block__img hover-image__img-alt" style="background-image: url( <?php echo $block['hover_image']['url']; ?> );"></div>
                  <?php endif; ?>

                  <?php if ($block['link']): ?>
                      <a class="hover-image__link" href="<?php echo $block['link']; ?>"></a>
                  <?php endif; ?>

                  <?php if ($block['text']): ?>
                      <span class="hover-image__text"><?php echo $block['text']; ?></span>
                  <?php endif; ?>
                </div>
              </div>
          <?php endforeach ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>
