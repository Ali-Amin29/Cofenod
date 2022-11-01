 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <title>LOGIN</title>
     <!-- <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
     <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'> -->
     <!-- <script src="https://kit.fontawesome.com/621136387c.js" crossorigin="anonymous"></script> -->
     <link rel="stylesheet" href="css/login.css">
 </head>

 <body>
     <div class="full-page">
         <div class="navbar">
             <div>
                 <h1 class="logo"><a href="system_login.php" style="color:white ;"><i class="fas fa-mug-hot"></i></a>
                 </h1>
             </div>
             <nav>
                 <ul id='MenuItems'>
                     <li><a class='loginbtn' onclick="document.getElementById('login-form').style.display='block'"
                             style="width:auto; display:none;">Login</a></li>
                 </ul>
             </nav>
         </div>
         <div id='login-form' class='login-page'>
             <div class="form-box">
                 <div class='button-box'>
                     <div id='btn'></div>
                     <button type='button' style="color:white !important;" onclick='login()' class='toggle-btn'>Log
                         In</button>
                     <button type='button' style="color:white !important;" onclick='register()'
                         class='toggle-btn'>Register</button>
                 </div>

                 <form id='login' class='input-group-login' action="controller/login.php" enctype="multipart/form-data"
                     method="post">
                     <input type='email' class='input-field' placeholder='Email Id' required name="email">
                     <input type='password' class='input-field' placeholder='Enter Password' required name="password">
                     <input type='checkbox' class='check-box'><span style="color:white !important;">Remember
                         Password</span>
                     <button type='submit' style="color:white !important;" class='submit-btn'>Log in</button>
                 </form>
                 <!-- form -->
                 <form id='register' class='input-group-register' action="controller/Register.php"
                     enctype="multipart/form-data" method="post">

                     <input name="name" type='text' class='input-field' placeholder='Full Name' required
                         id="validationCustom01">
                     <!-- email -->
                     <input name="email" type='email' class='input-field' placeholder='Email Id' required>
                     <!-- room -->
                     <input name="room" type='number' class='input-field' placeholder='room ' required>
                     <!-- floor -->
                     <input name="floor" type='number' class='input-field' placeholder='floor ' required>
                     <!-- password -->
                     <input name="password" type='password' class='input-field' placeholder='Enter Password' required>
                     <input name="Confirm" type='password' class='input-field' placeholder='Confirm Password' required>
                     <input type="file" name="photo" id="photo">

                     <button type='submit' style="color:white !important;" class='submit-btn'>Register</button>
                 </form>

             </div>
         </div>
     </div>
     <script>
     var x = document.getElementById('login');
     var y = document.getElementById('register');
     var z = document.getElementById('btn');

     function register() {
         x.style.left = '-400px';
         y.style.left = '50px';
         z.style.left = '110px';
     }

     function login() {
         x.style.left = '50px';
         y.style.left = '450px';
         z.style.left = '0px';

     }
     </script>

 </body>

 </html>