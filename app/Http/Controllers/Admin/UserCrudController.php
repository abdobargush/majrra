<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
	use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
	use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
	use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
	use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
	use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
	use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
	use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
	
	/**
	 * Configure the CrudPanel object. Apply settings to all operations.
	 * 
	 * @return void
	 */
	public function setup()
	{
		CRUD::setModel(\App\Models\User::class);
		CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
		CRUD::setEntityNameStrings( __('User'), __('Users') );
	}

	/**
	 * Define what happens when the List operation is loaded.
	 * 
	 * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
	 * @return void
	 */
	protected function setupListOperation()
	{
		CRUD::column('username')->label( __('Username') );
		CRUD::column('email')->type('email')->label( __('Email') );
		CRUD::column('created_at')->label( __('Created At') );

		CRUD::addButtonFromView('line', 'edit_profile', 'edit-profile', 'end');
	}

	/**
	 * Define what happens when the Create operation is loaded.
	 * 
	 * @see https://backpackforlaravel.com/docs/crud-operation-create
	 * @return void
	 */
	protected function setupCreateOperation()
	{
		CRUD::setValidation(CreateUserRequest::class);

		CRUD::field('username')->label( __('Username') );
		CRUD::field('email')->type('email')->label( __('Email') );
		CRUD::field('password')->type('password')->label( __('Password') );
	}

	/**
	 * Define what happens when the Update operation is loaded.
	 * 
	 * @see https://backpackforlaravel.com/docs/crud-operation-update
	 * @return void
	 */
	protected function setupUpdateOperation()
	{
		CRUD::setValidation(UpdateUserRequest::class);

		CRUD::field('username')->label( __('Username') );
		CRUD::field('email')->type('email')->label( __('Email') );
		CRUD::field('password')->type('password')->label( __('Password') );
	}

	/**
	 * Define what happens when the Show operation is loaded.
	 * 
	 * @see https://backpackforlaravel.com/docs/4.1/crud-operation-show
	 * @return void
	 */
	protected function setupShowOperation()
	{
		CRUD::column('profile.name')->label( __('Name') );
		CRUD::column('username')->label( __('Username') );
		CRUD::column('email')->type('email')->label( __('Email') );
		CRUD::column('profile.avatar')->type('image')->label( __('Avatar') );
		CRUD::column('profile.bio')->label( __('Bio') );
		CRUD::column('profile.link')->label( __('Link') )->wrapper([
			'element' => 'a',
			'href' => function ($crud, $column, $entry, $related_key) {
				return $column['text'];
			},
			'target' => '_blank'
		]);
		CRUD::column('created_at')->label( __('Created At') );

		CRUD::addButtonFromView('line', 'edit_profile', 'edit-profile', 'beginning');
	}

	/**
	 * Store a newly created resource in the database.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		$this->crud->setRequest($this->crud->validateRequest());
		$this->crud->setRequest($this->handlePasswordInput($this->crud->getRequest()));
		$this->crud->unsetValidation(); // validation has already been run

		return $this->traitStore();
	}
	
	/**
	 * Update the specified resource in the database.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update()
	{
		$this->crud->setRequest($this->crud->validateRequest());
		$this->crud->setRequest($this->handlePasswordInput($this->crud->getRequest()));
		$this->crud->unsetValidation(); // validation has already been run

		return $this->traitUpdate();
	}
	

	/**
	 * Handle password input fields.
	 */
	protected function handlePasswordInput($request)
	{

		// Encrypt password if specified.
		if ($request->input('password')) {
			$request->request->set('password', Hash::make($request->input('password')));
		} else {
			$request->request->remove('password');
		}

		return $request;
	}
}
