
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <style>
        /* Inline CSS for demonstration */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
   
          
        }
        /* Global Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body and general layout */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #fafafa;
    color: #333;
    line-height: 1.6;
}

/* Header styling */
header {
    background-color: #4CAF50;
    color: white;
    text-align: center;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

header h1 {
    font-size: 2.8em;
    letter-spacing: 2px;
}

/* Main content styling */
main {
    padding: 40px 20px;
}

/* Section Titles */
h2 {
    font-size: 2.4em;
    margin-top:15px;
    margin-bottom: 1px;
    color: #4CAF50;
    text-transform: uppercase;
    text-align: center;
    font-weight: bold;
}
        .navbar {
            height: 50px;
            display: flex;
          
           justify-content:end;
            align-items: center;
            background-color:#4CAF50;
            padding: 1rem;
            padding: 1rem;
            position: fixed;
            width: 100%;
           
        }
        .logo{
        color:white;
        font-size:20px;
     }
        .navbar a {
            margin:20px;
       color:white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            font-size:20px;
        }
        .navbar a:hover {
            background-color:black;
            border-radius: 5px;
        }

        .content {
            padding: 1.5rem;
            text-align: center;
            color:white;
        }
        .content1 {
            padding: 10px;
            text-align: center;
        }
        .section {
            margin: 20px 0;
        }
        .crops {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
        .crop {
            border-radius: 50%;
            overflow: hidden;
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #ddd;
        }
        .crop img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .navbar .icons {
            display: flex;
            align-items: center;
        }
        footer {
    text-align: center;
    padding: 1rem 0;
    background: #333;
    color: #fff;
}
    
    </style>
</head>
<body>
    <div class="navbar">
<div class="logo">Farmer Friendly 🌱</div>
    <div>
        <a href="former.php">Home</a>
        <a href="crop_guide.php">Crop Guide</a>
        <a href="purchase.php">Purchase</a>
        <a href="sell_crops.php">Sell Crops </a>
        <a href="faqs.php">FAQs</a>
        <a href="logout.php">Logout</a>
        </div>
        <div class="icons">
        <a href="profile.php">🙎</a>
        
    </div>
    </div>

    <div class="content">
        <h2>Welcome to the Farmer Portal</h2>
   </div>
    
<div class="content1">
    <div class="section">
        <h2>Field Crops</h2>
        <div class="crops">
        <a href="https://en.wikipedia.org/wiki/Rice"><div class="crop"><img src="https://media.istockphoto.com/id/622925154/photo/ripe-rice-in-the-field-of-farmland.jpg?s=612x612&w=0&k=20&c=grtA7L3dm_SP80Fdt-PpIwu5GYacZygErTDUDNIKHwY=" alt="Crop 1"></div>
        </a>    
        <a href="https://en.wikipedia.org/wiki/Maize"> <div class="crop"><img src="https://media.istockphoto.com/id/1061097354/photo/the-corn-plant-in-the-field.jpg?s=612x612&w=0&k=20&c=NEEzE5il-up8g7NZj_7HJUpyVep18zBRfhnMZ5laLiQ=" alt="Crop 2"></div>
           </a>
        <a href="https://www.britannica.com/plant/sorghum-grain"><div class="crop"> <img src="https://cdn.britannica.com/21/136021-050-FA97E7C7/Sorghum.jpg"></div></a>
        <a href="https://www.britannica.com/plant/soybean"><div class="crop"> <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRf9O8IOiodDs3f4_15kCGHfdnIsuJCMuP2dKj4p0Fn1z2Fc4NPK2qEJCB1Htyho1bxUpPz6Hx4hYACUUpFAjp8Zw"></div></a>
        <a href="https://en.wikipedia.org/wiki/Winter_wheat"><div class="crop"> <img src="https://cdn.mos.cms.futurecdn.net/wbFZ3LmpwKuDAZeFZmyGuf.jpg"></div></a>
        <a href="https://en.wikipedia.org/wiki/Durum_wheat"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/5/5d/Triticum_durum.jpg"></div></a>
        <a href="https://en.wikipedia.org/wiki/Wheat"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Vehn%C3%A4pelto_6.jpg/1280px-Vehn%C3%A4pelto_6.jpg"></div></a>
        </div>
    </div>
    <div class="section">
        <h2>Vegetables</h2>
        <div class="crops">
        <a href="https://en.wikipedia.org/wiki/Carrot"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Vegetable-Carrot-Bundle-wStalks.jpg/1920px-Vegetable-Carrot-Bundle-wStalks.jpg"></div></a>
        <a href="https://en.wikipedia.org/wiki/Chili_pepper"><div class="crop"> <img src="https://organicbazar.net/cdn/shop/products/Untitled-design-2022-06-07T132558.848.jpg?v=1694168995"></div></a>
        <a href="https://en.wikipedia.org/wiki/Eggplant"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/76/Solanum_melongena_24_08_2012_%281%29.JPG/800px-Solanum_melongena_24_08_2012_%281%29.JPG"></div></a>
        <a href="https://en.wikipedia.org/wiki/Tomato"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Tomato_je.jpg/330px-Tomato_je.jpg"></div></a>
        <a href="https://en.wikipedia.org/wiki/Cucumber"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/ARS_cucumber.jpg/330px-ARS_cucumber.jpg"></div></a>
        <a href="https://en.wikipedia.org/wiki/Cauliflower"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Chou-fleur_02.jpg/1024px-Chou-fleur_02.jpg"></div></a>
        <a href="https://en.wikipedia.org/wiki/Pea"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Peas_in_pods_-_Studio.jpg/330px-Peas_in_pods_-_Studio.jpg"></div></a>
       
        </div>
    </div>
    <div class="section">
        <h2>Fruits</h2>
        <div class="crops">
        <a href="https://en.wikipedia.org/wiki/Pea"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2d/Nedravazhakola.jpg/1280px-Nedravazhakola.jpg"></div></a>
        <a href="https://en.wikipedia.org/wiki/Apple"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Pink_lady_and_cross_section.jpg/1920px-Pink_lady_and_cross_section.jpg"></div></a>
        <a href="https://en.wikipedia.org/wiki/Orange_(fruit)"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/b/b0/OrangeBloss_wb.jpg"></div></a>
        <a href="https://en.wikipedia.org/wiki/Watermelon"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/47/Taiwan_2009_Tainan_City_Organic_Farm_Watermelon_FRD_7962.jpg/800px-Taiwan_2009_Tainan_City_Organic_Farm_Watermelon_FRD_7962.jpg"></div></a>
        <a href="https://en.wikipedia.org/wiki/Grape"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/6/6c/Abhar-iran.JPG"></div></a>
        <a href="https://en.wikipedia.org/wiki/Mango"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/60/Mango_tree_with_fruit_in_Rinc%C3%B3n%2C_Puerto_Rico.jpg/1280px-Mango_tree_with_fruit_in_Rinc%C3%B3n%2C_Puerto_Rico.jpg"></div></a>
        <a href="https://en.wikipedia.org/wiki/Papaya"><div class="crop"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Carica_papaya_leaf_14_07_2012.jpg/1280px-Carica_papaya_leaf_14_07_2012.jpg"></div></a>
    </div>
        </div>
</div>
<footer>
        <p>&copy; <?= date('Y'); ?> Farmer Dashboard</p>
    </footer>
</body>
</html>
