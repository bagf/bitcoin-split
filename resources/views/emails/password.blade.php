<!-- resources/views/emails/password.blade.php -->

Click here to reset your password: {{ action('Auth\PasswordController@getReset', compact('token'))."?email={$user->email}" }}