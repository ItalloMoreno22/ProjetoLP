@extends('layouts.app')

@section('content')
<div class="container py-5" style="background: #f8fafc; min-height: 100vh;">

    <h1 class="mb-3 text-center text-primary fw-bold">Estoque: {{ $category }}</h1>

    {{-- Navegação --}}
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Produtos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('stock.index') }}" class="text-decoration-none">Estoque</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category }}</li>
            </ol>
        </nav>
    </div>

    {{-- Resumo da Categoria --}}
    <div class="card shadow-sm mb-4 border-0 rounded-4">
        <div class="card-body bg-light rounded-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-1 fw-bold text-dark">{{ $category }}</h4>
                    <p class="text-muted mb-0">
                        Total de {{ $products->count() }} {{ $products->count() == 1 ? 'produto' : 'produtos' }} 
                        | Quantidade total: {{ $products->sum('quantity') }} unidades
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('stock.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Voltar ao Estoque
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Lista de Produtos da Categoria --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white rounded-top-4">
            <strong class="fs-5">Produtos em Estoque</strong>
        </div>
        <div class="card-body">
            @if($products->count())
            <div class="table-responsive">
                <table class="table table-striped align-middle table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Status</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td class="fw-semibold">{{ $product->name }}</td>
                            <td>{{ $product->description ?: 'Sem descrição' }}</td>
                            <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-info fs-6">{{ $product->quantity }}</span>
                            </td>
                            <td>
                                @if($product->quantity > 10)
                                    <span class="badge bg-success">Em estoque</span>
                                @elseif($product->quantity > 0)
                                    <span class="badge bg-warning">Estoque baixo</span>
                                @else
                                    <span class="badge bg-danger">Sem estoque</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning me-2 shadow-sm" title="Editar">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>

                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Tem certeza que deseja excluir?')" title="Excluir">
                                        <i class="bi bi-trash"></i> Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Estatísticas da Categoria --}}
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <h5>{{ $products->count() }}</h5>
                            <small>Total de Produtos</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h5>{{ $products->sum('quantity') }}</h5>
                            <small>Unidades em Estoque</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <h5>R$ {{ number_format($products->avg('price'), 2, ',', '.') }}</h5>
                            <small>Preço Médio</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <h5>R$ {{ number_format($products->sum(function($p) { return $p->price * $p->quantity; }), 2, ',', '.') }}</h5>
                            <small>Valor Total</small>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="alert alert-info text-center mb-0">
                    <i class="bi bi-info-circle fs-4 mb-3 d-block"></i>
                    <h5>Nenhum produto encontrado</h5>
                    <p class="mb-0">Não há produtos cadastrados nesta categoria.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Cadastrar Produtos</a>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection

