<?php

namespace App\Views\Composers;


use App\Models\Comment;
use Illuminate\View\View;
class CommentComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $commentAll;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        
        $this->commentAll = Comment::all();

    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('commentAll', $this->commentAll);
    }
}
