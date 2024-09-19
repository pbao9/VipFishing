<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lấy lại mật khẩu</title>
</head>
<body>
    <p>Xin chào, {{ $user->fullname }}</p>
    <p>Để lấy lại mật khẩu bạn vui lòng truy cập link dưới để xác nhận mật khẩu mới. Hãy nhớ rằng để đảm bảo tính bảo mật, bạn không được gửi thông tin này cho bất kì ai.</p>
    <p>link: <a href="{{ $url }}">Truy cập link</a></p>
    <p style="text-aign:right">Xin cảm ơn</p>
</body>
</html>