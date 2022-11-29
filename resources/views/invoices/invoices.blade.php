@extends('layouts.master')


@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection

@section('title')
    قائمة الفواتير
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الفواتير</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')

    @if (session()->has('delete_invoice'))
        <script>
            window.onload = function() {
                notif({

                    msg: 'Invoice Deleted Successfully',
                    type: 'error'
                })
            }
        </script>
    @endif


    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="col-sm-6 col-md-4 col-xl-3 mb-2">
                        <a class=" btn btn-outline-primary " href="{{ route('invoices.create') }}">اضافة فاتورة</a>
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
                                <tr class=" text-right">
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                    <th class="border-bottom-0">تاريخ الفاتورة</th>
                                    <th class="border-bottom-0">تاريخ الاتسحقاق</th>
                                    <th class="border-bottom-0">المنتج</th>
                                    <th class="border-bottom-0">القسم</th>
                                    <th class="border-bottom-0">الخصم</th>
                                    <th class="border-bottom-0">نسبة الضريبة</th>
                                    <th class="border-bottom-0">قيمة الضريبة</th>
                                    <th class="border-bottom-0">الاجمالي</th>
                                    <th class="border-bottom-0">الحالة</th>
                                    <th class="border-bottom-0">ملاحطات</th>
                                    <th class="border-bottom-0">عمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($invoices as $invoice)
                                    <tr class=" text-center">
                                        <?php $i++; ?>
                                        <td>{{ $i }}</td>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->invoice_date }}</td>
                                        <td>{{ $invoice->due_date }}</td>
                                        <td>{{ $invoice->product }}</td>
                                        <td>
                                            <a href="{{ url('invoicesDetails') }}/{{ $invoice->id }}">{{ $invoice->section->section_name }}
                                            </a>
                                        </td>
                                        <td>{{ $invoice->discount }}</td>
                                        <td>{{ $invoice->rate_vat }}</td>
                                        <td>{{ $invoice->value_vat }}</td>
                                        <td>{{ $invoice->total }}</td>
                                        <td>

                                            @if ($invoice->value_status == 1)
                                                <span class="text-white px-1 bg-success">{{ $invoice->status }}</span>
                                            @elseif ($invoice->value_status == 2)
                                                <span class="text-white px-1 bg-warning">{{ $invoice->status }}</span>
                                            @else
                                                <span class="text-white px-1 bg-danger">{{ $invoice->status }}</span>
                                            @endif

                                        </td>
                                        <td>{{ $invoice->note }}</td>
                                        <td>



                                            <div class="dropdown dropbottom">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary" data-toggle="dropdown"
                                                    type="button">العمليات&nbsp;&nbsp;<i class="fas fa-caret-down ml-1"></i> </button>
                                                <div class="dropdown-menu tx-13">

                                                    <a class=" dropdown-item" data-effect="effect-scale" role="button"
                                                        href="{{ route('edit_invoice', $invoice->id) }}"
                                                        title="تعديل">تعديل</a>

                                                    <a class=" dropdown-item" href="#" data-effect="effect-scale"
                                                        data-toggle="modal" data-target="#delete_invoice"
                                                        data-invoice_id="{{ $invoice->id }}" title="حذف">
                                                        حذف
                                                    </a>

                                                    <a class="dropdown-item" data-effect="effect-scale" role="button"
                                                        href="{{ route('show_status', $invoice->id) }}"
                                                        title="تغيير الحالة">تغيير الحالة</a>

                                                        <a class=" dropdown-item" href="#" data-effect="effect-scale"
                                                        data-toggle="modal" data-target="#archive_invoice"
                                                        data-invoice_id="{{ $invoice->id }}" title="ارشفة الفاتورة">
                                                        ارشفة الفاتورة
                                                    </a>

                                                    <a class="dropdown-item" data-effect="effect-scale" role="button"
                                                    href="{{ route('print_invoice', $invoice->id) }}"
                                                    title="طباعة فاتورة">طباعة فاتورة</a>

                                                </div>
                                            </div>



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
        {{-- delete section --}}
        <div class="modal fade" id="delete_invoice" role="effect-flip-horizontal" style="display: none;"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content modal-content-demo">


                    <div class="modal-header">
                        <h6 class="modal-title">حذف قسم</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('invoices.destroy') }}" method="post" autocomplete="off">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                هل انت متأكد من عملية الحذف
                                <input type="hidden" class="form-control " id="invoice_id" name="invoice_id">
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
        {{-- delete section --}}



                {{-- archive invoice --}}
                <div class="modal fade" id="archive_invoice" role="effect-flip-horizontal" style="display: none;"
                aria-hidden="true">
    
                <div class="modal-dialog modal-dialog-centered " role="document">
                    <div class="modal-content modal-content-demo">
    
    
                        <div class="modal-header">
                            <h6 class="modal-title">ارشفة الفاتورة</h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                        </div>
    
                        <div class="modal-body">
                            <form action="{{ route('archive_invoice') }}" method="post" autocomplete="off">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <div class="form-group">
                                    هل انت متأكد من ارشفة الفاتورة؟
                                    <input type="hidden" class="form-control " id="invoice_id" name="invoice_id">
                                </div>
    
                                <div class="modal-footer">
                                    <button class="btn ripple btn-success" type="submit">تأكيد</button>
                                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                                        type="button">اغلاق</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- archive invoice --}}
    </div>

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
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

    <script>
        $('#delete_invoice').on('shown.bs.modal', function(event) {

            var button = $(event.relatedTarget);
            var invoice_id = button.data('invoice_id');
            var modal = $(this);
            modal.find(".modal-body #invoice_id").val(invoice_id);

        })
        $('#archive_invoice').on('shown.bs.modal', function(event) {

            var button = $(event.relatedTarget);
            var invoice_id = button.data('invoice_id');
            var modal = $(this);
            modal.find(".modal-body #invoice_id").val(invoice_id);
        })
    </script>
@endsection
