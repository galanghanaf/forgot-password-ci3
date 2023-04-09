<body>
    <center>
        <?= $this->session->flashdata('message'); ?>
        <?= validation_errors(); ?>
        <h1>Forgot Password With Phone Number</h1>
        <form method="post" action="<?= base_url() . 'forgotpassword/phone'; ?>" enctype="multipart/form-data">
            <div>
                <label for="phone">Phone Number</label>
                <br>
                <input type="number" id="phone" name="phone" placeholder="Insert Your Phone Number...">
            </div>
            <br>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
        <br>
        <a href="<?= base_url() . 'forgotpassword'; ?>">Kembali</a>
    </center>
</body>