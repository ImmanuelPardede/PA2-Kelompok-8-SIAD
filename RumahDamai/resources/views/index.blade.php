<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- You can link your CSS styles here if needed -->
</head>
<body>
    @auth('admin')
        <p>Halo Admin</p>
    @endauth

    @auth('staff')
        <p>Halo Staff</p>
    @endauth

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <!-- You can link your CSS styles here if needed -->
    </head>
    <body>
        @auth('admin')
        <p>Halo Admin</p>
    @endauth

    @auth('staff')
        <p>Halo Staff</p>
    @endauth

    @auth('guru')
    <p>Halo guru</p>
@endauth
    
        <a href="/logout">Logout</a>

    
</body>
</html>
