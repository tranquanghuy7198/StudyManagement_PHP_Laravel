<h1>Thay đổi thông tin cá nhân</h1>

{!! Form::open(array('route' => 'updatePersonalInfo', 'method' => 'post')) !!}

{!! csrf_field() !!}

    <!-- 'Chính quy' => 'Hệ chính quy',
    'Cử nhân' => 'Cử nhân',
    'Kỹ sư chất lượng cao' => 'Kỹ sư chất lượng cao',
    'Kỹ sư tài năng' => 'Kỹ sư tài năng',
    'Việt - Nhật' => 'Việt - Nhật',
    'ICT' => 'ICT' -->

{!! Form::label('phone', 'Số điện thoại') !!}
{!! Form::text('phone', '', array('placeholder' => 'Nhập số mới')) !!}<br>

{!! Form::label('mail', 'Email') !!}
{!! Form::text('mail', '', array('placeholder' => 'Nhập email mới')) !!}<br>

{!! Form::label('address', 'Địa chỉ') !!}
{!! Form::text('address', '', array('placeholder' => 'Nhập địa chỉ mới')) !!}<br>

{!! Form::reset('Nhập lại') !!}
{!! Form::submit('Gửi thông tin') !!}

{!! Form::close() !!}