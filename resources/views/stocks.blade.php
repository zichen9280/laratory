<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href=""/>
    <title>Stocks</title>
    <meta charset="utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <link rel="shortcut icon" href="/assets/media/logos/favicon.ico"/>
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <!--end::Global Stylesheets Bundle-->

    <x-layout/>

</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-extended header-fixed header-tablet-and-mobile-fixed">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-theme-mode");
        } else {
            if (localStorage.getItem("data-theme") !== null) {
                themeMode = localStorage.getItem("data-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-theme", themeMode);
    }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
            <!--end::Header-->
            <!--begin::Toolbar-->
            <div class="toolbar mb-n1 pt-3 mb-lg-n3 pt-lg-6" id="kt_toolbar">
                <!--begin::Container-->
                <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap gap-2">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column align-items-start me-3 py-2 py-lg-0 gap-2">
                        <!--begin::Title-->
                        <h1 class="d-flex text-dark fw-bold m-0 fs-3">Table</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Container-->
            <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                <!--begin::Card-->
                <div class="content flex-row-fluid" id="kt_content">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Stocks</h3>
                            <div class="card-toolbar">
                                <a data-bs-toggle='modal' data-bs-target='#modal-lg-1' title='Create Stock'
                                   href='{{route('stock.create')}}' type="button" class="btn btn-sm btn-success">
                                    Create New
                                </a>
                                <a href="{{route('stock.list.deleted')}}" type="button" class="btn btn-sm btn-primary mx-2">
                                Show Deleted
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Table-->
                            <table id="kt_datatable_dom_positioning"
                                   class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th>Id</th>
                                    <th>Product Name</th>
                                    <th>Status</th>
                                    <th>Cost</th>
                                    <th>Sell Price</th>
                                    <th>Remark</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Sold</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($stock as $row)
                                    @if($row['deleted_at'] == null)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->product_of->name}}</td>
                                            <td>{{$row->status}}</td>
                                            <td>RM {{$row->cost}}</td>
                                            <td>RM {{$row->sell_price}}</td>
                                            <td>{{$row->remark}}</td>
                                            <td>{{$row->create_user->name}}</td>
                                            <td>{{$row->created_at}}</td>
                                            <td><a data-bs-toggle='modal' data-bs-target='#modal-lg-1'
                                                   title='View Stocks'
                                                   href='{{route('stock.view',$row->id)}}'
                                                   type="button" class="btn btn-primary"><span class="bi-search"></span></a>
                                            </td>

                                            @if ($row->sold_to != null)
                                                <td>
                                                    <button
                                                        class="btn btn-success" disabled><span class="bi-pencil"></span>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info"
                                                            disabled><span
                                                            class="bi-cash"></span></button>
                                                </td>
                                                <td>
                                                    <button
                                                        class="btn btn-danger" disabled><span class="bi-trash"></span>
                                                    </button>
                                                </td>
                                                @else
                                                <td><a data-bs-toggle='modal' data-bs-target='#modal-lg-1'
                                                       title='Edit Stocks'
                                                       href='{{route('stock.edit',$row->id)}}'
                                                       type="button" class="btn btn-success"><span
                                                            class="bi-pencil"></span></a>
                                                </td>
                                                <td><a data-bs-toggle='modal' data-bs-target='#modal-lg-1'
                                                       title='Sold Stocks'
                                                       href='{{route('stock.sold',$row->id)}}'
                                                       type="button" class="btn btn-info"><span class="bi-cash"></span></a>
                                                </td>
                                                <td><a data-bs-toggle='modal' data-bs-target='#modal-lg-1'
                                                       title='Delete Stocks'
                                                       href='{{route('stock.delete',$row->id)}}'
                                                       type="button" class="btn btn-danger"><span
                                                            class="bi-trash"></span></a></td>
                                            @endif
                                        @endif
                                    @endforeach
                                        </tr>

                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                </div>
                <!--end::Cards-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->
<!--end::Main-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                          fill="currentColor"/>
					<path
                        d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                        fill="currentColor"/>
				</svg>
			</span>
    <!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->
<!--begin::Javascript-->
<script>var hostUrl = "/assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="/assets/js/widgets.bundle.js"></script>
<script src="/assets/js/custom/widgets.js"></script>
<script src="/assets/js/custom/apps/chat/chat.js"></script>
<script src="/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="/assets/js/custom/utilities/modals/create-campaign.js"></script>
<script src="/assets/js/custom/utilities/modals/create-app.js"></script>
<script src="/assets/js/custom/utilities/modals/users-search.js"></script>
<x-modals/>

<script type="text/javascript">
    $("#kt_datatable_dom_positioning").DataTable({
        "language": {
            "lengthMenu": "Show _MENU_",
        },
        "dom":
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"
    });
</script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->


</html>
