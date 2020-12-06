<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Category;
use App\Models\Tag;

class HomeComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $categories;
    protected $tags;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    // public function __construct(Category $categories, Tag $tags)
    // {
    //     // Dependencies automatically resolved by service container...
    //     $this->categories = $categories;
    //     $this->tags = $tags;
    // }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // $cats = Category::where('parent_id', null)->take(5)->get();
        // $tags = Tag::all();

        // $view->withCatHomes($cats);
        // $view->withCatHomes($cats)->withTagHomes($tags);
    }
}
