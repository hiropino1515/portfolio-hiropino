<?php get_header(); ?>

  <!-- 下層ページのメインビュー -->
  <div class="sub-mv bg-campaign">
    <div class="sub-mv__inner">
      <picture>
        <source srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/campaign-img_sp.jpg" media="(max-width: 767px)" >
        <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/campaign-img_pc.jpg" alt="青い海の前に赤いピンフラッグが靡いているゴルフコース">
      </picture>
      <div class="sub-mv__header js-mv-header">
        <h2 class="sub-mv__title" id="text">Campaign</h2>
      </div>
    </div>
  </div>

   <!-- パンくず -->
   <?php get_template_part('parts/breadcrumb') ?>

  <main>
    <div class="common-tab layout-page-common fadein">
      <div class="common-tab__inner inner">
        <ul class="common-tab__lists">
          <li><a href="<?php echo esc_url( home_url( '/campaign/' ) ) ; ?>" class="common-tab__list current">ALL</a></li>
          <?php
              $terms = get_terms('campaign_category');
              foreach ( $terms as $term ) {
              echo '<li><a class="common-tab__list" href="'.get_term_link($term).'">'.esc_html($term->name).'</a></li>';
              }
          ?>
        </ul>
      </div>
    </div>
    <section class="page-campaign layout-page-campaign">
      <div class="page-campaign__inner inner">
        <div class="page-campaign__container">
          <ul class="page-campaign__items">
          <?php if (have_posts(  )): ?>
            <?php while(have_posts(  )): ?>
              <?php the_post(  ); ?>
            <li class="page-campaign__item campaign-card fadein" data-campaign-title="<?php the_title(); ?>">
              <div class="campaign-card__image">
                <?php if(has_post_thumbnail()): ?>
                    <img src="<?php the_post_thumbnail_url('medium'); ?>"
                        srcset="<?php the_post_thumbnail_url('medium'); ?> 768w, 
                                <?php the_post_thumbnail_url('large'); ?> 1024w"
                        sizes="(max-width: 768px) 100vw, (max-width: 1024px) 100vw, 1024px"
                        alt="">
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/noimg.png" alt="">
                <?php endif; ?>
              </div>
              <div class="campaign-card__inner campagin-card__inner--page-campaign">
                <div class="campaign-card__head">
                <?php
                $terms = get_the_terms(get_the_ID(), 'campaign_category');
                if ($terms && !is_wp_error($terms)) {
                    $term = reset($terms); // 最初のタームを取得
                    echo '<p class="campaign-card__category">' . esc_html($term->name) . '</p>';
                }
                ?>
                  <h3 class="campaign-card__title campaign-card__title--page-campaign"><?php the_title(); ?></h3>
                </div>
                <div class="campaign-card__body campaign-card__body--page-campaign">
                  <p class="campaign-card__menu-title"><?php the_field('campaign_1'); ?></p>
                  <div class="campaign-card__price">
                    <p class="campaign-card__price-before"><?php the_field('campaign_2'); ?></p>
                    <p class="campaign-card__price-after"><?php the_field('campaign_3'); ?></p>
                  </div>
                  <p class="campaign-card__text u-desktop"><?php the_field('campaign_4'); ?>
                  </p>
                  <time class="campaign-card__date u-desktop" datetime="2023/6/1-9/30"><?php the_field('campaign_5'); ?></time>
                  <p class="campaign-card__message u-desktop">ご予約・お問い合わせはコチラ</p>
                  <object class="campaign-card__button u-desktop">
                  <?php $campaign_url = esc_url(get_field('campaign_6')); ?>
                  <a href="<?php echo esc_url( home_url( '/contact/' ) ) ; ?>" class="button shiny select-button">Contact us<span></span></a>
                  </object>
                </div>
              </div>
            </li>
            <?php endwhile; ?>
          <?php endif; ?>
          </ul>
        </div>
        <div class="page-campaign__pagenavi fadein">
          <div class="wp-pagenavi">
            <?php wp_pagenavi(); ?>
          </div>
        </div>
      </div>
    </section>

<?php get_footer(); ?>