<?php namespace Yamobile\Reviews;

use Backend;
use System\Classes\PluginBase;

/**
 * Reviews Plugin Information File
 */
class Plugin extends PluginBase {
   public $require = [
      'Inetis.ListSwitch',
   ];
   
   /**
    * Returns information about this plugin.
    *
    * @return array
    */
   public function pluginDetails()
   {
      return [
         'name'        => 'Отзывы',
         'description' => 'Плагин для отправки и модерации отзывов',
         'author'      => 'Ya-mobile',
         'icon'        => 'icon-comments'
      ];
   }

   /**
    * Register method, called when the plugin is first registered.
    *
    * @return void
    */
   public function register()
   {

   }

   /**
    * Boot method, called right before the request route.
    *
    * @return array
    */
   public function boot()
   {

   }

   /**
    * Registers any front-end components implemented in this plugin.
    *
    * @return array
    */
   public function registerComponents()
   {
      return [
         'Yamobile\Reviews\Components\ReviewForm' => 'ReviewForm',
         'Yamobile\Reviews\Components\ReviewList' => 'ReviewList'
      ];
   }

   /**
    * Registers any back-end permissions used by this plugin.
    *
    * @return array
    */
   public function registerPermissions()
   {
      return []; // Remove this line to activate

      return [
         'yamobile.reviews.some_permission' => [
               'tab' => 'Reviews',
               'label' => 'Some permission'
         ],
      ];
   }

   /**
    * Registers back-end navigation items for this plugin.
    *
    * @return array
    */
   public function registerNavigation()
   {

      return [
         'reviews' => [
               'label'       => 'Отзывы',
               'url'         => Backend::url('yamobile/reviews/Reviews'),
               'icon'        => 'icon-comments',
               'permissions' => ['yamobile.reviews.*'],
               'order'       => 500,
         ],
      ];
   }
}
