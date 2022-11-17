<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href="../../../"/>
    <title>Sign Up</title>
    <meta charset="utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <link rel="canonical" href=""/>
    <link rel="shortcut icon" href="/assets/media/logos/favicon.ico"/>
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>

    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank">
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
    <!--begin::Authentication - Sign-up -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <!--begin::Form-->
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <!--begin::Wrapper-->

                <div class="w-lg-500px p-10">
                    <!--begin::Form-->
                    <form class="form w-100" method="post" id="kt_sign_up_form"
                          action="{{route('signUp')}}">
                        @csrf

                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
                            <!--end::Title-->
                        </div>
                        <!--begin::Heading-->

                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="email" placeholder="Email" name="email" autocomplete="off"
                            class="form-control bg-transparent" value="{{old('email')}}" required>
                            @error('email')
                            <p class="text-xs mt-1" style="color: red">{{$message}}</p>
                            @enderror
                            <!--end::Email-->
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-8" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input class="form-control bg-transparent" type="password" placeholder="Password"
                                           name="password" autocomplete="off" id="pass" value="password" required>
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                          data-kt-password-meter-control="visibility">
												<i class="bi bi-eye-slash fs-2"></i>
												<i class="bi bi-eye fs-2 d-none"></i>
											</span>
                                    @error('password')
                                    <p class="text-xs mt-1" style="color: red">{{$message}}</p>
                                    @enderror
                                </div>

                            <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.
                            </div>
                            <!--end::Hint-->
                        </div>

                        <div class="fv-row mb-8">
                            <!--begin::checkpass-->

                            <input type="password" placeholder="Re-type Password" name="r_password" autocomplete="off"
                                   class="form-control bg-transparent" id="rpass" onkeyup="passCheck()" value="password" required>
                            <p id="rpassErr" class="error" style="color: red"></p>

                        </div>

                        <div class="fv-row mb-8">
                            <!--begin::name-->

                            <input type="text" placeholder="Name" name="name" autocomplete="off"
                            class="form-control bg-transparent" value="{{old('name')}}" required>
                            @error('name')
                            <p class="text-xs mt-1" style="color: red">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="fv-row mb-8">
                            <!--begin::contact-->
                            <br>
                            <input type="text" placeholder="Contact" name="contact" autocomplete="off"
                            class="form-control bg-transparent" value="{{old('contact')}}" required>
                            @error('contact')
                            <p class="text-xs mt-1" style="color: red">{{$message}}</p>
                            @enderror
                            <!--end::contact-->
                        </div>
                        <!--end::Input group=-->

                        <!--begin::Accept-->
                        <div class="fv-row mb-8">
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="toc" value="1" id="toc"
                                       onClick="Trychecked()"/>
                                <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">Accept the
										<a class="ms-1 link-primary">Terms</a></span> la, which time not
                                accept.
                            </label>
                        </div>
                        <!--end::Accept-->

                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_up_submit" class="btn btn-primary" disabled>
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Sign up</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                        <!--end::Submit button-->
                        <!--begin::Sign up-->
                        <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
                            <a href="{{route('signIn')}}" class="link-primary fw-semibold">Sign in</a></div>

                        <!--end::Sign up-->
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->
        </div>
        <!--end::Body-->
        <!--end::Authentication - Sign-up-->
    </div>
</div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <script>var hostUrl = "/assets/";</script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="/assets/plugins/global/plugins.bundle.js"></script>
    <script src="/assets/js/scripts.bundle.js"></script>


    <script>

        var rPassError= false;
        var toc = document.getElementById("toc");

        function passCheck() {

            if (document.getElementById("pass").value != document.getElementById("rpass").value) {
                document.getElementById("rpassErr").innerHTML = "*Retype password is not same as password.";
                rPassError = true;
                document.getElementById("toc").checked = false;
            }
            else {
                document.getElementById("rpassErr").innerHTML = null;
                rPassError = false;
            }
        }

        function Trychecked() {
            passCheck();
            if (toc.checked == true && rPassError == false)
                document.getElementById("kt_sign_up_submit").disabled = false;
            else
                document.getElementById("kt_sign_up_submit").disabled = true;
        }

    </script>
    <!--end::Global Javascript Bundle-->




</body>
<!--end::Body-->

</html>
