<?php namespace Yamobile\SimpleReviews;

use Backend;
use System\Classes\PluginBase;

/**
 * SimpleReviews Plugin Information File
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
         'Yamobile\SimpleReviews\Components\ReviewForm' => 'ReviewForm',
         'Yamobile\SimpleReviews\Components\ReviewList' => 'ReviewList'
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
         'ironlab.simplereviews.some_permission' => [
               'tab' => 'SimpleReviews',
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
         'simplereviews' => [
               'label'       => 'Отзывы',
               'url'         => Backend::url('ironlab/simplereviews/SimpleReviews'),
               'icon'        => 'icon-comments',
               'permissions' => ['ironlab.simplereviews.*'],
               'order'       => 500,
         ],
      ];
   }
}
