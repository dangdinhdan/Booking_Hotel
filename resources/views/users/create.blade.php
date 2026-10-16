@extends('layouts.layoutmaster')
@section('title', 'Thêm người dùng mới')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Thêm người dùng mới</h1>
        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Quay lại danh sách</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card" style="max-width: 800px;">
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST" novalidate>
                @csrf
                @include('users._form')
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Thêm người dùng</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>
@endsection
