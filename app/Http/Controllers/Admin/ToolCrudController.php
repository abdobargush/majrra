<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ToolRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ToolCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ToolCrudController extends CrudController
{
	use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
	use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
	use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
	use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
	use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

	/**
	 * Configure the CrudPanel object. Apply settings to all operations.
	 * 
	 * @return void
	 */
	public function setup()
	{
		CRUD::setModel(\App\Models\Tool::class);
		CRUD::setRoute(config('backpack.base.route_prefix') . '/tool');
		CRUD::setEntityNameStrings( __('Tool'), __('Tools') );
	}

	/**
	 * Define what happens when the List operation is loaded.
	 * 
	 * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
	 * @return void
	 */
	protected function setupListOperation()
	{
		CRUD::column('title')->label( __('Title') );
		CRUD::addColumn([
			'name' => 'tutorialsCount',
			'label' => __('Tutorials Count'),
			'type' => 'closure',
			'function' => function ($tool) {
				return $tool->tutorials()->count();
			}
		]);
		CRUD::column('created_at')->label( __('Created At') );
	}

	/**
	 * Define what happens when the Create operation is loaded.
	 * 
	 * @see https://backpackforlaravel.com/docs/crud-operation-create
	 * @return void
	 */
	protected function setupCreateOperation()
	{
		CRUD::setValidation(ToolRequest::class);

		CRUD::field('title')->label( __('Title') );
		CRUD::addField([
			'name' => 'thumbnail', 
			'label' => __('Thumbnail'),
			'type' => 'image',
			'upload' => true,
			'aspect_ratio' => 1
		]);
	}

	/**
	 * Define what happens when the Update operation is loaded.
	 * 
	 * @see https://backpackforlaravel.com/docs/crud-operation-update
	 * @return void
	 */
	protected function setupUpdateOperation()
	{
		$this->setupCreateOperation();
	}

	/**
	 * Define what happens when the Show operation is loaded.
	 * 
	 * @see https://backpackforlaravel.com/docs/4.1/crud-operation-show
	 * @return void
	 */
	protected function setupShowOperation()
	{
		CRUD::addColumn([
			'name' => 'thumbnail', 
			'type' => 'image', 
			'label' => __('Thumbnail'),
			'width' => '64px',
			'height' => '64px'
		]);
		
		$this->setupListOperation();
	}

}
