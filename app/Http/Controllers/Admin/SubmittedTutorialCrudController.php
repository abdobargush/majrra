<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Http\Requests\Admin\SubmittedTutorialRequest;
use App\Models\SubmittedTutorial;
use App\Models\Tool;
use App\Models\User;
use App\Notifications\TutorialPublished as TutorialPublishedNotification;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SubmittedTutorialCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SubmittedTutorialCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
	use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\SubmittedTutorial::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/submittedtutorial');
        CRUD::setEntityNameStrings( __('Tutorial'), __('Submitted Tutorials'));
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'url',
            'label' => __('Url'),
            'type' => 'closure',
            'function' => function ($entry) {
                return "<a href='$entry->url' target='_blank'>$entry->url</a>";
            },
            'searchLogic' => 'text'
        ]);
        CRUD::column('addedBy.username')->label( __('Added By') );
        CRUD::column('created_at')->label( __('Created At') );

        // Remove default buttons and add review button instead
        CRUD::removeAllButtons();
        CRUD::addButtonFromView('line', 'reviewTutorial', 'review-tutorial', 'beginning');
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
        CRUD::addColumn([
            'name' => 'tools',
            'label' => __('Tools'),
            'type' => 'closure',
            'function' => function ($entry) {

                if (! $entry->tools) return;

                // Generate tools list
                $toolsArr = [];
                foreach ($entry->tools as $tool) {

                    // if tool id exist and the tool is in the db
                    if ( is_numeric($tool) ) {
                        // Get tool name
                        $tool = Tool::find($tool, ['title'])->title;
                    }

                    $toolsArr[] = $tool;
                }

                return implode(', ', $toolsArr);

            }
        ]);
        CRUD::column('addedBy.username')->label( __('Added By') );
        CRUD::column('created_at')->label( __('Created At') );

        // Add publish button
        CRUD::addButtonFromView('line', 'publishTutorial', 'publish-tutorial', 'beginning');
    }
    

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(SubmittedTutorialRequest::class);
        
        // Generate tools array for select2 options
        $tools = Tool::all();
        foreach ($tools as $tool) {
            $toolsArr[$tool->id] = $tool->title;
        }

        // Generate default selected tools array
        $tutorial = SubmittedTutorial::find(request()->id);
        $defaultArr = [];
        if ($tutorial->tools) {

            foreach ($tutorial->tools as $tool) {
    
                // if the tool is new add it  to tools array
                if (! is_numeric($tool) ) {
                    $toolsArr[$tool] = $tool;
                }
    
                // Add selected tools to the array
                $defaultArr[] = $tool;
            }

        }

        CRUD::field('url')->type('url')->label( __('Url') );
        CRUD::field('title')->label( __('Title') );
        CRUD::addField([
            'name' => 'tools',
            'label' => __('Tools'),
            'type' => 'select2_from_array',
            'options' => $toolsArr,
            'default' => $defaultArr,
            'allows_multiple' => true,
            'dynamicOptions' => true // allow typing custom tools
        ]);
        CRUD::addField([
            'name'        => 'filters->difficulty',
            'label'       => __('Level'),
            'type'        => 'radio',
            'options'     => [
                'beginner' => __('Beginner'),
                'advanced' => __('Advanced')
            ],
            'default' => $tutorial->filters['difficulty'],
            'inline' => true
        ]);
        CRUD::addField([
            'name'        => 'filters->price',
            'label'       => __('Price'),
            'type'        => 'radio',
            'options'     => [
                'free' => __('Free'),
                'paid' => __('Paid')
            ],
            'default' => $tutorial->filters['price'],
            'inline' => true
        ]);
        CRUD::addField([
            'name'        => 'filters->type',
            'label'       => __('Content type'),
            'type'        => 'radio',
            'options'     => [
                'video' => __('Video'),
                'book' => __('Book'),
                'interactive' => __('Interactive')
            ],
            'default' => $tutorial->filters['type'],
            'inline' => true,
        ]);

        CRUD::removeSaveActions(['save_and_edit', 'save_and_back']);
    }


    /**
     * Publish submitted tutorial
     *
     * @param int $id
     * @return void
     */
    public function publish($id)
    {
        $submittedTutorial = SubmittedTutorial::find($id);
        
        // Return alert if there is no tools
        if (! $submittedTutorial->tools) {
            Alert::add('danger', __('The tutorial must relate to tool or technology') )->flash();
            return back();
        }
        
        // Save the tutorial in tutorials table and hold it in variable
        $tutorial = User::find($submittedTutorial->added_by)->tutorials()->create([
            'title' => $submittedTutorial->title,
            'url' => $submittedTutorial->url,
            'filters' => json_encode($submittedTutorial->filters)
        ]);
            
        $toolsList = [];
        foreach ($submittedTutorial->tools as $tool) {

            if ( is_numeric($tool) ) {
                // if tool is chosen by id and already exist in the db
                array_push($toolsList, $tool);
            } else {
                // if new tool name is provided insert it first then push the id
                array_push($toolsList, Tool::create(['title' => $tool])->id);
            }

        }

        // Make the relationship between the tutorial and the tools
        $tutorial->tools()->attach($toolsList);
        
        // Delete the the tutorial from SubmittedTutorials
        $submittedTutorial->delete();
        
        // Notify the user who submitted the tutorial
        $tutorial->addedBy->notify( new TutorialPublishedNotification($tutorial->addedBy) );

        // Send success message and redirect to the list
        Alert::add('success', __('Tutorial published successfully!') )->flash();
        return redirect( $this->crud->route );
    }

}
