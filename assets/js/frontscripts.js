var stars = jQuery('.ec-rating').find('.ec-rating-stars>span');
console.log('loading');
stars.on('touchend click', function(e){
   
   var starDesc = jQuery(this).data('description');
   jQuery(this).parent().parent().find('.ec-rating-description').html(starDesc).data('old-text', starDesc);
   jQuery(this).parent().children().removeClass('active active2 active-disabled');
   jQuery(this).prevAll().addClass('active');
   jQuery(this).addClass('active');
   // save vote
   var storageId = jQuery(this).closest('.ec-rating').data('storage-id');
   jQuery('#' + storageId).val(jQuery(this).data('rating'));
   console.log('click');
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
      console.log('hover-in');
   },
   // hover out
   function(){
      var descEl = jQuery(this).parent().parent().find('.ec-rating-description');
      descEl.html(descEl.data('old-text'));
      jQuery(this).parent().children().removeClass('active2 active-disabled');
      console.log('hover-out');
   }
);

/** выбор файлов */
let inputs = document.querySelectorAll('.js-input-files-label');
Array.prototype.forEach.call(inputs, function (input) {
	let label = input.querySelector('span');
	let labelVal = label.innerText;
	let input_item = input.querySelector('.js-input-files');
	let btn_close = input.nextSibling;
	
	input_item.addEventListener('change', function (e) {
		let countFiles = '';
		if (this.files && this.files.length >= 1) {
			countFiles = this.files.length;
		}

		if (countFiles) {
			label.innerText = 'Выбрано файлов: ' + countFiles;
			btn_close.classList.remove('hide');
		}
		else {
			label.innerText = labelVal;
			btn_close.classList.add('hide');
		}
	});
	btn_close.addEventListener('click', function(){
		input_item.value = '';
		label.innerText = labelVal;
		btn_close.classList.add('hide');
	})
});
/** выбор файлов */

function sendMsg(form) {
   form.querySelector('.modal-success').classList.add('active');
   form.querySelector('button').disabled = true;
}

function noSendMsg(form) {
   form.querySelector('.modal-success-error').classList.add('active');
   form.querySelector('button').disabled = true;
}