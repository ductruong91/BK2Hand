<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategorySelect extends Component
{
    public $categories = [];
    public $subCategories = [];
    public $selectedCategory;

    protected $listeners = [
        'update'
    ];

    public function render()
    {
        return view('livewire.category-select');
    }

    public function mount()
    {
        $this->categories = Category::all()->whereNull('parent_id');
        foreach ($this->categories as $category) {
            $category->subCategories;
        }
    }

    public function update($key)
    {
        $this->subCategories = $this->categories[$key]['subCategories'];
    }
}
