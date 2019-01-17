@extends('admin.layouts.index')
@section('content')
  <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sản phẩm
                  <small>danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if (session('success'))
              {{session('success')}}
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Hình Ảnh</th>
                        <th>Mô tả</th>
                        <th>Giảm giá</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                    <tr class="odd gradeX" align="center">
                      <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->image}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->discount}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                          <a href="admin/product/delete/{{$product->id}}"> Xóa</a>
                        </td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i>
                          <a href="admin/product/edit/{{$product->id}}">Sửa</a>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
@endsection
