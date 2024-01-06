<?php
session_start();
if (!empty($_SESSION["loggedin"])) {
    header("Location: index.php");
}
?>

<head>
    <base href="../../../" />
    <title>Petcare - We care about animals!</title>
    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - Bootstrap Admin Template, HTML, VueJS, React, Angular. Laravel, Asp.Net Core, Ruby on Rails, Spring Boot, Blazor, Django, Express.js, Node.js, Flask Admin Dashboard Theme & Template" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="animalcareapp/project/images/custom_images/petcareico.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="animalcareapp/project/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="animalcareapp/project/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="animalcareapp/project/assets/css/customstyle.css" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="app-blank pattern-overlay">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url('animalcareapp/project/assets/media/auth/bg10.jpeg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('animalcareapp/project/assets/media/auth/bg10-dark.jpeg');
            }
        </style>
        <div class="d-flex justify-content-center">
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10 my-12">
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-500px p-10">
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" data-kt-redirect-url="../../demo1/dist/authentication/layouts/corporate/sign-in.html" action="#" method="POST">
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">რეგისტრაცია</h1>
                                <div class="text-gray-500 fw-semibold fs-6">ერთად მოვუაროთ ცხოველებს!</div>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="სახელი" name="username" autocomplete="off" class="form-control bg-transparent" />
                            </div>
                            <div class="fv-row mb-8" data-kt-password-meter="true">
                                <div class="mb-1">
                                    <div class="position-relative mb-3">
                                        <input class="form-control bg-transparent" type="password" placeholder="პაროლი" name="password" autocomplete="off" />
                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                            <i class="ki-duotone ki-eye-slash fs-2"></i>
                                            <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                </div>
                                <div class="text-muted">გამოიყენეთ მინიმუმ 8 სიმბოლოსგან შემდგარი პაროლი.</div>
                            </div>
                            <div class="fv-row mb-8">
                                <input placeholder="გაიმეორეთ პაროლი" name="confirm-password" type="password" autocomplete="off" class="form-control bg-transparent" />
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                                    <span class="indicator-label">რეგისტრაცია</span>
                                    <span class="indicator-progress">გთხოვთ დაელოდოთ...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <div class="text-gray-500 text-center fw-semibold fs-6">უკვე ხართ დარეგისტრირებული?
                                <a href="animalcareapp/project/sign_in.php" class="link-primary fw-semibold">შედით სისტემაში</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var hostUrl = "animalcareapp/project/assets/";
    </script>
    <script src="animalcareapp/project/assets/plugins/global/plugins.bundle.js"></script>
    <script src="animalcareapp/project/assets/js/scripts.bundle.js"></script>
    <script src="animalcareapp/project/assets/js/custom/authentication/sign-up/general.js"></script>
</body>

</html>