<body>
    <center>
        <?= $this->session->flashdata('message'); ?>
        <?= validation_errors(); ?>
        <br>
        <h2>Login</h2>
        <form action="<?= base_url() . 'auth'; ?>" method="post" enctype="multipart/form-data">
            <div>
                <label for="email">Email</label>
                <br>
                <input type="email" name="email" id="email" placeholder="Masukan Email..." required>
            </div>
            <br>
            <div>
                <label for="password">Password</label>
                <br>
                <input type="password" name="password" id="password" placeholder="Masukan Password..." required>
            </div>
            <br>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>

        <br>
        <a href="<?= base_url() . 'forgotpassword'; ?>">Forgot Password</a>
    </center>
</body>