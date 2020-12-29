@extends('user::layoutAdmin.app')

@section('title', 'Chỉnh sử người dùng')

@section('content')
        <!-- Page Content  -->
        <div id="content">

            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="page-header">
                        <h2><a href="{{ route('users.edit', $user->id) }}">Chỉnh sửa người dùng</a></h2>
                    </div>
                </div>

                <div class="col-md-12">
                    <form method="post" action="{{ route('users.update', $user->id) }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input name="url_back" type="hidden" class="form-control" value="{{ url()->previous() }}">
                        <input name="id" type="hidden" class="form-control" value="{{ $user->id }}">

                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="name" class="control-label">Name</label>
                            </div>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="inputName" value="{{ $user->name ?? old('name') }}" placeholder="vd: Nguyễn Văn An">
                            </div>
                        </div>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        {{--email--}}
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="email" class="control-label @if($errors->has('email')) text-danger @endif">email</label>
                            </div>
                            <div class="col-sm-10">
                                <input name="email" type="text" class="form-control @if($errors->has('email')) is-invalid @endif" id="inputEmail" value="{{ $user->email ?? old('email') }}" placeholder="vd:example@gmail.com">
                            </div>
                        </div>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        {{--avata_url--}}
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="avata" class="control-label @if($errors->has('avata_url')) text-danger @endif">avata</label>
                            </div>
                            <div class="col-sm-10">
                                <input name="avata_url" type="file" class="form-control @if($errors->has('avata_url')) is-invalid @endif" id="inputPasswordConfirmation" placeholder="">
                            </div>
                        </div>
                        @error('avata_url')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        {{--password--}}
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="password" class="control-label @if($errors->has('password')) text-danger @endif">password</label>
                            </div>
                            <div class="col-sm-10">
                                <input name="password" type="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="inputPassword" placeholder="********">
                            </div>
                        </div>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        {{--password_confirmation--}}
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="password_confirmation" class="control-label @if($errors->has('password_confirmation')) text-danger @endif">password confirm</label>
                            </div>
                            <div class="col-sm-10">
                                <input name="password_confirmation" type="password" class="form-control @if($errors->has('password_confirmation')) is-invalid @endif" id="inputPasswordConfirmation" placeholder="********">
                            </div>
                        </div>
                        @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        {{--address--}}
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="address" class="control-label @if($errors->has('address')) text-danger @endif">Địa chỉ</label>
                            </div>
                            <div class="col-sm-10">
                                <input name="address" type="text" class="form-control @if($errors->has('address')) is-invalid @endif" id="addressInput" value="{{ $user->address ?? old('address') }}" placeholder="123 đường xxx, phường xxxx, quận xxx, tp xxx">
                            </div>
                        </div>
                        @error('address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        {{--address--}}
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="phone" class="control-label @if($errors->has('phone')) text-danger @endif">Số điện thoại</label>
                            </div>
                            <div class="col-sm-10">
                                <input name="phone" type="text" class="form-control @if($errors->has('phone')) is-invalid @endif" value="{{ $user->phone ?? old('phone') }}" id="phoneInput" placeholder="0123456789">
                            </div>
                        </div>
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        {{--status--}}
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="inputStatus" class="control-label">Trạng thái.</label>
                            </div>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" @if($user->status == 0) checked @endif>Đang khóa
                                    <input type="radio" name="status" value="1" @if($user->status == 1) checked @endif>Kích hoạt
                                </label>
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

