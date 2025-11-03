@extends('layouts.app')

@section('title', 'Registrar')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Registrar</h4>
            </div>
            <div class="card-body">
                <form id="registerForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Registrar</button>
                </form>
                <div class="mt-3 text-center">
                    <p>Já tem conta? <a href="{{ route('login') }}">Faça login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="{{ asset('js/auth-register.js') }}"></script>
@endsection
@endsection

