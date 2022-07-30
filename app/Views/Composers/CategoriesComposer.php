<?php

namespace App\Views\Composers;

use App\Models\Category;
use Illuminate\View\View;
class CategoriesComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $categoryAll;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        
        $this->categoryAll = Category::all();

    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categoryAll', $this->categoryAll);
    }
}
