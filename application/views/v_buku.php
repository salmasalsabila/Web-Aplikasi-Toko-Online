<h2>Skincare Ready</h2>
<?= $this->session->flashdata('pesan'); ?>
<center>
  <a href="#tambah" data-toggle="modal" class="btn btn-warning">+Tambah</a>
</center>
<table id="example" class="table table-hover table-striped">
  <thead>
    <tr>
      <td>No</td>
      <td>Gambar Produk</td>
      <td>Merk</td>
      <td>Kategori</td>
      <td>Harga</td>
      <td>Stock</td>
      <td>Deskripsi</td>
      <td>Aksi</td>
    </tr>
  </thead>
  <tbody>
    <?php $no=0; foreach($tampil_skincare as $skincare):
    $no++; ?>
    <tr>
      <td><?= $no ?></td>
      <td><img src="<?=base_url('assets/img/'.$skincare->gambar_produk )?>" style="width: 40px"></td>
      <td><?= $skincare->merk_skincare ?></td>
      <td><?= $skincare->nama_kategori ?></td>
      <td><?= $skincare->harga ?></td>
      <td><?= $skincare->stok ?></td>
      <td><?= $skincare->deskripsi ?></td>
      <td><a href="#edit" onclick="edit('<?= $skincare->id_skincare ?>')" data-toggle="modal" class="btn btn-success">Ubah</a>
        <a href="<?=base_url('index.php/buku/hapus/'.$skincare->id_skincare)?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Hapus</a></td>
    </tr>
  <?php endforeach ?>
  </tbody>
</table>

<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-titile">Tambah Skincare</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/buku/tambah')?>" method="post" enctype="multipart/form-data">
          <table>
            <tr>
              <td><input type="hidden" name="id_skincare" class="form-control"></td>
            </tr>
            <tr>
              <td>Merk</td>
              <td><input type="text" name="merk_skincare" required class="form-control"></td>
            </tr>
            <tr>
              <td>Kategori</td>
              <td><select name="id_kategori" class="form-control">
                <option></option>
                <?php foreach($kategori as $kat): ?>
                <option value="<?=$kat->id_kategori?>"><?=$kat->nama_kategori?></option>
                <?php endforeach ?>
              </select></td>
            </tr>
            <tr>
              <td>Harga</td>
              <td><input type="number" name="harga" required class="form-control"></td>
            </tr>
            <tr>
              <td>Stok</td>
              <td><input type="number" name="stok" required class="form-control"></td>
            </tr>
            <tr>
              <td>Deskripsi</td>
              <td><input type="text" name="deskripsi" required class="form-control"></td>
            </tr>
              <td>Gambar Produk</td>
              <td><input type="file" name="gambar_produk" class="form-control"></td>
            </tr>
          </table>
          <input type="submit" name="create" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-titile">Edit Skincare</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/buku/skincare_update')?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_skincare_lama" id="id_skincare_lama">
          <table>
            <tr>
              <td><input type="hidden" name="id_skincare" id="id_skincare" class="form-control"></td>
            </tr>
            <tr>
              <td>Merk</td>
              <td><input type="text" name="merk_skincare" id="merk_skincare" required class="form-control"></td>
            </tr>
            <tr>
              <td>Kategori</td>
              <td><select name="id_kategori" class="form-control" id="id_kategori">
                <option></option>
                <?php foreach($kategori as $kat): ?>
                <option value="<?=$kat->id_kategori?>"><?=$kat->nama_kategori?></option>
                <?php endforeach ?>
              </select></td>
            </tr>
            <tr>
              <td>Harga</td>
              <td><input type="number" name="harga" required id="harga" class="form-control"></td>
            </tr>
            <tr>
              <td>Stok</td>
              <td><input type="number" name="stok" required id="stok" class="form-control"></td>
            </tr>
            <tr>
              <td>Deskripsi</td>
              <td><input type="text" name="deskripsi" required id="deskripsi" class="form-control"></td>
            </tr>
            <tr>
              <td>Gambar Produk</td>
              <td><input type="file" name="gambar_produk" id="gambar_produk" class="form-control"></td>
            </tr>
          </table>
          <input type="submit" name="edit" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function edit(a){
    $.ajax({
      type:"post",
      url:"<?=base_url()?>index.php/buku/edit_skincare/"+a,
      dataType:"json",
      success:function(data){
        $("#id_skincare").val(data.id_skincare);
        $("#merk").val(data.merk);
        $("#id_kategori").val(data.id_kategori);
        $("#harga").val(data.harga);
        $("#stok").val(data.stok);
        $("#deskripsi").val(data.deskripsi);
        $("#id_skincare_lama").val(data.id_skincare);
      }
    })
  }
</script>