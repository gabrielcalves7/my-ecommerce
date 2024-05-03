<?php
$a = 1;
?>
<form wire:submit="login" class="flex align-center justify-center">
    <div class="flex-col flex items-center justify-center">
            <div class="col-md-12 mb-2 w-full">
                <div class="form-group flex flex-col">
                    <label>Email :</label>
                    <input type="text" wire:model="email" class="form-control border-2 border-color-sky-400">
                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-md-12 mb-2 w-full">
                <div class="form-group flex flex-col">
                    <label>Password :</label>
                    <input type="password" wire:model="password" class="form-control border-2 border-color-sky-400">
                    @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-md-12">
                <button class="btn btn-primary text-sky-400 btn-success" wire:click.prevent="login">Entrar</button>
            </div>
            <div class="col-md-12 text-center">
                <a class="btn btn-success btn text-sky-400 btn-success" href="{{route('register')}}"><strong>Registrar</strong></a>
            </div>
        </div>
</form>
