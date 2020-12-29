@extends('product::layoutAdmin.app')
@section('title', 'Thêm mới sản phẩm')

@section('content')
        <!-- Page Content  -->
        <div id="content">

            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="page-header">
                        <h2><a href="{{ route('products.create') }}">Thêm mới sản phẩm</a></h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input name="url_back" type="hidden" class="form-control" value="{{ url()->previous() }}">

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="name" class="control-label">Name</label>
                            </div>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="inputName" value="{{ old('name') ?? null }}" placeholder="vd: Nguyễn Văn An">
                            </div>
                        </div>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="avata" class="control-label @if($errors->has('image')) text-danger @endif">ảnh trước</label>
                            </div>
                            <div class="col-sm-10">
                                <input name="image" type="file" class="form-control @if($errors->has('image')) is-invalid @endif" id="inputPasswordConfirmation" placeholder="">
                            </div>
                        </div>
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        {{--category_id--}}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="inputRole" class="control-label">Thể loại:</label>
                            </div>
                            <div class="col-sm-10">
                                <select class="form-control" name="category_id" id="">
                                    <option value="">--Chọn thể loại--</option>
                                    @foreach($categorys as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{--price--}}
                        <div class="form-group">
                            <div class="col-sm-5">
                                <label for="price" class="control-label @if($errors->has('price')) text-danger @endif">Giá tiền(đồng):</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="number" class="form-control @if($errors->has('phone')) is-invalid @endif" name="price"  id="validationServerUsername" placeholder="cao">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend3">đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        {{--description--}}
                        <div class="form-group">
                            <div class="col-sm-5">
                                <label for="description" class="control-label @if($errors->has('description')) text-danger @endif">Mô tả sản phẩm</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <textarea rows="4" cols="300" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        @error('price')
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
    </div>
@endsection	('content')
