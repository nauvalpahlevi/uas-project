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
            background: linear-gradient(-45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
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