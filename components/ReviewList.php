<?php namespace Eugene3993\Reviews\Components;

use Cms\Classes\ComponentBase;

class ReviewList extends ComponentBase {
   public function componentDetails() {
      return [
         'name'        => 'eugene3993.reviews::lang.review_list.info.name',
         'description' => 'eugene3993.reviews::lang.review_list.info.description'
      ];
   }

   public function defineProperties() {
      return [
         'items' => [
               'title'         => 'eugene3993.reviews::lang.review_list.items.title',
               'description'   => 'eugene3993.reviews::lang.review_list.items.description',
               'default'       => '30',
         ],
         'SortOrder' => [
               'title'         => 'eugene3993.reviews::lang.review_list.sortorder.title',
               'description'   => 'eugene3993.reviews::lang.review_list.sortorder.description',
               'type'          => 'dropdown',
               'options'       => [
                  'new'    => 'eugene3993.reviews::lang.review_list.sortlist.new',
                  'old'    => 'eugene3993.reviews::lang.review_list.sortlist.old'
               ],
               'default'       => 'new',
         ],
         'reviewstyle' => [
               'title'         => 'eugene3993.reviews::lang.review_list.reviewstyle.title',
               'description'   => 'eugene3993.reviews::lang.review_list.reviewstyle.description',
               'type'          => 'checkbox',
               'default'       => 1,
         ],
         'itemwidth' => [
               'title'         => 'eugene3993.reviews::lang.review_list.itemwidth.title',
               'description'   => 'eugene3993.reviews::lang.review_list.itemwidth.description',
               'type'          => 'checkbox',
               'default'       => 0,
         ]
      ];
   }

   public $reviews;
   public $width100;
   public $reply_text;

   public function onRun() {
      if ($this->property('itemwidth')) {
         $this->width100 = true;
      }
      if ($this->property('reviewstyle')) {
         $this->addCss('assets/css/reviews-with-paginate.css');
      }
      $this->addCss('assets/css/lightzoom.css');
      if ($this->property('SortOrder') == 'new') {
         $this->reviews = \Eugene3993\Reviews\Models\Review::
            where('spam', false)
            ->orWhere('spam', null)
            ->where('publish', true)
            ->orderBy('date', 'desc')
            ->paginate($this->property('items'));
      } elseif ($this->property('SortOrder') == 'old') {
         $this->reviews = \Eugene3993\Reviews\Models\Review::
         where('spam', false)
         ->orWhere('spam', null)
         ->where('publish', true)
         ->orderBy('date', 'asc')
         ->paginate($this->property('items'));
      }
   }
}