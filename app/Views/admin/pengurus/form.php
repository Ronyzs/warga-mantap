<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3><?= $title ?></h3>
        <p class="text-subtitle text-muted">Halaman Untuk Melakukan <?= $title ?></p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <section id="input-validation">
    <div class="row">
      <div class="col-12">
        <form class="card" action="<?= $isNew ? '/admin/pengurus/post' : "/admin/pengurus/put/$id" ?>" method="post">
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

              <!-- nama -->
              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="nama" class="col-form-label">Nama</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <input name="nama" type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama" value="<?= old('nama', $pengurus['nama'] ?? '') ?>">
                    <?php if ($validation->hasError('nama')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('nama') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <!-- nomor_induk -->
              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="nomor_induk" class="col-form-label">NIK</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <input name="nomor_induk" type="text" class="form-control <?= ($validation->hasError('nomor_induk')) ? 'is-invalid' : '' ?>" id="nomor_induk" value="<?= old('nomor_induk', $pengurus['nik'] ?? '') ?>">
                    <?php if ($validation->hasError('nomor_induk')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('nomor_induk') ?>
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
                    <input name="rt" type="number" class="form-control <?= $validation->hasError('rt') ? 'is-invalid' : '' ?>" id="rt" value="<?= old('rt', $pengurus['rt'] ?? '') ?>">
                    <?php if ($validation->hasError('rt')) : ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('rt') ?>
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