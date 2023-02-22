<div>
    <div wire:ignore.self class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Menambah Admin/Karyawan</h2>
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
                <div class="modal-body py-lg-10 px-lg-10">
                    <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid"
                        id="kt_modal_create_app_stepper">
                        <div
                            class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px">
                            <div class="stepper-nav ps-lg-10">
                                <div class="stepper-item current" data-kt-stepper-element="nav" wire:ignore.self>
                                    <div class="stepper-wrapper">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">1</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Data Akun</h3>
                                            <div class="stepper-desc">Akun karyawan</div>
                                        </div>
                                    </div>
                                    <div class="stepper-line h-40px"></div>
                                </div>
                                <div class="stepper-item" data-kt-stepper-element="nav" wire:ignore.self>
                                    <div class="stepper-wrapper">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">2</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Biodata</h3>
                                            <div class="stepper-desc">Data Identitas karyawan</div>
                                        </div>
                                    </div>
                                    <div class="stepper-line h-40px"></div>
                                </div>
                                <div class="stepper-item" data-kt-stepper-element="nav" wire:ignore.self>
                                    <div class="stepper-wrapper">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">3</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Validasi</h3>
                                            <div class="stepper-desc">Dokumen Identitas Karyawan</div>
                                        </div>
                                    </div>
                                    <div class="stepper-line h-40px"></div>
                                </div>
                                <div class="stepper-item" data-kt-stepper-element="nav" wire:ignore.self>
                                    <div class="stepper-wrapper">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">4</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Penempatan Kerja</h3>
                                            <div class="stepper-desc">Lokasi cabang dan outlet penempatan</div>
                                        </div>
                                    </div>
                                    <div class="stepper-line h-40px"></div>
                                </div>
                                <div class="stepper-item mark-completed" data-kt-stepper-element="nav" wire:ignore.self>
                                    <div class="stepper-wrapper">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">5</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Penyelesaian</h3>
                                            <div class="stepper-desc">Periksa data dan simpan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-row-fluid py-lg-5 px-lg-15">
                            <form wire:submit.prevent="simpanForm" class="form" novalidate="novalidate"
                                id="kt_modal_create_app_form" enctype="multipart/form-data">
                                <div class="current" data-kt-stepper-element="content" wire:ignore.self>
                                    <div class="w-100">
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Nama lengkap</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Masukan nama lengkap sesuai KTP"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                name="name" wire:model="name" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">NIK</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Nomor induk KTP"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                name="nik" wire:model="nik" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Email</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Diperlukan untuk identitas saat masuk admin"></i>
                                            </label>
                                            <input type="email" class="form-control form-control-lg form-control-solid"
                                                name="email" wire:model="email" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Handphone</span>
                                            </label>
                                            <input type="number" class="form-control form-control-lg form-control-solid"
                                                name="phone" wire:model="phone" />
                                        </div>
                                    </div>
                                </div>
                                <div data-kt-stepper-element="content" wire:ignore.self>
                                    <div class="w-100">
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">Foto</label>
                                            <div class="col-lg-8">
                                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                                    style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                                    @if ($img)
                                                    <img class="image-input image-input-outline img-profile"
                                                        src="{{ $img->temporaryUrl() }}"></img>
                                                    @else
                                                    <img id="placeholder"
                                                        src="{{ $photo ? asset($photo['value']) : 'undefined' }}"
                                                        class="img-profile preview-img"
                                                        onerror="this.src='{{ asset('assets/img/users.png') }}'">
                                                    @endif
                                                    {{-- <div class="image-input-wrapper w-125px h-125px"
                                                        style="background-image: url(../assets/img/users.png)">
                                                    </div> --}}
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Tambahkan foto profil">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <input type="file" id="profile" name="img"
                                                            accept=".png, .jpg, .jpeg" wire:model="img" />
                                                        {{-- <input type="hidden" name="avatar_remove" /> --}}
                                                    </label>
                                                    {{-- <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        title="Cancel avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span> --}}
                                                    {{-- <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        title="Remove avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span> --}}
                                                </div>
                                                <div class="form-text">Tipe file yang diterima: png, jpg, jpeg.</div>
                                            </div>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Tempat Lahir</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                name="tempatlahir" wire:model="tempatlahir" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Tanggal Lahir</span>
                                            </label>
                                            <input type="date" class="form-select form-select-solid"
                                                name="tanggallahir" wire:model="tanggallahir" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Jenis Kelamin</span>
                                            </label>
                                            <select wire:ignore class="form-select form-select-solid"
                                                name="kelamin" wire:model="kelamin" id="kelamin">
                                                <option value="">-- Pilih jenis kelamin --</option>
                                                <option value="laki-laki">Laki - Laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Agama</span>
                                            </label>
                                            <select class="form-select form-select-solid" wire:ignore
                                                name="agama" wire:model="agama" id="agama">
                                                <option value="">-- Pilih agama --</option>
                                                <option value="islam">Islam</option>
                                                <option value="kristen">Kristen</option>
                                                <option value="katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="konghucu">Konghucu</option>
                                            </select>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Alamat sesuai KTP</span>
                                            </label>
                                            <textarea class="form-control form-control-lg form-control-solid"
                                                name="alamat" wire:model="alamat"></textarea>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Alamat Domisili</span>
                                            </label>
                                            <textarea class="form-control form-control-lg form-control-solid"
                                                name="domisili" wire:model="domisili"></textarea>
                                        </div>
                                        <div class="fv-row mb-10" wire:ignore>
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Kewarganegaraan</span>
                                            </label>
                                            <select class="form-select form-select-solid" wire:ignore
                                                wire:model="kewarganegaraan">
                                                <option value="">-- Pilih Kewarganegaraan --</option>
                                                @foreach ($country as $lc)
                                                <option wire:key="{{ $lc }}" value="{{ $lc }}" class="text-capitalize">
                                                    {{ $lc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Nama Ibu Kandung</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                name="nama_ibu" wire:model="nama_ibu" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Pendidikan terakhir</span>
                                            </label>
                                            <select wire:model="pendidikan" name="pendidikan"
                                                class="form-select form-select-solid" wire:ignore
                                                id="pendidikan">
                                                <option value="">-- Pilih Pendidikan --</option>
                                                <option value="SD/MI">SD / MI (Sederajat)</option>
                                                <option value="SMP/MTs">SMP / MTs (Sederajat)</option>
                                                <option value="SMA/MA">SMA / MA (Sederajat)</option>
                                                <option value="S1">S1/D IV(Sederajat)</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div data-kt-stepper-element="content" wire:ignore.self>
                                    <div class="w-100">
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2"><span
                                                    class="required">Foto KTP</span></label>
                                            <div class="col-lg-8">
                                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                                    style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                                    @if ($ktp_img)
                                                    <img class="image-input image-input-outline img-profile"
                                                        src="{{ $ktp_img->temporaryUrl() }}"></img>
                                                    @else
                                                    <img id="placeholder2" src="{{ asset('assets/img/ktp-logo.png') }}"
                                                        class="img-profile preview-img"
                                                        onerror="this.src='{{ asset('assets/img/ktp-logo.png') }}'">
                                                    @endif
                                                    {{-- <div class="image-input-wrapper w-125px h-125px"
                                                        style="background-image: url(../assets/img/ktp-logo.png)">
                                                    </div> --}}
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Tambahkan foto KTP">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <input type="file" id="ktp_img" name="ktp_img"
                                                            accept=".png, .jpg, .jpeg" wire:model="ktp_img" />
                                                        {{-- <input type="hidden" name="avatar_remove" /> --}}
                                                    </label>
                                                    {{-- <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        title="Hapus ktp">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span> --}}
                                                    {{-- <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        title="Remove avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span> --}}
                                                </div>
                                                <div class="form-text">Tipe file yang diterima: png, jpg, jpeg.</div>
                                            </div>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Nomor KK</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                name="no_kk" wire:model="no_kk" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Status Pernikahan</span>
                                            </label>
                                            <select wire:model="status" name="status"
                                                class="form-select form-select-solid" wire:ignore
                                                id="status">
                                                <option value="">-- Pilih status--</option>
                                                @foreach ($nikah as $n)
                                                <option value="{{ $n }}" class="text-capitalize">{{ $n }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Bank</span>
                                            </label>
                                            <select wire:model="bank" name="bank"
                                                class="form-select form-select-solid" wire:ignore
                                                id="bank">
                                                <option value="">-- Pilih Bank--</option>
                                                @foreach ($bank_list as $b)
                                                <option value="{{ $b }}" class="text-capitalize">{{ $b }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">No. Rekening</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                name="rekening" wire:model="rekening" />
                                        </div>
                                    </div>
                                </div>
                                <div data-kt-stepper-element="content" wire:ignore.self>
                                    <div class="w-100">
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Penempatan Cabang</span>
                                            </label>
                                            <select wire:model="cabang_id" name="cabang" wire:change="getOutlet"
                                                class="form-select form-select-solid" wire:ignore
                                                id="cabang">
                                                <option value="">-- Pilih Cabang--</option>
                                                @foreach ($office as $o)
                                                <option value="{{ $o->id }}" class="text-capitalize">{{ $o->nama_office }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Penempatan Outlet</span>
                                            </label>
                                            <select wire:model="outlet_id" name="outlet"
                                                class="form-select form-select-solid"
                                                id="outlet">
                                                <option value="">-- Pilih cabang dahulu--</option>
                                                @foreach ($outlet as $t)
                                                <option value="{{ $t->id }}" class="text-capitalize">{{ $t->nama_outlet}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Jabatan</span>
                                            </label>
                                            <select wire:model="jabatan" name="jabatan"
                                                class="form-select form-select-solid" wire:ignore
                                                id="jabatan">
                                                <option value="">-- Pilih Jabatan--</option>
                                                @foreach ($jab as $j)
                                                <option value="{{ $j }}" class="text-capitalize">{{ $j }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Role / Hak Akses</span>
                                            </label>
                                            <select wire:model="role_id" name="role"
                                                class="form-select form-select-solid" wire:ignore
                                                id="role">
                                                <option value="">-- Pilih Role--</option>
                                                @foreach ($role as $r)
                                                <option value="{{ $r->id }}" class="text-capitalize">{{ $r->role }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <div class="fv-row mb-10">
                                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                    <span class="">Keterangan</span>
                                                </label>
                                                <textarea class="form-control form-control-lg form-control-solid"
                                                    name="keterangan" wire:model="keterangan"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div data-kt-stepper-element="content" wire:ignore.self>
                                    <div class="w-100 text-center">
                                        <!--begin::Heading-->
                                        <h1 class="fw-bold text-dark mb-3">Periksa data!</h1>
                                        <h3 class="stepper-title text-left text-muted mt-2">Data Akun</h3>
                                        <hr>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Nama lengkap</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="name" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">NIK</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="nik" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Email</span>
                                            </label>
                                            <input type="email" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="email" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Handphone</span>
                                            </label>
                                            <input type="number" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="phone" />
                                        </div>
                                        <h3 class="stepper-title text-left text-muted mt-2">Biodata Karyawan</h3>
                                        <hr>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Foto Profil</span>
                                            </label>
                                            <div class="col-6">
                                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                                    style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                                    @if($img)
                                                    <img src="{{ $img->temporaryUrl() }}" alt="Foto hilang"
                                                        class="img-profile">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Tempat Lahir</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="tempatlahir" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Tanggal Lahir</span>
                                            </label>
                                            <input type="date" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="tanggallahir" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Jenis Kelamin</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="kelamin" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Agama</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="agama" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Alamat sesuai KTP</span>
                                            </label>
                                            <textarea disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="alamat"></textarea>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Alamat Domisili</span>
                                            </label>
                                            <textarea disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="domisili"></textarea>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Kewarganegaraan</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="kewarganegaraan" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Nama Ibu Kandung</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="nama_ibu" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Pendidikan terakhir</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="pendidikan" />
                                        </div>
                                        <h3 class="stepper-title text-left text-muted mt-2">Validasi Dokumen</h3>
                                        <hr>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Foto KTP</span>
                                            </label>
                                            <div class="col-6">
                                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                                    style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                                    @if($ktp_img)
                                                    <img src="{{ $ktp_img->temporaryUrl() }}" alt="Foto hilang"
                                                        class="img-profile">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Nomor KK</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="no_kk" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Status Pernikahan</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="status" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Bank</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="bank" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Rekening</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="rekening" />
                                        </div>
                                        <h3 class="stepper-title text-left text-muted mt-2">Penempatan Kerja</h3>
                                        <hr>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Kantor Cabang</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="cabang_id" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Outlet</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="outlet_id" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Jabatan</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="jabatan" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Keterangan</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="keterangan" />
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="">Role / Hak Akses</span>
                                            </label>
                                            <input type="text" disabled
                                                class="form-control form-control-lg form-control-solid"
                                                wire:model="role_id" />
                                        </div>
                                        <button type="submit" id="save" class="btn btn-lg btn-primary position-absolute ms-auto" style="bottom: 50px; right: 20px;">
                                            <span class="indicator-label">Simpan
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-3 ms-2 me-0">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                                            transform="rotate(-180 18 13)" fill="currentColor" />
                                                        <path
                                                            d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex flex-stack pt-10">
                                    <!--begin::Wrapper-->
                                    <div class="me-2" wire:ignore>
                                        <button type="button" class="btn btn-lg btn-light-primary me-3"
                                            data-kt-stepper-action="previous">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                            <span class="svg-icon svg-icon-3 me-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Back
                                        </button>
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Wrapper-->
                                    <div>
                                        <button type="submit" id="save" class="btn btn-lg btn-primary d-none"
                                            data-kt-stepper-action="submit">
                                            <span class="indicator-label">Simpan
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-3 ms-2 me-0">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                                            transform="rotate(-180 18 13)" fill="currentColor" />
                                                        <path
                                                            d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <button type="button" class="btn btn-lg btn-primary"
                                            data-kt-stepper-action="next">Lanjutkan
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                            <span class="svg-icon svg-icon-3 ms-1 me-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                                        transform="rotate(-180 18 13)" fill="currentColor" />
                                                    <path
                                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function () {
            refreshSelect()
        });

        Livewire.on('refresh', () => {
            $('#kt_modal_create_app').modal('hide')
        })

        $('#profile').on('change'){
            $('#placeholder').addClass('d-none');
        };
        $('#ktp_img').on('change'){
            $('#placeholder2').addClass('d-none');
        };

        window.addEventListener('contentChange', function(){
            refreshSelect()
        })

        $('#kelamin').on('change', function (e) {
            let data = $(this).val();
            @this.set('kelamin', data);
        });

        $('#kewarga').on('change', function (e) {
            let data = $(this).val();
            @this.set('kewarganegaraan', data);
        });

        $('#agama').on('change', function (e) {
            let data = $(this).val();
            @this.set('agama', data);
        });

        $('#pendidikan').on('change', function (e) {
            let data = $(this).val();
            @this.set('pendidikan', data);
        });

        function refreshSelect(){
            $('select[name="periode_master"]').select2()

            $('select[name="periode_master"]').on('change', function(){
                @this.set('periode_master', $(this).val())
            })
        }

        Livewire.on('onClickSave', () => {
            Livewire.emit('simpanForm');
        })

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })
</script>
@endpush
