<!DOCTYPE html>
<html>

<head>
    <title>Verifikasi OTP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f3f0f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: #ffffff;
            padding: 40px;
            width: 400px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #9c5cf7;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 25px;
        }

        .otp-inputs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .otp-inputs input {
            width: 50px;
            height: 55px;
            font-size: 22px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: 0.3s;
        }

        .otp-inputs input:focus {
            border-color: #9c5cf7;
            box-shadow: 0 0 5px rgba(156, 92, 247, 0.3);
            outline: none;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            background: linear-gradient(to right, #c471f5, #7f5af0);
            transition: 0.3s;
        }

        .btn-login:hover {
            opacity: 0.9;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="card">
        <h2>Verifikasi OTP</h2>
        <p class="subtitle">Masukkan 6 digit kode yang dikirim ke email kamu</p>

        @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/verify-otp">
            @csrf
            <input type="text" name="otp" maxlength="6" placeholder="Masukkan 6 digit OTP">
            <button type="submit">Verifikasi</button>
        </form>
    </div>

    <script>
        function move(current, nextFieldID) {
            if (current.value.length >= 1) {
                document.getElementById(nextFieldID)?.focus();
            }
        }
    </script>

</body>

</html>