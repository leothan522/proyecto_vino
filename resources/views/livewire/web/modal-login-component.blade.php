<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    {{--<button id="buttonModalLoginFast" type="button" data-toggle="modal" data-target="#modalLoginFast">Modal Login Fast</button>--}}

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalLoginFast" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit="login" class="billing-form" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if ($register)
                                {{ __('Register') }}
                            @else
                                {{ __('Login') }}
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body position-relative" style="max-height: 70vh; overflow-y: auto;">
                        <div class="row">
                            @if($register)
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" wire:model="cedula" placeholder="Cédula" >
                                        @error('cedula')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" wire:model="name" placeholder="{{ __('Name') }}" >
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="number" step="1" class="form-control" wire:model="telefono" placeholder="Teléfono">
                                        @error('telefono')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" wire:model="email" placeholder="{{ __('Email') }}" autocomplete="off">
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" wire:model="password" placeholder="{{ __('Password') }}" autocomplete="new-password">
                                    @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Spinner overlay -->
                        <div wire:loading wire:target="login, btnRegister, btnLogin" class="spinner-overlay align-content-center text-center">
                            <div class="spinner-border color-active" role="status"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div>
                            @if (!$register)
                                <a href="#" wire:click.prevent="btnRegister" class="mr-2">{{ __('Register') }}</a>
                            @else
                                <a href="#" wire:click.prevent="btnLogin" class="mr-2">{{ __('Already registered?') }}</a>
                            @endif
                        </div>
                        <div>
                            <button id="cerrarModalLoginFast" type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                @if ($register)
                                    {{ __('Register') }}
                                @else
                                    {{ __('Login') }}
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



</div>
