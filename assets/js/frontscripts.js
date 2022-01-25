var stars = jQuery('.ec-rating').find('.ec-rating-stars>span');
stars.on('touchend click', function(e){
   var starDesc = jQuery(this).data('description');
   jQuery(this).parent().parent().find('.ec-rating-description').html(starDesc).data('old-text', starDesc);
   jQuery(this).parent().children().removeClass('active active2 active-disabled');
   jQuery(this).prevAll().addClass('active');
   jQuery(this).addClass('active');
   // save vote
   var storageId = jQuery(this).closest('.ec-rating').data('storage-id');
   jQuery('#' + storageId).val(jQuery(this).data('rating'));
});
stars.hover(
   // hover in
   function() {
      var descEl = jQuery(this).parent().parent().find('.ec-rating-description');
      descEl.data('old-text', descEl.html());
      descEl.html(jQuery(this).data('description'));
      jQuery(this).addClass('active2').removeClass('active-disabled');
      jQuery(this).prevAll().addClass('active2').removeClass('active-disabled');
      jQuery(this).nextAll().removeClass('active2').addClass('active-disabled');
   },
   // hover out
   function(){
      var descEl = jQuery(this).parent().parent().find('.ec-rating-description');
      descEl.html(descEl.data('old-text'));
      jQuery(this).parent().children().removeClass('active2 active-disabled');
   }
);

/** выбор файлов */
let inputs = document.querySelectorAll('.js-input-files-label');
Array.prototype.forEach.call(inputs, function (input) {
	let label = input.querySelector('span');
	let labelVal = label.innerText;
	let input_item = input.querySelector('.js-input-files');
	let btn_close = input.nextElementSibling;
	
	input_item.addEventListener('change', function (e) {
		let countFiles = '';
		if (this.files && this.files.length >= 1) {
			countFiles = this.files.length;
		}

		if (countFiles) {
			label.innerText = 'Выбрано фотографий: ' + countFiles;
			btn_close.classList.remove('hide');
         input.classList.remove('nofile');
		}
		else {
			label.innerText = labelVal;
			btn_close.classList.add('hide');
         input.classList.add('nofile');
		}
	});
	btn_close.addEventListener('click', function(){
		input_item.value = '';
		label.innerText = labelVal;
		btn_close.classList.add('hide');
      input.classList.add('nofile');
	})
});
/** выбор файлов */

function sendMsg(form) {
   form.querySelector('.modal-success').classList.add('active');
   form.querySelector('button').disabled = true;
   console.log([form]);
}

function noSendMsg(form) {
   form.querySelector('.modal-success-error').classList.add('active');
   form.querySelector('button').disabled = true;
}

function ErrorMsg(text) {
   $.oc.flashMsg({text: 'error', 'class': 'error', 'interval': 10});
}

/**
 * jQuery lightzoom v1.1.0
 * Copyright 2020
 * Contributing Author: Aleksey Savin
 * E-mail: asavin.work@yandex.ru
 */

 (function ($, window, document, undefined) {
   "use strict";
   var pluginName = "lightzoom";
   var defaults = {
      overlayOpacity: "0.75",
      overlayColor: "",
   };

   var html = '<div id="lz-container"><div id="lz-box"><div id="lz-overlay"></div></div></div>';

   function Plugin(element, options) {
      this.element = element;
      this.settings = $.extend({}, defaults, options);
      this._defaults = defaults;
      this._name = pluginName;
      this.init();
   }

   $.extend(Plugin.prototype, {
      init: function () {
         var $this = this;
         $this.build();
         $(document).on("click", "#lz-close", function (event) {
            event.preventDefault();
            $this.closeZoom();
         });

         $(document).on("scroll", function (event) {
            $this.closeZoom();
         });

         $(document).on("click", "#lz-container", function (event) {
            $this.closeZoom();
         });
         $(document).on("click", "#lz-overlay", function (event) {
            $this.closeZoom();
         });
         
         $(document).keydown(function (event) {
               if (event.which === 27) {
                  $this.closeZoom();
               }
         });
         
         $this.resize();
      },

      build: function () {
         var $this = this;
         $(this.element).on("click", function (event) {
            event.preventDefault();
            $("body").append(html);
            var lz = $("#lz-box"),
                  img = $(this).children("img"),
                  src = $(this).attr("href"),
                  overlayCss = {};
            overlayCss = {
                  opacity: $this.settings.overlayOpacity,
                  backgroundColor: $this.settings.overlayColor,
            };
            $("#lz-overlay").css(overlayCss);
            $("#lz-container").fadeIn({ display: "block" });
            $(new Image())
                  .attr("src", src)
                  .on("load", function () {
                     lz.append('<img src="' + src + '">');
                     $this.setDim();
                     lz.append('<a href="#" id="lz-close" title="Close">Close</a>');
                     $("#lz-loading-center").remove();
                     $("#lz-box img").animate({ opacity: 1 }, 200);
                  });
         });
      },

      setDim: function () {
         var width,
            height,
            imgCss = {};
         var winWidth = window.innerWidth ? window.innerWidth : $(window).width();
         var winHeight = window.innerHeight ? window.innerHeight : $(window).height();

         if (winWidth > winHeight) {
            width = "95%";
            height = "80%";
         } else {
            width = "80%";
            height = "100%";
         }

         // Reset dimensions on mobile orientation change
         if ("onorientationchange" in window) {
            window.addEventListener(
                  "orientationchange",
                  function () {
                     if (window.orientation === 0) {
                        width = "80%";
                        height = "100%";
                     } else if (window.orientation === 90 || window.orientation === -90) {
                        width = "95%";
                        height = "80%";
                     }
                  },
                  false
            );
         }
         imgCss = {
            maxWidth: width,
            maxHeight: height,
         };
         $("#lz-box img").css(imgCss);
      },

      closeZoom: function () {
         var $this = this;
         $("#lz-container").fadeOut(200, function () {
            $this.destroy();
         });
      },

      resize: function () {
         var $this = this;
         $(window).resize(function () {
            $this.setDim();
         }); // .resize();
      },

      destroy: function () {
         $("#lz-container").remove();
      },
   });

   $.fn[pluginName] = function (options) {
      return this.each(function () {
         if (!$.data(this, "plugin_" + pluginName)) {
            $.data(this, "plugin_" + pluginName, new Plugin(this, options));
         }
      });
   };
})(jQuery, window, document);
jQuery(".lightzoom").lightzoom();
