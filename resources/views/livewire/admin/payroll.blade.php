@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush
<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <div class="card-title">
                {{ $title }}
            </div>
            <div class="card-toolbar">
                <button type="button" wire:click.prevent="$emit('onClickAdd')"
                    class="btn btn-sm btn-light-success btn-hover-rotate-end" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Tambah payroll">
                    <i class="fas fa-plus-square mr-2"></i> Payroll
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
                        data-bs-placement="top" title="Refresh Data payroll">
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
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">Nama
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Kantor Cabang
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Outlet
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Bulan
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Tahun
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Gaji
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Slip Gaji
                            </th>
                            <th class="text-uppercase text-sm text-dark font-weight-bolder opacity-75 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($payroll) > 0)
                        @foreach ($payroll as $i => $item)
                        <tr>
                            <td class="align-middle text-center">{{ ($page - 1) * $total_show + $i +1 }}</td>
                            <td class="align-middle text-center text-capitalize">{{ $item->user->name}}</td>
                            <td class="align-middle text-center text-capitalize">{{ $item->outlet->cabang->nama_office}}</td>
                            <td class="align-middle text-center text-capitalize">{{ $item->outlet->nama_outlet}}</td>
                            <td class="align-middle text-center text-capitalize">{{ App\CPU\Helpers::monthName($item->bulan)}}</td>
                            <td class="align-middle text-center">{{ $item->tahun}}</td>
                            <td class="align-middle text-center text-capitalize">{{ 'Rp. ' . number_format($item->gaji)}}</td>
                            <td class="align-middle text-center text-capitalize">
                                <img height="80px" src="{{ asset('/'.$item->slip_gaji) }}" alt="">
                            </td>
                            <td class="align-middle text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" wire:click.prevent="$emit('onClickUpdatePayroll', {{ $item }})"
                                        class="btn btn-sm bg-success text-white btn-hover-rotate-start"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Ubah data {{ $item->nama_payroll}}"><i
                                            class="fas fa-edit text-light"></i></button>
                                    <button type="button" wire:click.prevent="$emit('onClickDelete', `{{ $item->id }}`)"
                                        class="btn btn-sm bg-danger btn-hover-rotate-end" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Hapus data {{ $item->nama_payroll}}"><i
                                            class="fas fa-trash text-light"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="no-data">
                            <td colspan="8">
                                <div class="row justify-content-center mx-0">
                                    <img src="{{ asset('assets/img/no_data.png') }}" alt=""
                                        class="h-125px w-125px">
                                    <div class="text-center">
                                        <span class="badge badge-square badge-lg badge-danger text-capitalize p-2">
                                            Tidak ada data payroll</span>
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
                    {{ $payroll->links() }}
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
                    <h5 class="modal-title">Masukan Data payroll</h5>

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
                            <label for="exampleFormControlInput1" class="required form-label">Karyawan</label>
                            <select class="form-select form-select-solid" wire:model="user_id">
                                <option value="">-- Pilih Admin / karyawan --</option>
                                @foreach ($user as $u)
                                    <option value="{{ $u['id'] }}">{{ $u['name'] }}
                                    @if ($u->role)
                                    <span class="badge badge-success ms-auto">
                                        ({{ $u->role->role }})
                                    </span>
                                    @else
                                    <span class="badge badge-danger">Belum ada hak akses</span>
                                    @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Kantor Cabang</label>
                            <select class="form-select form-select-solid" wire:model="cabang_id" wire:change="getOutlet">
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
                            <label for="exampleFormControlInput1" class="required form-label">Outlet</label>
                            <select wire:model="outlet_id" name="outlet" class="form-select form-select-solid" id="outlet">
                                <option value="">-- Pilih Outlet --</option>
                                @foreach ($outlet as $t)
                                <option value="{{ $t->id }}" class="text-capitalize">{{ $t->nama_outlet }}</option>
                                @endforeach
                            </select>
                            @error('outlet_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Bulan & Tahun Gaji</label>
                            <div class="input-group">
                                <input name="bulan" id="bulan" wire:model="bulan" class="date-picker form-control" />
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="fa-solid fa-calendar-week"></i>
                                </span>
                            </div>
                            @error('bulan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Nominal Gaji</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon2">
                                    Rp.
                                </span>
                                <input type="number" name="gaji" wire:model="gaji" class="form-control" />
                            </div>
                            @error('gaji')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column mb-8">
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span class="">Slip Gaji</span>
                            </label>
                            <div class="col-6">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                    @if ($img)
                                    <img class="image-input image-input-outline img-profile"
                                        src="{{ $img->temporaryUrl() }}"></img>
                                    @else
                                    <img id="placeholderSlip" src="{{ $photo }}" class="img-profile preview-img"
                                        onerror="this.src='{{ asset('assets/img/slip.png') }}'">
                                    @endif
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="Masukan foto produk">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" id="produk-img" name="img" accept=".png, .jpg, .jpeg"
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
                    <h5 class="modal-title">Ubah Data payroll</h5>

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
                            <label for="exampleFormControlInput1" class="required form-label">Karyawan</label>
                            <select class="form-select form-select-solid" wire:model="user_id">
                                <option value="">-- Pilih Admin / karyawan --</option>
                                @foreach ($user as $u)
                                    <option value="{{ $u['id'] }}">{{ $u['name'] }}
                                    @if ($u->role)
                                    <span class="badge badge-success ms-auto">
                                        ({{ $u->role->role }})
                                    </span>
                                    @else
                                    <span class="badge badge-danger">Belum ada hak akses</span>
                                    @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Kantor Cabang</label>
                            <select class="form-select form-select-solid" wire:model="cabang_id" wire:change="getOutlet">
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
                            <label for="exampleFormControlInput1" class="required form-label">Outlet</label>
                            <select wire:model="outlet_id" name="outlet" class="form-select form-select-solid" id="outlet">
                                <option value="">-- Pilih Outlet --</option>
                                @foreach ($outlet as $t)
                                <option value="{{ $t->id }}" class="text-capitalize">{{ $t->nama_outlet }}</option>
                                @endforeach
                            </select>
                            @error('outlet_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Bulan & Tahun Gaji</label>
                            <div class="input-group">
                                <input name="bulan" id="bulan" wire:model="bulan" class="date-picker form-control" />
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="fa-solid fa-calendar-week"></i>
                                </span>
                            </div>
                            @error('bulan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Nominal Gaji</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon2">
                                    Rp.
                                </span>
                                <input type="number" name="gaji" wire:model="gaji" class="form-control" />
                            </div>
                            @error('gaji')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column mb-8">
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span class="">Slip Gaji</span>
                            </label>
                            <div class="col-6">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                    @if ($img)
                                    <img class="image-input image-input-outline img-profile"
                                        src="{{ $img->temporaryUrl() }}"></img>
                                    @else
                                    <img id="placeholderSlips" src="{{ $photo }}" class="img-profile preview-img"
                                        onerror="this.src='{{ asset('assets/img/slip.png') }}'">
                                    @endif
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="Masukan foto produk">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" id="produk-img" name="img" accept=".png, .jpg, .jpeg"
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#hak_akses, #hak_akses_update').select2({});

        $(function() {
            $('.date-picker').datepicker( {
                format: "mm-yyyy",
                startView: "months",
                minViewMode: "months"
            });
        });

        $('#produk-img').change(function(){
            $('#placeholderSlip').addClass('d-none');
        });

        $('#bulan').on('change', function(e){
            let data = $(this).val();
            @this.set('bulan', data);
        })

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
        $('#outlet').select2({});
        $(function() {
            $('.date-picker').datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM',
            onClose: function(dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
            });
        });
    })

        Livewire.on('onClickAdd', () => {
            $('#modal_add').modal('show')
        })

        Livewire.on('refresh', () => {
            $('#modal_update').modal('hide')
            $('#modal_add').modal('hide')
        })

        Livewire.on("finishPayroll", (status, message) => {
            alertMessage(status, message)
        })

        Livewire.on('onClickRefresh', (id) => {
            Livewire.emit('refreshPayroll')
            alertMessage(1, 'Data berhasil diperbarui!')
        })

        Livewire.on('onClickUpdatePayroll', (item) => {
            console.log('called', item);
            Livewire.emit('setPayroll', item);
            $('#modal_update').modal('show')
        })

        Livewire.on('onClickDelete', async (id) => {
            const response = await alertHapus('Warning !!!', 'Anda yakin ingin menghapus data payroll ini?')
            if(response.isConfirmed == true){
                @this.set('payroll_id', id)
                Livewire.emit('delete')
            }
        })
</script>
@endpush
