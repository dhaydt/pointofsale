<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                {{ $title }}
            </h3>
            <div class="card-title">
                <button class="btn btn-sm btn-outline btn-outline-success" wire:click="$emit('onClickTambah')"><i
                        class="bi bi-plus-circle"></i> Tambah</button>
            </div>
        </div>
        <div class="card-body">
            {{-- @include('helper.alert-message') --}}
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,hapus', 'message' => 'Memuat data...'])
            </div>
            @include('livewire.helper.alert-session')
            <div class="row justify-content-between">
                <div class="mb-4 input-group input-group-outline w-md-25 w-50">
                    <input type="text" class="form-control" placeholder="Search..." wire:model="search">
                </div>

                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-light-success btn-sm" wire:click="$emit('onClickRefresh')"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh Data Admin / Karyawan">
                        <i class="fas fa-sync-alt"></i> Segarkan
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Foto</th>
                            <th>NIK</th>
                            <th>Email</th>
                            <th>Handphone</th>
                            <th>Cabang</th>
                            <th>Outlet</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) > 0)
                        @foreach ($users as $index => $item)
                        <tr>
                            <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <img src="{{ asset('/'.$item->detail->img) }}" onerror="this.src='{{ asset('assets/img/users.png') }}'" alt="" style="height: 80px;">
                            </td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->detail->cabang_id ?? 'Invalid cabang' }}</td>
                            <td>
                                @if (isset($item->detail->outlet_id))
                                {{ $item->detail->outlet_id }}
                                @else
                                <span class="badge badge-danger">
                                    Outlet tidak ditemukan
                                </span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit Admin / Karyawan"
                                        wire:click="$emit('onClickEdit', {{ $item->id }})">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Hapus Admin / Karyawan"
                                        wire:click="$emit('onClickHapus', {{ $item->id }})">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                    <a href="{{ route('user.detail', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Detail Form">
                                        <i class="bi bi-info-circle-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="no-data">
                            <td colspan="8">
                                <div class="row justify-content-center mx-0">
                                    <img src="{{ asset('assets/img/no_data.png') }}" alt="" class="h-125px w-125px">
                                    <div class="text-center">
                                        <span class="badge badge-square badge-lg badge-danger text-capitalize p-2">
                                            Tidak ada data Karyawan</span>
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                    fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form wire:submit.prevent="updateForm" id="kt_modal_new_target_form" class="form" action="#">
                        <div class="mb-13 text-center">
                            <h1 class="mb-3 text-capitalize">Ubah data Admin / Karyawan</h1>
                            {{-- <div class="text-muted fw-semibold fs-5">If you need more info, please check
                                <a href="#" class="fw-bold link-primary">Project Guidelines</a>.
                            </div> --}}
                        </div>
                        <h3 class="text-end">
                            <span class="text-muted fw-semibold fs-14">Informasi Akun</span>
                            <hr>
                        </h3>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Nama</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="text" class="form-control form-control-solid" name="name" wire:model="name" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Email</span>
                            </label>
                            <input type="email" class="form-control form-control-solid" name="email"
                                wire:model="email" />
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Handphone</span>
                                </label>
                                <input type="number" class="form-control form-control-solid" name="phone"
                                    wire:model="phone" />
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">NIK</span>
                                </label>
                                <input type="number" class="form-control form-control-solid" name="nik"
                                    wire:model="nik" />
                            </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Assign</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true" data-placeholder="Select a Team Member"
                                    name="target_assign">
                                    <option value="">Select user...</option>
                                    <option value="1">Karina Clark</option>
                                    <option value="2">Robert Doe</option>
                                    <option value="3">Niel Owen</option>
                                    <option value="4">Olivia Wild</option>
                                    <option value="5">Sean Bean</option>
                                </select>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Due Date</label>
                                <div class="position-relative d-flex align-items-center">
                                    <span class="svg-icon svg-icon-2 position-absolute mx-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3"
                                                d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                fill="currentColor" />
                                            <path
                                                d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                fill="currentColor" />
                                            <path
                                                d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <input class="form-control form-control-solid ps-12" placeholder="Select a date"
                                        name="due_date" />
                                </div>
                            </div>
                        </div>
                        <h3 class="text-end">
                            <span class="text-muted fw-semibold fs-14">Biodata</span>
                            <hr>
                        </h3>
                        <div class="d-flex flex-column mb-8">
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span class="">Foto Profil</span>
                            </label>
                            <div class="col-6">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                    @if ($img)
                                    <img class="image-input image-input-outline img-profile"
                                        src="{{ $img->temporaryUrl() }}"></img>
                                    @else
                                    <img id="placeholder" src="{{ $photo }}" class="img-profile preview-img"
                                        onerror="this.src='{{ asset('assets/img/users.png') }}'">
                                    @endif
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="Ganti foto profil">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" id="profile" name="img" accept=".png, .jpg, .jpeg"
                                            wire:model="img" />
                                        {{-- <input type="hidden" name="avatar_remove" /> --}}
                                    </label>
                                </div>
                                <div class="form-text">Tipe file yang diterima: png, jpg, jpeg.</div>
                            </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Tempat Lahir</span>
                                </label>
                                <input class="form-control form-control-solid" name="tempatlahir"
                                    wire:model="tempatlahir" />
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Tanggal Lahir</span>
                                </label>
                                <input type="date" class="form-control form-control-solid" name="tanggallahir"
                                    wire:model="tanggallahir" />
                            </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Jenis Kelamin</span>
                                </label>
                                <select wire:ignore class="form-select form-select-solid" name="kelamin"
                                    wire:model="kelamin" id="kelamin">
                                    <option value="laki-laki">Laki - Laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Agama</span>
                                </label>
                                <select class="form-select form-select-solid" wire:ignore name="agama"
                                    wire:model="agama" id="agama">
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="konghucu">Konghucu</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Alamat sesuai KTP</span>
                            </label>
                            <textarea class="form-control form-control-solid" name="alamat"
                                wire:model="alamat"></textarea>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Alamat Domisili</span>
                            </label>
                            <textarea class="form-control form-control-solid" name="domisili"
                                wire:model="domisili"></textarea>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Nama Ibu Kandung</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" name="nama_ibu"
                                    wire:model="nama_ibu" />
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Kewarganegaraan</span>
                                </label>
                                <select class="form-select form-select-solid" wire:ignore name="kewarganegaraan"
                                    wire:model="kewarganegaraan" id="agama">
                                    @foreach ($country as $lc)
                                    <option value="{{ $lc }}" class="text-capitalize">
                                        {{ $lc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Pendidikan</span>
                            </label>
                            <select wire:model="pendidikan" name="pendidikan" class="form-select form-select-solid"
                                wire:ignore id="pendidikan">
                                <option value="SD/MI">SD / MI (Sederajat)</option>
                                <option value="SMP/MTs">SMP / MTs (Sederajat)</option>
                                <option value="SMA/MA">SMA / MA (Sederajat)</option>
                                <option value="S1">S1/D IV(Sederajat)</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                        </div>
                        <h3 class="text-end">
                            <span class="text-muted fw-semibold fs-14">Validasi Berkas</span>
                            <hr>
                        </h3>
                        <div class="d-flex flex-column mb-8">
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span class="">Foto KTP</span>
                            </label>
                            <div class="col-6">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                    @if ($ktp_img)
                                    <img class="image-input image-input-outline img-profile"
                                        src="{{ $ktp_img->temporaryUrl() }}"></img>
                                    @else
                                    <img id="placeholder2" src="{{ $photo_ktp }}" class="img-profile preview-img"
                                        onerror="this.src='{{ asset('assets/img/users.png') }}'">
                                    @endif
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="Ganti foto KTP">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" id="ktp_img" name="img" accept=".png, .jpg, .jpeg"
                                            wire:model="ktp_img" />
                                        {{-- <input type="hidden" name="avatar_remove" /> --}}
                                    </label>
                                </div>
                                <div class="form-text">Tipe file yang diterima: png, jpg, jpeg.</div>
                            </div>
                            <div class="row g-9 mb-8 mt-2">
                                <div class="col-md-6 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">No KK</span>
                                    </label>
                                    <input class="form-control form-control-solid" name="no_kk" wire:model="no_kk" />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Status Menikah</span>
                                    </label>
                                    <select wire:model="status" name="status" class="form-select form-select-solid"
                                        wire:ignore id="status">
                                        @foreach ($nikah as $n)
                                        <option value="{{ $n }}" class="text-capitalize">{{ $n }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row g-9 mb-8 mt-2">
                                <div class="col-md-6 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Bank</span>
                                    </label>
                                    <select wire:model="bank" name="bank" class="form-select form-select-solid"
                                        wire:ignore id="bank">
                                        @foreach ($bank_list as $b)
                                        <option value="{{ $b }}" class="text-capitalize">{{ $b }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">No Rekening</span>
                                    </label>
                                    <input class="form-control form-control-solid" name="rekening"
                                        wire:model="rekening" />
                                </div>
                            </div>
                        </div>
                        <h3 class="text-end">
                            <span class="text-muted fw-semibold fs-14">Validasi Berkas</span>
                            <hr>
                        </h3>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Penempatan Cabang</span>
                                </label>
                                <select wire:model="cabang_id" name="cabang" class="form-select form-select-solid"
                                    wire:ignore id="cabang">
                                    @foreach ($office as $o)
                                    <option value="{{ $o }}" class="text-capitalize">{{ $o }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Penempatan Outlet</span>
                                </label>
                                <select wire:model="outlet_id" name="outlet" class="form-select form-select-solid"
                                    wire:ignore id="outlet">
                                    @foreach ($outlet as $t)
                                    <option value="{{ $t }}" class="text-capitalize">{{ $t }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Jabatan</span>
                                </label>
                                <select wire:model="jabatan" name="jabatan" class="form-select form-select-solid"
                                    wire:ignore id="jabatan">
                                    @foreach ($jab as $j)
                                    <option value="{{ $j }}" class="text-capitalize">{{ $j }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Role / Hak Akses</span>
                                </label>
                                <select wire:model="role_id" name="role" class="form-select form-select-solid"
                                    wire:ignore id="role">
                                    @foreach ($role as $r)
                                    <option value="{{ $r->id }}" class="text-capitalize">{{ $r->role }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="">Keterangan</span>
                            </label>
                            <textarea class="form-control form-control-lg form-control-solid" name="keterangan"
                                wire:model="keterangan"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Ubah</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function () {
        });

        window.addEventListener('contentChange', event => {
        })

        $('#profile').change(function(){
            $('#placeholder').addClass('d-none');
        });

        // $('#ktp_img').on('change'){
        //     $('#placeholder2').addClass('d-none');
        // };

        Livewire.on('onClickTambah', () => {
            $('#kt_modal_create_app').modal('show')
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('#kt_modal_create_app').modal('hide');
            alertMessage(status, message)
        })
        Livewire.on('finishUpdate', (status, message) => {
            $('#editUser').modal('hide');
            alertMessage(1, 'Admin / Karyawan Berhasil di ubah!')
        })

        Livewire.on("finishDataUser", (status, message) => {
            alertMessage(status, message)
        })

        Livewire.on('onClickEdit', (id) => {
            Livewire.emit('setDataUser', id)
            $('#editUser').modal('show')
        })

        Livewire.on('onClickRefresh', (id) => {
            Livewire.emit('refreshUser')
            alertMessage(1, 'Data berhasil diperbarui!')
        })

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertHapus('Peringatan !', 'Apakah kamu yakin ingin menghapus admin / karyawan ?')
            if(response.isConfirmed == true){
                Livewire.emit('hapus', id)
            }
        })
</script>
@endpush
