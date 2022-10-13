@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="{{route('product.create')}}" class="btn btn-primary">Thêm mới</a></div>
                    <div class="card-body">
                        @if(session()->has('msg_success'))
                            <div class="alert alert-success" role="alert">{{session('msg_success')}}</div>
                        @elseif(session()->has('msg_error'))
                            <div class="alert alert-danger" role="alert">{{session('msg_error')}}</div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Tên sản phẩm</th>
                                    <th width="10%">Giá bán</th>
                                    <th width="10%">Số lượng</th>
                                    <th class="text-center" width="5%">Sửa</th>
                                    <th class="text-center" width="5%">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td class="text-center">
                                            <a href="{{route('product.edit',['id'=>$product->id])}}" class="btn btn-primary">Sửa</a>
                                        </td>
                                        <td class="text-center">
                                            <form method="POST" action="{{route('product.destroy',['id'=>$product->id])}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
