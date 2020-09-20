@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
    <form action="{{ $register_url }}" method="post">
        {{ csrf_field() }}

        {{-- Cedula field --}}
        <div class="input-group mb-3">
            <input type="number" name="cedula" class="form-control {{ $errors->has('cedula') ? 'is-invalid' : '' }}"
                   value="{{ old('cedula') }}" placeholder="Ingrese su cedula" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-card-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('cedula'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('cedula') }}</strong>
                </div>
            @endif
        </div>

        {{-- Nombre field --}}
        <div class="input-group mb-3">
            <input type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                   value="{{ old('nombre') }}" placeholder="Ingrese su nombre">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('nombre'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('nombre') }}</strong>
                </div>
            @endif
        </div>

        {{-- Apellido field --}}
        <div class="input-group mb-3">
            <input type="text" name="apellido" class="form-control {{ $errors->has('apellido') ? 'is-invalid' : '' }}"
                   value="{{ old('apellido') }}" placeholder="Ingrese su apellido">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('apellido'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('apellido') }}</strong>
                </div>
            @endif
        </div>
        {{-- Sexo field --}}
        <div class="input-group mb-3">
            <select class="custom-select border border-success" id="inputGroupSelect01" name="sexo" class="form-control {{ $errors->has('sexo') ? 'is-invalid' : '' }}">
                <option selected>Seleccione...</option>
                <option value="F">Femenino</option>
                <option value="M">Masculino</option>
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-ankh {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('sexo'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('sexo') }}</strong>
                </div>
            @endif
        </div>
        {{-- Telefono field --}}
        <div class="input-group mb-3">
            <input type="number" name="telefono" class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                   value="{{ old('telefono') }}" placeholder="Ingrese su telefono">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('telefono'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('telefono') }}</strong>
                </div>
            @endif
        </div>
        {{-- Fecha Nacimiento field --}}
        <div class="input-group mb-3">
            <input type="date" name="fecha_nacimiento" class="form-control {{ $errors->has('fecha_nacimiento') ? 'is-invalid' : '' }}"
                   value="{{ old('fecha_nacimiento') }}" placeholder="Ingrese su fecha de nacimiento">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-calendar {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('fecha_nacimiento'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                </div>
            @endif
        </div>
        {{-- Direccion field --}}
        <div class="input-group mb-3">
            <input type="text" name="direccion" class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}"
                   value="{{ old('direccion') }}" placeholder="Ingrese su direccion">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-address-book {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('direccion'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('direccion') }}</strong>
                </div>
            @endif
        </div>
        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   value="{{ old('email') }}" placeholder="Ingrese su correo electronico">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password"
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password_confirmation'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
            @endif
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('adminlte::adminlte.i_already_have_a_membership') }}
        </a>
    </p>
@stop
