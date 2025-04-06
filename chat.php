<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


$output = shell_exec("python3 handleprompt.py");
$columns = json_decode($output, true);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Threads</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/chat.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
    .right .buttons {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        gap: 5px;
        margin-top: -20px;
    }

    .right .button {
        display: flex;
        align-items: center;
        gap: 8px;
        background-color: #f2f2f2;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.2s;
        padding: 6px 12px;
    }

    .right .button:hover {
        background-color: #ddd;
    }

    .right .button p {
        margin: 0;
    }

    .charta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        margin-top: 15px;
    }

    .charta h2 {
        margin: 0;
        font-size: 16px;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-toggle {
        background-color: #f1f1f1;
        border: 1px solid #ccc;
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-family: Inter, sans-serif;
        display: inline-block;
        white-space: nowrap;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 30%;
        left: 0;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.15);
        min-width: 160px;
        z-index: 99;
        margin-top:-120px;
    }

    .dropdown-menu a {
        display: block;
        padding: 10px;
        font-size:13px;
        color: black;
        text-decoration: none;
    }

    .dropdown-menu a:hover {
        background-color: #f0f0f0;
    }

    .dropdown-menu.show {
        display: block;
    }
    .charta h2{
    padding-left: 30px;
    font-size: 25px;
    font-weight: 550;
    color:#4C1EE5;
  }
  #charta {
  display: none;
}


.message {
  max-width: 70%;
  padding: 10px 15px;
  border-radius: 15px;
  margin: 10px;
  font-size: 16px;
  line-height: 1.5;
}

.user-bubble {
  background-color: #ffffff;
  color: #000;
  align-self: flex-end;
  margin-left: auto;
}

.ai-bubble {
  background-color: #eee;
  color: #000;
  align-self: flex-start;
  margin-right: auto;
}
#submit{
    display:none;
    color:black;
    scale:1;
    margin-top:40px;
width:120px;
margin-left: 20px;
height:47px;
font-size:18px;
background: white;
border-radius:25px;

}
.anala h2{
    padding-left: 30px;
    font-size: 25px;
    font-weight: 550;
    color:#4C1EE5;
}

.anala .dropdown{
    margin-left: 20px;
    margin-top:20px;
  }
    </style>
</head>

<body>
<nav>
    <img src="IMG/logo black.png" id="logo" alt="Logo">
    <div>
        <a href="chat.php">My Threads</a>
        <a href="downloads.php">Downloads</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="main">
    <div class="left">
        <h1>My Threads</h1>
        <div class="thread" id="t01">
            <h3 class="threadtit">Thread Title</h3>
            <h4 class="threaddesc">Thread Description (latest message) with...</h4>
        </div>
    </div>

    <div class="right">
        <div class="messages">
        <?php
