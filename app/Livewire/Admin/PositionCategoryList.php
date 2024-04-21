<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\PositionCategory;
use App\Models\SalaryGrade;

class PositionCategoryList extends Component
{
    public $category = '';
    public $position;
    public $salaryID;
    public $salary;

    public function render()
    {
        $teaching_category = PositionCategory::leftJoin('salary_grades', 'position_categories.position', '=', 'salary_grades.position')
                                            ->where('category', 'Teaching')->get();
        $non_teaching_category = PositionCategory::leftJoin('salary_grades', 'position_categories.position', '=', 'salary_grades.position')
                                            ->where('category', 'Non-Teaching')->get();
        $teaching_related_category = PositionCategory::leftJoin('salary_grades', 'position_categories.position', '=', 'salary_grades.position')
                                            ->where('category', 'Teaching Related')->get();

        return view('livewire.admin.position-category-list', ['teaching_category' => $teaching_category, 'non_teaching_category' => $non_teaching_category, 'teaching_related_category' => $teaching_related_category]);
    }

    public function addPosition(){
        $this->validate([
            'category' => 'required',
            'position' => 'required|unique:position_categories,position',
            'salaryID' => 'required|unique:salary_grades,salaryID',
            'salary' => 'required'
        ]);

        try{
            
            PositionCategory::create(['category' => $this->category, 'position' => $this->position]);
            SalaryGrade::create(['position' => $this->position, 'salaryID' => $this->salaryID, 'salary' => $this->salary]);
            session()->flash('success', 'New Position Added!');
            $this->category = '';
            $this->position = '';
            $this->salaryID = '';
            $this->salary = '';
            $this->dispatch('hide:modal');
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!');
        }
        
    }

    public function deletePosition($id){
        PositionCategory::where('id', $id)->delete();
    }
}
