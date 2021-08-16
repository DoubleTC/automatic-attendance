<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Automatic Attendance</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
    <div class="container">
        <div class="heading-box text-center">
            <h2>Automatic Attendance</h2>
            <h4>By DoubleTC</h4>
        </div>
        @if(session()->has('success'))
            <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
        @endif
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif
        <form method="POST" action="{{ route('register') }}" class="row g-3 needs-validation" novalidate>
            @csrf
            <div class="col-md-4">
                <label for="accessToken" class="form-label">Access Token</label>
                <input type="text" class="form-control" id="accessToken" name="access_token" value="{{ old('access_token') }}" maxlength="50" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please provide access token.
                </div>
            </div>
            <div class="col-md-4">
                <label for="channelId" class="form-label">Channel Id</label>
                <input type="text" class="form-control" id="channelId" name="channel_id" value="{{ old('channel_id') }}" maxlength="50" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please provide channel Id.
                </div>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" maxlength="100" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please provide an email.
                </div>
            </div>
            <div class="col-md-12">
                <label for="message" class="form-label">Message</label>
                <input type="text" class="form-control" id="message" name="message" value="{{ old('message') }}" maxlength="200" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please choose a message.
                </div>
            </div>
            <div class="col-md-12">
                <label for="sendAtTime" class="form-label">Send At Time</label>
                <input type="time" class="form-control" id="sendAtTime" name="send_at_time" value="{{ old('send_at_time') }}" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please choose a time.
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="monday" name="monday" value="1" @if(old('monday') == 1) checked @endif>
                    <label class="form-check-label" for="monday">Monday</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="tuesday" name="tuesday" value="1" @if(old('tuesday') == 1) checked @endif>
                    <label class="form-check-label" for="tuesday">Tuesday</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="wednesday" name="wednesday" value="1" @if(old('wednesday') == 1) checked @endif>
                    <label class="form-check-label" for="wednesday">Wednesday</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="thursday" name="thursday" value="1" @if(old('thursday') == 1) checked @endif>
                    <label class="form-check-label" for="thursday">Thursday</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="friday" name="friday" value="1" @if(old('friday') == 1) checked @endif>
                    <label class="form-check-label" for="friday">Friday</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="saturday" name="saturday" value="1" @if(old('saturday') == 1) checked @endif>
                    <label class="form-check-label" for="saturday">Saturday</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="sunday" name="sunday" value="1" @if(old('sunday') == 1) checked @endif>
                    <label class="form-check-label" for="sunday">Sunday</label>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    </body>
</html>
