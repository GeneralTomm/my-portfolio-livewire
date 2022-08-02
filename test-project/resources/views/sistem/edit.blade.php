@extends('partials.content')

@section('testcontent')
    <form action="{{route('sistem.update', $sistem->id)}}" method="POST">
    @csrf
    @method('patch')
  <div class="form-group">
    <label for="exampleInputEmail1">Kode</label>
    <input type="text" class="form-control" placeholder="Enter Kode" name="kode" value="{{$sistem->kode}}">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nama</label>
    <input type="text" class="form-control" placeholder="Enter nama" name="nama" value="{{$sistem->nama}}">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Sektor</label>
    <input type="text" class="form-control" placeholder="Enter sektor" name="sektor" value="{{$sistem->sektor}}">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Papan</label>
    <input type="text" class="form-control" placeholder="Enter papan" name="papan" value="{{$sistem->papan}}">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Harga Lembar</label>
    <input type="number" class="form-control" placeholder="Enter Harga Lembar" name="lembar" value="{{$sistem->lembar}}">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Harga Lot</label>
    <input type="number" class="form-control" placeholder="Enter Harga lot" name="lot" value="{{$sistem->lot}}">
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
  <a href="{{route('sistem.index')}}" class="btn btn-warning">Kembali</a>
</form>
@endsection
