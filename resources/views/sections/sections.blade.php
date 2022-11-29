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
    الاقسام
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الاقسام</span>
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
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#modaldemo1">اضافة قسم</a>
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
                                    <th class="border-bottom-0">اسم القسم</th>
                                    <th class="border-bottom-0">الوصف</th>
                                    <th class="border-bottom-0">العمليات</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($sections as $sec)
                                    <?php $i++; ?>

                                    <tr class=" text-center">
                                        <td>{{ $i }}</td>
                                        <td>{{ $sec->section_name }}</td>
                                        <td>{{ $sec->description }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-info  btn-sm" data-effect="effect-scale"
                                                data-toggle="modal" href="#modaldemo2" title="تعديل"><i class="las la-pen"
                                                    data-id="{{ $sec->id }}"
                                                    data-section_name="{{ $sec->section_name }}"
                                                    data-description="{{ $sec->description }}"></i></a>

                                            <a class="modal-effect btn btn-danger btn-sm" data-effect="effect-scale"
                                                data-toggle="modal" href="#modaldemo3" title="حذف"><i
                                                    class="las la-trash" data-id="{{ $sec->id }}"
                                                    data-section_name="{{ $sec->section_name }}"></i></a>

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
    {{-- add section --}}
    <div class="modal fade" id="modaldemo1" role="effect-flip-horizontal" style="display: none;" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">



                <div class="modal-header">
                    <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('sections.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="section_name">اسم القسم</label>
                            <input type="text" class="form-control" id="section_name" name="section_name">
                        </div>

                        <div class="form-group">
                            <label for="description">ملاحضات</label>
                            <textarea type="text" class="form-control" id="description" name="description"></textarea>
                        </div>


                        <div class="modal-footer">
                            <button class="btn ripple btn-success" type="submit">تاكيد</button>
                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- edit section --}}

    {{-- edit section --}}
    <div class="modal fade" id="modaldemo2" role="effect-flip-horizontal" style="display: none;" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content modal-content-demo">


                <div class="modal-header">
                    <h6 class="modal-title">نعديل قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    <form action="sections/store" method="post" autocomplete="off">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id">

                            <label for="section_name">اسم القسم</label>
                            <input type="text" class="form-control" id="section_name" name="section_name">
                        </div>

                        <div class="form-group">
                            <label for="description">ملاحضات</label>
                            <textarea type="text" class="form-control" id="description" name="description"></textarea>
                        </div>


                        <div class="modal-footer">
                            <button class="btn ripple btn-success" type="submit">تعديل</button>
                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- edit section --}}


    {{-- delete section --}}
    <div class="modal fade" id="modaldemo3" role="effect-flip-horizontal" style="display: none;" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content modal-content-demo">


                <div class="modal-header">
                    <h6 class="modal-title">حذف قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    <form action="sections/destroy" method="post" autocomplete="off">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id">

                            <label for="section_name">اسم القسم</label>
                            <input type="text" class="form-control " disabled id="section_name" name="section_name">
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-danger" type="submit">حذف</button>
                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- delete section --}}

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
        $('#modaldemo2').on('shown.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = $($(button).children()[0]).attr('data-id');
            var section_name = $($(button).children()[0]).attr('data-section_name');
            var description = $($(button).children()[0]).attr('data-description');
            var modal = $(this);

            modal.find(".modal-body #id").val(id);
            modal.find(".modal-body #section_name").val(section_name);
            modal.find(".modal-body #description").val(description);
        })
    </script>

    <script>
        $('#modaldemo3').on('shown.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = $($(button).children()[0]).attr('data-id');
            var section_name = $($(button).children()[0]).attr('data-section_name');
            var modal = $(this);

            modal.find(".modal-body #id").val(id);
            modal.find(".modal-body #section_name").val(section_name);
        })
    </script>
@endsection
