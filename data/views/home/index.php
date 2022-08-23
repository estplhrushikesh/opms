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

        
        /* image-purpose */

        .ocac-logo{
            height: 46px !important;
            width: 100% !important;
        }
        .ocac-form{
            border-radius: 20px;
        }
          .ocac-form label{
            font-size: 20px;
          }
          .ocac-form button{
            width: 100%;
            font-size: 30px;
          }
          .ocac-form .form-control{
           /* height: 35px;*/
               height: calc(1.5em + 1rem + 2px);
            border-radius: 0.3rem;
            padding: 0.5rem 1rem;
            font-size: 1.75rem;
            line-height: 1.5;
             border-radius: 0.3rem;
             border: 1px solid black;
          }
          .ocac-form .form-control:focus{
            outline: none;
            box-shadow: none;
          }

        @media(max-width:768px) {

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
            <div class="col-md-6 my-5">
                <div class="left-content mt-md-5 mt-0 ml-2 px-3 mb-2">
                    <h3 style="font-size: 30px; font-weight: bold; color: white">OCAC Project Monitoring System</h3>
                    <p style="font-size: 23px; font-weight: 500; color: white;">Govt Of Odisha</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="right-side mt-md-5 mt-0 px-3 mb-2" style="position: absolute; top: 80px;">

                    <form action="Home/user_login_process" name="Home" method="post" class="bg-light px-5 py-5 ocac-form">
                            <div class="msg">
                               <h3 align="center"><div class="error" style="color:#FF0000;margin-top:0px">
                                <?php echo $this->session->flashdata('message'); ?>
                                </div></h3> 
                                <h3 align="center"> Sign in to start your session </h3>
                            </div>
                             <div class="ocac-logo text-center px-5 py-3">
                                <img class="img-fluid" src="<?php echo base_url();?>assets/images/ocac_logo.png" alt="">
                            </div>
                          <div class="form-group mt-5">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control form-control-lg" id="username" name="username" aria-describedby="emailHelp" required placeholder="Username">
                          </div>
                          <div class="form-group mt-5">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
                          </div>
                          <button type="submit" class="btn btn-primary mt-md-4 mt-3 py-md-2">SIGN IN</button>
                        </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 my-3 mt-5 mt-0  ml-3 px-3 mb-2">
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