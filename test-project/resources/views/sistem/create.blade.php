@extends('partials.content')

@section('testcontent')
    <form action="{{route('sistem.store')}}" method="POST">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Kode</label>
    <input type="text" class="form-control" placeholder="Enter Kode" name="kode">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nama</label>
    <input type="text" class="form-control" placeholder="Enter nama" name="nama">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Sektor</label>
    <input type="text" class="form-control" placeholder="Enter sektor" name="sektor">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Papan</label>
    <input type="text" class="form-control" placeholder="Enter papan" name="papan">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Harga Lembar</label>
    <input type="number" class="form-control" placeholder="Enter Harga Lembar" name="lembar">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Harga Lot</label>
    <input type="number" class="form-control" placeholder="Enter Harga lot" name="lot">
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
  <a href="{{route('sistem.index')}}" class="btn btn-warning">Kembali</a>
</form>
@endsection
