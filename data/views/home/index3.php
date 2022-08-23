<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="">
    <style>
        .background {
            background: linear-gradient(279.18deg, #45a4ec 9.61%, #216bab 75.6%);
        }

        .logo {
            display: inline-block;
            width: 120px;
            margin: 20px;
        }

        /* image-purpose */

        .ocac-image{
            height: 46px !important;
            width: 100% !important;
        }
        .ocac-form{
            border-radius: 20px;
        }

        @media(max-width:768px) {
         /*   .logo {
                margin: 10px 25px;
            }*/

            .right-side {
                position: relative !important;
                top: 0px !important;
            }

            .oki {
                display: flex;
                margin: 5px;
            }

        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row background">
            <div class="col-md-6 my-3">
                <div class="left-content mt-md-5 mt-0 ml-2 px-3 mb-2">
                    <h3 style="font-size: 30px; font-weight: bold; color: white">OCAC Project Monitoring System</h3>
                    <p style="font-size: 23px; font-weight: 500; color: white;">Govt Of Odisha</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="right-side mt-md-5 mt-0 px-3 mb-2" style="position: absolute; top: 80px;">
                    <form class="bg-light ocac-form px-4 py-4">
                        <div class="ocac-logo text-center px-5 py-3">
                            <img class="img-fluid ocac-image" src="<?php echo base_url();?>assets/images/ocac_logo.png" alt="">
                        </div>
                        <div class="form-group mt-4">
                            <label for="exampleInputEmail1">Email address</label>
                            <input class="form-control form-control-lg" type="email" placeholder="Enter E-mail">
                        </div>
                        <div class="form-group mt-4">
                            <label for="exampleInputPassword1">Password</label>
                            <input class="form-control form-control-lg" type="password" placeholder="********">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 my-3 mt-md-5 mt-0  ml-3 px-3 mb-2">
                <ul class="text-dark ">
                    <li style="font-size: 20px;">Dashboard And Reporting</li>
                    <li style="font-size: 20px;">Accessiblity Across Devices</li>
                    <li style="font-size: 20px;">Streamlines all Project In One-Place</li>
                    <li style="font-size: 20px;">Monitoring And Tracking Project Progress</li>
                </ul>
            </div>
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>
    <script src="" async defer></script>
</body>

</html>