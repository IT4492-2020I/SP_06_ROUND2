@extends('layouts.app')

@section('title', 'Quản lý thể loại')

@section('content')
    <!-- Page Content  -->
    <div id="content">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header row">
                    <div class="col">
                        <h2><a href="{{ route('categorys.index') }}">Danh sách thể loại</a></h2>
                    </div>
                    <div class="col text-right">
                        <a href="{{ route('categorys.create') }}" class="btn btn-success">Tạo mới</a>
                    </div>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Tên</th>
                    <th class="text-center">Trang thái</th>
                    <th class="text-center">Ngày tạo</th>
                    <th class="text-center">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categorys as $key => $value)
                    <tr>
                        <td>{{ $categorys->perPage() * ($categorys->currentPage() - 1) + $key + 1 }}</td>
                        <td>{{ $value->name }}</td>
                        <td>@if (($value->status) == 1)Đang sử dụng @else Ngưng sử dụng @endif</td>
                        <td>{{ date("H:i:s d/m/Y",strtotime($value->created_at)) }}</td>
                        <td>
                            <p class="text-right">
                                <a href="{{ route('categorys.show', $value->id) }}">hiện thị</a>　|　
                                <button class="btn btn-link text-danger mb-1" data-toggle="modal" data-target="{{ '#delete-modal' . $key }}">Xóa</button>
                            </p>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="{{ 'delete-modal' . $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form method="post" action="{{ route('categorys.destroy', $value->id) }}">
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
            <div class="col-md-12">{{ $categorys->appends(request()->input())->links() }}</div>
    </div>
@endsection
