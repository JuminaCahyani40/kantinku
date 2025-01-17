@extends('layouts.main')
@section('title','Dashboard')

@section('body')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4>Selamat Datang, {{ Auth::user()->name }}</h4>
      </div>
      <div class="card-body">
        <h4>Anda Login Sebagai {{ Auth::user()->role }}</h4>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4>
        <a href="{{route('Transaksi.create')}}">Transaksi Table</a>
        </h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-md">
            <tbody>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              @foreach ($Transaksi as $tsk)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$tsk->nama}}</td>
                <td>{{$tsk->produks}}</td>
                <td>{{$tsk->jumlah}}</td>
                <td>{{$tsk->status}}</td>
                {{-- <td>
                  <div class="badge badge-success">Active</div>
                </td> --}}
                <td>
                  <form method="post" action="{{route('Transaksi.destroy',$tsk->id)}}">
                    @csrf
                    @method('DELETE') 
                    {{-- <a href="{{route('produk.edit',$tsk->id)}}" class="btn btn-icon icon-left btn-warning"><i class="fas fa-exclamation-triangle"></i> Edit</a> --}}
                  <button type="submit" class="btn btn-icon icon-left btn-danger"><i class="fas fa-times"></i> Delete</a> </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer text-center">
        {{-- {{ ($Transaksi->links()) }} --}}
    </div>
    </div>
  </div>
</div>

@endsection