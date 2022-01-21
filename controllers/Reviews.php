<?php namespace Eugene3993\Reviews\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Eugene3993\Reviews\Models\Review;

/**
 * Simple Reviews Back-end Controller
 */
class Reviews extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Eugene3993.Reviews', 'reviews', 'reviews');
    }

    public function update($recordId)
    {
        $record = Review::find($recordId);
        $record->unread = false;
        $record->save();
        $this->vars['record'] = $record;
        return $this->asExtension('FormController')->update($recordId);
    }

}