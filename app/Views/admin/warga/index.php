<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Data Warga</h3>
        <p class="text-subtitle text-muted">Repository of Warga</p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Warga</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <?php if (session()->getFlashData('pesan')) : ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashData('pesan') ?></div>
  <?php endif; ?>

  <section class="section">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h4>Data Warga</h4>
        <div class="d-flex justify-content-end">
          <a href="/admin/warga/add" class="p-2">
            <button class="btn btn-primary px-3">
              Tambah Data
            </button>
          </a>
          <a href="/admin/warga/export" target="blank_" class="p-2">
            <button class="btn btn-success px-3">
              Export Excel
            </button>
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-around">
          <!-- Filters -->
          <div class="mb-3 flex-fill px-1">
            <label for="filter_rt" class="form-label">Filter by RT:</label>
            <select id="filter_rt" class="form-select filter_rt">
              <option value="">All</option>
              <?php foreach ($rts as $rt) : ?>
                <option value="<?= $rt ?>"><?= $rt ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3 flex-fill px-1">
            <label for="filter_rw" class="form-label">Filter by RW:</label>
            <select id="filter_rw" class="form-select filter_rw">
              <option value="">All</option>
              <?php foreach ($rws as $rw) : ?>
                <option value="<?= $rw ?>"><?= $rw ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <button class="btn btn-secondary px-3" id="clearFilter">
          Hapus Filter
        </button>

        <!-- Table -->
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>No.</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>No. Telp</th>
              <th>RT</th>
              <th>RW</th>
              <th>Jenis Kelamin</th>
              <th>Pengurus</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($warga as $key => $w) : ?>
              <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $w['nik'] ?></td>
                <td><?= $w['nama'] ?></td>
                <td><?= $w['alamat'] ?></td>
                <td><?= $w['no_telp'] ?></td>
                <td><?= $w['rt'] ?></td>
                <td><?= $w['rw'] ?></td>
                <td><?= $w['jenis_kelamin'] ?></td>
                <td><?= $w['pengurus_nama'] . ' - ' . $w['lingkup_rt'] ?></td>
                <td>
                  <!-- <a href="/admin/warga/update/<?= $w['id'] ?>">
                                        <button class="btn btn-sm btn-warning">
                                            Update
                                        </button>
                                    </a> -->
                  <a href="/admin/warga/delete/<?= $w['id'] ?>">
                    <button class="btn btn-sm btn-danger ml-2">
                      Delete
                    </button>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="/assets/vendors/simple-datatables/style.css">
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    // Initialize DataTable
    var table = $('#table1').DataTable({
      "pageLength": 50,
    });

    select2config('filter_rt', 'Pilih RT', '', '', (e) => table.columns(5).search(e.params.data.id).draw());
    select2config('filter_rw', 'Pilih RW', '', '', (e) => table.columns(6).search(e.params.data.id).draw());

    $('#clearFilter').click(function(e) {
      e.preventDefault();
      $(".filter_rw").val(null).trigger('change');
      $(".filter_rt").val(null).trigger('change');
      table.search('').columns().search('').draw();
    });
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