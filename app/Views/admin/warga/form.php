<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Data Warga</h3>
        <p class="text-subtitle text-muted">Halaman untuk menambah data warga</p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah data warga</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <section id="input-validation">
    <div class="row">
      <div class="col-12">
        <form class="card" action="/admin/warga/post" method="post">
          <div class="card-body">
            <div class="row">

              <!-- Nama -->
              <!-- DONT TOUCH -->
              <div class="col-12 d-none">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="nama123" class="col-form-label">Nama</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <input name="nama123" type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama123" value="<?= old('nama') ?>">
                    <?php if ($validation->hasError('nama')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('nama') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <!-- DONT TOUCH -->

              <!-- Timses -->
              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="timses" class="col-form-label">Pengurus</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <?= form_dropdown(
                      'timses',
                      $pengurus,
                      '',
                      ['class' => 'form-control select2 select2-timses' . ($validation->hasError('timses') ? 'is-invalid' : ''), 'id' => 'select2-form-timses']
                    ); ?>
                    <?php if ($validation->hasError('timses')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('timses') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <!-- Nama -->
              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="nama" class="col-form-label">Nama</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <input name="nama" type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama" value="<?= old('nama') ?>">
                    <?php if ($validation->hasError('nama')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('nama') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <!-- NIK -->
              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="nomor_induk" class="col-form-label">NIK</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <input name="nomor_induk" type="text" class="form-control <?= $validation->hasError('nomor_induk') ? 'is-invalid' : '' ?>" id="nomor_induk" value="<?= old('nomor_induk') ?>">
                    <?php if ($validation->hasError('nomor_induk')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('nomor_induk') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <!-- Alamat -->
              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="alamat" class="col-form-label">Alamat</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <input name="alamat" type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" id="alamat" value="<?= old('alamat') ?>">
                    <?php if ($validation->hasError('alamat')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('alamat') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <!-- No. Telp -->
              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="no_telp" class="col-form-label">No. Telp</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <input name="no_telp" type="text" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : '' ?>" id="no_telp" value="<?= old('no_telp') ?>">
                    <?php if ($validation->hasError('no_telp')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('no_telp') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <!-- RT -->
              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="rt" class="col-form-label">RT</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <input name="rt" type="text" class="form-control <?= ($validation->hasError('rt')) ? 'is-invalid' : '' ?>" id="rt" value="<?= old('rt') ?>" readonly>
                    <?php if ($validation->hasError('rt')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('rt') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <!-- RW -->
              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="rw" class="col-form-label">RW</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <input name="rw" type="text" class="form-control <?= ($validation->hasError('rw')) ? 'is-invalid' : '' ?>" id="rw" value="<?= old('rw') ?>">
                    <?php if ($validation->hasError('rw')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('rw') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <!-- Jenis Kelamin -->
              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <select name="jenis_kelamin" class="form-select <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : '' ?>" id="jenis_kelamin">
                      <option value="">Pilih Jenis Kelamin</option>
                      <option value="Pria" <?= (old('jenis_kelamin') == 'Pria') ? 'selected' : '' ?>>Pria</option>
                      <option value="Wanita" <?= (old('jenis_kelamin') == 'Wanita') ? 'selected' : '' ?>>Wanita</option>
                    </select>
                    <?php if ($validation->hasError('jenis_kelamin')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('jenis_kelamin') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <!-- Submit Button -->
              <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4">
                  Simpan
                </button>
              </div>

            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- validations end -->

</div>
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    // Initialize Select2 with the old selected value
    select2config('select2-timses', 'Pengurus', '', '<?= old('timses') ?>', (e) => {
      blockUI(true);

      $.ajax({
        type: "GET",
        url: `get-pengurus/${e.params.data.id}`,
        success: function(res) {
          $('#rt').val(res.rt).trigger('change');
        },
      }).fail(function(xhr) {}).always(function() {
        blockUI(false);
      });;
    });

    // Ensure Select2 shows the old selected value after validation
    $('.select2-timses').val('<?= old('timses') ?>').trigger('change');
  });

  function select2config(
    selector,
    placeholder = "",
    data = "",
    selected = "",
    onCl = function(e) {
      app.form.model[selector] = e.params.data.id;
    }
  ) {
    if ($(`.${selector}`).data("select2")) {
      $(`.${selector}`).select2("destroy");
    }

    if (data) {
      $(`.${selector}`).html(data);
    }

    $(`.${selector}`)
      .select2({
        placeholder: placeholder ? `Pilih ${placeholder}` : `Pilih Data`,
        width: "100%",
      })
      .on("select2:select", onCl);

    if (selected != "") {
      $(`.${selector}`).val(selected).trigger("change");
    }
  }
</script>
<?= $this->endSection() ?>