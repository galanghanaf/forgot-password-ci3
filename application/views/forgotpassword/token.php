<body>
    <center>
        <?= $this->session->flashdata('message'); ?>
        <?= validation_errors(); ?>
        <h1>Masukan Token</h1>
        <br>
        <form action="<?= base_url() . 'forgotpassword/token'; ?>" method="post" enctype="multipart/form-data">
            <div>
                <label for="token">Token</label>
                <br>
                <input type="text" id="token" name="token" placeholder="Masukan Token...">
            </div>
            <br>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
        <br>
        <a href="<?= base_url() . 'auth'; ?>">Kembali</a>
    </center>
</body>