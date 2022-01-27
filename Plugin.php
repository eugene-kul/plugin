<?php namespace Eugene3993\Reviews;

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
   public function pluginDetails() {
      return [
         'name'        => 'eugene3993.reviews::lang.plugin.details.name',
         'description' => 'eugene3993.reviews::lang.plugin.details.description',
         'author'      => 'Eugene3993',
         'icon'        => 'icon-comments'
      ];
   }

   /**
    * Register method, called when the plugin is first registered.
    *
    * @return void
    */
   public function register() {}

   /**
    * Boot method, called right before the request route.
    *
    * @return array
    */
   public function boot() {}

   /**
    * Registers any front-end components implemented in this plugin.
    *
    * @return array
    */
   public function registerComponents() {
      return [
         'Eugene3993\Reviews\Components\ReviewForm' => 'ReviewForm',
         'Eugene3993\Reviews\Components\ReviewList' => 'ReviewList'
      ];
   }

   /**
    * Registers any back-end permissions used by this plugin.
    *
    * @return array
    */
   public function registerPermissions() {}

   /**
    * Registers back-end navigation items for this plugin.
    *
    * @return array
    */
   public function registerNavigation() {
      return [
         'reviews' => [
               'label'       => 'eugene3993.reviews::lang.plugin.menu.name',
               'url'         => Backend::url('eugene3993/reviews/Reviews'),
               'icon'        => 'icon-comments',
               'permissions' => ['eugene3993.reviews.*'],
               'order'       => 500,
         ],
      ];
   }
}
