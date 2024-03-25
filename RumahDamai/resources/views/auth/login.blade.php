

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="-8">
  <meta name="viewport" content="=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 400px;
      background-color: #fff;
      margin: 150px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    figure{
        text-align: center;
        margin-bottom: 10px;
        font-size: 15px;
    }

    img {
display: block;  
margin: 10px auto;
width: 150px;
}

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"],
    input[type="institute"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 15px;
    }

    /* Style the checkbox and button container */
    .checkbox-and-button {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    input[type="checkbox"] {
      margin-right: 10px;
    }

    button[type="submit"] {
      width: 48%; /* Adjust width for two elements */
      padding: 10px;
      background-color: #2f2671;
      color: #fff; 
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #4CAF50;
    }
  </style>
</head>
<body>
  <div class="container">
    
    <img src="{{ asset('skydash/images/logo.png') }}" alt="">
    <figure>YPA Rumah Damai</figure>
    <hr>
    @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ url('/login') }}">
            @csrf
      <label for="email">Email:</label>
      <input type="text" id="email" name="email" value="{{ old('email') }}" required>
      <br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>


      <div class="checkbox-and-button">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Remember Me</label>
        <button type="submit">Sign In</button>
      </div>
    </form>
  </div>
</body>
</html>