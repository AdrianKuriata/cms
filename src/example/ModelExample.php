<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Akuriatadev\Wordit\AppTraits\WorditTrait;

class Example extends Model
{
    use WorditTrait;

    protected $fillable = [
        'title', 'slug', 'description'
    ];

    /**
     * If you want define or rewrite model controller you need give here a route to the your controller and just rewrite functions
     * @url https://example.com/model-controller-methods
     */
    protected $controller = 'App\Http\Controllers\ExampleController';

    /**
     * Here is a labels for define some singular and plural names in admin panel
     */
    protected $labels = [
        'singular_name' => 'Strona',
        'plural_name' => 'Strony',
        'all_items' => 'Wszystkie strony',
        'search_name' => 'Szukaj strony',
        'add_item' => 'Dodaj stronę',
        'remove_item' => 'Usuń stronę',
        'remove_item_all' => 'Usuń strony',
        'update_item' => 'Aktualizuj stronę',
        'count_item' => 'Stron',
        'icon' => 'fa fa-user'
    ];

    /**
     * Here you can define which fields should be displayed in index model page.
     */
    protected $adminTable = [
        [
            'name' => 'title',
            'display_name' => 'Tytuł',
        ],
        [
            'name' => 'created_at',
            'display_name' => 'Utworzony',
        ],
        // [
        //     'name' => 'user',
        //     'display_name' => 'Twórca',
        //     'relation' => [
        //         'name' => 'user',
        //         'relation_display_field' => 'name'
        //     ]
        // ]
    ];

    /**
     * This is a form property for setting form create-update in admin panel.
     * Left - this is a left col-8 column
     * Right - this is a right col-8 column
     * In every column you can define a card like a Publishing, SEO, Settings etc., whatever you want
     * Title is a card title and data is a information about fields in form
     */
    protected $form = [
        'left' => [
            'tresci' => [
                'title' => 'Treści',
                'data' => [
                    [
                        'name' => 'title',
                        'placeholder' => 'Wprowadź nazwę strony',
                        'type' => 'text',
                        'label' => 'Nazwa strony',
                        'class' => 'col-12'
                    ]
                ]
            ]
        ],
        'right' => [
            [
                'title' => 'Informacje',
                'data' => [
                    [
                        'name' => 'slug',
                        'placeholder' => 'Wprowadź odnośnik strony',
                        'type' => 'text',
                        'label' => 'Odnośnik strony',
                        'class' => 'col-12'
                    ]
                ]
            ]
        ]
    ];

    /**
     * Here is a validation property, where you define validation rules for form fields
     */
    protected $validation = [
        'title' => 'required|min:3|max:64',
        'slug' => 'sometimes|nullable|min:3|max:64'
    ];

    /**
     * This is route name which will be users for route names and route url, ex. wordit.admin.pages.create.get
     */
    protected $route_name = 'pages';

    /**
     * This is permissions for models, which will be user in default routes for model
     */
    protected $permissions = [
        'view' => [
            'view-page',
            'can_view_page',
        ],
        'create' => [
            'create-page',
            'can_create_page',
        ],
        'update' => [
            'update-page',
            'can_update_page',
        ],
        'delete' => [
            'detele-page',
            'can_delete_page',
        ]
    ];
}
