<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />



    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href={{asset("Admin/assets/img/favicon/favicon.ico")}} />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href={{asset("Admin/assets/vendor/fonts/boxicons.css")}} />




                    {{-- datatables --}}
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
                    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap5.min.css">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
                    {{-- end of datatable --}}
    <!-- Core CSS -->
    <link rel="stylesheet" href={{asset("Admin/assets/vendor/css/core.css")}} class="template-customizer-core-css" />
    <link rel="stylesheet" href={{asset("Admin//assets/vendor/css/theme-default.css")}} class="template-customizer-theme-css" />
    <link rel="stylesheet" href={{asset("Admin/assets/css/demo.css")}} />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href={{asset("Admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css")}} />

    <link rel="stylesheet" href={{asset("Admin/assets/vendor/libs/apex-charts/apex-charts.css")}} />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src={{asset("Admin/assets/vendor/js/helpers.js")}}></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src={{asset("Admin/assets/js/config.js")}}></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
                @include("Admin.layouts.sidebar")
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include("Admin.layouts.header")
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                        @yield("content")
                    <!-- / Content -->

                    <!-- Footer -->
                        @include("Admin.layouts.footer")
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src={{asset("Admin/assets/vendor/libs/jquery/jquery.js")}}></script>
    <script src={{asset("Admin/assets/vendor/libs/popper/popper.js")}}></script>
    <script src={{asset("Admin/assets/vendor/js/bootstrap.js")}}></script>
    <script src={{asset("Admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js")}}></script>



    <script src={{asset("Admin/assets/vendor/js/menu.js")}}></script>
    <!-- endbuild -->

        {{-- datatables --}}
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>

        {{-- end of datatable --}}

                {{-- start of all myscripts --}}
        <script>

            // to make check all
            function check_all(){
                $('input[class="item_checkbox"]:checkbox').each(function(){
                    if($('input[class="checkbox_all"]:checkbox:checked').length == 0){
                        $(this).prop("checked",false);
                    }else{
                        $(this).prop("checked",true);
                    }
                })
            }

            // to show delete modal
            function delete_all(){

                $(document).on("click",".delete_item",function(){
                    $("#formdata").submit();
                });

                $(document).on("click",".delete_user",function(){
                    $("#deleteuser").submit();
                });

                $(document).on("click",".EditUser",function(){
                    $("#edituser").submit();
                });
                $(document).on("click",".delBtn",function(){
                    var item_checked = $('input[class="item_checkbox"]:checkbox').filter(":checked").length;
                    console.log(item_checked);
                    if(item_checked > 0){
                        $('.non-empty').removeClass("invisible");
                        $('.empty').addClass("invisible");
                        $(".count").text(item_checked);
                    }else{
                        $('.empty').removeClass("invisible");
                        $('.non-empty').addClass("invisible");
                    }

                    $("#delmodal").modal('show');
                });
            }
        </script>
        {{-- end of all myscripts --}}

    <!-- Vendors JS -->
    <script src={{asset("Admin/assets/vendor/libs/apex-charts/apexcharts.js")}}></script>

    <!-- Main JS -->
    <script src={{asset("Admin/assets/js/main.js")}}></script>

    <!-- Page JS -->
    <script src={{asset("Admin/assets/js/dashboards-analytics.js")}}></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    @stack('scripts')

</body>

</html>
