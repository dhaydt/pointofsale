<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <div class="card-title">
                {{ $title }}
            </div>
            <div class="card-toolbar">
                <button type="button" wire:click.prevent="$emit('onClickAdd')"
                    class="btn btn-sm btn-light-success btn-hover-rotate-end" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Tambah jasa">
                    <i class="fas fa-plus-square mr-2"></i> Jasa
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
                        data-bs-placement="top" title="Refresh Data jasa">
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
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">Nama Jasa
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">Kategori
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">Foto
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">Harga (Rp.)
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($jasa) > 0)
                        @foreach ($jasa as $i => $item)
                        <tr>
                            <td class="align-middle text-center">{{ ($page - 1) * $total_show + $i +1 }}</td>
                            <td class="align-middle text-center text-capitalize">{{ $item->name}}</td>
                            <td class="align-middle text-center text-capitalize">{{ $item->category->name}}</td>
                            <td class="align-middle text-center text-capitalize">
                                <img src="{{ asset('/'.$item->image) }}" onerror="this.src='{{ asset('assets/img/placeholder.png') }}'" alt="" style="height: 80px;">
                            </td>
                            <td class="align-middle text-center text-capitalize">Rp. {{ (float)$item->price}}</td>
                            <td class="align-middle text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" wire:click.prevent="$emit('onClickUpdateJasa', `{{ $item }}`)"
                                        class="btn btn-sm bg-success text-white btn-hover-rotate-start"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Ubah data {{ $item->name}}"><i
                                            class="fas fa-edit text-light"></i></button>
                                    <button type="button" wire:click.prevent="$emit('onClickDelete', `{{ $item->id }}`)"
                                        class="btn btn-sm bg-danger btn-hover-rotate-end" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Hapus data {{ $item->name}}"><i
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
                                            Tidak ada data jasa</span>
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
                    {{ $jasa->links() }}
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
                    <h5 class="modal-title">Masukan Data jasa</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <form wire:submit.prevent="save" id="form_add">
                    <div class="modal-body">
                        {{-- @include('helper.alert-message') --}}
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpan', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Kategori</label>
                            <select class="form-select form-select-solid" wire:model="cat_id">
                                <option value="">-- Pilih Kategori jasa --</option>
                                @foreach ($category as $c)
                                    <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                                @endforeach
                            </select>
                            @error('cat_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Nama jasa</label>
                            <input type="text" class="form-control form-control-solid" wire:model="name"
                                placeholder="Masukan nama jasa" />
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column mb-8">
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span class="">Foto jasa</span>
                            </label>
                            <div class="col-6">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                    @if ($img)
                                    <img class="image-input image-input-outline img-profile"
                                        src="{{ $img->temporaryUrl() }}"></img>
                                    @else
                                    <img id="placeholderJasa" src="{{ $photo }}" class="img-profile preview-img"
                                        onerror="this.src='{{ asset('assets/img/placeholder.png') }}'">
                                    @endif
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="Masukan foto jasa">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" id="jasa-img" name="img" accept=".png, .jpg, .jpeg"
                                            wire:model="img" />
                                        {{-- <input type="hidden" name="avatar_remove" /> --}}
                                    </label>
                                </div>
                                <div class="form-text">Tipe file yang diterima: png, jpg, jpeg.</div>
                                @error('img')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Harga jasa</label>
                            <input type="number" class="form-control form-control-solid" wire:model="price"
                                placeholder="Masukan harga jasa" />
                            @error('price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Deskripsi jasa</label>
                            <textarea class="form-control form-control-solid" wire:model="description"></textarea>
                            @error('description')
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
                    <h5 class="modal-title">Ubah Data jasa</h5>

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
                            <label for="exampleFormControlInput1" class="required form-label">Kategori</label>
                            <select class="form-select form-select-solid" wire:model="cat_id">
                                <option value="">-- Pilih Kategori jasa --</option>
                                @foreach ($category as $c)
                                    <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                                @endforeach
                            </select>
                            @error('cat_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Nama jasa</label>
                            <input type="text" class="form-control form-control-solid" wire:model="name"
                                placeholder="Masukan nama jasa" />
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column mb-8">
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span class="">Foto jasa</span>
                            </label>
                            <div class="col-6">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                    @if ($img)
                                    <img class="image-input image-input-outline img-profile"
                                        src="{{ $img->temporaryUrl() }}"></img>
                                    @else
                                    <img id="placeholder" src="{{ $photo }}" class="img-profile preview-img"
                                        onerror="this.src='{{ asset('assets/img/placeholder.png') }}'">
                                    @endif
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="Masukan foto jasa">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" id="profile" name="img" accept=".png, .jpg, .jpeg"
                                            wire:model="img" />
                                        {{-- <input type="hidden" name="avatar_remove" /> --}}
                                    </label>
                                </div>
                                <div class="form-text">Tipe file yang diterima: png, jpg, jpeg.</div>
                                @error('img')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Harga jasa</label>
                            <input type="number" class="form-control form-control-solid" wire:model="price"
                                placeholder="Masukan harga jasa" />
                            @error('price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Deskripsi jasa</label>
                            <textarea class="form-control form-control-solid" wire:model="description"></textarea>
                            @error('description')
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
    });
    window.addEventListener('contentChange', event => {

    })
        $('#jasa-img').change(function(){
            $('#placeholderJasa').addClass('d-none');
        });

        Livewire.on('onClickAdd', () => {
            $('#modal_add').modal('show')
        })

        Livewire.on('refresh', () => {
            $('#modal_update').modal('hide')
            $('#modal_add').modal('hide')
        })

        Livewire.on("finishJasa", (status, message) => {
            alertMessage(status, message)
        })

        Livewire.on('onClickRefresh', (id) => {
            Livewire.emit('refreshJasa')
            alertMessage(1, 'Data berhasil diperbarui!')
        })

        Livewire.on('onClickUpdateJasa', (item) => {
            Livewire.emit('updateJasa', item);
            $('#modal_update').modal('show')
        })

        Livewire.on('onClickDelete', async (id) => {
            const response = await alertHapus('Warning !!!', 'Anda yakin ingin menghapus data jasa ini?')
            if(response.isConfirmed == true){
                @this.set('jasa_id', id)
                Livewire.emit('delete')
            }
        })
</script>
@endpush
