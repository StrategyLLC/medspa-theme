<div class="ll-vac spacing-top-none spacing-bottom-medium">
  <div class="container">

    <?php vac_display_notices(); ?>

    <?php if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty( $_POST )  ) : ?>
      <div class="vac__contact">

        <?php if ( function_exists( gravity_form ) ) : ?>

          <?php $selected = get_option( 'vac_gravity_form' ); ?>

          <?php if ( $selected ) : ?>
            <h1 class="vac__content__title">Virtual Consultation</h1>
            <p>Enter your contact information to instantly receive your customized virtual consultation!</p>
            <p>All of your information will be kept private and only shared with your Aestheticare provider.</p>
            <?php gravity_form( $selected, false, false, false, '', false ) ?>
          <?php endif; ?>

        <?php endif; ?>

      </div>

    <?php else : ?>

      <div class="vac">

        <div class="vac__content">

          <div class="vac__content__wrapper">

            <h1 class="vac__content__title">Virtual Consultation</h1>

            <p>Please select your cosmetic concerns to receive confidential treatment recommendations by clicking on the appropriate body area on the model to the right.</p>

            <button class="vac__submit vac__button button is-solid" type="submit">Finish Consult</button>

          </div>

        </div>

        <div class="vac__forms">

          <?php vac_nav_buttons() ?>

          <?php vac_build_forms(); ?>

        </div>

      </div>

    <?php endif; ?>

  </div>
</div>
