<?php namespace Eugene3993\Reviews\Models;

use Model;

/**
 * Review Model
 */
class Review extends Model
{
   use \October\Rain\Database\Traits\Validation;

   public function onRun() {
      $this->addCss('assets/css/backend.css');
      dd($this);
   }

   /**
    * @var string The database table used by the model.
    */
   public $table = 'eugene3993_reviews_list';

   /**
    * @var array Guarded fields
    */
   protected $guarded = ['*'];

   /**
    * @var array Fillable fields
    */
   protected $fillable = [];

   /**
    * @var array Relations
    */
   public $hasOne = [];
   public $hasMany = [];
   public $belongsTo = [];
   public $belongsToMany = [];
   public $morphTo = [];
   public $morphOne = [];
   public $morphMany = [];
   public $attachOne = [];
   public $attachMany = [
      'files' => 'System\Models\File',
   ];

    /*Validation fields*/
   public $rules = [
      'name' => 'required',
      'date' => 'required',
      'text' => 'required'
   ];
}
