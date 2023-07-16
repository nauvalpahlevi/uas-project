<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SMK Widya Nusantara</title>
    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">

    <?= $this->renderSection('styles') ?>
    <style>
        /* @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .gradient-animation {
            background: linear-gradient(-45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
        } */

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .gradient-animation {
            background: radial-gradient(circle at 50% -20.71%, #cbe7e1 0, #cae7e3 6.25%, #c9e7e6 12.5%, #c9e7e8 18.75%, #c9e7eb 25%, #c9e7ed 31.25%, #cae6ef 37.5%, #cbe6f1 43.75%, #cde5f2 50%, #cfe4f3 56.25%, #d1e4f4 62.5%, #d4e3f5 68.75%, #d7e2f5 75%, #dae1f5 81.25%, #dde0f4 87.5%, #e0e0f4 93.75%, #e3dff2 100%);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            color: #000000;
        }



        body {
            font-family: "Arial";

        }

        .custom-box {
            border: 1px 1px solid;
            background-color: #F7F7F7;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="gradient-animation">
    <div class="fluid-container">
        <nav class="navbar navbar-expand-lg navbar-light" id="gradient2">
            <a class="navbar-brand" href="#">Tracer Study </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url("study/home"); ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url("study/informasi"); ?>">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url("study/visi_misi"); ?>">Visi & Misi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li> -->
                </ul>
                <a class="btn btn-secondary my-2 my-sm-0" href="<?php echo base_url("study/login"); ?>">Login</a>
            </div>
        </nav>
    </div>
    <div>
        <center>
            <h3>SMK WIDYA NUSANTARA</h3>
        </center>
    </div>