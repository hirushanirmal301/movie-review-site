<?php
if (isset($_GET['action'])) {
    $messages = [
        'err_user' => [
            'icon' => 'error',
            'title' => 'Invalid Name',
            'text' => 'The name must be at least 3 characters long.',
        ],
        'err_pass' => [
            'icon' => 'error',
            'title' => 'Password Mismatch',
            'text' => 'Your confirm password does not match!',
        ],
        'err_passlen' => [
            'icon' => 'error',
            'title' => 'Password Too Short',
            'text' => 'The password should be at least 5 characters long.',
        ],
        'err_email' => [
            'icon' => 'error',
            'title' => 'Email in Use',
            'text' => 'Email is already in use. Please use another one.',
        ],
        'err_uniquser' => [
            'icon' => 'error',
            'title' => 'Username Taken',
            'text' => 'Username is already in use. Please use another one.',
        ],
        'done' => [
            'icon' => 'success',
            'title' => 'Register Successful',
            'text' => 'You have successfully Registerd.',
        ],
        'err_active' => [
            'icon' => 'error',
            'title' => 'Account Not Activated',
            'text' => 'Your account is not activated.',
        ],
        'err_acc' => [
            'icon' => 'error',
            'title' => 'Login Failed',
            'text' => 'Wrong username or password.',
        ],
        'post_success' => [
            'icon' => 'success',
            'title' => 'Movie created Successful',
            'text' => 'You have successfully Movie Created',
        ],
        'err_post' => [
            'icon' => 'error',
            'title' => 'Movie Create Failed',
            'text' => 'You have unsuccessfully Movie Create',
        ],
        'movie_remove_err' => [
            'icon' => 'error',
            'title' => 'Movie Delete Failed',
            'text' => 'Error deleting movie',
        ],
        'movie_remove_success' => [
            'icon' => 'success',
            'title' => 'Movie deleted Successful',
            'text' => 'You have successfully Movie deleted',
        ],
    ];

    $action = $_GET['action'];
    if (array_key_exists($action, $messages)) {
        $alert = $messages[$action];
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: '{$alert['icon']}',
                    title: '{$alert['title']}',
                    text: '{$alert['text']}',
                });
            });
        </script>";
    }
}
?>
