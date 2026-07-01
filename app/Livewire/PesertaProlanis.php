<?php

namespace App\Livewire;

use App\Models\PesertaProlanis as ModelsPesertaProlanis;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PesertaProlanis extends Component
{
    public function render()
    {
        $dataPeserta = ModelsPesertaProlanis::orderBy('created_at', 'desc')->get();

        // Kirim variabel $dataPeserta ke view
        return view('livewire.peserta-prolanis', [
            'dataPeserta' => $dataPeserta
        ]);
    }

    // Tambahkan unique:peserta_prolanis,nik
    #[Validate('required|digits:3|unique:peserta_prolanis,nik')]
    public $nik = '';

    // Tambahkan unique:peserta_prolanis,no_bpjs
    #[Validate('required|digits:3|unique:peserta_prolanis,no_bpjs')]
    public $no_bpjs = '';

    #[Validate('required')]
    public $nama = '';

    #[Validate('required')]
    public $alamat = '';

    #[Validate('required|digits:3')]
    public $no_hp = '';

    #[Validate('required')]
    public $diagnosa = '';

    protected function messages()
    {
        return [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari tepat 16 digit.',
            'nik.unique' => 'NIK ini sudah terdaftar. Silakan gunakan NIK lain.', // Pesan error baru

            'no_bpjs.required' => 'Nomor BPJS wajib diisi.',
            'no_bpjs.digits' => 'Nomor BPJS harus terdiri dari tepat 13 digit.',
            'no_bpjs.unique' => 'Nomor BPJS ini sudah terdaftar. Silakan gunakan nomor lain.', // Pesan error baru
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

        $this->reset();

        $this->dispatch('peserta-ditambahkan');

        session()->flash('sukses', 'Peserta prolanis berhasil ditambahkan !');
    }

    public $idHapus;

    public function hapusPeserta($id)
    {
        // Mencari data berdasarkan ID
        $peserta = ModelsPesertaProlanis::find($id);

        if ($peserta) {
            $peserta->delete();

            // Memberikan feedback sukses
            //session()->flash('sukses', 'Data berhasil dihapus.');

            // Dispatch event untuk menutup modal dan mungkin memberi notifikasi
            $this->dispatch('peserta-dihapus');
        }
    }
}
