@extends('layouts.app')

@section('title', 'Cadastrar Produto')

@section('content')
    <h1>Cadastrar Produto</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Preço</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Armazém</label>
            <input type="text" name="warehouse" class="form-control" placeholder="Local do armazém">
        </div>

        <button class="btn btn-success">Salvar</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
@endsection
