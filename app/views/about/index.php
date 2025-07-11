<?php require_once 'app/views/templates/header.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>About Me - Larry Masters</title>
<style>
body {
font-family: Arial, sans-serif;
margin: 40px;
background-color: #f9f9f9;
}

.about-container {
display: flex;
align-items: center;
background: #fff;
padding: 20px;
border-radius: 10px;
box-shadow: 0 0 15px rgba(0,0,0,0.1);
max-width: 800px;
margin: auto;
}

.about-photo img {
width: 200px;
height: auto;
border-radius: 10px;
margin-right: 30px;
}

.about-text {
line-height: 1.6;
}

.about-text h1 {
margin: 0;
font-size: 28px;
}

.about-text p {
margin: 6px 0;
color: #333;
}
</style>
</head>
<body>

<div class="about-container">
<div class="about-photo">
<img src="app/views/about/me.jpg" alt="Photo of Larry Masters">
</div>
<div class="about-text">
<h1>Larry Masters</h1>
<p>Retired Educator</p>
<p>Lifelong Learner</p>
<p>Currently studying COSC4806</p>
<p>Starting Master of Science in Data Analytics this fall</p>
</div>
</div>

</body>
</html>