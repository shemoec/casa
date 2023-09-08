<?php 
    include_once "../init.php";
    if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
    }
    include_once 'skeleton.php'; 

    $message = "";

    if(isset($_POST['submitContribution'])) {
        $userId = $_POST['user'];
        $amount = $_POST['amount'];
        $date = $_POST['contributionDate'];  // <-- Nueva línea para obtener la fecha

        // Llamada a la función para insertar el aporte
        $base = new Base($pdo); // Asegúrate de tener $pdo definido en "init.php"
        $base->addContribution($userId, $amount, $date);  // <-- Modifica la función para aceptar la fecha

        $message = "Contribution added successfully!";
    }
?>

<div class="wrapper">
    <div class="row">
        <div class="col-12 col-m-12 col-sm-12">
            <div class="card">
                <div class="counter"  style="height: 40vh; display: flex; align-items: center; justify-content: center;">
                    <form action="12-contributions.php" method="post"> 
                        <p style="font-size: 1.4em; color:black; font-family:'Source Sans Pro'">
                            Register Monthly Contribution:
                        </p><br>
                        
                        <!-- Lista desplegable de usuarios -->
                        <select name="user" required>
                            <option value="">Select User</option>
                            <?php
                                $users = $getFromU->getAllUsers();
                                foreach($users as $user) {
                                    echo "<option value='{$user->UserId}'>{$user->Full_Name}</option>";
                                }
                            ?>
                        </select><br><br>
                               <!-- Añadir un input para la fecha -->
                        <input type="date" name="contributionDate" required/><br><br>

                        <p style="color: green;"><?php echo $message; ?></p> <!-- Mensaje de éxito -->
                        <!-- Cambiar el input de monto -->
                        <input type='number' step='0.01' name="amount" placeholder="Enter Contribution Amount" required/><br><br><br>
                        <button type="submit" name="submitContribution" class="pressbutton">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../static/js/12-contributions.js"></script>
