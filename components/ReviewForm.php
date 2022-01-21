<?php namespace Yamobile\Reviews\Components;

use Cms\Classes\ComponentBase;
use Yamobile\Reviews\Models\Review;

class ReviewForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Форма',
            'description' => 'Форма для отправки отзыва'
        ];
    }

    public function defineProperties()
    {
        return [
            'SuccessSend' => [
                'title'         => 'Сообщение об отправке',
                'description'   => 'Текст cообщения при успешной отправке отзыва',
                'type'          => 'string',
                'default'       => 'Спасибо! Отзыв успешно отправлен'
            ],
            'ErrorSend' => [
                'title'         => 'Сообщение об ошибке',
                'description'   => 'Текст cообщения с ошибкой отправки отзыва',
                'type'          => 'string',
                'default'       => 'Отзыв не был отправлен'
            ],
            'reviewstyle' => [
                'title'         => 'Подключить стили',
                'description'   => 'Для подключения необходимо в шаблон доавить тег {% styles %}',
                'type'          => 'checkbox',
                'default'       => 1
            ]
        ];
    }

    public $SuccessSend;
    public $ErrorSend;

    public function onRun()
    {

        if ($this->property('reviewstyle')) {
            $this->addCss('assets/css/reviews-form.css');
        }

        $this->SuccessSend = $this->property('SuccessSend');
        $this->ErrorSend = $this->property('ErrorSend');
        $this->addJs('assets/js/frontscripts.js');
    }


    public function onSaveReview()
    {   
        $PostPrt = post('reviewpPrt');
        if ($PostPrt == null) {
            $PostName = post('reviewName');
            $PostContacts = post('reviewContscts');
            $PostRating = post('reviewRating');
            $PostText = post('reviewText');
            $ReviewName = new Review;
            $ReviewName->name = $PostName;
            $ReviewName->text = $PostText;
            $ReviewName->contacts = $PostContacts;
            $ReviewName->rating = $PostRating;
            $ReviewName->unread = true;
            $ReviewName->save();
        }    
    }
}