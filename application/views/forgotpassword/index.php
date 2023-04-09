<body>
    <center>
        <?= $this->session->flashdata('message'); ?>
        <?= validation_errors(); ?>
        <h1>Forgot Password With Email</h1>
        <form method="post" action="<?= base_url() . 'forgotpassword'; ?>" enctype="multipart/form-data">
            <div>
                <label for="email">Email</label>
                <br>
                <input type="email" id="email" name="email" placeholder="Insert Your Email...">
            </div>
            <br>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
        <br>
        <a href="<?= base_url() . 'forgotpassword/phone'; ?>">Forgot Password With Phone Number</a>
        <br>
        <br>
        <br>
        <a href="<?= base_url() . 'auth'; ?>">Kembali</a>
    </center>
</body>