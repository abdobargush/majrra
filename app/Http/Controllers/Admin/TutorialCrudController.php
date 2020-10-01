<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TutorialRequest;
use App\Models\Tutorial;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TutorialCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TutorialCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
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
        CRUD::setModel(\App\Models\Tutorial::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/tutorial');
        CRUD::setEntityNameStrings( __('Tutorial'), __('Published Tutorials'));
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('title')->label( __('Title'));
        CRUD::addColumn([
            'name' => 'url',
            'label' => __('Url'),
            'type' => 'closure',
            'function' => function ($entry) {
                return "<a href='$entry->url' target='_blank'>" . substr( $entry->url, 0, 40) . "[..]</a>";
            },
            'searchLogic' => 'text'
        ]);
        CRUD::column('addedBy.username')->label( __('Added By'));
        CRUD::column('created_at')->label( __('Created At'));
    }

    /**
	 * Define what happens when the Show operation is loaded.
	 * 
	 * @see https://backpackforlaravel.com/docs/4.1/crud-operation-show
	 * @return void
	 */
	protected function setupShowOperation()
	{
        // Stop default loading coulmns from database
        CRUD::set('show.setFromDb', false);
        
        CRUD::addColumn([
            'name' => 'url',
            'label' => __('Url'),
            'type' => 'closure',
            'function' => function ($entry) {
                return "<a href='$entry->url' target='_blank'>$entry->url</a>";
            }
        ]);
        CRUD::column('title')->label( __('Title') );
        CRUD::column('filters')->type('array')->label( __('Filters') );
        CRUD::column('tools')->type('relationship')->label( __("Tools") );
        CRUD::column('addedBy.username')->label( __('Added By') );
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

        CRUD::setValidation(TutorialRequest::class);

        CRUD::field('url')->type('url')->label( __('Url'));
        CRUD::field('title')->label( __('Title'));
        CRUD::addField([
            'name'  => 'added_by',
            'type'  => 'hidden',
            'value' => auth()->id()
        ]);
        CRUD::addField([
            'label'     => __('Tools'),
            'type'      => 'select2_multiple',
            'name'      => 'tools',
            'attribute' => 'title', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?       
            'options'   => (function ($query) {
                return $query->orderBy('title', 'ASC')->get();
            })
        ]);
        CRUD::addField([
            'name'        => 'difficulty',
            'label'       => __('Level'),
            'type'        => 'radio',
            'options'     => [
                'beginner' => __('Beginner'),
                'advanced' => __('Advanced')
            ],
            'inline' => 'true',
            'fake' => true,
            'store_in' => 'filters'
        ]);
        CRUD::addField([
            'name'        => 'price',
            'label'       => __('Price'),
            'type'        => 'radio',
            'options'     => [
                'free' => __('Free'),
                'paid' => __('Paid')
            ],
            'inline' => true,
            'fake' => true,
            'store_in' => 'filters'
        ]);
        CRUD::addField([
            'name'        => 'type',
            'label'       => __('Content type'),
            'type'        => 'radio',
            'options'     => [
                'video' => __('Video'),
                'book' => __('Book'),
                'interactive' => __('Interactive')
            ],
            'inline' => true,
            'fake' => true,
            'store_in' => 'filters'
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
        
        // Get the tutorial to get default filters' values
        $tutorial = Tutorial::find( request()->id, ['filters']);

        // Modify fields to set default values from db
        $this->crud->modifyField('difficulty', [
            'default' => $tutorial->filters['difficulty']
        ]);
        $this->crud->modifyField('price', [
            'default' => $tutorial->filters['price']
        ]);
        $this->crud->modifyField('type', [
            'default' => $tutorial->filters['type']
        ]);

    }
}
