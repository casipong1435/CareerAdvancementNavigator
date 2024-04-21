<?php

namespace App\Livewire\Admin;
use App\Models\school;

use Livewire\Component;

class SchoolList extends Component
{
    public $district = '';
    public $school_name;

    public function render()
    {
        $district1 = school::where('district', 1)->get();
        $district2 = school::where('district', 2)->get();
        $district3 = school::where('district', 3)->get();
        $district4 = school::where('district', 4)->get();
        $district5 = school::where('district', 5)->get();
        $district6 = school::where('district', 6)->get();
        $district7 = school::where('district', 7)->get();
        $district8 = school::where('district', 8)->get();
        $district9 = school::where('district', 9)->get();
        $district10 = school::where('district', 10)->get();
        $division = school::where('district', 'Division')->get();

        return view('livewire.admin.school-list', 
        [
            'district1' => $district1,
            'district2' => $district2,
            'district3' => $district3,
            'district4' => $district4,
            'district5' => $district5,
            'district6' => $district6,
            'district7' => $district7,
            'district8' => $district8,
            'district9' => $district9,
            'district10' => $district10,
            'division' => $division,
        ]);
    }

    public function addSchool(){
        //dd($this->district, $this->school_name);
        $this->validate([
            'district' => 'required',
            'school_name' => 'required'
        ]);

        try{
            school::create(['district' => $this->district, 'school_name' => $this->school_name]);
            session()->flash('success', 'New School Added!');
            $this->district = '';
            $this->school_name = '';
            $this->dispatch('hide:modal');
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!');
        }
    }

    public function deleteSchool($id){
        school::where('id', $id)->delete();
    }
}
