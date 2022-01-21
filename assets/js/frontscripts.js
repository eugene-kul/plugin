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