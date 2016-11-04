<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Nama</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="Nama Kamu" placeholder="Masukkan Nama Kamu">
  </div>
  <div class="form-group">
    <label for="lgFormGroupInput" class="col-sm-12 form-label" style="padding-left: 0">Jenis Kelamin</label>
    <div class="form-check">
      <label class="form-check-inline">
        <input class="form-check-input" type="radio" id="inlineCheckbox1" value="male"> Laki-laki
      </label>
      <label class="form-check-inline">
        <input class="form-check-input" type="radio" id="inlineCheckbox2" value="female"> Perempuan
      </label>    
    </div>
  </div>
  <div class="form-group">
    <label for="example-date-input">Tanggal Lahir</label>
    <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
  </div>
  <div class="form-group">
    <label for="exampleTextarea">Alamat</label>
    <textarea class="form-control" id="exampleTextarea" rows="2"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleSelect1">Provinsi</label>
    <select class="form-control form-control-lg" id="exampleSelect1">
      <option>Banten</option>
      <option>DKI Jakarta</option>
      <option>Jawa Barat</option>
    </select>
  </div><div class="form-group">
    <label for="exampleSelect1">Kabupaten/Kota</label>
    <select class="form-control form-control-lg" id="exampleSelect1">
      <option>Tangerang</option>
      <option>Tangerang Selatan</option>
      <option>Jakarta</option>
      <option>Bandung</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleSelect2">Minat</label>
    <select multiple class="form-control" id="exampleSelect2">
      <option>Teknologi</option>
      <option>Olahraga</option>
      <option>Musik</option>
      <option>Seni</option>
      <option>Bela diri</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Konfirmasi Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Konfirmasi Password">
  </div>
  <button type="reset" class="btn btn-danger">Reset</button>
  <button type="submit" class="btn btn-primary pull-right">Simpan</button>
</form>