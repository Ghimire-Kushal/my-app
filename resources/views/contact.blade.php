<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
</head>
<body>
    @extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="mb-4 text-center">Contact Me</h3>

                <form>
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Message</label>
                        <textarea class="form-control" rows="4"></textarea>
                    </div>

                    <button class="btn btn-primary w-100">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
</body>
</html>