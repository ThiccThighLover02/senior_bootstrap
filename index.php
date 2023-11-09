<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <?php
        include 'links.php';
    ?>

    <title>Hello, world!</title>
  </head>
  <body>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">Senior Citizen System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        </div>
        

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">

              <div class="dropdown">
                <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Login
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="senior/senior_login.php">Senior Login</a></li>
                  <li><a class="dropdown-item" href="user/emp_login.php">Employee Login</a></li>
                  <li><a class="dropdown-item" href="admin/admin_login.php">Admin Login</a></li>
                </ul>
              </div>

            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">FAQ U<span class="sr-only">(current)</span></a>
            </li>
            </ul>
          </div>
          </nav>

    <div class="container-xxlg d-flex flex-column align-items-center justify-content-center bg-primary" style="height: 100vh;">

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://picsum.photos/900/400" class="d-block" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://picsum.photos/900/400" class="d-block" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://picsum.photos/900/400" class="d-block" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>


        <h1 class="text-white">Slideshow and some texts goes here</h1>
        

    </div>

    <!-- the benefits starts here -->

    <div class="container d-flex flex-column align-items-center justify-content-center" style="height: 100vh;">
        <div class="row">
            <div class="col-12 text-align-center">
                <h1>Benefits goes here</h1>
            </div>
        </div>
        

        <div class="row">
            <div class="col-4">
                <div class="card">
                    <img class="card-img-top" src="https://picsum.photos/318/100" alt="Card image cap">
                    <div class="card-body text-align-center">
                        Fast: <br> With the help of the senior system you are able to see the events and attend these events with ease.
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <img class="card-img-top" src="https://picsum.photos/318/100" alt="Card image cap">
                    <div class="card-body text-align-center"> Reliable: <br> The senior citizen system will help make the process of claiming benefits and attending events easier. </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <img class="card-img-top" src="https://picsum.photos/318/100" alt="Card image cap">
                    <div class="card-body text-align-center"> What the fuck do I put here </div>
                </div>
            </div>
        </div>
    </div>

   <!-- the benefits ends here -->

    <div class="container d-flex flex-column align-items-center justify-content-center mb-5">
      <h1>Want to sign up?</h1>
      <a href="senior/senior_create_acc.php" class="btn btn-outline-primary">Click Here</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>