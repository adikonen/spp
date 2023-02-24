<!DOCTYPE html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title><?= e(APP_NAME)?></title>
<style>
    .bg-login {
      background: url("<?= BASE_URL?>/img/laptop.jpg");
      background-position: center;
      background-size: cover;
    }
</style>
<!-- Custom fonts for this template-->
<link href="<?= BASE_URL?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="<?= BASE_URL?>/css/sb-admin-2.css" rel="stylesheet">

</head>
 <body class="bg-light-700">
    <div class="container">
      <!-- Outer Row -->
      <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-4 d-none d-lg-block bg-login"></div>
                <div class="col-lg-8">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Welcome Back</h1>
                      <?php Flasher::flash();?>
                    </div>
                    <form class="user" action="<?= BASE_URL?>/login/store" method="post">
                      <div class="form-group">
                        <hr />
                        <input type="text" class="form-control form-control-user" id="username" aria-describedby="username" name="username" placeholder="Masukan Username..." />
                      </div>
                      <div class="form-group">
                        <hr />
                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password" />
                      </div>
                      <!-- <div class="form-group">
                        <hr />
                        <div class="custom-control custom-checkbox small">
                          <input type="checkbox" class="custom-control-input" id="customCheck" />
                          <label class="custom-control-label" for="customCheck">Remember Me</label>
                        </div>
                      </div> -->
                      <hr />
                      <button class="btn btn-primary btn-user btn-block"> Login </button>
                      <hr />
                    </form>
              
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
