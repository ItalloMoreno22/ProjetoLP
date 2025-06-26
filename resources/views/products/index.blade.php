@extends('layouts.app')

@section('content')
<div class="container py-5" style="background: #f8fafc; min-height: 100vh;">

    <h1 class="mb-5 text-center text-primary fw-bold">Cadastro de Produtos</h1>

    {{-- Menu de Navegação --}}
    <div class="mb-4">
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="bi bi-list-ul"></i> Produtos
            </a>
            <a href="{{ route('stock.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-boxes"></i> Estoque
            </a>
        </div>
    </div>

    {{-- Formulário de Cadastro --}}
    <div class="card shadow-lg mb-5 border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <strong class="fs-5">Novo Produto</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nome <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-lg shadow-sm" placeholder="Digite o nome do produto" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Categoria</label>
                        <input type="text" name="category" class="form-control form-control-lg shadow-sm" placeholder="Ex: Eletrônicos, Roupas...">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Descrição</label>
                        <textarea name="description" class="form-control form-control-lg shadow-sm" rows="3" placeholder="Descrição detalhada do produto"></textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Preço <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="price" class="form-control form-control-lg shadow-sm" placeholder="R$ 0,00" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Quantidade <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" class="form-control form-control-lg shadow-sm" placeholder="Quantidade em estoque" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Armazém</label>
                        <input type="text" name="warehouse" class="form-control form-control-lg shadow-sm" placeholder="Local do armazém">
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-lg px-4 shadow-sm">
                            Cadastrar Produto
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Lista de Produtos --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white rounded-top-4">
            <strong class="fs-5">Produtos Cadastrados</strong>
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
                            <th>Categoria</th>
                            <th>Armazém</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td class="fw-semibold">{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->warehouse }}</td>
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
            @else
                <div class="alert alert-info text-center mb-0">
                    Nenhum produto cadastrado.
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection
