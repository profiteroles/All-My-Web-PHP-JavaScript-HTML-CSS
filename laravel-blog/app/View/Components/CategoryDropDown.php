<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryDropDown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('components.category-drop-down',[
            'categories'=> Category::all(),
            'currentCategory'=> Category::firstWhere('slug',request('category')),
        ]);
    }
}
