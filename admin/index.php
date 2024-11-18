<?php
@session_start();
include "../+koneksi.php";

if(@$_SESSION['admin'] || @$_SESSION['pengajar']) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php cek_session("Halaman Administrator", "Halaman Pengajar"); ?> e-Learning</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <style type="text/css">
    .link:hover { cursor:pointer; }
    </style>
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" role="navigation">
    <div class="navbar-header">
                <a class="navbar-brand" href="./"><?php cek_session("Administrator", "Pengajar"); ?></a>
            </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      <a class="btn btn-success<?php if(@$_GET['page'] == '') { echo 'active-menu'; } ?>" href="./">Dashboard</a>
      </li>
      <?php
                    if(@$_SESSION['admin']) {
                    ?>
                        <li>
                    
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?page=pengajar" class=" nav-link<?php if(@$_GET['page'] == 'pengajar') { echo 'active-menu'; } ?>">Manajemen Pengajar</a>
                                </li>
                                <br>
                                <li>
                                    <a href="?page=siswa" class="nav-link<?php if(@$_GET['page'] == 'siswa') { echo 'active-menu'; } ?>">Manajemen Siswa</a>
                                </li>
                                <br>
                                <li>
                                    <a href="?page=siswaregistrasi" class="nav-link<?php if(@$_GET['page'] == 'siswaregistrasi') { echo 'active-menu'; } ?>">Registrasi Siswa</a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menu
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item<?php if(@$_GET['page'] == 'kelas') { echo 'active-menu'; } ?>" href="?page=kelas"><i class="fa fa-table"></i> Manajemen Kelas</a>
                        <a class="dropdown-item<?php if(@$_GET['page'] == 'mapel') { echo 'active-menu'; } ?>" href="?page=mapel"><i class="fa fa-fw fa-file"></i> Mata Pelajaran</a>
                        <a class="dropdown-item<?php if(@$_GET['page'] == 'quiz') { echo 'active-menu'; } ?>" href="?page=quiz"><i class="fa fa-bar-chart-o"></i> Manajemen Tugas / Quiz</a>
                        <a class="dropdown-item<?php if(@$_GET['page'] == 'materi') { echo 'active-menu'; } ?>" href="?page=materi"><i class="fa fa-qrcode"></i> Materi</a>
                        <a class="dropdown-item<?php if(@$_GET['page'] == 'berita') { echo 'active-menu'; } ?>" href="?page=berita"><i class="fa fa-desktop"></i> Berita</a>
        </div>
                    </li>
    </ul>
    
  </div>
                    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <li class="nav-item">
          <?php
                        if(@$_SESSION['admin']) {
                            $sesi_id = @$_SESSION['admin'];
                            $level = "admin";
                        } else if(@$_SESSION['pengajar']) {
                            $sesi_id = @$_SESSION['pengajar'];
                            $level = "pengajar";
                        }

                        if($level == 'admin') {
                            $sql_terlogin = mysqli_query($db, "SELECT * FROM tb_admin WHERE id_admin = '$sesi_id'") or die ($db->error);
                        } else if($level == 'pengajar') {
                            $sql_terlogin = mysqli_query($db, "SELECT * FROM tb_pengajar WHERE id_pengajar = '$sesi_id'") or die ($db->error);
                        }
                        $data_terlogin = mysqli_fetch_array($sql_terlogin);
                        echo ucfirst($data_terlogin['username']);
                        ?>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="?hal=editprofil"><i class="fa fa-user fa-fw"></i> Edit Profil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php cek_session('../inc/logout.php?sesi=admin', '../inc/logout.php?sesi=pengajar'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a href="<?php cek_session('../inc/logout.php?sesi=admin', '../inc/logout.php?sesi=pengajar'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
        </div>
      </li>
</nav>

    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
    
        </nav>
<div class="container">
    
<div id="page-wrapper">
            <div id="page-inner">
                
                <?php
                if(@$_GET['page'] == '') {
                    include "inc/dashboard.php";
                } else if(@$_GET['page'] == 'pengajar') {
                    include "inc/pengajar.php";
                } else if(@$_GET['page'] == 'siswaregistrasi') {
                    include "inc/siswaregistrasi.php";
                } else if(@$_GET['page'] == 'siswa') {
                    include "inc/siswa.php";
                } else if(@$_GET['page'] == 'kelas') {
                    include "inc/kelas.php";
                } else if(@$_GET['page'] == 'mapel') {
                    include "inc/mapel.php";
                } else if(@$_GET['page'] == 'quiz') {
                    include "inc/quiz.php";
                } else if(@$_GET['page'] == 'materi') {
                    include "inc/materi.php";
                } else if(@$_GET['page'] == 'berita') {
                    include "inc/berita.php";
                } else {
                    echo "<div class='col-xs-12'><div class='alert alert-danger'>[404] Halaman tidak ditemukan! Silahkan pilih menu yang ada!</div></div>";
                } ?>
                
				<footer><p> &copy; IKENA CORP WEBSERVERLES</p></footer>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
} else {
 include "login.php";
}
?>