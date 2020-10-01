<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProfileRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProfileCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProfileCrudController extends CrudController
{
		use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
		use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

		/**
		 * Configure the CrudPanel object. Apply settings to all operations.
		 * 
		 * @return void
		 */
		public function setup()
		{
			CRUD::setModel(\App\Models\Profile::class);
			CRUD::setRoute(config('backpack.base.route_prefix') . '/profile');
			CRUD::setEntityNameStrings( __('Profile') , __('Profiles') );
		}

		/**
		 * Define what happens when the Update operation is loaded.
		 * 
		 * @see https://backpackforlaravel.com/docs/crud-operation-update
		 * @return void
		 */
		protected function setupUpdateOperation()
		{
			CRUD::setValidation(ProfileRequest::class);
			
			CRUD::addField([
				'name' => 'user.username',
				'type' => 'text', 
				'label' => __('Username'),
				'attributes' => ['disabled' => 'disabled']
			]);
			CRUD::field('name')->label( __('Name') );
			CRUD::field('bio')->type('textarea')->label( __('Bio') );
			CRUD::field('link')->type('url')->label( __('Link') );
		}
}
