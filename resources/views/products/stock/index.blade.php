@extends('layouts.app')

@section('content')
<div class="container py-5" style="background: #f8fafc; min-height: 100vh;">

    <h1 class="mb-5 text-center text-primary fw-bold">Gerenciamento de Estoque</h1>

    {{-- Navegação --}}
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Produtos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Estoque</li>
            </ol>
        </nav>
    </div>

    {{-- Lista de Categorias (Estoques) --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <strong class="fs-5">Categorias de Estoque</strong>
        </div>
        <div class="card-body">
            @if($categories->count())
            <div class="row g-4">
                @foreach ($categories as $category)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-3 hover-card">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-box-seam fs-1 text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold">{{ $category->category }}</h5>
                            <p class="card-text text-muted">
                                @php
                                    $productCount = \App\Models\Product::where('category', $category->category)->count();
                                @endphp
                                {{ $productCount }} {{ $productCount == 1 ? 'produto' : 'produtos' }}
                            </p>
                            <a href="{{ route('stock.category', $category->category) }}" class="btn btn-primary btn-lg w-100">
                                Ver Produtos
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <div class="alert alert-info text-center mb-0">
                    <i class="bi bi-info-circle fs-4 mb-3 d-block"></i>
                    <h5>Nenhuma categoria encontrada</h5>
                    <p class="mb-0">Cadastre produtos com categorias para visualizar o estoque aqui.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Cadastrar Produtos</a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.hover-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}
</style>

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection

