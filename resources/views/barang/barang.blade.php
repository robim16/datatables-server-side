@extends('template.main')
@section('title', 'Barang')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="text-right">
                                    <a href="/barang/create" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add
                                        Asset</a>
                                    <a href="{{ route('assets.csv')}}" class="btn btn-success"><i class="fa-solid fa-plus"></i> Export
                                        Assets</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="assets-table"
                                    class="table table-striped table-bordered table-hover text-center barang-table"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="">#</th>
                                            <th class="head">Name</th>
                                            <th class="head">Category</th>
                                            <th class="head">Supplier</th>
                                            <th class="head">Stock</th>
                                            <th class="head">Price</th>
                                            {{-- <th class="head">Appraisal value</th> --}}
                                            <th class="">Action</th>
                                        </tr>
                                        <tr>
                                            <th class=""></th>
                                            <th class="head">Name</th>
                                            <th class="head">Category</th>
                                            <th class="head">Supplier</th>
                                            <th class="head">Stock</th>
                                            <th class="head">Price</th>
                                            {{-- <th class="head">Appraisal value</th> --}}
                                            <th class=""></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            
            var table = $('#assets-table').DataTable({
                processing: true,
                responsive: false,
                serverSide: true,
                columnDefs: [
                    {
                        "className": "dt-center",
                        "targets": "_all"
                    },
                    // {
                    //     "targets": [6],
                    //     "render": function ( data, type, row ) {
                    //         if (row.appraisals.length > 0) {
                    //             return row.appraisals[0]?.value
                    //         }
                    //         else{
                    //             return 0
                    //         }
                            
                    //     }
                    // },
    
                ],
                ajax: "{{ route('barang.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'supplier',
                        name: 'supplier'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    // {
                    //     data: 'appraisals.value',
                    //     name: 'value',
                    // },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                initComplete: function () {

                    table.columns('.head').every( function () {
                        var column = this;
                        var select = $('<select class=""><option value=""></option></select>')
                            .appendTo( $("#assets-table thead tr:eq(1) th").eq(column.index()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                
                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );

                            table.cells( null, this).render('display').unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' );
                            });
                    });
                }
            });
    
            // table.on('xhr.dt', function ( e, settings, json, xhr ) {
    
            //     var json_data = table.ajax.json();
    
            //     table.rows.add(json_data.data).draw();
    
    
            //     table.columns('.head').every( function () {
            //         var column = this;
            //         var select = $('<select class=""><option value=""></option></select>')
            //             .appendTo( $("#assets-table thead tr:eq(1) th").eq(column.index()).empty() )
            //             .on( 'change', function () {
            //                 var val = $.fn.dataTable.util.escapeRegex(
            //                     $(this).val()
            //                 );
    
                            
            //                 column
            //                     .search( val ? '^'+val+'$' : '', true, false )
            //                     .draw();
            //             } );
    
    
            //         table.cells( null, this).render('display').unique().sort().each( function ( d, j ) {
            //             select.append( '<option value="'+d+'">'+d+'</option>' );
            //         });
                    
            //     })
    
            // })
        });

    </script>

@endsection
