<div wire:ignore.self class="modal fade" tabindex="-1" id="password_change" data-bs-backdrop="static"
data-bs-keyboard="false">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Ganti Password</h5>

            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                aria-label="Close">
                <span class="svg-icon svg-icon-2x"></span>
            </div>
            <!--end::Close-->
        </div>

        <form wire:submit.prevent="change_password" id="form_add">
            <div class="modal-body">
                @include('helper.alert-message')
                <div class="text-center">
                    @include('helper.simple-loading', ['target' => 'simpan', 'message' => 'Menyimpan data ...'])
                </div>
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Masukan password baru</label>
                    <input type="password" class="form-control form-control-solid" wire:model="password"
                        placeholder="Password baru" />
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Konfirmasi password</label>
                    <input type="password" class="form-control form-control-solid" wire:model="c_password"
                        placeholder="Konfirmasi password" />
                    @error('c_password')
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
<div wire:ignore.self class="modal fade" tabindex="-1" id="modal_profile" data-bs-backdrop="static"
  data-bs-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Profil</h5>

        <!--begin::Close-->
        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
          <span class="svg-icon svg-icon-2x"></span>
        </div>
        <!--end::Close-->
      </div>

      <form wire:submit.prevent="save" id="form_update">
        <input type="hidden" wire:mode="cabang_id">
        <div class="modal-body">
          <div class="text-center">
            @include('helper.simple-loading', ['target' => 'update', 'message' => 'Menyimpan data ...'])
          </div>
          <div class="d-flex flex-column mb-8">
            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
              <span class="">Foto Profil</span>
            </label>
            <div class="col-12">
              <div class="image-input image-input-outline" data-kt-image-input="true"
                style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                @if ($img)
                <img class="image-input image-input-outline img-profile" src="{{ $img->temporaryUrl() }}"></img>
                @else
                <img id="placeholder" src="{{ $photo }}" class="img-profile preview-img"
                  onerror="this.src='{{ asset('assets/img/placeholder.png') }}'">
                @endif
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                  data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Masukan foto produk">
                  <i class="bi bi-pencil-fill fs-7"></i>
                  <input type="file" id="profile" name="img" accept=".png, .jpg, .jpeg" wire:model="img" />
                  {{-- <input type="hidden" name="avatar_remove" /> --}}
                </label>
              </div>
              <div class="form-text">Tipe file yang diterima: png, jpg, jpeg.</div>
              @error('img')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>
          <h3 class="text-end">
            <span class="text-muted fw-semibold fs-14">Informasi Akun</span>
            <hr>
          </h3>
          <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Nama</label>
            <input type="text" class="form-control form-control-solid" wire:model="name" />
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="row">
            <div class="mb-10 col-md-6">
              <label for="exampleFormControlInput1" class="required form-label">No Handphone</label>
              <input type="number" class="form-control form-control-solid" wire:model="phone" />
              @error('phone')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="mb-10 col-md-6">
              <label for="exampleFormControlInput1" class="required form-label">Email</label>
              <input type="email" class="form-control form-control-solid" wire:model="email" />
              @error('email')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="mb-10 col-md-6">
              <label for="exampleFormControlInput1" class="required form-label">Nomor Induk Keluarga (NIK)</label>
              <input type="text" class="form-control form-control-solid" wire:model="nik" />
              @error('nik')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="mb-10 col-md-6">
              <label for="exampleFormControlInput1" class="required form-label">Nomor Kartu Keluarga</label>
              <input type="text" class="form-control form-control-solid" wire:model="no_kk" />
              @error('no_kk')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

          </div>
          <h3 class="text-end">
            <span class="text-muted fw-semibold fs-14">Informasi Bank</span>
            <hr>
          </h3>
          <div class="row">
            <div class="mb-10 col-md-6">
              <label for="exampleFormControlInput1" class="required form-label">Bank</label>
              <input type="text" class="form-control form-control-solid" wire:model="bank" />
              @error('bank')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="mb-10 col-md-6">
              <label for="exampleFormControlInput1" class="required form-label">Rekening</label>
              <input type="text" class="form-control form-control-solid" wire:model="rekening" />
              @error('rekening')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>
          <h3 class="text-end">
            <span class="text-muted fw-semibold fs-14">Biodata</span>
            <hr>
          </h3>
          <div class="row">
            <div class="mb-10 col-md-6">
              <label for="exampleFormControlInput1" class="required form-label">Tempat Lahir</label>
              <input type="text" class="form-control form-control-solid" wire:model="tempat_lahir" />
              @error('tempat_lahir')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="mb-10 col-md-6">
              <label for="exampleFormControlInput1" class="required form-label">Tanggal Lahir</label>
              <input type="date" class="form-control form-control-solid" wire:model="tanggal_lahir" />
              @error('tanggal_lahir')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="mb-10 col-md-6">
              <label for="exampleFormControlInput1" class="required form-label">Jenis Kelamin</label>
              <select class="form-select form-select-solid" wire:model="kelamin">
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="laki-laki">Laki - laki</option>
                <option value="perempuan">Perempuan</option>
              </select>
              @error('kelamin')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="mb-10 col-md-6">
              <label for="exampleFormControlInput1" class="required form-label">Agama</label>
              <select class="form-select form-select-solid" name="agama" wire:model="agama" id="agama">
                <option value="">-- Pilih agama --</option>
                <option value="islam">Islam</option>
                <option value="kristen">Kristen</option>
                <option value="katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="konghucu">Konghucu</option>
              </select>
              @error('agama')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

          </div>
          <div class="row">
            <div class="mb-10 col-md-6">
              <label for="exampleFormControlInput1" class="required form-label">Nama Ibu Kandung</label>
              <input type="text" class="form-control form-control-solid" wire:model="nama_ibu" />
              @error('nama_ibu')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="fv-row mb-10 col-md-6">
              <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                <span class="required">Kewarganegaraan</span>
              </label>
              <select class="form-select form-select-solid" wire:ignore wire:model="kewarganegaraan">
                <option value="">-- Pilih Kewarganegaraan --</option>
                @foreach ($country as $lc)
                <option wire:key="{{ $lc }}" value="{{ $lc }}" class="text-capitalize">
                  {{ $lc }}</option>
                @endforeach
              </select>
              @error('kewarganegaraan')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="fv-row mb-10 col-md-6">
              <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                <span class="required">Pendidikan terakhir</span>
              </label>
              <select wire:model="pendidikan" name="pendidikan" class="form-select form-select-solid" wire:ignore
                id="pendidikan">
                <option value="">-- Pilih Pendidikan --</option>
                <option value="SD/MI">SD / MI (Sederajat)</option>
                <option value="SMP/MTs">SMP / MTs (Sederajat)</option>
                <option value="SMA/MA">SMA / MA (Sederajat)</option>
                <option value="S1">S1/D IV(Sederajat)</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
              </select>
              @error('pendidikan')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="col-md-6 fv-row">
              <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                  <span class="">Status Pernikahan</span>
              </label>
              <select wire:model="status" name="status" class="form-select form-select-solid"
                  wire:ignore id="status">
                  <option value="" class="text-capitalize">-- Pilih Status Pernikahan --</option>
                  @foreach ($nikah as $n)
                  <option value="{{ $n }}" class="text-capitalize">{{ $n }}</option>
                  @endforeach
              </select>
              @error('status')
              <small class="text-danger">{{ $message }}</small>
              @enderror
          </div>
          </div>
          <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Alamat KTP</label>
            <textarea type="text" class="form-control form-control-solid" wire:model="alamat_ktp"></textarea>
            @error('alamat_ktp')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Alamat Domisili</label>
            <textarea type="text" class="form-control form-control-solid" wire:model="domisili"></textarea>
            @error('domisili')
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