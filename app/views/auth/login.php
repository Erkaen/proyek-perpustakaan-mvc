<style>
    html, body {
        height: 100%;
    }
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #272B30; 
    }
    .form-signin {
        width: 100%;
        max-width: 400px;
        padding: 15px;
        margin: auto;
    }
    .password-wrapper {
        position: relative;
    }
    .password-wrapper .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #888;
    }
</style>

<main class="form-signin text-center">
    <form action="<?= BASEURL; ?>/auth/login" method="post">
        <h1 class="h3 mb-3 fw-normal">Silakan Login</h1>
        <p class="mb-4">Selamat datang kembali di Perpustakaan Erkaen</p>

        <?php Flasher::flash(); ?>

        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="nama@contoh.com" required>
            <label for="email">Alamat Email</label>
        </div>

        <div class="form-floating password-wrapper">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <label for="password">Password</label>
            <i class="bi bi-eye-fill toggle-password" id="togglePassword"></i>
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Login</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2025 Perpustakaan Erkaen</p>
    </form>
</main>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        this.classList.toggle('bi-eye-slash-fill');
    });
</script>