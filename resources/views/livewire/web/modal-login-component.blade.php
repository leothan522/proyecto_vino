<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    {{--<button id="buttonModalLoginFast" type="button" data-toggle="modal" data-target="#modalLoginFast">Modal Login Fast</button>--}}

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalLoginFast" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit="login" class="billing-form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Login') }} {{ $productos_id }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body position-relative">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" wire:model="email" placeholder="{{ __('Email') }}" >
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" wire:model="password" placeholder="{{ __('Password') }}" >
                                    @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Spinner overlay -->
                        <div wire:loading wire:target="login" class="spinner-overlay align-content-center text-center">
                            <div class="spinner-border color-active" role="status"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="cerrarModalLoginFast" type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</div>
