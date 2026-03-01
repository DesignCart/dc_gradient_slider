/**
 * DC Gradient Slider - init from data-config, Slick + optional Granim
 */
(function() {
	'use strict';

	window.dcGsliderInit = function(modId, gradientEnable, gradientColors, gradientImageUrl) {
		var el = document.getElementById(modId);
		if (!el) return;
		var sliderEl = el.querySelector('.dc-gslider-slider');
		if (!sliderEl) return;

		var jq = window.jQuery || window.$;
		if (!jq || !jq.fn.slick) {
			setTimeout(function() { window.dcGsliderInit(modId, gradientEnable, gradientColors, gradientImageUrl); }, 100);
			return;
		}

		jq(sliderEl).slick({
			dots: true,
			infinite: true,
			speed: 500,
			fade: true,
			cssEase: 'linear',
			arrows: true,
			autoplay: true,
			autoplaySpeed: 5000,
			adaptiveHeight: false
		});

		// Inicjalizacja gradientu na wszystkich slajdach, gdy slider jest gotowy
		function initGranimForAllSlides() {
			var canvases = el.querySelectorAll('.dc-gslider-slide .dc-gslider-gradient-canvas');
			canvases.forEach(function(canvas, index) {
				// Unikalne id (Slick klonuje slajdy – unikamy duplikatów id)
				if (!canvas.id || document.querySelectorAll('#' + CSS.escape(canvas.id)).length > 1) {
					canvas.id = modId + '-granim-' + index;
				}
				var slideEl = canvas.closest('.dc-gslider-slide');
				if (slideEl) {
					initGranimForSlide(slideEl, gradientEnable, gradientColors);
				}
			});
		}

		jq(sliderEl).on('init', initGranimForAllSlides);

		// Jeśli Slick już się zainicjalizował (np. przy ponownym wywołaniu), wywołaj od razu
		if (sliderEl.classList.contains('slick-initialized')) {
			initGranimForAllSlides();
		}
	}

	function runInits() {
		var wrappers = document.querySelectorAll('.dc-gslider-wrapper[data-dc-gslider-config]');
		wrappers.forEach(function(wrapper) {
			try {
				var cfg = JSON.parse(wrapper.getAttribute('data-dc-gslider-config'));
				if (cfg.modId) {
					window.dcGsliderInit(cfg.modId, cfg.gradientEnable || false, cfg.gradientColors || [], cfg.gradientImageUrl || '');
				}
			} catch (e) {}
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', runInits);
	} else {
		runInits();
	}

	function initGranimForSlide(slideEl, gradientEnable, gradientColors) {
		if (!gradientEnable || !gradientColors || !gradientColors.length) {
			return;
		}

		var canvas = slideEl.querySelector('.dc-gslider-gradient-canvas');
		if (!canvas) {
			return;
		}

		if (canvas._granimInstance) {
			return;
		}

		if (!window.Granim) {
			setTimeout(function() { initGranimForSlide(slideEl, gradientEnable, gradientColors); }, 100);
			return;
		}

		var canvasSelector = '#' + canvas.id;
		var imgUrl = canvas.dataset.image || '';

		var opts = {
			element: canvasSelector,
			direction: 'top-bottom',
			isPausedWhenNotInView: true,
			states: {
				'default-state': {
					gradients: gradientColors,
					transitionSpeed: 2000
				}
			}
		};

		if (imgUrl) {
			opts.image = {
				source: imgUrl,
				blendingMode: 'overlay',
				position: ['center', 'center'],   // wyśrodkowanie
        		stretchMode: ['stretch-if-smaller', 'stretch-if-smaller']  // rozciąganie na całą szerokość	
			};
		}

		try {
			canvas._granimInstance = new window.Granim(opts);
		} catch (e) {}
	}
})();
