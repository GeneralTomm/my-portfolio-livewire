@extends('partials.content')

@section('testcontent')
    <a href="{{route('sistem.create')}}" class="btn btn-success px-4 mt-5">Tambah Data</a>

    <table class="table table-bordered table-striped mt-4">
  <thead>
    <tr class="text-center items-center items-middle">
        <th rowspan="2">#</th>
        <th rowspan="2">Kode</th>
        <th rowspan="2">Nama</th>
        <th rowspan="2">Sektor</th>
        <th rowspan="2">Papan</th>
        <th colspan="2">Harga</th>
        <th rowspan="2">Edit</th>
    </tr>
    <tr class="items-end text-center">
        <th>Lembar</th>
        <th>Lot</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($sistems as $sistem)
        <tr class="text-center">
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$sistem->kode}}</td>
            <td>{{$sistem->nama}}</td>
            <td>{{$sistem->sektor}}</td>
            <td>{{$sistem->papan}}</td>
            <td>Rp. {{$sistem->lembar}}</td>
            <td>Rp. {{$sistem->lot}}</td>
            <td>
                <a href="{{route('sistem.edit', $sistem->id)}}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{route('sistem.destroy', $sistem->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
      @endforeach

  </tbody>
</table>
@endsection
