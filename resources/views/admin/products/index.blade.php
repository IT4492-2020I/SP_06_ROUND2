@extends('layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('content')
        <!-- Page Content  -->
        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header row">
                        <div class="col">
                            <h2><a href="{{ route('products.index') }}">Danh sách sản phẩm</a></h2>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('products.create') }}" class="btn btn-success">Tạo mới</a>
                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded mt-3 mb-3 p-4">
                    <form action="{{ route('products.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-right">Tên</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" value="{{ request('name') }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-right">Thể loại</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="category_id">
                                            <option value="">--Chọn thể loại.</option>
                                            @foreach($categorys as $key => $value)
                                                <option value="{{ $key }}" @if(request('category_id') == $key) selected @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-right">Trang thái</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="status">
                                            <option value="0" @if(request('status') == 0) selected @endif>Ngừng bán</option>
                                            <option value="1" @if(request('status') == 1) selected @endif>Kinh doanh</option>
                                            <option value="" selected>--Chọn trạng thái.</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-right">Thời gian từ:</label>
                                    <div class="col-md-8">
                                        <input data-provide="datepicker" data-date-format="yyyy-mm-dd" class="form-control" type="date" name="from" value="{{ request('from') }}" placeholder="Từ" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-right">đến:</label>
                                    <div class="col-md-8">
                                        <input data-provide="datepicker" data-date-format="yyyy-mm-dd" class="form-control" type="date" name="to" value="{{ request('to') }}" placeholder="Đến" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                &nbsp;
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-2 offset-md-5">
                                        <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @if ($products->count() == 0)
                    <div><h3 class="text-center red">{{ 'Không tìm thấy bản ghi nào.' }}</h3></div>
                @else
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Tên</th>
                            <th class="text-center">Thể loại</th>
                            <th class="text-center">Giá tiền(vnđ)</th>
                            <th class="text-center">Trang thái</th>
                            <th class="text-center">Thời gian</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $value)
                            <tr>
                                <td>{{ $products->perPage() * ($products->currentPage() - 1) + $key + 1 }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->category->name }}</td>
                                <td>{{ number_format($value->price, 0, '', ',') }}</td>
                                <td>@if (($value->status) == 0)Ngừng bán @else Kinh doanh @endif</td>
                                <td>{{  date("H:i:s d/m/Y",strtotime($value->created_at)) }}</td>
                                <td>
                                    <p class="text-left">
                                        <a href="{{ route('products.show', $value->id) }}">hiển thị</a>　|　
                                        <a href="{{ route('products.edit', $value->id) }}">Sửa</a>　|　
                                        <button class="btn btn-link text-danger mb-1" data-toggle="modal" data-target="{{ '#delete-modal' . $key }}">
                                            Xóa
                                        </button>
                                    </p>
                                    <!-- Modal -->
                                    <div class="modal fade" id="{{ 'delete-modal' . $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <form method="post" action="{{ route('products.destroy', $value->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Bạn có chắc chắn muốn xóa bản ghi này không?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                                                        <button type="submit" class="btn btn-danger">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-12">{{ $products->appends(request()->input())->links() }}</div>
                @endif
            </div>
    </div>
@endsection