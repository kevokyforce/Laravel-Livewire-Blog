<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{

    use WithPagination;

    #[url()]
    public $sort = 'desc';
    public $search = '';

    public function setSort($sort)
    {
        $this->sort = ($sort == 'desc') ?'desc':'asc';
    }

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;

    }

     #[computed()]
    public function posts()
    {
        return Post::published()->orderBy('published', $this->sort)
        ->where('title', 'like', "%{$this->search}%")
        ->simplePaginate(4);
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
