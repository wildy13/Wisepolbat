let navVertical = document.getElementById('navVertical');
let toggleInput = document.getElementById('toggleInput');

toggleInput.addEventListener('click', function () {
  navVertical.classList.toggle('slide');
})

let formPengaduan = document.querySelector(".formPengaduan");
formPengaduan.addEventListener('click', (X) => {
  if (X.target.classList.contains('btnDelete')) {
    X.target.parentElement.parentElement.remove();
  }
});

formPengaduan.addEventListener('change', (X) => {
  if (X.target.classList.contains('inputLampiran')) {
    let fileName = X.target.files[0].name;
    X.target.nextElementSibling.innerHTML = fileName;
  }
});

$("#btnTambahTerlapor").click(() => {
  $("#addLaporan").before(`
    <div class="form-row">
      <div class="col-md-6 mb-3">
          <input type="text" name="nama[]" class="form-control" id="validationDefault03" placeholder="Nama Lengkap" required>
      </div>
      <div class="col-md-3 mb-3">
          <input type="text" name="jabatan[]" class="form-control" id="validationDefault05" placeholder="Jabatan" required>
      </div>
      <div class="col-md-2 mb-3">
          <select class="custom-select" id="validationDefault04" name="klasifikasi[]" required>
              <option selected disabled value="">Klasifikasi</option>
              <option value="PNS">PNS</option>
              <option value="Non PNS">Non PNS</option>
          </select>
      </div>
      <div class="col-md-1 mb-3 colDelete">
          <i class=" fas fa-trash-alt btnDelete"></i>
      </div>
    </div>
  `);
})