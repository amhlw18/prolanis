<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Peserta Prolanis</h4>
                </div><!-- end card header -->

                @if (session('sukses'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.duration.500ms
                        class="alert alert-success alert-dismissible border-2 bg-body-secondary fade show material-shadow m-3"
                        role="alert">
                        <strong>{{ session('sukses') }}</strong>
                        <button type="button" class="btn-close" @click="show = false" aria-label="Close"></button>
                    </div>
                @endif


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                    id="create-btn" data-bs-target="#showModal"><i
                                        class="ri-add-line align-bottom me-1"></i> Tambah Peserta</button>

                            </div>
                            <div class="card-body" wire:ignore>
                                <table id="alternative-pagination"
                                    class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>NIK</th>
                                            <th>No BPJS</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>No Hp</th>
                                            <th>Diagnosa</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataPeserta as $peserta)
                                            <tr>
                                                <td class="customer_name">{{ $peserta->nik }}</td>
                                                <td class="customer_name">{{ $peserta->no_bpjs }}</td>
                                                <td class="email">{{ $peserta->nama }}</td>
                                                <td class="phone">{{ $peserta->alamat }}</td>
                                                <td class="date">{{ $peserta->no_hp }}</td>
                                                <td class="status">
                                                    {{-- Membuat warna badge berbeda tergantung diagnosa --}}
                                                    @if ($peserta->diagnosa == 'Diabetes')
                                                        <span
                                                            class="badge bg-warning-subtle text-warning text-uppercase">{{ $peserta->diagnosa }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-danger-subtle text-danger text-uppercase">{{ $peserta->diagnosa }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <button class="btn btn-sm btn-success edit-item-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#showModal">Edit</button>
                                                        </div>
                                                        <div class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deleteRecordModal"
                                                                wire:click="$set('idHapus', {{ $peserta->id }} )"
                                                                onclick="confirmDelete({{ $peserta->id }})">Hapus</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form wire:submit.prevent="tambahPeserta" class="tablelist-form" autocomplete="off">
                    <div class="modal-body">
                        <div class="mb-3" id="modal-id" style="display: none;">
                            <label for="id-field" class="form-label">ID</label>
                            <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                        </div>


                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input wire:model="nik" type="number" id="nik"
                                class="form-control  @error('nik') is-invalid @enderror" placeholder="Masukan NIK" />
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="no_bpjs" class="form-label">Nomor BPJS</label>
                            <input wire:model="no_bpjs" type="number" id="no_bpjs"
                                class="form-control  @error('no_bpjs') is-invalid @enderror"
                                placeholder="Masukan Nomor BPJS" />
                            @error('no_bpjs')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Peserta</label>
                            <input wire:model="nama" type="text" id="nama"
                                class="form-control  @error('nama') is-invalid @enderror"
                                placeholder="Masukan Nama Peserta" />
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input wire:model="alamat" type="text" id="alamat"
                                class="form-control  @error('alamat') is-invalid @enderror"
                                placeholder="Masukan Alamat" />
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor Handphone</label>
                            <input wire:model="no_hp" type="text" id="no_hp"
                                class="form-control  @error('no_hp') is-invalid @enderror"
                                placeholder="Masukan Nomor Handphone" />

                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div>
                            <label for="diagnosa" class="form-label">Diagnosa</label>
                            <select wire:model="diagnosa"
                                class="form-control  @error('diagnosa') is-invalid @enderror" data-trigger
                                name="diagnosa" id="diagnosa">
                                <option value="">Diagnosa</option>
                                <option value="Diabetes">Diabetes</option>
                                <option value="Hipertensi">Hipertensi</option>
                            </select>
                            @error('diagnosa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Tambahkan Peserta</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger " id="delete-record"
                            wire:click="hapusPeserta(idHapus)">Yes,
                            Delete
                            It!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('peserta-ditambahkan', () => {
                // Ambil element modal
                const modalElement = document.getElementById('showModal');

                // Dapatkan instance Bootstrap modal yang sedang aktif
                const modal = bootstrap.Modal.getInstance(modalElement);

                if (modal) {
                    modal.hide(); // Tutup modal secara paksa lewat JS jika sukses
                }

                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            });
        });
    </script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Memanggil fungsi hapus di Livewire component
                    @this.call('hapusPeserta', id);
                }
            })
        }

        // Listener untuk sukses menghapus
        window.addEventListener('peserta-dihapus', event => {
            Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
        });
    </script>


</div>
