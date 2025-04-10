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
        <h2 class="mb-4">LOGIN TO YOUR ACCOUNT</h2>
        <form method="POST" action="login">
            <div class="mb-3">
                <label for="email" class="form-label visually-hidden">Email address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email address" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label visually-hidden">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
            </div>
            <?php if(isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
      <?= $_SESSION['error_message']; ?>
    </div>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

            <button type="submit" class="btn btn-black w-100">LOGIN</button>
        </form>

        <p class="mt-4 text-muted" style="font-size: 0.9rem;">
            By continuing, you agree to our <a href="#" class="text-decoration-none">Platform's Terms of Service</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>.
        </p>
        <p class="mt-4 text-muted" style="font-size: 0.9rem;">
            <a href="<?= _WEB_ROOT_ ?>/register" class="text-decoration-none">Register Now</a>
        </p>
    </div>
</div>
