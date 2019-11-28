<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>测试</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <p> users </p>
    {{ $hao }}
    @foreach ($data as $v)
        {{ $v['username'] }}
    @endforeach
</div>
</body>
</html>
