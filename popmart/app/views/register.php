<style>
    .form-container {
        max-width: 400px;
        width: 100%;
        padding: 20px;
        background: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-black {
        background-color: #000;
        border-color: #000;
        color: #fff;
    }

    .btn-black:hover {
        background-color: #d41d1d;
        color: white;
    }

    .form-container input,
    .form-container select,
    .btn {
        border-radius: 0 !important;
    }

    h2 {
        font-size: 1.5rem;
    }

    .divider {
        display: flex;
        align-items: center;
        text-align: center;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #ddd;
    }

    .divider::before {
        margin-right: 0.5em;
    }

    .divider::after {
        margin-left: 0.5em;
    }

    .form-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
    }
</style>
<div class="form-wrapper">
    <div class="form-container text-center">
        <h2 class="mb-4">REGISTER</h2>
        <form method="POST" action="register">
            <div class="mb-3">
                <label for="country" class="form-label visually-hidden">Country</label>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label visually-hidden">Email address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your e-mail address" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label visually-hidden">Your Name</label>
                <input type="name" name="name" class="form-control" id="name" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label visually-hidden">Your Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-black w-100">Register</button>
        </form>

        <div class="divider my-4">Join With</div>

        <div class="d-flex justify-content-center gap-3">
            <button class="btn rounded-circle">
                <img src="<?=_WEB_ROOT_?>/app/assets/img/google-icon.avif" alt="Google" width="40">
            </button>
            <button class="btn rounded-circle">
                <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple" width="30">
            </button>
        </div>

        <p class="mt-4 text-muted" style="font-size: 0.9rem;">
            By continuing, you agree to our <a href="#" class="text-decoration-none">Platform's Terms of Service</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>.
        </p>
        <p class="mt-4 text-muted" style="font-size: 0.9rem;">
           You have a account <a href="<?=_WEB_ROOT_?>/login" class="text-decoration-none">Login Now</a>
        </p>
    </div>
</div>
