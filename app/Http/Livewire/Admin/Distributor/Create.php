<?php

namespace App\Http\Livewire\Admin\Distributor;

use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class Create extends Component
{
    public $countries;
    public $users;
    public $managers;


    // Forms
    public $name;
    public $company_name;
    public $email;
    public $phone;
    public $address;
    public $country = 0;
    public $password;
    public $password_confirmation;
    public $status = 1;
    public $manager = 0;

    public function mount()
    {
        $this->countries = Country::all();
        $this->country = $this->countries->first()->id;

        $this->users = User::WhereIsNot('distributor')->get();
    }

    protected function rules()
    {
        return [
            'company_name' => 'required',
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required'],
            'address' => ['required'],
            'country' => ['required'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required_with:password', 'same:password'],
            'status' => ['required'],
            'manager' => ['required'],
        ];
    }

    protected $messages = [
        'password.required' => 'Please enter a password',
        'company_name.required' => 'Please enter company name',
        'name.required' => 'Please enter a name',
        'email.unique' => 'The email is already take, please use another email.',
        'email.email' => 'The email address format is not valid.',
        'email.required' => 'The email address is required.',
        'password_confirmation.same' => 'The password confirmation does not match.',
    ];

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'status' => $this->status,
        ]);

        $user->assign('distributor');

        $user->distributor()->create([
            'company_name' => $this->company_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'country_code' => $this->country,
            'manager_id' => $this->manager,
            'distributer_code' => "asd",
        ]);

        $this->reset([
            'company_name',
            'name',
            'email',
            'phone',
            'address',
            'country',
            'password',
            'password_confirmation',
            'status',
            'manager',
        ]);

        $this->dispatchBrowserEvent('created');
    }

    public function render()
    {
        $this->managers = new Collection();

        foreach ($this->users as $manager) {
            if ($manager->can('manage-distributor')) {
                $this->managers->add($manager);
            }
        }

        $this->manager = $this->managers->first()->id;

        return view('livewire.admin.distributor.create');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
