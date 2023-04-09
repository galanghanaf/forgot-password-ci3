<body>
    <center>
        <?= $this->session->flashdata('message'); ?>
        <?= validation_errors(); ?>
        <h1>Create Password</h1>
        <br>
        <form action="<?= base_url() . 'forgotpassword/resetpasswordaksi'; ?>" method="post" enctype="multipart/form-data">
            <?php foreach ($queryDataUser as $row) : ?>
                <input type="hidden" name="email" value="<?= $row->email; ?>">
                <input type="hidden" name="token" value="<?= $row->token; ?>">
                <div>
                    <label for="token">Create Password</label>
                    <br>
                    <input type="password" id="password" name="password" placeholder="Masukan Password...">
                </div>
                <div>
                    <label for="token">Verify Password</label>
                    <br>
                    <input type="password" id="verify_password" name="verify_password" placeholder="Verifikasi Password...">
                </div>
                <br>
            <?php endforeach; ?>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
    </center>
</body>