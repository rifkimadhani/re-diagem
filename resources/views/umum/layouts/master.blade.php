<!doctype html>
<html lang="en" class="no-focus">
    <head>
        @include('umum.layouts.meta')
        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" id="css-main" href="{{ asset('public/css/app.css') }}">

        @yield('styles')
        <style>
            .cart {

            }

            .btn-cart .cart .cart-notification {
                min-width: 20px;
                min-height: 20px;
                color: var(--N0,#FFFFFF);
                font-size: 10px;
                font-weight: 700;
                line-height: 1.6;
                text-align: center;
                background-color: rgb(239, 20, 74);
                border: 2px solid var(--N0,#FFFFFF);
                border-radius: 18px;
                position: absolute;
                top: 0px;
                right: 0px;
                padding: 0px 4px;
                transform: translate(-10%, -8%);
            }

            .btn-cart .cart-overlay {
                background-color: rgb(255, 255, 255);
                box-shadow: rgb(0 0 0 / 12%) 0px 2px 8px 0px;
                width: 360px;
                z-index: 495;
                overflow: hidden;
                animation-name: animation-1bic2n7;
                animation-duration: 0.4s;
                height: auto;
            }
            .btn-cart .cart-overlay .cart-content {
                max-height: 295px;
                overflow: auto;
            }

            .cart-content .cart-item {
                font-size: 14px;
                color: rgba(49, 53, 59, 0.96);
                display: flex;
                -webkit-box-align: center;
                align-items: center;
                text-decoration: none;
                border-bottom: 1px solid rgb(229, 231, 233);
                padding: 8px 0px;
                margin: 0px 16px;
                transition: color 280ms ease 0s;
            }

            .cart-item .cart-item-prodImg {
                width: 40px;
                height: 40px;
                border-radius: 4px;
                margin: 4px 12px 4px 4px;
            }

            .cart-item .cart-item-content  {
                min-width: 0px;
                flex: 1 1 0%;
            }

            .cart-item .cart-item-content .cart-item-prodName {
                font-weight: 700;
                line-height: 20px;
                white-space: nowrap;
                text-overflow: ellipsis;
                display: block;
                overflow: hidden;
            }

            .cart-item .cart-item-content .cart-item-prodQty {
                color: rgba(49, 53, 59, 0.96);
                font-size: 10px;
                line-height: 16px;
                display: block;
                margin-top: 2px;
            }

            .cart-item .cart-item-price {
                color: rgb(250, 89, 29);
                font-weight: 700;
                line-height: 20px;
                margin-left: 8px;
            }
        </style>
    </head>
    <body>

        <div id="page-container" class="sidebar-inverse side-scroll page-header-fixed main-content-boxed">

            <!-- Header -->
            @include('umum.layouts.header')
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                @yield('content')
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->

            @include('umum.layouts.footer')

            <!-- Pop Out Modal -->
            <div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
                <div class="modal-dialog modal-dialog-popout" role="document">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Terms &amp; Conditions</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-alt-success" data-dismiss="modal">
                                <i class="fa fa-check"></i> Perfect
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Pop Out Modal -->
        </div>
        <script src="{{ asset('public/js/laravel.app.js') }}"></script>
        <script src="{{ asset('public/js/laroute.js') }}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @stack('scripts')
    </body>
</html>
