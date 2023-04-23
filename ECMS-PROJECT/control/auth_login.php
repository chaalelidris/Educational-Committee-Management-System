<?php
include("config/dbcon.php");
if (isset($_POST['user_submit'])) {
    // code...
    error_reporting(0);
    extract($_POST);

    if (empty($username) & empty($password)) {
        header('location:../index.php?username='.$username.'& erroru=Nom utilisateur obligatoire & errorm=Mot de passe obligatoire');
    } elseif (empty($password)) {
        header('location:../index.php?username='.$username.'& errorm=Mot de passe obligatoire');
    } elseif (empty($username)) {
        header('location:../index.php?username='.$username.'& erroru=Nom utilisateur obligatoire');
    } else {
        $pass1 = mysqli_real_escape_string($con, $password);
        $date=date('Y-m-d h:i:s');
        $pass=md5($pass1);
        $password=$pass;

        $query=mysqli_query($con, "SELECT * from tbl_users where user_name='$username' LIMIT 1 ");
        $row=mysqli_fetch_assoc($query); //tableau
        $num=mysqli_num_rows($query);


        if ($num>0) {

            if ($row['user_pass']==$password) {
                session_start();
                if ($row['user_type']=="super_admin") {
                    //$details=$row['user_fulname']." s'est connecté au systèm ";
                    //mysqli_query("INSERT into tbl_history values('','$row[user_id]','$details','$date')");


                    $_SESSION['super_admin_user_id']=$row['user_id'];
                    $_SESSION['super_admin_user_name']=$row['user_name'];
                    $_SESSION['super_admin_user_fullname']=$row['user_fullname'];
                    header('location:../super-admin/dashboard.php');
                } elseif ($row['user_type']=="admin") {
                    //$details=$row['user_fulname']." s'est connecté au systèm ";
                    //mysqli_query("INSERT into tbl_history values('','$row[user_id]','$details','$date')");

                    // Admin ID
                    $admin_id = $row['user_id'];

                    $_SESSION['admin_user_id']=$admin_id;
                    $_SESSION['admin_user_name']=$row['user_name'];
                    $_SESSION['admin_user_fullname']=$row['user_fullname'];


                    // SQL query to select department ID
                    $sql = "SELECT department_id FROM tbl_department WHERE admin_id = '$admin_id'";
                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                    $row_department_id = mysqli_fetch_array($result);

                    $_SESSION['admin_department_id']=$row_department_id['department_id'];

                    header('location:../admin/dashboard.php');
                } elseif ($row['user_type']=="1") {
                    //$details=$row['user_fulname']." s'est connecté au systèm ";
                    //mysqli_query("INSERT into tbl_history values('','$row[user_id]','$details','$date')");
                    $_SESSION['responsable_user_id']=$row['user_id'];
                    $_SESSION['responsable_user_name']=$row['user_name'];
                    $_SESSION['responsable_user_fullname']=$row['user_fullname'];

                    $respid = $row['user_id'];
                    $sql = "SELECT prom_id FROM tbl_promo WHERE prom_resp_id='$respid'";
                    $result1 = mysqli_query($con, $sql) or die(mysqli_error($con));
                    $rowprom = mysqli_fetch_array($result1);

                    $_SESSION['responsable_prom_id']=$rowprom['prom_id'];

                    header('location:../responsable/responsable.php');
                } elseif ($row['user_type']=="2") {
                    $_SESSION['enseignant_user_id']=$row['user_id'];
                    $_SESSION['enseignant_user_name']=$row['user_name'];
                    $_SESSION['enseignant_user_fullname']=$row['user_fullname'];

                    $ensid = $row['user_id'];
                    $query=mysqli_query($con, "SELECT * from tbl_module where modl_ens_id='$ensid' LIMIT 1 ");
                    $rowprmid=mysqli_fetch_assoc($query); //tableau
                    $_SESSION['enseignant_promotion_id']=$rowprmid['modl_promo_id'];
                    header('location:../enseignant/enseignant.php');
                } elseif ($row['user_type']=="3") {
                    $_SESSION['delegue_user_id']=$row['user_id'];
                    $_SESSION['delegue_user_name']=$row['user_name'];
                    $_SESSION['delegue_user_fullname']=$row['user_fullname'];

                    $delid = $row['user_id'];
                    $query=mysqli_query($con, "SELECT * from tbl_delegation where delegation_del_id='$delid' LIMIT 1 ");
                    $rowprmid=mysqli_fetch_assoc($query); //tableau
                    $_SESSION['delegue_promotion_id']=$rowprmid['delegation_prom_id'];


                    header('location:../delegue/delegue.php');
                }else{
                    header('location:../index.php?username='.$username.'&errorlog=Utilisateur inconnu');
                }
            }else {
              header('location:../index.php?username='.$username.'&errorlog=Mot de passe incorrect');
            }
        } else {
            header('location:../index.php?username='.$username.'&errorlog=Nom utilisateur incorrect');
        }
    }
}
