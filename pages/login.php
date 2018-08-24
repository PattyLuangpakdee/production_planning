<?php
session_start();
include "connect.php";
include "query.php";
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../assets/img/apple-icon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?= $ARRAY_ORGANIZATION['ogz_name'] ?></title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
        <!-- CSS Files -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="../assets/css/demo.css" rel="stylesheet" />
    </head>

    <body>
        <div class="wrapper wrapper-full-page">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute">
                <div class="container">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand" href="#pablo"><?= $ARRAY_ORGANIZATION['ogz_name'] ?></a>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="full-page  section-image" data-color="black" data-image="../assets/img/full-screen-image-2.jpg">
                <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
                <div class="content">
                    <div class="container">
                        <div class="col-md-4 col-sm-6 ml-auto mr-auto">
                            <form class="form" id="form1" name="form1" method="post" action="chk.php"  onsubmit="return chk_form()">    
                                <div class="card card-login card-hidden">
                                    <div class="card-header ">
                                        <h3 class="header text-center">Login</h3>
                                    </div>
                                    <div class="card-body ">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" autocomplete="off" id="username" placeholder="Enter Username" class="form-control" required="required" maxlength="20" value="<?= $_COOKIE['CK_username'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" autocomplete="off" id="password" placeholder="Password" class="form-control" required="required" maxlength="20" value="<?= $_COOKIE['CK_password'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="keep_login" id="keep_login" value="1" checked <?= (isset($_COOKIE['CK_username']) && $_COOKIE['CK_username']) ?>>
                                                        <span class="form-check-sign"></span>
                                                        Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer ml-auto mr-auto">
                                        <button type="submit" class="btn btn-warning btn-wd">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        function chk_form() {
            var j_keep_login = document.form1.keep_login;
            var i_username = document.form1.username.value;
            var i_password = document.form1.password.value;
            if (j_keep_login.checked === true) {
                var days = 1; // กำหนดจำนวนวันที่ต้องการให้จำค่า
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                var expires = "; expires=" + date.toGMTString();
                document.cookie = "CK_username=" + i_username + "; expires=" + expires + "; path=/";
                document.cookie = "CK_password=" + i_password + "; expires=" + expires + "; path=/";
            } else {
                var expires = "";
                document.cookie = "CK_username=" + expires + ";-1;path=/";
                document.cookie = "CK_password=" + expires + ";-1;path=/";
            }
        }
    </script>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <!--  Plugin for Switches, full documentation here: https://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="../assets/js/plugins/bootstrap-switch.js"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
    <!--  Chartist Plugin  -->
    <script src="../assets/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!--  Share Plugin -->
    <script src="../assets/js/plugins/jquery.sharrre.js"></script>
    <!--  jVector Map  -->
    <script src="../assets/js/plugins/jquery-jvectormap.js" type="text/javascript"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--  DatetimePicker   -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.js"></script>
    <!--  Sweet Alert  -->
    <script src="../assets/js/plugins/sweetalert2.min.js" type="text/javascript"></script>
    <!--  Tags Input  -->
    <script src="../assets/js/plugins/bootstrap-tagsinput.js" type="text/javascript"></script>
    <!--  Sliders  -->
    <script src="../assets/js/plugins/nouislider.js" type="text/javascript"></script>
    <!--  Bootstrap Select  -->
    <script src="../assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
    <!--  jQueryValidate  -->
    <script src="../assets/js/plugins/jquery.validate.min.js" type="text/javascript"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--  Bootstrap Table Plugin -->
    <script src="../assets/js/plugins/bootstrap-table.js"></script>
    <!--  DataTable Plugin -->
    <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
    <!--  Full Calendar   -->
    <script src="../assets/js/plugins/fullcalendar.min.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
    <!-- Light Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/js/demo.js"></script>
    <script>
        $(document).ready(function () {
            demo.checkFullPageBackgroundImage();

            setTimeout(function () {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
    <!-- Facebook Pixel Code Don't Delete -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq)
                return;
            n = f.fbq = function () {
                n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq)
                f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window,
                document, 'script', '//connect.facebook.net/en_US/fbevents.js');

        try {
            fbq('init', '111649226022273');
            fbq('track', "PageView");

        } catch (err) {
            console.log('Facebook Track Error:', err);
        }
    </script>
    <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->

</html>
