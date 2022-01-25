<?php namespace Eugene3993\Reviews\Components;

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
         ],
         'itemwidth100' => [
               'title'         => '100% ширина блока',
               'description'   => 'Список отзывов будет занимать всю ширину родительского контейнера',
               'type'          => 'checkbox',
               'default'       => 0,
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
   public $width100;

   public function onRun() {
      
      if ($this->property('itemwidth100')) {
         $this->width100 = true;
      }
      if ($this->property('reviewstyle')) {
         $this->addCss('assets/css/reviews-with-paginate.css');
      }
      $this->addCss('assets/css/lightzoom.css');
      if ($this->property('SortOrder') == 'new') {
         $this->reviews = \Eugene3993\Reviews\Models\Review::where('publish', true)->orderBy('date', 'desc')->paginate($this->property('items'));
      } elseif ($this->property('SortOrder') == 'old') {
         $this->reviews = \Eugene3993\Reviews\Models\Review::where('publish', true)->orderBy('date', 'asc')->paginate($this->property('items'));
      }
   }
}