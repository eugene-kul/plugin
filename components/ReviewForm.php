<?php namespace Eugene3993\Reviews\Components;

use Cms\Classes\ComponentBase;
use Eugene3993\Reviews\Models\Review;
use Input;

class ReviewForm extends ComponentBase
{
   public function componentDetails()
   {
      return [
         'name'        => 'Форма',
         'description' => 'Форма для отправки отзыва'
      ];
   }

   public function defineProperties() {
      return [
         'SuccessSend' => [
               'title'         => 'Сообщение об отправке',
               'description'   => 'Текст cообщения при успешной отправке отзыва',
               'type'          => 'string',
               'default'       => 'Спасибо! Ваш отзыв успешно отправлен. Он появится на сайте после модерации.'
         ],
         'ErrorSend' => [
               'title'         => 'Сообщение об ошибке',
               'description'   => 'Текст cообщения с ошибкой отправки отзыва',
               'type'          => 'string',
               'default'       => 'Отзыв не был отправлен, пожалуйста, обновите страницу и попробуйте еще раз'
         ],
         'FilesPhoto' => [
               'title'         => 'Отправка фото',
               'description'   => 'Разрешить отправку фотографий',
               'type'          => 'checkbox'
         ],
         'CITECODE' => [
               'title'         => 'Ключ сайта reCAPTCHA v3',
               'type'          => 'string'
         ],
         'SECRETCODE' => [
               'title'         => 'Секретный код reCAPTCHA v3',
               'type'          => 'string'
         ],
         'sendRobotsMsg' => [
               'title'         => 'Принимать сообщения от ботов',
               'description'   => 'В сообщениях от ботов, в разделе текст отзыва будет содержаться IP адрес, который можно будет заблокировать для доступа к сайту',
               'type'          => 'checkbox'
         ],
         'reviewstyle' => [
               'title'         => 'Подключить стили',
               'description'   => 'Для подключения необходимо в шаблон доавить тег {% styles %}',
               'type'          => 'checkbox',
               'default'       => 1
         ],
         'darkstyle' => [
               'title'         => 'Темный стиль',
               'description'   => 'Темное оформление отзывов',
               'type'          => 'checkbox',
               'default'       => 0
         ]
      ];
   }

   public $SuccessSend;
   public $ErrorSend;
   public $FilesPhoto;
   public $CITECODE;
   public $SECRETCODE;

   public function onRun() {
      if ($this->property('reviewstyle')) {
         $this->addCss('assets/css/reviews-form.css');
         if($this->property('darkstyle')) {
            $this->addCss('assets/css/reviews-dark.css');
         }
      }
      
      $this->CITECODE = $this->property('CITECODE');
      $this->SECRETCODE = $this->property('SECRETCODE');
      
      $this->SuccessSend = $this->property('SuccessSend');
      $this->ErrorSend = $this->property('ErrorSend');
      $this->FilesPhoto = $this->property('FilesPhoto');
      $this->addJs('assets/js/frontscripts.js');
   }
   
   


   public function onSaveReview() {
      $PostPrt = false;
      $secretKey = $this->property('SECRETCODE');
      
      if($secretKey) {
      	
	      $googleToken = '';
	      
	      if(isset($_POST['goggle_token'])) {
	      	$googleToken = $_POST['goggle_token'];
	      }
	      
	      $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$googleToken;
	      
	      $response = file_get_contents($url);
	      $responseKeys = json_decode($response, true);
	      header('Content-type: application/json');
	      
	      if($responseKeys["success"] && $responseKeys["score"] >= 0.5) {
	      	$PostPrt = true;
	      } else {
	      	if($this->property('sendRobotsMsg')) {
	      		$ip = $_SERVER['REMOTE_ADDR'];
		      	$ReviewName = new Review;
		        $ReviewName->name = 'СПАМ от бота';
		        $ReviewName->text = 'IP для блокировки: '.$ip;
		        $ReviewName->date = date('Y-m-d H:m:s');
		        $ReviewName->unread = true;
		        $ReviewName->spam = true;
		        $ReviewName->publish = false;
		        $ReviewName->save();
	      	}
	      	print 'Unknown Error!';
	      }
      } else {
      	$PostPrt = true;
      }
      
      if ($PostPrt) {
      	 date_default_timezone_set('Europe/Moscow');
         $PostName = post('reviewName');
         $PostContacts = post('reviewContscts');
         $PostRating = post('reviewRating');
         $PostText = post('reviewText');

         $ReviewName = new Review;
         $key = 0;
         $files = Input::file('reviewFile');
         
         if (Input::hasFile('reviewFile')) {
            foreach($files as $file) {
               $name = $file->getClientOriginalExtension();
               if(
                  ($name === 'png' or $name === 'jpg' or $name === 'jpeg' or $name === 'webp' or $name === 'png' or $name === 'bmp') and $this->property('FilesPhoto')
                  and $file->getSize() <= 5242639
                  and $key < 7
                  ) {
                  $ReviewName->files = $file;
                  $key++;
               }
            }
         }
         
         $ReviewName->name = $PostName;
         $ReviewName->text = $PostText;
         $ReviewName->contacts = $PostContacts;
         $ReviewName->rating = $PostRating;
         $ReviewName->date = date('Y-m-d H:m:s');
         $ReviewName->unread = true;
         $ReviewName->spam = false;
         $ReviewName->publish = false;
         $ReviewName->save();
      }
   }
}