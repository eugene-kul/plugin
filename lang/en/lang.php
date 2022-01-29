<?php

return [
	'plugin' => [
		'details' => [
			'name' 			=> 'Reviews Manager',
			'description' 	=> 'Plugin for moderation, sending and displaying reviews on the site'
		],

		'menu' => [
			'name'	=> 'Reviews'
		]
	],

   'models' => [
      'fields' => [
         'publish'         => 'Publish review',
         'name'            => 'Name',
         'contacts'        => 'Contacts: Phone/E-mail',
         'rating'          => 'Rating',
         'select_rating'   => 'Select a rating',
         'date'            => 'Review date',
         'files'           => 'Photos',
         'text'            => 'Review text',
         'reply'           => 'Official reply to the review'
      ],

      'columns' => [
         'name'            => 'Name',
         'text'            => 'Review text',
         'contacts'        => 'Contacts',
         'rating'          => 'Rating',
         'files'           => 'Photos',
         'reply'           => 'Reply',
         'publish'         => 'Publish',
         'date'            => 'Review date',
         'updated_at'      => 'Updated'
      ],
   ],

   'review_form' => [
      'info' => [
         'name' 			=> 'Review form',
         'description' 	=> 'Form for sending review'
      ],

      'success' => [
         'title'			=> 'Successful submission message',
         'description'	=> 'The text of the message upon successful submission of feedback',
         'default'		=> 'Thanks! Your review has been successfully submitted. It will appear on the site after moderation.'
      ],

      'error'	=> [
         'title'			=> 'Error message',
         'description'	=> 'The text of the message with an error sending feedback',
         'default'		=> 'Feedback was not sent, please refresh the page and try again'
      ],

      'files'	=> [
         'title'			=> 'Sending a photo',
         'description'	=> 'Allow sending photos'
      ],

      'captcha'	=> [
         'sitecode'			=> 'Site key reCAPTCHA v3',
         'secretcey'       => 'Secret code reCAPTCHA v3',
         'description'     => 'The secret key and the site key are issued by the Google service after registering the domain on the google captcha service'
      ],

      'mail'	=> [
         'title'           => 'Email notification',
         'description'     => 'Enter your email, for example: mail@gmail.com. Make sure your email settings are correct.'
      ],

      'spam'	=> [
         'title'           => 'Receive spam from bots',
         'description'     => 'Messages from bots will contain an IP address that can be blocked from accessing the site'
      ],

      'reviewstyle'	=> [
         'title'			=> 'Enable Styles',
         'description'	=> 'To connect, you need to add the {% styles %} tag to the template'
      ],

      'dark' => [
         'title'         => 'Dark style',
         'description'    => 'Dark design of reviews and forms'
      ]
   ],

   'review_list' => [
      'info' => [
         'name'          => 'Review list',
         'description'   => 'Component for displaying reviews on the page'
      ],

      'items' => [
         'title'         => 'Quantity per page',
         'description'   => 'Specifies the number of reviews on one page'
      ],

      'sortorder' => [
         'title'         => 'Sort',
         'description'   => 'Sort reviews to display on the page'
      ],

      'reviewstyle' => [
         'title'         => 'Enable Styles',
         'description'   => 'To connect, you need to add the {% styles %} tag to the template'
      ],

      'itemwidth' => [
         'title'         => '100% block width',
         'description'   => 'The review list will take up the entire width of the parent container'
      ],

      'sortlist' => [
         'new'           => 'New ones first',
         'old'           => 'Old ones first'
      ]
   ],

   'breadcrumbs' => [
      'reviews_list'      => 'Reviews',
      'review'            => 'Review',
      'autor'             => 'author:',
      'new_review'        => 'New review'
   ],

   'buttons' => [
      'create'           => 'Create',
      'save'             => 'Save',
      'save_indicator'   => 'Saving...',
      'save_and_close'   => 'Save and Close',
      'or'               => 'or',
      'cancel'           => 'Cancel',
      'remove_indicator' => 'Remove Review',
      'remove_confirm'   => 'Remove this review?',
      'new_review'       => 'New review',
      'delete_selected'  => 'Delete selected',
      'delete_confirm'   => 'Do you want to delete the selected reviews?'
   ],

   'errors' => [
      'return_list'       => 'Return to the list of reviews',
   ],

   'messages' => [
      'save'              => 'Review saved',
      'remove'            => 'Review remove'
   ],

   'page_title' => [
      'list' => 'Review list',
      'create' => 'Add new review',
      'edit' => 'Edit review'
   ],

   'unread' => 'New',
   'no'     => 'No'
];

?>