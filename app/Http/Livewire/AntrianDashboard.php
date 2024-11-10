<?php

namespace App\Http\Livewire;

use App\Models\Poli;
use Livewire\Component;

class AntrianDashboard extends Component
{
    public $antrianPolis;

    protected $listener = ['antrianUpdated'];

    public function mount()
    {
        $this->antrianUpdated();
    }

    public function antrianUpdated()
    {
        $this->antrianPolis = Poli::withCount([
            'antrians as total',
            'antrians as antrian' => function ($query) {
                $query->where('status', 1);
            }
        ])->get()->map(function ($poli) {
            $color = ['secondary', 'primary', 'success', 'danger'];
            $poli->color = $color[rand(0, 3)];
            return $poli;
        });
    }

    public function render()
    {
        return view('livewire.antrian-dashboard');
    }
}
