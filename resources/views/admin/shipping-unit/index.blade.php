@extends('layouts.admin');

@section('title', 'Danh mục ĐVVC')

@section('content-header')
    <h1>
        Danh mục ĐVVC
        {{-- <small>TẠO MỚI</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ĐVVC</li>
    </ol>
    </section>

@endsection

@section('content')

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="">Lọc</label>
                <select  name="filter_date" class="form-control select2" style="width: 100%;">
                    <option value="1" selected class="selected">Ngày tạo</option>
                    <option value="2"  class="">Ngày sửa</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Từ ngày</label>
                <input name="filter_date_from" class="form-control" type="datetime-local" name="" id="">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Đến ngày</label>
                <input name="filter_date_end" class="form-control" type="datetime-local" name="" id="">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for=""> Chức năng</label> <br>
                <div class="btn-filter">
                    <button class="btn btn-success form-control" id="btn-add">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Thêm
                    </button>
                    <button class="btn btn-info form-control" id="btn-search">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        Tìm kiếm
                    </button>
                    <button class="btn btn-primary form-control" id="btn-all">
                        Tất cả
                    </button>
                </div>

            </div>

        </div>
    </div>
    <form id="filter-form" onsubmit="this.preventDefault()" >
         <div class="search-field">
        {{-- <div class="row" style="">
            <div class="col-sm-3">

                <label for=""> <span>Danh mục 1</span></label>

                <div class="form-group select-filter-shipping">
                    <select class="form-control select2" style="width: 100%;">
                        <option value="" selected class="selected">Tên ĐVVC</option>
                        <option value="">Tên viết tắt</option>
                        <option value="">Địa chỉ</option>
                        <option value="">Số điện thoại</option>
                        <option value="">Ghi chú</option>
                        <option disabled="disabled">California (disabled)</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <label for=""><span>Tìm kiếm</span></label>

                <div class="form-group input-filter-shipping">
                    <input type="text" class="form-control" placeholder="Nhập nội dung tìm kiếm">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <button class="form-control btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>

            </div>
        </div> --}}

    </div>
    </form>
   





    <div class="row text-center text-danger">
        <span>
            <h4>
                @if (session()->has('fail'))
                    {{ session()->get('fail') }}
                @endif
            </h4>
        </span>
        <span>
            <h4>
                @if (session()->has('success'))
                    {{ session()->get('success') }}
                @endif
            </h4>
        </span>
    </div>
    <table class="table table-bordered" id="shipping-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>
                    Tên đầy đủ
                    <br> Tên tài khoản ngân hàng
                </th>
                <th>
                    Tên viết tắt <br>
                    Số TK NH <br>
                    Tk Đăng nhập
                </th>
                <th>
                    Mã số thuế <br>
                    Số điện thoại
                </th>
                <th> Ghi chú</th>
                <th>
                    Địa chỉ <br>
                    Thông tin <br>
                </th>
                <th>
                    Trạng thái <br>
                    Người tạo <br>
                    Ngày tạo
                </th>
                <th>
                    Chức năng
                </th>
            </tr>
        </thead>
    </table>



@stop

@section('js')
    <script>
        window.addEventListener('load', function() {
            var index = 1;
            $table = $('#shipping-table').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [20, 40, 60, 80, 100],
                ajax: '{!! route('datatables.getAllShippingUnit') !!}',
                columnDefs: [{
                        data: 'id',
                        render: function(data, screen, record, index) {
                            return `<div> ${data}</div>`;
                        },
                        targets: 0
                    },
                    {
                        data: 'name',
                        render: function(data, screen, record, index) {
                            return `<div> ${data} <br> ${record.bankName  } </div>`;
                        },
                        targets: 1
                    },
                    {
                        data: 'shortName',
                        render: function(data, screen, record, index) {
                            return `<div> ${data} <br> ${record.bankNumber} </div>`;
                        },
                        targets: 2
                    },
                    {
                        data: 'taxId',
                        render: function(data, screen, record, index) {
                            return `<div> ${data} <br> ${record.phoneNumber} </div>`;
                        },
                        targets: 3
                    },

                    {
                        data: 'note',
                        render: function(data, screen, record, index) {
                            return `<div> ${data} </div>`;
                        },
                        targets: 4
                    },
                    {
                        data: 'address',
                        render: function(data, screen, record, index) {
                            return `<div> ${data} <br> ${record.contact}  </div>`
                        },
                        targets: 5
                    },
                    {
                        data: 'created_by',
                        render: function(data, screen, record, index) {
                            return `<div> ${record.updated_by.name} <br> ${record.status.name} <br> ${record.created_by.name} </div>`
                        },
                        targets: 6
                    },
                    {
                        class: 'align-middle',
                        data: 'id',
                        render: function(data, screen, record, index) {
                            var btnEdit =
                                `<a href="{{ url('/admin/shipping-unit/edit') }}/${data}" class="link-control align-middle"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>`;
                            var btnDelete = `<form action="{{ route('shippingUnit.delete') }}" method="POST">
                                                @csrf
                                                <a href="#" onclick="$(this).closest('form').submit();" class="link-control"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                <input type="hidden" name="id" value="${data}">
                                                </form>`;

                            return `<div class="text-center" >  ${btnEdit} ${btnDelete }</div>`
                        },
                        targets: 7
                    }

                ],
                
            });
        });
    </script>
    <script src="{{ asset('js/shipping-unit/index.js') }}">

    </script>
@endsection
