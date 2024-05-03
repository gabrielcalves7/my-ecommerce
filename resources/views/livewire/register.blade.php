<form wire:submit="handleRegister" class="flex align-center justify-center">
    <div class="flex-col flex items-center justify-center">
        <div class="col-md-12 mb-2 w-full">
            <div class="form-group flex-col flex w-full">
                <label>Nome :</label>
                <input type="text" wire:model="name" class="form-control border-2 border-color-sky-400">
                @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-12 mb-2 w-full">
            <div class="form-group flex-col flex w-full">
                <label>Email :</label>
                <input type="text" wire:model="email" class="form-control border-2 border-color-sky-400">
                @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-12 mb-2 w-full">
            <div class="form-group flex-col flex w-full">
                <label>Senha :</label>
                <input type="password" wire:model="password" class="form-control border-2 border-color-sky-400">
                @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="btn btn-success btn text-sky-400 btn-success" wire:click.prevent="handleRegister">Registrar</button>
        </div>
        <div class="col-md-12">
            <a class="text-primary btn btn-primary text-sky-400" href="{{route('login')}}"><strong>Já possui uma conta?Clique aqui.</strong></a>
        </div>
    </div>
</form>
