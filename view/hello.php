<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Hello Cofenode</title>
        <link rel="stylesheet" href="style.css">
        <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'> 
        <script src="https://kit.fontawesome.com/621136387c.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1 class="logo"><i class="fas fa-mug-hot"></i></h1>
            <div class="navbar-menu">
                <a class="small" href="#">home</a>
                <a class="small" href="#">about</a>
                <a class="small" href="#">menu</a>
                <a href="#">sign in</a>
                <a href="#">Login</a>
              </div>
</div>
    </nav>
    <video autoplay muted loop id="myVideo">
        <source src="../photo/amaya-coffee-video-xs.mp4" type="video/mp4">
      </video>
    <div class="description">
        <h2> Welcome To</h2>
        <h1>our shop coffee</h1>
        <button onclick='root()'> <a > find your Order </a></button>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<script>
  function root(){
    window.location="./loginRegester.php"
  }
</script>
</body>
</html>