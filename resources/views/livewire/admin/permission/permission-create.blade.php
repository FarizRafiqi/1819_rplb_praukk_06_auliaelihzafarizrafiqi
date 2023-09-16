<div>
    <form action="{{ route('admin.permissions.store') }}" method="POST" class="form-row">
        @csrf

        @if($counter > 1)
            <h5 class="ml-auto">{{ 'Jumlah hak akses : '. $counter }}</h5>
        @endif

        <div class="form-group col-11">
            <label class="font-weight-bold">Title <strong class="text-danger">*</strong></label>
        </div>

        <div class="form-group col-1 text-center">
            <label class="font-weight-bold">Aksi</label>
        </div>

        @foreach ($permissions as $index => $permission)
            <div class="form-group col-9 col-lg-11" wire:key="title-field-{{ $index }}">
                <input type="text" name="title[{{$index}}]" class="form-control @error('permissions.{{ $index }}.title') is-invalid @enderror" placeholder="Masukkan title {{ $loop->iteration }}" wire:model.debounce.1000ms="permissions.{{ $index }}.title" autofocus>

                @error('permissions.{{ $index }}.title')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-3 col-lg-1" wire:key="delete-btn-{{ $index }}">
                <button class="btn btn-danger form-control" wire:click.prevent="removePermission({{ $index }})" {{ $counter <= 1 ? 'disabled' : '' }}>Hapus</button>
            </div>
        @endforeach

        <div class="form-group col-md-3 offset-md-9 text-right">
            <span 
                class="text-danger" 
                x-data="{show: false}"
                x-show.transition.opacity.out.duration.1500ms="show" 
                x-init="
                    @this.on('reachMaxPermissionAllowed', () => { 
                        show = true; 
                        setTimeout(() => { show = false; }, 2000) 
                    })"
                style="display: none;"
            >
                <strong>Maksimal 10 permission!</strong>
            </span>
            
            <button class="btn btn-primary-custom" type="button" wire:click="addPermission" {{ $counter == $maxPermissions ? 'disabled' : '' }}>Tambah</button>
        </div>

        <div class="form-group col-12">
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-danger">Batal</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
