<?php

namespace App\Http\Livewire\Admin\Distributor;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Bouncer;

class Edit extends Component
{

    public $dist;
    // public $dist_country;
    // public $dist_manager;
    public $countries;
    public $users;
    public $managers;

    public $password;
    public $password_confirmation;

    public function mount($distributor_id)
    {

        if (Bouncer::cannot('edit-distributor')) {
            abort(404);
        }

        $this->dist = User::with([
            'distributor',
        ])->findOrFail($distributor_id);

        // $this->dist_country = $this->dist->distributor->country;
        // $this->dist_manager = $this->dist->distributor->manager;

        $this->countries = Country::all();
        $this->users = User::WhereIsNot('distributor')->get();
    }

    protected function rules()
    {
        return [
            'dist.distributor.company_name' => 'required',
            'dist.name' => 'required',
            'dist.email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->dist->id)],
            'dist.distributor.phone' => ['required'],
            'dist.distributor.address' => ['required'],
            'dist.distributor.country_code' => ['required'],
            'password' => ['nullable', 'min:8'],
            'password_confirmation' => ['required_with:password', 'same:password'],
            'dist.status' => ['required'],
            'dist.distributor.manager_id' => ['required'],
        ];
    }

    protected $messages = [
        'password.required' => 'Please enter a password',
        'dist.distributor.company_name.required' => 'Please enter company name',
        'dist.name.required' => 'Please enter a name',
        'dist.email.email' => 'The email address format is not valid.',
        'dist.email.required' => 'The email address is required.',
        'password_confirmation.same' => 'The password confirmation does not match.',
        'password_confirmation.required_with' => 'Please enter the password again.',
        'dist.email.unique' => 'The email is already take, please use another email.',
    ];

    public function save()
    {
        $this->validate();

        if ($this->password !== "") {
            $this->dist->password = $this->password;
            $this->reset([
                'password_confirmation',
                'password'
            ]);
        }

        $this->dist->distributor->save();
        $this->dist->save();
        $this->dispatchBrowserEvent('updated');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->managers = new Collection();

        foreach ($this->users as $manager) {
            if ($manager->can('manage-distributor')) {
                $this->managers->add($manager);
            }
        }

        return view('livewire.admin.distributor.edit');
    }
}
