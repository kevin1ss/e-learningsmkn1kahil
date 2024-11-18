<?php
@session_start();
include "+koneksi.php";

if(!@$_SESSION['siswa']) {
    if(@$_GET['hal'] == 'daftar') {
        include "register.php";
    } else {
        include "login.php";
    }
} else { ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>E-Learning V2.1</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="style/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
 
 #cameraFeed {
     width: 20%;
     height: 20%;
     border: 4px solid green;
     background-color: #666;
     border-radius: 500px;
 }
 </style>
</style>
</head>
<body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php
$sql_terlogin = mysqli_query($db, "SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_siswa = '$_SESSION[siswa]' AND tb_kelas.id_kelas = tb_siswa.id_kelas") or die ($db->error);
$data_terlogin = mysqli_fetch_array($sql_terlogin);
?>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    Selamat datang, <b><?php echo ucfirst($data_terlogin['username']); ?></b>.  
                    <div class="float-right"><a href="inc/logout.php?sesi=siswa" class="btn btn-xs btn-danger">Logout</a></div>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
         

            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                            </a>
                            <div class="dropdown-menu dropdown-settings">
                                <div class="media">
                                    <a class="media-left" href="#">
                                        <img src="img/foto_siswa/<?php echo $data_terlogin['foto']; ?>" class="img-rounded" />
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo $data_terlogin['nama_lengkap']; ?></h4>
                                        <h5>Kelas : <?php echo $data_terlogin['nama_kelas']; ?></h5>
                                    </div>
                                </div>
                                <hr />
                                <center><a href="?hal=detailprofil" class="btn btn-info btn-sm">Detail Profile</a> <a href="?hal=editprofil" class="btn btn-primary btn-sm">Edit Profile</a></center>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="menu-section">

        <div class="container">
                            <a class="btn btn-sm btn-primary"<?php if(@$_GET['page'] == '') { echo 'class="menu-top-active"'; } ?> href="./">Beranda</a>
                            <a class="btn btn-sm btn-primary"<?php if(@$_GET['page'] == 'quiz') { echo 'class="menu-top-active"'; } ?> href="?page=quiz">Tugas / Quiz</a>
                            <a class="btn btn-sm btn-primary"<?php if(@$_GET['page'] == 'materi') { echo 'class="menu-top-active"'; } ?> href="?page=materi">Materi</a>
							<a class="btn btn-sm btn-primary"<?php if(@$_GET['page'] == 'nilai') { echo 'class="menu-top-active"'; } ?> href="?page=nilai">Nilai</a>
                            <a class="btn btn-sm btn-primary"<?php if(@$_GET['page'] == 'berita') { echo 'class="menu-top-active"'; } ?> href="?page=berita">Berita</a>
        </div>
    </section>

    <div class="content-wrapper">
        <div class="container" id="wadah">
        <?php
        if(@$_GET['page'] == '') {
            include "inc/beranda.php";
        } else if(@$_GET['page'] == 'quiz') {
            include "inc/quiz.php";
        } else if(@$_GET['page'] == 'nilai') {
            include "inc/nilai.php";
        } else if(@$_GET['page'] == 'materi') {
            include "inc/materi.php";
        } else if(@$_GET['page'] == 'berita') {
            include "inc/berita.php";
        } ?>
        </div>
    </div>
    <center>
    <video id="cameraFeed" autoplay></video>
    </center>
    <script src="js/controllercamera.js"></script>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; UPDATE BY IKENA
                </div>

            </div>
        </div>
    </footer>
</body>
</html>
<?php
}
?>