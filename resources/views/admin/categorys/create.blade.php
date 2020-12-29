@extends('layouts.app')

@section('title', 'Thêm mới thể loại')

@section('content')
        <!-- Page Content  -->
        <div id="content">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="page-header">
                        <h2><a href="{{ route('categorys.create') }}">Thêm mới thể loại</a></h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('categorys.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input name="url_back" type="hidden" class="form-control" value="{{ url()->previous() }}">
                
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="name" class="control-label">Name</label>
                            </div>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="inputName" value="{{ old('name') ?? null }}" placeholder="vd: Anime" required>
                            </div>
                        </div>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                
                        {{--status--}}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="inputStatus" class="control-label">Trạng thái.</label>
                            </div>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" @if(old('status') == 0) checked @endif>Ngừng bán</label>
                                <input type="radio" name="status" value="1" @if(old('status') == 1) checked @endif>Kinh doanh</label>
                            </div>
                        </div>
                
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Lưu.</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
@endsection	('content')
