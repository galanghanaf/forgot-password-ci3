<body>
    <center>
        <?= $this->session->flashdata('message'); ?>
        <?= validation_errors(); ?>
        <br>
        <h2>Table User</h2>
        <p>Selamat Datang <span style="color:green;"><?= $login['nama'] ?></span></p>
        <table border='1'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($getDataUser as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->nama; ?></td>
                        <td><?= $row->email; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <a href="<?= base_url() . 'auth/logout'; ?>">Logout</a>
    </center>

</body>