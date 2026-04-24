<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>
</head>
<body>
    
    @extends('layouts.app')

@section('content')
<div class="row align-items-center">
    <div class="col-md-4 text-center">
        <img src="https://via.placeholder.com/250"
             class="img-fluid rounded-circle shadow"
             alt="Profile">
    </div>

    <div class="col-md-8">
        <h2>About Me</h2>
        <p>
            I am a passionate Laravel developer who loves building
            modern web applications and solving real-world problems.
        </p>

        <h4 class="mt-4">Skills</h4>

        <div class="mb-3">
            <label>Laravel</label>
            <div class="progress">
                <div class="progress-bar bg-success" style="width: 85%"></div>
            </div>
        </div>

        <div class="mb-3">
            <label>PHP</label>
            <div class="progress">
                <div class="progress-bar bg-info" style="width: 80%"></div>
            </div>
        </div>

        <div class="mb-3">
            <label>HTML & CSS</label>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width: 90%"></div>
            </div>
        </div>
    </div>
</div>
@endsection
</body>
</html>