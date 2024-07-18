<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChildrenComments extends Component
{
    public $replies;

    public function __construct($replies)
    {
        $this->replies = $replies;
    }

    public function render()
    {
        return view('components.children-comments');
    }
}
