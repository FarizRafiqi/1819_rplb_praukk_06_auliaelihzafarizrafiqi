<?php

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;

class PermissionCreate extends Component
{
    public $permissions = [];
    public $counter = 1;
    public $maxPermissions = 10;
    protected $rules = [
        'permissions' => 'required|array',
        'permissions.*.title' => 'required|string|min:3'
    ];

    protected $messages =  [
        'permissions.required' => 'Permission tidak boleh kosong',
        'permissions.array' => 'Permission harus berupa array',
        'permissions.*.title.required' => 'Title tidak boleh kosong',
        'permissions.*.title.string' => 'Title harus berupa karakter',
        'permissions.*.title.min' => 'Title minimal terdiri dari 3 karakter',
    ];

    public function mount()
    {
        $this->permissions = [['title' => '']];
    }

    public function render()
    {
        return view('livewire.admin.permission.permission-create');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function addPermission()
    {
        if($this->counter < $this->maxPermissions){
            $this->counter++;
            $this->permissions[] = ['title' => ''];
        }
        $this->emit('reachMaxPermissionAllowed');
    }

    public function removePermission($id)
    {
        if(count($this->permissions) <= 1){
            $this->permissions = $this->permissions;
        }else{
            unset($this->permissions[$id]);
            $this->permissions = array_values($this->permissions);
            $this->counter--;
        }
    }

    public function store()
    {

    }
}
