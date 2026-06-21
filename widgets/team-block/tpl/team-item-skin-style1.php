<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- Team Block Style1 -->
<?php
$team_item['settings']     = $settings;
$team_item['title_tag']    = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>
<div class="team-current-theme1 team-item">
	<div class="inner-block">
		<div class="thumb">
			<?php unique_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false ); ?>
		</div>
		<div class="team-content">
			<div class="team-meta">
				<?php unique_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false ); ?>
				<?php unique_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false ); ?>
			</div>
			<div class="team-action">
				<?php unique_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false ); ?>
				<span class="share-icon fa fa-share" aria-hidden="true"></span>
			</div>
		</div>
	</div>
</div>
