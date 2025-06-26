@extends('layouts.app')

@section('content')
<div class="container py-5" style="background: #f8fafc; min-height: 100vh;">

    <h1 class="mb-5 text-center text-primary fw-bold">Editar Produto</h1>

    <div class="mb-4">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card shadow-lg mb-5 border-0 rounded-4">
        <div class="card-header bg-warning text-white rounded-top-4">
            <strong class="fs-5">Editar Produto</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nome <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-lg shadow-sm" value="{{ $product->name }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Categoria</label>
                        <input type="text" name="category" class="form-control form-control-lg shadow-sm" value="{{ $product->category }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Descrição</label>
                        <textarea name="description" class="form-control form-control-lg shadow-sm" rows="3">{{ $product->description }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Preço <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="price" class="form-control form-control-lg shadow-sm" value="{{ $product->price }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Quantidade <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" class="form-control form-control-lg shadow-sm" value="{{ $product->quantity }}" required>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-lg px-4 shadow-sm">
                            Salvar Alterações
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection
