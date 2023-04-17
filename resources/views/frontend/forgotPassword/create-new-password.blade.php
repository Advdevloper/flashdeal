<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        form {
            border: 3px solid #f1f1f1;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <h2>Create Password</h2>
    {{-- @if ($errors->any())
        <h4>{{ $errors->first() }}</h4>
    @endif --}}


    <form action="{{ route('update-password') }}" method="post">
        @csrf
        <div class="imgcontainer">
            <img src="img_avatar2.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="uname"><b>new password</b></label>
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="text" placeholder="Enter Passord" minlength="8" name="password" required>
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
            <label for="psw"><b> Confirm Password</b></label>
            <input type="password" placeholder="Enter confirm Password"minlength="8" name="confirm_password" required>
            @if ($errors->has('confirm_password'))
                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
            @endif
            <button type="submit" value="submit">submit</button>
            {{-- <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me --}}
            </label>
        </div>


    </form>

</body>

</html>
