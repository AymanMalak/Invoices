@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('title')
    المنتجات
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    المنتجات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="col-sm-6 col-md-4 col-xl-3 mb-2">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#add_product">اضافة منتج</a>
                    </div>
                    <div class="col-12 ">

                        @if ($errors->any())
                            <div class="alert alert-danger mt-2">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }} <button type="button" class="close" data-dismiss="alert"
                                                aria-label="close">
                                                <span aria-hidden="true">&times;</span>
                                            </button></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session()->has('Add'))
                            <div class="alert alert-success fade show" role="alert">
                                <strong>{{ session()->get('Add') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session()->has('Edit'))
                            <div class="alert alert-success fade show" role="alert">
                                <strong>{{ session()->get('Edit') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session()->has('Delete'))
                            <div class="alert alert-success fade show" role="alert">
                                <strong>{{ session()->get('Delete') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session()->has('Error'))
                            <div class="alert alert-danger fade show" role="alert">
                                <strong>{{ session()->get('Error') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr class=" text-center">
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم المنتج</th>
                                    <th class="border-bottom-0">اسم القسم</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                    <th class="border-bottom-0">العمليات</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($products as $product)
                                    <?php $i++; ?>

                                    <tr class=" text-center">
                                        <td>{{ $i }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->section->section_name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-info  btn-sm" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit_product" title="تعديل"
                                                data-id="{{ $product->id }}" data-product_name="{{ $product->product_name }}"
                                                data-section_id="{{ $product->section->id }}"
                                                data-description="{{ $product->description }}">تعديل</a>

                                            <a class="modal-effect btn btn-danger btn-sm" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete_product" title="حذف"
                                                data-id="{{ $product->id }}"
                                                data-product_name="{{ $product->product_name }}">حذف</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
        {{-- add product --}}
        <div class="modal fade" id="add_product" role="effect-flip-horizontal" style="display: none;" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">



                    <div class="modal-header">
                        <h6 class="modal-title">اضافة منتج</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('products.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="product_name">اسم المنتج</label>
                                <input type="text" class="form-control" id="product_name" name="product_name">
                            </div>

                            <div class="form-group">
                                <label for="section_name">اسم القسم</label>
                                <select name="section_id" id="section_id" class="form-control">
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}
                                        <option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">ملاحضات</label>
                                <textarea type="text" class="form-control" id="description" name="description"></textarea>
                            </div>


                            <div class="modal-footer">
                                <button class="btn ripple btn-success" type="submit">تاكيد</button>
                                <button class="btn ripple btn-secondary" data-dismiss="modal"
                                    type="button">اغلاق</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- add product --}}

        {{-- edit product --}}
        <div class="modal fade" id="edit_product" role="effect-flip-horizontal" style="display: none;"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content modal-content-demo">


                    <div class="modal-header">
                        <h6 class="modal-title">نعديل منتج</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <form action="products/update" method="post" autocomplete="off">
                            {{ method_field('patch') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id" name="id">

                                <label for="product_name">اسم المنتج</label>
                                <input type="text" class="form-control" id="product_name" name="product_name">
                            </div>


                            <div class="form-group">
                                <label for="section_id">اسم القسم</label>
                                <select name="section_id" id="section_id" class="form-control">
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}<option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="description">ملاحضات</label>
                                <textarea type="text" class="form-control" id="description" name="description"></textarea>
                            </div>


                            <div class="modal-footer">
                                <button class="btn ripple btn-success" type="submit">تعديل</button>
                                <button class="btn ripple btn-secondary" data-dismiss="modal"
                                    type="button">اغلاق</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- edit product --}}


        {{-- delete product --}}
        <div class="modal fade" id="delete_product" role="effect-flip-horizontal" style="display: none;"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content modal-content-demo">


                    <div class="modal-header">
                        <h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <form action="products/destroy" method="post" autocomplete="off">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <p class="font-weight-bold mb-2">هل انت متاكد من عملية الحذف؟</p>
                                <label for="product_name">اسم المنتج</label>
                                <input type="text" class="form-control " disabled id="product_name"
                                    name="product_name">
                            </div>
                            <div class="modal-footer">
                                <button class="btn ripple btn-danger" type="submit">حذف</button>
                                <button class="btn ripple btn-secondary" data-dismiss="modal"
                                    type="button">اغلاق</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- delete product --}}

        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>


    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>





    <script>
        $('#edit_product').on('shown.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = $($(button)).attr('data-id');
            var product_name = $($(button)).attr('data-product_name');
            var section_id = $($(button)).attr('data-section_id');
            var description = $($(button)).attr('data-description');
            var modal = $(this);
            console.log(description);
            modal.find(".modal-body #id").val(id);
            modal.find(".modal-body #product_name").val(product_name);
            modal.find(".modal-body #section_id").val(section_id);
            modal.find(".modal-body #description").val(description);
        })
    </script>

    <script>
        $('#delete_product').on('shown.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = $($(button)).attr('data-id');
            var product_name = $($(button)).attr('data-product_name');
            var modal = $(this);

            modal.find(".modal-body #id").val(id);
            modal.find(".modal-body #product_name").val(product_name);
        })
    </script>
@endsection
