<?php namespace Yamobile\Reviews\Components;

use Cms\Classes\ComponentBase;

class ReviewList extends ComponentBase {
    public function componentDetails() {
        return [
            'name'        => 'Отзывы',
            'description' => 'Компонент для страницы с отзывами'
        ];
    }

    public function defineProperties() {
        return [
            'items' => [
                'title'         => 'Количество',
                'description'   => 'Определяет количетсво отзывов на странице',
                'default'       => '30',
            ],
            'SortOrder' => [
                'title'         => 'Сортировка',
                'description'   => 'Отсортировать отзывы для отображения на странице',
                'type'          => 'dropdown',
                'default'       => 'new',
            ],
            'reviewstyle' => [
                'title'         => 'Подключить стили',
                'description'   => 'Для подключения необходимо в шаблон доавить тег {% styles %}',
                'type'          => 'checkbox',
                'default'       => 1,
            ]
        ];
    }

    public function getSortOrderOptions() {
        return [
            'new' => 'Сначала новые',
            'old' => 'Сначала старые'
        ];
    }

    public $reviews;

    public function onRun() {
        if ($this->property('reviewstyle')) {
            $this->addCss('assets/css/reviews-with-paginate.css');
        }
        if ($this->property('SortOrder') == 'new') {
         $this->reviews = \Yamobile\Reviews\Models\Review::where('publish', true)->orderBy('created_at', 'desc')->paginate($this->property('items'));
        } elseif ($this->property('SortOrder') == 'old') {
            $this->reviews = \Yamobile\Reviews\Models\Review::where('publish', true)->orderBy('created_at', 'asc')->paginate($this->property('items'));
        }
    }
}