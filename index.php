<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Document</title>
    <style>
       
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'poppins',sans-serif;

}
.hero{
    width: 100%;
    height: 100vh;
   
    background-image: linear-gradient(rgba(12,3,51,0.3),rgba(12,3,51,0.3));
    position: relative;
    padding: 0 5%;
display: flex;
    align-items: center;
    justify-content: center;
}
nav{
    height: ;
    top: 0;
    left: 0;
    padding: 20px 8%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: rgba(51, 51, 51, 0.8); 
            padding: 1rem;
            position: fixed;
            width: 100%;
}
.logo{
width: 60px;
height: 40px;
border-radius:20px;
}

nav ul li{
    list-style: none;
    display: inline-block;
    margin-left: 40px;
}
nav ul li a{
    text-decoration: none;
    color: #ffff;
    font-size: 17px;
}

        nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
        }
        nav a:hover {
            background-color: green;
            border-radius: 5px;
        }
.content{
    text-align: center;
}
.content h1{
font-size: 90px;
color: #ffff;
font-weight: 600;
}
.content a{
    text-decoration: none;
    display: inline-block;
    color: #ffff;
    font-size: 24px;
    padding: 14px 70px;
    border: 2px solid #ffff ;
    margin-top: 20px;
    border-radius: 50px;
}
.content a:hover {
            background-color: green;
            border-radius: 50px;
        }
.back{
position: absolute;
right: 0;
bottom: 0;
z-index: -1;
}
@media (min-aspect-ratio:16/9) {
    .back{
        width: 100%;
        height: auto;
    }
    
}
@media (max-aspect-ratio:16/9) {
    .back{
        width: auto;
        height: 100%;
    }
    
}
.card-container {
            display: flex;
            gap: 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.7); /* Semi-transparent white */
            backdrop-filter: blur(10px); /* Adds blur effect */
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            padding: 20px;
            text-align: center;
        }

        .card h3 {
            margin: 0;
            color: #333;
        }

        .card p {
            color: #555;
        }
   
   </style>

</head>
<body>
<div class="hero">
    <video autoplay loop muted  plays-inline class="back"> 
        <source src="video1.mp4" type="video/mp4">
    </video>
<nav>
    <img src="photo.png" class="logo" alt="">
    <ul>
    <li ><a href="index.php">Home </a></li>
    <li ><a href="login.php">Login </a></li>
    <li ><a href="signup.php">SignUp</a></li>
   
</ul>
</nav>
<div class="content">
    <h1>Agrocraft Management</h1>
    <a href="signup.php">Get Start</a>
</div>
<div>
   
</div>

</body>
</html>
