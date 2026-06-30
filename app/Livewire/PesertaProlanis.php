<?php

namespace App\Livewire;

use App\Models\PesertaProlanis as ModelsPesertaProlanis;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PesertaProlanis extends Component
{
    public function render()
    {
        return view('livewire.peserta-prolanis');
    }

    #[Validate('required|digits:16')]
    public $nik = '';

    #[Validate('required|digits:13')]
    public $no_bpjs = '';

    #[Validate('required')]
    public $nama = '';

    #[Validate('required')]
    public $alamat = '';

    #[Validate('required')]
    public $no_hp = '';

    #[Validate('required')]
    public $diagnosa = '';

    protected function messages()
    {
        return [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',

            'no_bpjs.required' => 'Nomor BPJS wajib diisi.',
            'no_bpjs.digits' => 'Nomor BPJS harus terdiri dari 13 digit.',
        ];
    }

    public function tambahPeserta()
    {
        $this->validate();

        ModelsPesertaProlanis::create([
            'nik' => $this->nik,
            'no_bpjs' => $this->no_bpjs,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'no_hp' => $this->no_hp,
            'diagnosa' => $this->diagnosa,
        ]);
    }
}
