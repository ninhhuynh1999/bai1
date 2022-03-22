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
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>STT</th>
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
            $table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('datatables.getAllShippingUnit') !!}',
                columnDefs: [
                    {
                        data: 'id',
                        render: function(data, screen, record, index) {
                            return `<div> ${index.row+1} </div>`;
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
                            return `<div> ${data} <br> ${record.contac}  </div>`
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
                            var  btnEdit = `<a href="{{ url('/admin/shipping-unit/edit') }}/${data}" class="link-control align-middle"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>`;
                            var  btnDelete = `<form action="{{ route('shippingUnit.delete') }}" method="POST">
                                                @csrf
                                                <a href="#" onclick="$(this).closest('form').submit();" class="link-control"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                <input type="hidden" name="id" value="${data}">
                                                </form>`;

                            return `<div class="text-center" >  ${btnEdit} ${btnDelete }</div>`
                        },
                        targets: 7
                    }

                ]
                // columns: [
                //     { data: 'id',  },
                //     { data: 'name',},
                //     { data: 'bankName',  },
                //     { data: 'created_at', },
                //     { data: 'updated_at',  }
                // ]
            });
        });

        // $(document).ready(function() {
        //     $(function() {


        // });
    </script>
@endsection
