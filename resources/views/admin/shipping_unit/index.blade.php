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
                <select name="filter_date_option" class="form-control select2" style="width: 100%;">
                    <option value="created_at" selected class="selected">Ngày tạo</option>
                    <option value="updated_at" class="">Ngày sửa</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="">Từ ngày</label>
                <input name="filter_from_date" id="filter-from-date" class="form-control" type="date"
                    id="input-from-date">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="">Đến ngày</label>
                <input name="filter_to_date" id="input-to-date" class="form-control" type="date">
            </div>
        </div>
        <div class="col-md-2" style="padding-top: 2.5rem">
            <button style="max-width: 90px;" class="btn btn-info form-control" id="btn-clear-date">
                <i class="fa fa-refresh" aria-hidden="true"></i>
                Xóa ngày
            </button>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="" for=""> Chức năng</label>
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
    <form id="filter-form" onsubmit="this.preventDefault()">
        <div class="search-field">

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
                    Tên viết tắt/ <br>
                    Số TK NH/ <br>
                    Tk Đăng nhập
                </th>
                <th>
                    Số điện thoại <br>
                    Mã số thuế
                </th>
                <th> Ghi chú</th>
                <th>
                    Địa chỉ /<br>
                    Thông tin <br>
                </th>
                <th>
                    Trạng thái/ <br>
                    Người tạo /<br>
                    Người sửa
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
        // add event onLoad to windows 
        $(document).ready(function() {

            $table = load_data();
        });
        //end window eventListener


        function load_data(from_date = '',to_date='',optionDate='') {

            $table = $('#shipping-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                lengthMenu: [20, 40, 60, 80, 100],
                ajax: {
                    url: "{{ route("shippingUnit.getall") }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        optionDate: optionDate
                    },
                    method:'get'
                },
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
                            return `<div> <b>${record.status.name}</b> <br>${record.created_by.name}: ${record.created_at} <br> ${record.updated_by.name} : ${record.updated_at} </div>`
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

                ], //end columnDefs
                language: {
                    "lengthMenu": "Hiển thị _MENU_ hàng trong trang",
                    "zeroRecords": "Không tìm thấy dữ liệu",
                    "info": "Hiển thị trang thứ _PAGE_ trong _PAGES_ trang",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "paginate": {
                        "next": "Trang sau",
                        'previous': 'Trang trước'
                    }
                },
                // "bFilter": false,
            });
            //end $table
            return $table;
        }


        //end load_data
    </script>

    {{-- import js --}}
    <script src="{{ asset('js/shipping-unit/index.js') }}"></script>
@endsection
