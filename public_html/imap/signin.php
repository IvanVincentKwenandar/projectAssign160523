<?php
    require "connect.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $user=$_POST['nrp'];
        $pass=$_POST['password'];
        // var_dump($user.' '.$pass);exit;
        $imap=false;
        $timeout=30;
        $fp = fsockopen ($host='john.petra.ac.id',$port=110,$errno,$errstr,$timeout);
        $errstr = fgets ($fp);
        // var_dump($errstr);exit;
        if (substr ($errstr,0,1) == '+'){
            fputs ($fp,"USER ".$user."\n");
            $errstr = fgets ($fp);
            if (substr ($errstr,0,1) == '+'){
                fputs ($fp,"PASS ".$pass."\n");
                $errstr = fgets ($fp);
                if (substr ($errstr,0,1) == '+'){
                    $imap=true;
                }
            }
        }
    }
    
    if($imap){
        $nrp = substr($_POST["nrp"], 0, 9);
        $nrp1 = $_POST["nrp"];
        $_SESSION['nrp_panitia']=$_POST["nrp"];
            $getdata = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM panitia WHERE nrp = '$nrp'"));
            $_SESSION['nama_panitia'] = $getdata['nama_panitia'];
            $getdata2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM divisi WHERE id_divisi = ".$getdata['id_divisi']));
            $_SESSION['divisi'] = $getdata2['nama_divisi'];
            // var_dump("BISA LOGIN");
            header("Location: homepage.php");
    }
    else {
        header("Location: index.php?stat=2");
    }
