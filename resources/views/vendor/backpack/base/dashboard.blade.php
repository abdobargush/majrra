@extends(backpack_view('blank'))

@php

    Widget::add([
        'type'    => 'div',
        'class'   => 'row',
        'content' => [ // widgets 
            [
                'type'          => 'progress_white',
                'class'         => 'card mb-2',
                'value'         => \App\Models\SubmittedTutorial::count(),
                'description'   => __('Submitted tutorial'),
                'progress'      => 100,
                'progressClass' => 'progress-bar bg-warning',
                'wrapper'       => [
                    'class' => 'col-sm-6 col-md-3',
                    'style' => 'border-radius: 10px;',
                ]
            ],
            [
                'type'        => 'progress_white',
                'class'       => 'card mb-2',
                'value'       => \App\Models\Tutorial::count(),
                'progress'      => 100,
                'progressClass' => 'progress-bar bg-success',
                'description' => __('Published tutorial'),
                'wrapper' => [
                    'class' => 'col-sm-6 col-md-3',
                ]
            ],
            [
                'type'        => 'progress_white',
                'class'       => 'card mb-2',
                'value'       => \App\Models\User::count(),
                'progress'      => 100,
                'progressClass' => 'progress-bar bg-info',
                'description' => __('Registered user'),
                'wrapper' => [
                    'class' => 'col-sm-6 col-md-3',
                ]
            ],
            [
                'type'        => 'progress_white',
                'class'       => 'card mb-2',
                'value'       => \App\Models\Tool::count(),
                'progress'      => 100,
                'progressClass' => 'progress-bar bg-info',
                'description' => __('Tool and Technology'),
                'wrapper' => [
                    'class' => 'col-sm-6 col-md-3',
                ]
            ]
        ]
    ])->to('before_content');
    

@endphp

@section('content')
@endsection