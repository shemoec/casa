<?php 
    include_once "../init.php";

    // Verificar inicio de sesión de usuario
    if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
    }

    include_once 'skeleton.php'; 

    // Mostrar notificaciones, si las hay
    if (isset($_SESSION['swal'])) {
        echo $_SESSION['swal'];
        unset($_SESSION['swal']);
    }

    // Comprobar validez del presupuesto 
    $budget_validity = $getFromB->budget_validity_checker($_SESSION['UserId']);
    if($budget_validity == false) {
        $getFromB->del_budget_record($_SESSION['UserId']);
    }

    // Obtener y procesar gastos y presupuesto
    // [Notación condicional reducida para simplificar el código]
    $today_expense = $getFromE->Expenses($_SESSION['UserId'], 0) ?? "No Expenses Logged Today";
    $Yesterday_expense = $getFromE->Yesterday_expenses($_SESSION['UserId']) ?? "No Expenses Logged Yesterday";
    $week_expense = $getFromE->Expenses($_SESSION['UserId'], 6) ?? "No Expenses Logged This Week";
    $monthly_expense = $getFromE->Expenses($_SESSION['UserId'], 29) ?? "No Expenses This Month";
    $total_expenses = $getFromE->totalexp($_SESSION['UserId']) ?? "No Expenses Logged Yet";

    $budget_left = $getFromB->checkbudget($_SESSION['UserId']);
    $currmonexp = $getFromE->Current_month_expenses($_SESSION['UserId']) ?? 0;
    $budget_left = $budget_left ? "$ " . ($budget_left - $currmonexp) : "Not Set Yet";

    $user1_id = 3;
    $user2_id = 4;

    $user1_contribution = $getFromU->getUserContribution($user1_id) ?? 0;  // Por defecto, contribución 0 si es NULL
    $user2_contribution = $getFromU->getUserContribution($user2_id) ?? 0;

    $total_contributions = $user1_contribution + $user2_contribution;
    $user1_remaining = 910 - $user1_contribution;
    $user2_remaining = 1160 - $user2_contribution;
?>
    <div class="wrapper">
        <div class="row">
            <div class="col-4 col-m-4 col-sm-4">
                <div class="card">
                    <div class="counter bg-danger" style="color:white;">
                        <p><i class="fas fa-tasks"></i></p>
                        <h3>
                            Today's Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $today_expense ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-4 col-m-4 col-sm-4">
                <div class="card">
                    <div class="counter bg-primary" style="color:white;">
                        <p><i class="fas fa-undo-alt"></i></p>
                        <h3>
                            Yesterday's Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $Yesterday_expense ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-4 col-m-4 col-sm-4">
                <div class="card">
                    <div class="counter bg-warning" style="color:white;">
                        <p><i class="fas fa-calendar-week"></i></p>
                        <h3>
                            Last 7 day's Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $week_expense ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-4 col-m-4 col-sm-4">
                <div class="card">
                    <div class="counter bg-vio" style="color:white;">
                        <p><i class="fas fa-calendar"></i></p>
                        <h3>
                            Last 30 day's Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $monthly_expense ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-4 col-m-4 col-sm-4">
                <div class="card">
                    <div class="counter bg-success" style="color:white;">
                        <p><i class="fas fa-dollar-sign"></i></p>
                        <h3>
                            Monthly Budget Left
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $budget_left ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-4 col-m-4 col-sm-4">
                <div class="card">
                    <div class="counter bg-yell" style="color:white;">
                        <p><i class="fas fa-file-invoice-dollar" aria-hidden="true"></i></p>
                        <h3>
                            Total Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $total_expenses ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-4 col-m-4 col-sm-4">
    <div class="card">
        <div class="counter bg-success" style="color:white;">
            <p><i class="fas fa-dollar-sign"></i></p>
            <h3>
                Total User Contributions
            </h3>
            <p style="font-size: 1.2em;">
                <?php echo "$ " . $total_contributions ?>
            </p>
        </div>
    </div>
</div>

<div class="col-4 col-m-4 col-sm-4">
    <div class="card">
    <div class="counter bg-success" style="color:white;">
        <p><i class="fas fa-dollar-sign"></i></p>
            <h3>
                User 1 Remaining Contribution
            </h3>
            <p style="font-size: 1.2em;">
                <?php echo "$ " . $user1_remaining ?>
            </p>
        </div>
    </div>
</div>

<div class="col-4 col-m-4 col-sm-4">
    <div class="card">
        <div class="counter bg-success" style="color:white;">
        <p><i class="fas fa-dollar-sign"></i></p>
            <h3>
                User 2 Remaining Contribution
            </h3>
            <p style="font-size: 1.2em;">
                <?php echo "$ " . $user2_remaining ?>
            </p>
        </div>
    </div>
</div>

        </div>
    </div>