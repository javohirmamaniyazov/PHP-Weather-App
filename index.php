<?php
$status = "";
$msg = "";
if (isset($_POST['submit'])) {
    $city = $_POST['city'];
    $url = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=d2ccbc579207fd275d1ea85b6eb297ae";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result, true);
    if ($result['cod'] == 200) {
        $status = "yes";
    } else {
        $msg = $result['message'];
        echo "<script>alert('City not found. Please enter a valid city name.')</script>";
    }
}
?>

<html lang="en" class=" -webkit-">

<head>
    <meta charset="UTF-8">
    <title>Weather Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .form {
            /* margin-bottom: 10px; */
            width: 100%;
            text-align: center;
        }

        .text {

            width: 60%;
            border-radius: 5px;
            border: none;
            /* outline: none; */
            margin-bottom: 10px;
            margin-top: 0px;
            height: 37px;
        }

        .submit {
            border-radius: 5px;
            border: none;
            background-color: #0077be;
            color: #fff;
            margin-top: 0px;
        }

        .submit:hover {
            background-color: #005b8e;
        }

        .widget {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            margin-top: 40px;
        }

        .weatherIcon {
            float: left;
            margin-right: 20px;
        }

        .weatherIcon img {
            width: 100px;
            height: 100px;
        }

        .weatherInfo {
            overflow: hidden;
        }

        .temperature {
            font-size: 48px;
            font-weight: bold;
            color: #0077be;
        }

        .description {
            margin-top: 20px;
            font-size: 24px;
        }

        .weatherCondition {
            font-weight: bold;
            text-transform: capitalize;
        }

        .place {
            color: #666;
            text-transform: capitalize;
        }

        .date {
            margin-top: 20px;
            text-align: right;
            font-size: 18px;
            color: #666;
        }


        nav {
            background-color: #0077be;
            padding: 10px;
        }

        nav ul {
            display: flex;
            justify-content: space-between;
            align-items: center;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav li {
            color: #fff;

        }

        nav a {
            color: #fff;
            text-decoration: none;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .text {
            padding: 10px;
            border-radius: 5px;
            border: none;
            outline: none;
            margin-right: 0px;

        }

        .submit {
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #fff;
            color: #0077be;
            cursor: pointer;
            outline: none;

        }

        .submit:hover {
            background-color: #eee;
        }

        .search_form {
            margin-top: 10px;
            margin-bottom: 0;
            width: 500px;
            font-size: 20px;
        }
        .log{
            margin-left: 50px;
        }
    </style>
</head>


<body>
    <div class="form">
        <nav>
            <ul>
                <li class="logo"><a href="/" class="log">Weather App</a></li>
                <li>
                    <form class="search_form" method="post">
                        <input type="text" class="text" placeholder="Enter city name" name="city" value="" />
                        <button type="submit" class="submit" name="submit">🔍</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>



    <?php if ($status == "yes") { ?>
        <article class="widget">
            <div class="weatherIcon">
                <img src="http://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon'] ?>@4x.png" />
            </div>
            <div class="weatherInfo">
                <div class="temperature">
                    <span><?php echo round($result['main']['temp'] - 273.15); ?>°C </span>
                </div>
                <div class="description mr45">
                <div class="weatherCondition"><?php echo $result['weather'][0]['main']; ?></div>
                    <div class="place"><?php echo $result['name']; ?></div>
                </div>
                <div class="description">
                    <div class="weatherCondition">Wind</div>
                    <div class="place"><?php echo $result['wind']['speed']; ?> M/H</div>
                </div>
            </div>
            <div class="date">
                <?php echo date('d M', $result['dt']); ?>

            </div>
        </article>
    <?php } ?>
</body>

</html>