<?php 
include 'fabinde.php';
?>
<div class="row">
<?php
    $today_revenu = 0;
    $date = date('Y-m-d');

    $check = mysqli_query($con,"SELECT * FROM transactions WHERE transaction_date='$date' ");
    $today_revenu = 0;
    if(mysqli_num_rows($check) >= 1)
    {
        while($re = mysqli_fetch_assoc($check))
        {
            $today_revenu = $today_revenu + intval($re['amount']);
        }
    }
    else
    {
        $today_revenu = 0;
    }
?>
<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget">
        <span class="dash-widget-bg1">&#8358;</span>
        <div class="dash-widget-info text-right">
            <h3><?php echo $today_revenu; ?></h3>
            <span class="mx-4" style="color: #009efb;">Today's</span>
            <span class="" style="color: #009efb;">Revenue <i class="fa fa-check" aria-hidden="true"></i></span>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <?php
    $today_debt = 0;
    $date = date('Y-m-d');
    $debt = "no";

    $check_debt = mysqli_query($con,"SELECT * FROM transactions WHERE transaction_date='$date' AND transaction_payment='$debt'");
    $today_revenu = 0;
    if(mysqli_num_rows($check_debt) >= 1)
    {
        while($re = mysqli_fetch_assoc($check_debt))
        {
            $today_debt = $today_debt + intval($re['amount']);
        }
    }
    else
    {
        $today_debt = 0;
    }
    ?>
    <div class="dash-widget">
        <span class="dash-widget-bg2" style="background-color: #ffbc35;">&#8358;</span>
        <div class="dash-widget-info text-right">
            <h3><?php echo $today_debt; ?></h3>
            <span class="mx-4" style="color: #ffbc35;">Today's</span>
            <span class="" style="color: #ffbc35;">Debt <i class="fa fa-check" aria-hidden="true"></i></span>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget">
        <?php
    $total_debt = 0;
    $date = date('Y-m-d');
    $debt = "no";

    $check_total_debt = mysqli_query($con,"SELECT * FROM transactions WHERE transaction_payment='$debt'");
    if(mysqli_num_rows($check_total_debt) >= 1)
    {
        while($re = mysqli_fetch_assoc($check_total_debt))
        {
            $total_debt = $total_debt + intval($re['amount']);
        }
    }
    else
    {
        $total_debt = "none";
    }
        ?>
        <span class="dash-widget-bg3">&#8358;</span>
        <div class="dash-widget-info text-right">
            <h3><?php echo $total_debt; ?></h3>
            <span class="mx-4" style="color: #7a92a3;">Total</span>
            <span class="" style="color: #7a92a3;">Debt <i class="fa fa-check" aria-hidden="true"></i></span>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <?php
    $total_rev = 0;
    $debt = "yes";

    $check_total_rev = mysqli_query($con,"SELECT * FROM transactions WHERE transaction_payment='$debt'");
    if(mysqli_num_rows($check_total_rev) >= 1)
    {
        while($re = mysqli_fetch_assoc($check_total_rev))
        {
            $total_rev = $total_rev + intval($re['amount']);
        }
    }
    else
    {
        $total_rev = "none";
    }
?>
    <div class="dash-widget">
        <span class="dash-widget-bg4" style="background-color: #55ce63;">&#8358;</span>
        <div class="dash-widget-info text-right">
            <h3><?php echo $total_rev; ?></h3>
            <span class="mx-4" style="color: #55ce63;">Total</span>
            <span class="" style="color: #55ce63;">Revenue<i class="fa fa-check" aria-hidden="true"></i></span>
        </div>
    </div>
</div>
</div>
<?php
?>