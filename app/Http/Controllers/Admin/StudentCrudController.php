<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use Illuminate\Http\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\UserStoreCrudRequest as StoreRequest;
use App\Http\Requests\UserUpdateCrudRequest as UpdateRequest;

class StudentCrudController extends CrudController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:enrollments.view']);
    }
    
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Student');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/student');
        $this->crud->setEntityNameStrings('student', 'students');
        //$this->crud->removeAllButtons();

        $this->crud->removeButton('delete');
        $this->crud->removeButton('create');
        $this->crud->removeButton('update');

        $this->crud->allowAccess('show');
        $this->crud->denyAccess('create');

        //$this->crud->addClause('student');

        $permissions = backpack_user()->getAllPermissions();
        
        if($permissions->contains('name', 'enrollments.create')) {
            $this->crud->addButtonFromView('line', 'selectCourse', 'selectCourse', 'beginning');
        }
        
        if(!$permissions->contains('name', 'students.edit')) {
            $this->crud->denyAccess('edit');
        }

        $this->crud->orderBy('created_at', 'desc');

        // Columns.
        $this->crud->setColumns([
            [
                'label' => "ID number",
                'type' => "text",
                'name' => 'idnumber'
            ],
            [
                'label' => __('First Name'),
                'type' => "select",
                'name' => 'user_id',
                'entity' => 'user',
                'attribute' => "firstname",
                'model' => "App\Models\User",
            ],
            [
                'label' => __('Last Name'),
                'type' => "select",
                'name' => 'user_id',
                'entity' => 'user',
                'attribute' => "lastname",
                'model' => "App\Models\User",
            ],
            [
                'name'  => 'email',
                'label' => trans('backpack::permissionmanager.email'),
                'type'  => 'text',
            ],
            
        ]);

        // Fields
        $this->crud->addFields([
            [  // Select2
                'label' => trans('firstname'),
                'type' => 'text',
                'name' => 'firstname'
            ],
            [  // Select2
                'label' => trans('lastname'),
                'type' => 'text',
                'name' => 'lastname'
            ],
            [
                'name'  => 'email',
                'label' => trans('backpack::permissionmanager.email'),
                'type'  => 'email',
            ],
            [
                'name'  => 'password',
                'label' => trans('backpack::permissionmanager.password'),
                'type'  => 'password',
            ],
            [
                'name'  => 'password_confirmation',
                'label' => trans('backpack::permissionmanager.password_confirmation'),
                'type'  => 'password',
            ],
            [
                'name'  => 'birthdate',
                'label' => trans('birthdate'),
                'type'  => 'date',
            ],
            [
                'name'  => 'language',
                'label' => trans('language'),
                'type'  => 'text',
            ],

        ]);

    }

    /**
     * Store a newly created resource in the database.
     *
     * @param StoreRequest $request - type injection used for validation using Requests
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->handlePasswordInput($request);

        return parent::storeCrud($request);
    }

    /**
     * Update the specified resource in the database.
     *
     * @param UpdateRequest $request - type injection used for validation using Requests
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        $this->handlePasswordInput($request);

        return parent::updateCrud($request);
    }

    public function show($student)
    {
        $student = Student::findOrFail($student);
        $comments = $student->comments;

        return view('students/show', compact('student', 'comments'));
    }


    /**
     * Handle password input fields.
     *
     * @param Request $request
     */
    protected function handlePasswordInput(StoreRequest $request)
    {
        // Remove fields not present on the user.
        $request->request->remove('password_confirmation');

        // Encrypt password if specified.
        if ($request->input('password')) {
            $request->request->set('password', bcrypt($request->input('password')));
        } else {
            $request->request->remove('password');
        }
    }
}