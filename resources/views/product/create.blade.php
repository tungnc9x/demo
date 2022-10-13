@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Thêm sản phẩm</div>
                    <div class="card-body">
                        @if(session()->has('msg_error'))
                            <div class="alert alert-danger" role="alert">{{session('msg_error')}}</div>
                        @endif
                        <form action="{{route('product.store')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên sản phẩm</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Tên sản phẩm" autocomplete="off">
                                @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="price" class="form-label">Giá bán</label>
                                    <input type="number" name="price" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror" id="price">
                                    @error('price')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="quantity" class="form-label">Số lượng</label>
                                    <input type="number" name="quantity" value="{{old('quantity')}}" class="form-control @error('quantity') is-invalid @enderror" id="quantity">
                                    @error('quantity')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="excerpt" class="form-label">Mô tả</label>
                                <textarea class="form-control" name="excerpt" id="excerpt" rows="3">{{old('excerpt')}}</textarea>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Thêm mới</button>
                                <a href="{{route('product.index')}}" class="btn btn-warning">Quay lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
        })
    </script>
@endpush
