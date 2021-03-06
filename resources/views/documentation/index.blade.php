<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>:: Documentation</title>
    <link rel="icon" href="icon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('documentation/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('documentation/css/normalize.css')}}">
    <link rel="stylesheet" href="{{ asset('documentation/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('documentation/css/d-style.css') }}">
</head>

<body>
    <div class="wrapper">
        <header class="main-header">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-6">
                        <h2>Documentation</h2>
                    </div>
                    <div class="col-6 text-right">
                        <a href="https://projectx.com.bd/" class="btn btn-blue">ProjectX</a>
                    </div>
                </div>

            </div>
        </header>

        <div class="left-sidebar d-none d-md-block">
            <div class="card">
                <div class="card-body">
                    <h3>-- Main Navigation</h3>
                    <ul class="list-unstyled">
                        <li><a href="#start"><i class="fa fa-angle-right"></i><span>Start</span></a></li>
                        <li><a href="#Studio"><i class="fa fa-angle-right"></i><span>How to Configure Webservice In Your
                                    Server?</span></a></li>
                        <li><a href="#thank_you"><i class="fa fa-angle-right"></i><span>THANK YOU!</span></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row content-area">
                    <div class="col extra-col"></div>
                    <div class="col-lg-9 col-md-8 right-cnt">

                        <div id="start">
                            <div class="card">
                                <div class="card-body">
                                    <p><img alt="" src="{{asset('documentation/doc/banner.jpg')}}" class="img-fluid" height="100" width="100"></p>
                                    <style>
                                        header.major h2 {
                                            color: #000000;
                                            font-size: 3em;
                                            line-height: 60px;
                                        }

                                        .img-fluid {
                                            max-width: 100%;
                                            height: auto;
                                            background: repeating-radial-gradient(black, transparent 100px);
                                            padding: 10px;
                                        }

                                    </style>
                                    <header class="major">
                                        <h2>ProjectX</h2>
                                    </header>

                                    <p class="prepend-top"> <strong> Created: 01/01/2021<br>
                                            Company: ProjectX - Bangladesh<br>
                                            Contact: <a href="https://codecanyon.net/user/nemosofts"
                                                style="color:#3c55d1" target="_blank">CodeCanyon Profile</a> </strong>
                                    </p>

                                    <p class="prepend-top append-0">Thank you for purchasing the app. If you have any
                                        questions that are beyond the scope of this help file, please feel free to
                                        message me my user page contact form <a
                                            href="https://codecanyon.net/user/nemosofts" style="color:#3c55d1"
                                            target="_blank">here</a>. Thanks so much!</p>



                                </div>
                            </div>
                        </div>



                        <div class="card" id="Studio">
                            <div class="card-body">
                                <h2 id="toc"> How to Configure Webservice In Your Server?</h2>
                                <h3>Live Installation</h2>
                                    <p>Follow the video tutorial ahead.</p>
                                    <b>PHP Web Service Installation 1</b>
                                    <br>
                                    <iframe width="800" height="450" src="https://www.youtube.com/embed/AiRyaX2Ghu8"
                                        frameborder="0" allowfullscreen=""></iframe>
                                    <br>
                                    <br>
                                    <b>PHP Web Service Installation 2</b>
                                    <br>
                                    <iframe width="800" height="450" src="https://www.youtube.com/embed/nrODIG1Vcww"
                                        frameborder="0" allowfullscreen=""></iframe>
                                    <br>
                                    <br>
                                    <ol>
                                        <li>First of all find the <b>wp-admin</b> folder from the downloaded package and
                                            upload on live server.</li>
                                        <li>Then create a database.</li>
                                        <li>Import the database from the db folder.</li>
                                        <li>Aftre creating database configure the <b>config/config.php</b> file,which is
                                            in the includes folder of your package.<br>
                                            <code>$DB_HOST="localhost"; //Depends on hosting, normaly localhost<br>
                                                $userName="db_user";<br>
                                                $password="db_pass";<br>
                                                $dbname="db_name";<br></code>

                                        </li>


                                    </ol>
                                    <p>That???s all,now run the webservice : <b>http://domain.com/wp-admin/index.php</b>
                                    </p>

                                    <b>Default Login Details</b><br> Useremail: admin@newsapp.com<br> Pass: admin
                                    <br><br>

                            </div>
                        </div>



                        <div class="card" id="thank_you">
                            <div class="card-body">
                                <h2><strong>THANK YOU</strong></h2>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{asset('documentation/js/jquery-2.1.4.min.js')}}"></script>
    <!-- jQuery -->
    <script src="{{asset('documentation/js/bootstrap.min.js')}}"></script>
    <!-- Bootstrap -->

</body>

</html>
