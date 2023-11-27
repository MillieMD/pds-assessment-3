<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>The Poppleton Dog Show</title>

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">

  </head>
  <body>

    <div class = header>

        <!-- Logo, website title and sign up/register/enter 2024 button -->
        <div class = "upper-header" id = "upper-header">

            <!-- Logo -->
            <div class = "header-title">
                <!-- Title -->
                <div> The Poppleton Dog Show </div> 
            </div>

            <button class = "white-button"> Enter 2024</button>

        </div>

        <!-- Events, dogs, previous winners etc. -->
        <div class = "lower-header">

            <a href = "#"> Events </a>
            <a href = "pages/dogs.php"> Competitors </a>
            <a href = "#"> Previous Winners </a>

        </div>

    </div>

    <div class = "main-body">

        <!-- Dog Image -->
        <div class = "landing-image-wrapper">

            <img src="img/dog.jpg" alt="Dog agility competition">

            <!-- Box containing XYZ -->
            <div class = "stat-display-box">

                <h1> Welcome to The Popptleton Dog Show! <h1>

                <?php

                    require_once "php/database.php";

                    $query = $db->prepare("SELECT count(DISTINCT entries.dog_id) as dogs, count(DISTINCT entries.competition_id) as events, count(DISTINCT dogs.owner_id) as owners FROM entries, dogs WHERE entries.dog_id = dogs.id;");
                    $query->execute();
                    $result = $query->get_result();

                    if($result === FALSE){
                        die("no result");
                    }

                    if($result->num_rows <= 0){ // No rows found
                        die("no dogs?");
                    }

                    $row = $result->fetch_assoc();

                    echo("<h3>This year, " .$row["owners"]. " owners have entered " .$row["dogs"]. " dogs, into " .$row["events"]. " events!</h1>");
                
                ?>
                
            </div>

        </div>

        <!-- 10 dogs, with view profile buttons (link to owners profile) -->
        <h1> Our Top Competitors</h1>

        <div class = "gallery-container" id = "dog-gallery">

        <?php
            
            // Provides database access
            require_once "php/database.php";

            // Select the dogs name, breed, average score and owner details of the top 10 dogs
            $query = $db->prepare("SELECT dogs.name as dog, breeds.name as breed, owners.id as owner_id, owners.name as owner, owners.email as email FROM dogs, breeds, owners WHERE dogs.breed_id = breeds.id AND dogs.owner_id = owners.id ORDER BY dogs.id LIMIT 10;");
            $query->execute();
            $result = $query->get_result();

            if($result === FALSE){
                die("no result");
            }

            if($result->num_rows <= 0){ // No rows found
                die("no dogs?");
            }

            $i = 0;
            while ($row = $result->fetch_assoc()){
                
                echo("<div class = 'profile' id = 'profile-$i'>

                    <img src = 'img/dogprofileplaceholder.png'>

                    <div> 
                        <p class = 'profile-name'> " .$row['dog']. " </p>
                        <p class = 'profile-subtitle'> " .$row['breed']. " </p>
                        <p class = 'profile-score'>  9.8 </p>
                    </div>

                    <div>
                        <a href = ' pages/profile.php?owner=".$row["owner_id"]. " '> <p clas = 'profile-subtitle'> " .$row['owner']. " </p> </a>
                        <a href = 'mailto: " .$row['email']. "'> " .$row['email']. " </a>
                    </div>

                </div>");
            $i++;
            }
        
        ?>

        </div>

        <div hidden class = "gallery-container" id = "owner-gallery">

        <?php
            
            // Provides database access
            require_once "php/database.php";

            // Select the dogs name, breed, average score and owner details of the top 10 dogs
            $query = $db->prepare("SELECT dogs.name as dog, breeds.name as breed, owners.id as owner_id owners.name as owner, owners.email as email FROM dogs, breeds, owners WHERE dogs.breed_id = breeds.id AND dogs.owner_id = owners.id ORDER BY dogs.id LIMIT 10;");
            $query->execute();
            $result = $query->get_result();

            if($result === FALSE){
                die("no result");
            }

            if($result->num_rows <= 0){ // No rows found
                die("no dogs?");
            }

            while ($row = $result->fetch_assoc()){
                
                echo("<div class = 'profile' id = 'profile-$i'>

                    <img src = 'img/dogprofileplaceholder.png'>

                    <div> 
                        <p class = 'profile-name'> " .$row['dog']. " </p>
                        <p class = 'profile-subtitle'> " .$row['breed']. " </p>
                        <p class = 'profile-score'>  9.8 </p>
                    </div>

                    <div>
                        <a href = '" .$row["owner_id"]. "'> <p clas = 'profile-subtitle'> " .$row['owner']. " </p> </a>
                        <a href = '#'> " .$row['email']. " </a>
                    </div>

                </div>");

            $i++;


            }

        ?>

        </div>

    </div>

    <!-- "More" button 
    (link to full dog list, alphabetised)-->
    <button class = "purple-button" style = "font-size: 1.5em;"> More </button>

    </div> <!-- End of main body -->

    <div class = "footer"> 

        <!-- Social media icons as links -->
        <div class = "social-media-wrapper"> 

            <!-- Social media icons from SVGRepo:
            
            FB: primefaces
            Twitter: Konstantin Filatov
            Instagram: Ankush Syal
            -->

            <!-- FACEBOOK -->
            <svg width="2vw" height="2vw" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 12.05C19.9813 10.5255 19.5273 9.03809 18.6915 7.76295C17.8557 6.48781 16.673 5.47804 15.2826 4.85257C13.8921 4.2271 12.3519 4.01198 10.8433 4.23253C9.33473 4.45309 7.92057 5.10013 6.7674 6.09748C5.61422 7.09482 4.77005 8.40092 4.3343 9.86195C3.89856 11.323 3.88938 12.8781 4.30786 14.3442C4.72634 15.8103 5.55504 17.1262 6.69637 18.1371C7.83769 19.148 9.24412 19.8117 10.75 20.05V14.38H8.75001V12.05H10.75V10.28C10.7037 9.86846 10.7483 9.45175 10.8807 9.05931C11.0131 8.66687 11.23 8.30827 11.5161 8.00882C11.8022 7.70936 12.1505 7.47635 12.5365 7.32624C12.9225 7.17612 13.3368 7.11255 13.75 7.14003C14.3498 7.14824 14.9482 7.20173 15.54 7.30003V9.30003H14.54C14.3676 9.27828 14.1924 9.29556 14.0276 9.35059C13.8627 9.40562 13.7123 9.49699 13.5875 9.61795C13.4627 9.73891 13.3667 9.88637 13.3066 10.0494C13.2464 10.2125 13.2237 10.387 13.24 10.56V12.07H15.46L15.1 14.4H13.25V20C15.1399 19.7011 16.8601 18.7347 18.0985 17.2761C19.3369 15.8175 20.0115 13.9634 20 12.05Z" fill="#000000"/>
            </svg>

            <!-- TWITTER (X) -->
            <svg width="2vw" height="2vw" viewBox="0 -2 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    
                <title>twitter [#154]</title>
                <desc>Created with Sketch.</desc>
                <defs>
            
            </defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Dribbble-Light-Preview" transform="translate(-60.000000, -7521.000000)" fill="#000000">
                        <g id="icons" transform="translate(56.000000, 160.000000)">
                            <path d="M10.29,7377 C17.837,7377 21.965,7370.84365 21.965,7365.50546 C21.965,7365.33021 21.965,7365.15595 21.953,7364.98267 C22.756,7364.41163 23.449,7363.70276 24,7362.8915 C23.252,7363.21837 22.457,7363.433 21.644,7363.52751 C22.5,7363.02244 23.141,7362.2289 23.448,7361.2926 C22.642,7361.76321 21.761,7362.095 20.842,7362.27321 C19.288,7360.64674 16.689,7360.56798 15.036,7362.09796 C13.971,7363.08447 13.518,7364.55538 13.849,7365.95835 C10.55,7365.79492 7.476,7364.261 5.392,7361.73762 C4.303,7363.58363 4.86,7365.94457 6.663,7367.12996 C6.01,7367.11125 5.371,7366.93797 4.8,7366.62489 L4.8,7366.67608 C4.801,7368.5989 6.178,7370.2549 8.092,7370.63591 C7.488,7370.79836 6.854,7370.82199 6.24,7370.70483 C6.777,7372.35099 8.318,7373.47829 10.073,7373.51078 C8.62,7374.63513 6.825,7375.24554 4.977,7375.24358 C4.651,7375.24259 4.325,7375.22388 4,7375.18549 C5.877,7376.37088 8.06,7377 10.29,7376.99705" id="twitter-[#154]">
            
            </path>
                        </g>
                    </g>
                </g>
            </svg>

            <!-- INSTAGRAM -->
            <svg width="2vw" height="2vw" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z" fill="#0F0F0F"/>
                <path d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z" fill="#0F0F0F"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65396 4.27606C1 5.55953 1 7.23969 1 10.6V13.4C1 16.7603 1 18.4405 1.65396 19.7239C2.2292 20.8529 3.14708 21.7708 4.27606 22.346C5.55953 23 7.23969 23 10.6 23H13.4C16.7603 23 18.4405 23 19.7239 22.346C20.8529 21.7708 21.7708 20.8529 22.346 19.7239C23 18.4405 23 16.7603 23 13.4V10.6C23 7.23969 23 5.55953 22.346 4.27606C21.7708 3.14708 20.8529 2.2292 19.7239 1.65396C18.4405 1 16.7603 1 13.4 1H10.6C7.23969 1 5.55953 1 4.27606 1.65396C3.14708 2.2292 2.2292 3.14708 1.65396 4.27606ZM13.4 3H10.6C8.88684 3 7.72225 3.00156 6.82208 3.0751C5.94524 3.14674 5.49684 3.27659 5.18404 3.43597C4.43139 3.81947 3.81947 4.43139 3.43597 5.18404C3.27659 5.49684 3.14674 5.94524 3.0751 6.82208C3.00156 7.72225 3 8.88684 3 10.6V13.4C3 15.1132 3.00156 16.2777 3.0751 17.1779C3.14674 18.0548 3.27659 18.5032 3.43597 18.816C3.81947 19.5686 4.43139 20.1805 5.18404 20.564C5.49684 20.7234 5.94524 20.8533 6.82208 20.9249C7.72225 20.9984 8.88684 21 10.6 21H13.4C15.1132 21 16.2777 20.9984 17.1779 20.9249C18.0548 20.8533 18.5032 20.7234 18.816 20.564C19.5686 20.1805 20.1805 19.5686 20.564 18.816C20.7234 18.5032 20.8533 18.0548 20.9249 17.1779C20.9984 16.2777 21 15.1132 21 13.4V10.6C21 8.88684 20.9984 7.72225 20.9249 6.82208C20.8533 5.94524 20.7234 5.49684 20.564 5.18404C20.1805 4.43139 19.5686 3.81947 18.816 3.43597C18.5032 3.27659 18.0548 3.14674 17.1779 3.0751C16.2777 3.00156 15.1132 3 13.4 3Z" fill="#0F0F0F"/>
            </svg>

        </div>

        <!-- Footer
            Contains: about, contact etc -->
        <div class = "footer-info"> 

            <div> About us </div>
            <div> Contact us </div>
            <div> Privacy Policy </div>
            <div> Copyright Notice </div>
            <div> Modern Slavery Agreement </div>

        </div>

    </div>
	
    <!-- Toggle between dog and owner list -->
    <script> 

    let galleryToggle = document.getElementById("gallery-toggle");



    </script>

  </body>
</html>