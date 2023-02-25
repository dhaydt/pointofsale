<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <div class="card-title">
                {{ $title }}
            </div>
            <div class="card-toolbar">
                <button type="button" wire:click.prevent="$emit('onClickAdd')"
                    class="btn btn-sm btn-light-success btn-hover-rotate-end" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Tambah outlet">
                    <i class="fas fa-plus-square mr-2"></i> Outlet
                </button>
            </div>
        </div>
        <div class="card-body">
            @include('livewire.helper.alert-session')
            <div class="row justify-content-between">
                <div class="mb-4 input-group input-group-outline w-md-25 w-50">
                    <input type="text" class="form-control" placeholder="Search..." wire:model="search">
                </div>

                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-light-success btn-sm" wire:click="$emit('onClickRefresh')" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Refresh Data Outlet">
                        <i class="fas fa-sync-alt"></i> Segarkan
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table id="id" class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">No
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">Nama Outlet
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Cabang
                            </th>
                            {{-- <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Lokasi
                            </th> --}}
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Alamat
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($outlet) > 0)
                        @foreach ($outlet as $i => $item)
                        <tr>
                            <td class="align-middle text-center">{{ ($page - 1) * $total_show + $i +1 }}</td>
                            <td class="align-middle text-center text-capitalize">{{ $item->nama_outlet}}</td>
                            <td class="align-middle text-center text-capitalize">{{ $item->cabang->nama_office}}</td>
                            <td class="align-middle text-center text-capitalize">{{ $item->address}}</td>
                            <td class="align-middle text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" wire:click.prevent="$emit('onClickUpdateOutlet', {{ $item }})"
                                        class="btn btn-sm bg-success text-white btn-hover-rotate-start"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Ubah data {{ $item->nama_outlet}}"><i
                                            class="fas fa-edit text-light"></i></button>
                                    <button type="button" wire:click.prevent="$emit('onClickDelete', `{{ $item->id }}`)"
                                        class="btn btn-sm bg-danger btn-hover-rotate-end" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Hapus data {{ $item->nama_outlet}}"><i
                                            class="fas fa-trash text-light"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="no-data">
                            <td colspan="6">
                                <div class="row justify-content-center mx-0">
                                    <img src="{{ asset('assets/img/no_data.png') }}" alt=""
                                        class="h-125px w-125px">
                                    <div class="text-center">
                                        <span class="badge badge-square badge-lg badge-danger text-capitalize p-2">
                                            Tidak ada data Outlet</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row px-9 pt-3 pb-5">
                <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                    @include('livewire.helper.total-show')
                </div>
                <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                    {{ $outlet->links() }}
                </div>
            </div>
        </div>
    </div>
    <!--Modal Add -->
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_add" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Masukan Data Outlet</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <form wire:submit.prevent="save" id="form_add">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpan', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Kantor Cabang</label>
                            <select class="form-select form-select-solid" wire:model="cabang_id">
                                <option value="">-- Pilih Kantor Cabang --</option>
                                @foreach ($cabang as $c)
                                    <option value="{{ $c['id'] }}">{{ $c['nama_office'] }}</option>
                                @endforeach
                            </select>
                            @error('cabang_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Nama Outlet</label>
                            <input type="text" class="form-control form-control-solid" wire:model="name"
                                placeholder="Masukan nama outlet" />
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Lokasi Outlet</label>
                            <input type="text" class="form-control form-control-solid" wire:model="lokasi"/>
                            @error('lokasi')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> --}}
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Alamat Outlet</label>
                            <textarea class="form-control form-control-solid" wire:model="address"></textarea>
                            @error('address')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal Update -->
    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_update" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data Outlet</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <form wire:submit.prevent="update" id="form_update">
                    <input type="hidden" wire:mode="cabang_id">
                    <div class="modal-body">
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'update', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Kantor Cabang</label>
                            <select class="form-select form-select-solid" wire:model="cabang_id">
                                <option value="">-- Pilih Kantor Cabang --</option>
                                @foreach ($cabang as $c)
                                    <option value="{{ $c['id'] }}">{{ $c['nama_office'] }}</option>
                                @endforeach
                            </select>
                            @error('cabang_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Nama Outlet</label>
                            <input type="text" class="form-control form-control-solid" wire:model="name"
                                placeholder="Masukan nama outlet" />
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Lokasi Outlet</label>
                            <input type="text" class="form-control form-control-solid" wire:model="lokasi"/>
                            @error('lokasi')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> --}}
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Alamat Outlet</label>
                            <textarea class="form-control form-control-solid" wire:model="address"></textarea>
                            @error('address')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('js')
<script>
    $(document).ready(function() {
        $('#hak_akses, #hak_akses_update').select2({});

        $('#hak_akses').on('change', function (e) {
            let data = $(this).val();
            @this.set('hak_akses', data);
        });

        $('#hak_akses_update').on('change', function (e) {
            let data = $(this).val();
            @this.set('hak_akses', data);
        });
    });
    window.addEventListener('contentChange', event => {

    })

        Livewire.on('onClickAdd', () => {
            $('#modal_add').modal('show')
        })

        Livewire.on('refresh', () => {
            $('#modal_update').modal('hide')
            $('#modal_add').modal('hide')
        })

        Livewire.on("finishOutlet", (status, message) => {
            alertMessage(status, message)
        })

        Livewire.on('onClickRefresh', (id) => {
            Livewire.emit('refreshOutlet')
            alertMessage(1, 'Data berhasil diperbarui!')
        })

        Livewire.on('onClickUpdateOutlet', (item) => {
            console.log('called', item);
            Livewire.emit('setOutlet', item);
            $('#modal_update').modal('show')
        })

        Livewire.on('onClickDelete', async (id) => {
            const response = await alertHapus('Warning !!!', 'Anda yakin ingin menghapus data outlet ini?')
            if(response.isConfirmed == true){
                @this.set('outlet_id', id)
                Livewire.emit('delete')
            }
        })
</script>
@endpush