// DB connection
$host = 'localhost';
$dbname = 'DataViz';
$user = 'root';
$pass = 'root'; // or ''
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $thid = $_SESSION['thread_id'] ?? null;

    if ($thid !== null) {
        $thid=$_GET['thread_id'];
        $stmt = $pdo->prepare("SELECT sender, message FROM messages WHERE thread_id = :thid ORDER BY created_at ASC");
        $stmt->execute(['thid' => $thid]);
    
        while ($row = $stmt->fetch()) {
            if ($row['sender'] === 'user') {
                echo "<div class='user-message'>User: <i>" . htmlspecialchars($row['message']) . "</i></div>";
            } else {
                echo "<div class='ai-message'>AI: <i>" . htmlspecialchars($row['message']) . "</i></div>";
            }
        }
    } else {
        echo "No thread selected.";
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
        </div>
        <div class="inputs">
            <div class="buttons">
                <div class="button" id="predict">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 21V14.4L6.35 19.075L4.925 17.65L9.6 13H3V11H9.6L4.925 6.35L6.35 4.925L11 9.6V3H13V9.6L17.65 4.925L19.075 6.35L14.4 11H21V13H14.4L19.075 17.65L17.65 19.075L13 14.4V21H11Z" fill="black"/>
                    </svg>
                    <p>Predict</p>
                </div>

                <div class="button" id="analyse">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.03722 1.42939C9.31037 0.456452 10.6896 0.456454 10.9628 1.4294L12.4786 6.82887C12.5729 7.16467 12.8353 7.42709 13.1711 7.52136L18.5706 9.03722C19.5435 9.31037 19.5435 10.6896 18.5706 10.9628L13.1711 12.4786C12.8353 12.5729 12.5729 12.8353 12.4786 13.1711L10.9628 18.5706C10.6896 19.5435 9.31037 19.5435 9.03722 18.5706L7.52136 13.1711C7.42709 12.8353 7.16467 12.5729 6.82887 12.4786L1.42939 10.9628C0.456452 10.6896 0.456454 9.31037 1.4294 9.03722L6.82887 7.52136C7.16467 7.42709 7.42709 7.16467 7.52136 6.82887L9.03722 1.42939Z" fill="black"/>
                    </svg>
                    <p>Analyse</p>
                </div>

                <div class="button" id="chart">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.5 18.5L2 17L9.5 9.5L13.5 13.5L20.6 5.5L22 6.9L13.5 16.5L9.5 12.5L3.5 18.5Z" fill="black"/>
                    </svg>
                    <p>Chart</p>
                </div>
            </div>
            <form action="doit.php" method="POST">
                <div class="default" id = "default">
                    <h2>Select A Mode to get started.</h2>
                </div>

                <div class="anala" id="anala">
                    <h2 id='analh1'>Analyse the</h2>

                    <div class="dropdown" id = 'anald1'>
                      <button type="button" class="dropdown-toggle">Select Option ⌄</button>
                      <div class="dropdown-menu">
                        <a href="#">Mode</a>
                        <a href="#">Mean</a>
                        <a href="#">Max</a>
                        <a href="#">Trend</a>
                        <a href="#">Min</a>
                        <a href="#">Min</a>
                      </div>
                    </div>

                    <h2 id='analh2'>of</h2>

                    <div class="dropdown"  id = 'anald2'>
                      <button type="button" class="dropdown-toggle">Select Option ⌄</button>
                      <div class="dropdown-menu">
                      <?php

                    foreach ($columns as $col) {
                        echo "<a href='#'>" . htmlspecialchars($col) . "</a>";
                    }

                    ?>
                      </div>
                    </div>

                    
                    
                </div>


                <div class="charta" id="charta">
                    <h2 id='charh1'>Create a</h2>

                    <div class="dropdown" id = 'chartd1'>
                      <button type="button" class="dropdown-toggle">Select Option ⌄</button>
                      <div class="dropdown-menu">
                        <a href="#">Option 1</a>
                        <a href="#">Option 2</a>
                        <a href="#">Option 3</a>
                        <a href="#">Option 4</a>
                      </div>
                    </div>

                    <h2 id='charh2'>with</h2>

                    <h2 id='charh3' >X:</h2>
                    <div class="dropdown"  id = 'chartd2'>
                      <button type="button" class="dropdown-toggle" id="chartoggle">Select Option ⌄</button>
                      <div class="dropdown-menu">
                      <?php

                    foreach ($columns as $col) {
                        echo "<a href='#'>" . htmlspecialchars($col) . "</a>";
                    }

                    ?>
                      </div>
                    </div>

                    <h2 id='charh4' >and Y:</h2>
                    <div class="dropdown"  id = 'chartd3'>
                      <button type="button" class="dropdown-toggle">Select Option ⌄</button>
                      <div class="dropdown-menu"> 
                      <?php

                    foreach ($columns as $col) {
                        echo "<a href='#'>" . htmlspecialchars($col) . "</a>";
                    }

                    ?>
                      </div>
                    </div>
                </div>
            <input type="hidden" name="choice" id="choice" value="">
            <input type="hidden" name="an1" id="an1" value="">
            <input type="hidden" name="ch1" id="ch1" value="">
            <input type="hidden" name="ch2" id="ch2" value="">
            <input type="hidden" name="ch3" id="ch3" value="">
            <input type="hidden" name="ch4" id="ch4" value="">
            <input type="hidden" name="an2" id="an2" value="">
            <input type="submit" value="Send" id = "submit">
            </form>
            
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
            // Close other dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.remove('show'));
            // Toggle this one
            const menu = this.nextElementSibling;
            menu.classList.toggle('show');
        });
    });

    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault(); // stop the link from navigating

            // Find the closest dropdown container
            const dropdown = this.closest('.dropdown');
            // Find the toggle button inside this dropdown
            const button = dropdown.querySelector('.dropdown-toggle');
            // Update its text
            button.textContent = this.textContent;
            
            // Close the menu
            dropdown.querySelector('.dropdown-menu').classList.remove('show');
        });
    });

    // Click outside to close
    window.addEventListener('click', () => {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const chartButton = document.getElementById('chart');
    const chartaElement = document.getElementById('charta');
    const defaultElement = document.getElementById('default');

    if (chartButton && chartaElement && defaultElement) { // Check if elements exist
        chartButton.addEventListener('click', () => {
            console.log("Chart button clicked!");
            document.getElementById("choice").value="Chart"
            chartaElement.style.display = "flex";
            defaultElement.style.display = "none";
            document.getElementById("charh1").style.display="block";
            document.getElementById("charh2").style.display="block";
            document.getElementById("charh3").style.display="block";
            document.getElementById("charh4").style.display="block";
            document.getElementById("chartd3").style.display="block";
            document.getElementById("chartd2").style.display="block";
            document.getElementById("chartd1").style.display="block";
            document.getElementById("submit").style.display="block";
            document.getElementById("analh1").style.display="none";
            document.getElementById("analh2").style.display="none";
            document.getElementById("submit").style.marginTop="40px";
            document.getElementById("anald2").style.display="none";
            document.getElementById("anald1").style.display="none";
        });
    } else {
        console.error("One or more elements not found!");
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const chartButton = document.getElementById('analyse');
    const chartaElement = document.getElementById('anala');
    const defaultElement = document.getElementById('default');

    if (chartButton && chartaElement && defaultElement) { // Check if elements exist
        chartButton.addEventListener('click', () => {
            console.log("Analyse button clicked!");
            document.getElementById("choice").value="Analyse"
            chartaElement.style.display = "flex";
            defaultElement.style.display = "none";
            document.getElementById("analh1").style.display="block";
            document.getElementById("analh2").style.display="block";
           
            document.getElementById("anald2").style.display="block";
            document.getElementById("anald1").style.display="block";
            document.getElementById("charta").style.display="none";
            document.getElementById("charh1").style.display="none";
            document.getElementById("charh2").style.display="none";
            document.getElementById("charh3").style.display="none";
            document.getElementById("charh4").style.display="none";
            document.getElementById("chartd3").style.display="none";
            document.getElementById("chartd2").style.display="none";
            document.getElementById("chartd1").style.display="none";
            document.getElementById("submit").style.marginTop="0px";
            document.getElementById("submit").style.display="block";
        });
    } else {
        console.error("One or more elements not found!");
    }
});
</script>
</body>
</html>