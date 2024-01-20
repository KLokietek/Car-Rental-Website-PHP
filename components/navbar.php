<nav>
            <a href="index.php"><img src="../images/carlogo.png" alt=""></a>
            <div class="nav-links" id="navlinks">              
                    <i class='bx bx-x' onclick="hideMenu()"></i>    
                    <ul>
                        <?php 
                        if(isset($_SESSION["auth_user"]) && $_SESSION["auth_user"]["role"]==2){
                            echo '<li> <a href="index.php"> Strona główna </a> </li>';   
                            echo '<li> <a href="user_list.php"> Lista użytkowników </a> </li>';
                            echo '<li> <a href="car_admin_list.php"> Lista samochodów </a> </li>';
                        }
                        else{
                        ?>
                        <li><a href="index.php">Strona Główna</a></li>
                        <li><a href="offers.php">Oferta</a></li>
                        <?php
                        }
                            if(isset($_SESSION["auth_user"])){
                                echo '<li><a href="./rent_List.php">' . $_SESSION['auth_user']['name'] . '</a></li>';
                                echo '<li><a href="../scripts/logout.php">Wyloguj się</a></li>';

                            }
                            else{
                                echo '<li><a href="logandreg.php">Zaloguj się | Załóż konto </a></li>';
                            }
                        ?>
                        
                        
                        
                    </ul>
            </div>
            <i class='bx bx-menu' onclick="showMenu()"></i>
</nav>
<script>
    var navLinks= document.getElementById("navlinks");
    function showMenu(){
        navLinks.style.right="0";
     }
    function hideMenu(){
        navlinks.style.right="-1000px";
    }
</script>