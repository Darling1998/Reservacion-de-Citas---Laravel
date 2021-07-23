<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
class UsersIndex extends Component
{
    use WithPagination;

    protected $paginationTheme='bootstrap';

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        /* select * from users u inner join people p on u.persona_id=p.id */
       
        $users= User::join('people', 'users.persona_id', '=', 'people.id')
            ->select('users.email','users.id', 'people.nombres','people.apellidos','people.genero')
            ->where('email','LIKE','%'.$this->search.'%')
            ->orWhere('nombres','LIKE','%'.$this->search.'%')->paginate();


         //$users = User::where('email','LIKE','%'.$this->search.'%')->paginate(); 
        return view('livewire.admin.users-index',compact('users'));
    }
}
