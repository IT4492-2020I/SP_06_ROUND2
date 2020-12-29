@extends("user::layoutUser.index") @section("title", "Trang chủ") @section("content")
<div class="container" style="margin:50px 30px;">
    <br />
    <div class="row">
        <div class="col-sm-3">
            <ul class="aside-menu">
                <li> <img src="{{$user->avata_url}}" style="border: 2px solid blue;border-radius: 15px; width:50px; height:50px;" /></li>
                <li><a id="i" {{--href="{{route('thongtinuser',$user->id)}}" --}}>Thông Tin Tài Khoản</a></li>

            </ul>
        </div>
        <div class="col-sm-9">
            <div id="info">
                <form action="{{route('changeinfo')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    Full Name <input type="text" value="{{$user->name}}" name="name" required /><br />
                    Số Điện Thoại <input type="text" value="{{$user->phone}}" name="phone" required /><br />
                    Email <input type="email" disabled value="{{$user->email}}" name="email" required /> <br />
                    Địa Chỉ <input type="text" value="{{$user->address}}" name="address" required /><br />
                    Avatar <input type="file" name="avata_url" /><br />
                    <input type="hidden" value="{{$user->id}}" name="id" />
                    <br /><input type="submit" value="Cập Nhập" name="Submit" />
                </form>
            </div>
        </div>
    </div>
    <br />

</div>
@endsection
