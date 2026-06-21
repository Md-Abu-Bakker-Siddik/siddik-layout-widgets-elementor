(function ($) {
	'use strict';

	function initWorkingBlockStyle2($container) {
		var $blocks = $container.find('.working-block-style2 .inner-block');
		if (!$blocks.length) {
			return;
		}

		if ($container.data('working-style2-init')) {
			return;
		}
		$container.data('working-style2-init', true);

		if (!$blocks.filter('.active').length) {
			$blocks.first().addClass('active');
		}

		$blocks.on('mouseenter.workingStyle2', function () {
			$blocks.removeClass('active');
			$(this).addClass('active');
		});
	}

	var WidgetWorkingBlockStyle2Handler = function ($scope) {
		$scope.find('.tm-sc-working').each(function () {
			initWorkingBlockStyle2($(this));
		});
	};

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction(
			'frontend/element_ready/tm-ele-working-block.skin-style2',
			WidgetWorkingBlockStyle2Handler
		);
	});

	$(document).ready(function () {
		$('.tm-sc-working').each(function () {
			initWorkingBlockStyle2($(this));
		});
	});
})(jQuery);
