<?php
//session_start();
//
//$emailErr = $passwordErr = '';
//$email = $password = '';
//$something_wrong = 'try';
//$faulty = 0;
//$result = "";
//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//
//    if (empty($_POST["email"])) {
//        $emailErr = "*Email is required";
//        $faulty = 1;
//    } else
//        $email = $_POST["email"];
//
//    if (empty($_POST["password"])) {
//        $passwordErr = "*Password is required";
//        $faulty = 1;
//    } else
//        $password = $_POST["password"];
//
//    if ($faulty == 0) {
//        $_SESSION["email"] = $email;
//        $sql = "SELECT email, password FROM users WHERE email = '$email' AND password = '$password'";
//        $sql2 = "SELECT id, name, email FROM users WHERE email = '$email' AND password = '$password'";
//        $result = mysqli_query($conn, $sql);
//        if (mysqli_num_rows($result) == 1) {
//
//            $something_wrong = 'false';
//
//            $session_result = mysqli_query($conn, $sql2);
//            $rows = $session_result->fetch_all(MYSQLI_ASSOC);
//            foreach($rows as $row){
//                $_SESSION["name"] = $row['name'];
//                $_SESSION["email"] = $row['email'];
//                $_SESSION["id"] = $row['id'];
//            }
//        }
//        else
//            $something_wrong = 'true';
//    } else {
//        $something_wrong = 'true';
//    }
//}
//?><!---->
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href="../../../"/>
    <title>Sign In</title>
    <meta charset="utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <link rel="canonical" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
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
    <?php
        if(isset($_GET["signoutsuccess"])) {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin: 10px;" id="logout_alert" >
        Sign out successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } ?>

    <?php

    if(isset($_GET["unauthorized"])) {
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin: 10px;" id="logout_alert" >
            Please sign in first.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <!--begin::Form-->
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10">
                    <!--begin::Form-->
                    <form id="form" method="post" class="form w-100"  id="kt_sign_in_form" action="{{route('signIn')}}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                            <!--end::Title-->

                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="email" placeholder="Email" name="email" id="email"
                                   class="form-control bg-transparent" value="email@email.com" required/>
                            <!--end::Email-->
                        </div>
                        <!--end::Input group=-->
                        <div class="fv-row mb-3">
                            <!--begin::Password-->
                            <input type="text" placeholder="Password" id="password" name="password" autocomplete="off"
                                   class="form-control bg-transparent" value="password" required/>
                            <!--end::Password-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            @error('email')
                            <p class="text-s mt-2 mx-3" style="color: red">{{$message}}</p>
                            @enderror
                            <br>
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Sign In</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                        <!--end::Submit button-->
                        <!--begin::Sign up-->
                        <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                            <a href="/sign_up" class="link-primary">Sign up</a></div>
                        <!--end::Sign up-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->

</div>
<!--end::Root-->
<!--end::Main-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>

<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<!-- <script src="/assets/js/custom/authentication/sign-in/general.js"></script> -->
<!--end::Custom Javascript-->
<!--end::Javascript-->
<x-flash />
</body>

<!--end::Body-->
</html>
