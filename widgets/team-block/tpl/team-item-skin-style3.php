<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- Team Block Style3-->
<?php
$team_item['settings'] = $settings;
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>
<div class="team-current-theme3 team-item">
  <div class="inner-box text-center">
    <div class="image-box">
      <div class="thumb">
        <?php unique_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
        <?php unique_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
      </div>
    </div>
    <div class="content-box">
      <?php unique_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
      <?php unique_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
    </div>
  </div>
</div>