  
  <?php
    ob_start();
    //cek session
    session_start();

    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {?>
     <?php include('admin/head.php');?>
 <?php include('admin/sidebar.php');?>
 
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
   <section class="content-header">
          <h1>
            Cetak Disposisi
            <small>Data Disposisi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Disposisi</li>
          </ol>
        </section>
<?php
 echo '
        <style type="text/css">
            table {
                background: #fff;
                padding: 5px;
            }
            tr, td {
                border: table-cell;
                border: 1px  solid #444;
            }
            tr,td {
                vertical-align: top!important;
            }
            #right {
                border-right: none !important;
            }
            #left {
                border-left: none !important;
            }
            .isi {
                height: 300px!important;
            }
            .disp {
                text-align: center;
                padding: 1.5rem 0;
                margin-bottom: .5rem;
            }
            .logodisp {
                float: left;
                position: relative;
                width: 110px;
                height: 110px;
                margin: 0 0 0 1rem;
            }
            #lead {
                width: auto;
                position: relative;
                margin: 25px 0 0 75%;
            }
            .lead {
                font-weight: bold;
                text-decoration: underline;
                margin-bottom: -10px;
            }
            .tgh {
                text-align: center;
            }
            #nama {
                font-size: 2.1rem;
                margin-bottom: -1rem;
            }
            #alamat {
                font-size: 16px;
            }
            .up {
                text-transform: uppercase;
                margin: 0;
                line-height: 2.2rem;
                font-size: 1.5rem;
            }
            .status {
                margin: 0;
                font-size: 1.3rem;
                margin-bottom: .5rem;
            }
            #lbr {
                font-size: 20px;
                font-weight: bold;
            }
            .separator {
                border-bottom: 2px solid #616161;
                margin: -1.3rem 0 1.5rem;
            }
            @media print{
                body {
                    font-size: 12px;
                    color: #212121;
                }
                table {
                    width: 100%;
                    font-size: 12px;
                    color: #212121;
                }
                tr, td {
                    border: table-cell;
                    border: 1px  solid #444;
                    padding: 8px!important;

                }
                tr,td {
                    vertical-align: top!important;
                }
                #lbr {
                    font-size: 20px;
                }
                .isi {
                    height: 200px!important;
                }
                .tgh {
                    text-align: center;
                }
                .disp {
                    text-align: center;
                    margin: -.5rem 0;
                }
                .logodisp {
                    float: left;
                    position: relative;
                    width: 80px;
                    height: 80px;
                    margin: .5rem 0 0 .5rem;
                }
                #lead {
                    width: auto;
                    position: relative;
                    margin: 15px 0 0 75%;
                }
                .lead {
                    font-weight: bold;
                    text-decoration: underline;
                    margin-bottom: -10px;
                }
                #nama {
                    font-size: 20px!important;
                    font-weight: bold;
                    text-transform: uppercase;
                    margin: -10px 0 -20px 0;
                }
                .up {
                    font-size: 17px!important;
                    padding-bottom: 10px;
                
                    font-weight: normal;
                }
                .status {
                    font-size: 17px!important;
                    font-weight: normal;
                    margin-bottom: -.1rem;
                }
                #alamat {
                    margin-top: -15px;
                    font-size: 13px;
                }
                #lbr {
                    font-size: 17px;
                    font-weight: bold;
                }
                .separator {
                    border-bottom: 2px solid #616161;
                    margin: -1rem 0 1rem;
                }

            }
        </style>

        <body onload="window.print()">

        <section class="content">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">            
            <!-- general form elements -->
            <div class="box box-solid">
                <div class="box-body">
                <div id="colres">
            
                <div class="disp">';
                    $query2 = mysqli_query($config, "SELECT institusi, nama, status, alamat, logo FROM tbl_instansi");
                    list($institusi, $nama, $status, $alamat, $logo) = mysqli_fetch_array($query2);
                    if(!empty($logo)){
                        echo '<img class="logodisp" src="./upload/'.$logo.'"/>';
                    } else {
                        echo '<img class="logodisp" src="./asset/img/logo.png"/>';
                    }
                    if(!empty($institusi)){
                        echo '<h6 class="up">'.$institusi.'</h6>';
                    } else {
                        echo '<h6 class="up">BKPSDM</h6>';
                    }
                    if(!empty($nama)){
                        echo '<h5 class="up" id="nama">'.$nama.'</h5><br/>';
                    } else {
                        echo '<h5 class="up" id="nama"></h5><br/>';
                    }
                    if(!empty($status)){
                        echo '<h6 class="status">'.$status.'</h6>';
                    } else {
                        echo '<h6 class="status"></h6>';
                    }
                    if(!empty($alamat)){
                        echo '<span id="alamat">'.$alamat.'</span>';
                    } else {
                        echo '<span id="alamat">Jln Veteran</span>';
                    }
                    echo '
                </div>
                <div class="separator"></div>';

                $id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

                if(mysqli_num_rows($query) > 0){
                $no = 0;
                while($row = mysqli_fetch_array($query)){

                echo '
                    <table class="bordered" id="tbl">
                        <tbody>
                            <tr>
                                <td class="tgh" id="lbr" colspan="5">LEMBAR DISPOSISI</td>
                            </tr>
                            <tr>
                                <td id="right" width="18%"><strong>Indeks Berkas</strong></td>
                                <td id="left" style="border-right: none;" width="57%">: '.$row['indeks'].'</td>
                                <td id="left" width="25"><strong>Kode</strong> : '.$row['kode'].'</td>
                            </tr>
                            <tr>';

                                $y = substr($row['tgl_surat'],0,4);
                                $m = substr($row['tgl_surat'],5,2);
                                $d = substr($row['tgl_surat'],8,2);

                                if($m == "01"){
                                    $nm = "Januari";
                                } elseif($m == "02"){
                                    $nm = "Februari";
                                } elseif($m == "03"){
                                    $nm = "Maret";
                                } elseif($m == "04"){
                                    $nm = "April";
                                } elseif($m == "05"){
                                    $nm = "Mei";
                                } elseif($m == "06"){
                                    $nm = "Juni";
                                } elseif($m == "07"){
                                    $nm = "Juli";
                                } elseif($m == "08"){
                                    $nm = "Agustus";
                                } elseif($m == "09"){
                                    $nm = "September";
                                } elseif($m == "10"){
                                    $nm = "Oktober";
                                } elseif($m == "11"){
                                    $nm = "November";
                                } elseif($m == "12"){
                                    $nm = "Desember";
                                }
                                echo '

                                <td id="right"><strong>Tanggal Surat</strong></td>
                                <td id="left" colspan="2">: '.$d." ".$nm." ".$y.'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Nomor Surat</strong></td>
                                <td id="left" colspan="2">: '.$row['no_surat'].'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Asal Surat</strong></td>
                                <td id="left" colspan="2">: '.$row['asal_surat'].'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Isi Ringkas</strong></td>
                                <td id="left" colspan="2">: '.$row['isi'].'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Diterima Tanggal</strong></td>
                                <td id="left" style="border-right: none;">: '.$d." ".$nm." ".$y.'</td>
                                <td id="left"><strong>No. Agenda</strong> : '.$row['no_agenda'].'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Tanggal Penyelesaian</strong></td>
                                <td id="left" colspan="2">: </td>
                            </tr>
                            <tr>';
                            $query3 = mysqli_query($config, "SELECT * FROM tbl_disposisi JOIN tbl_surat_masuk ON tbl_disposisi.id_surat = tbl_surat_masuk.id_surat WHERE tbl_disposisi.id_surat='$id_surat'");

                            if(mysqli_num_rows($query3) > 0){
                                $no = 0;
                                $row = mysqli_fetch_array($query3);{
                                echo '
                            <tr class="isi">
                                <td colspan="2">
                                    <strong>Isi Disposisi :</strong><br/>'.$row['isi_disposisi'].'
                                    <div style="height: 50px;"></div>
                                    <strong>Batas Waktu</strong> : '.$d." ".$nm." ".$y.'<br/>
                                    <strong>Sifat</strong> : '.$row['sifat'].'<br/>
                                    <strong>Catatan</strong> :<br/> '.$row['catatan'].'
                                    <div style="height: 25px;"></div>
                                </td>
                                <td><strong>Diteruskan Kepada</strong> : <br/>'.$row['tujuan'].'</td>
                            </tr>';
                                }
                            } else {
                                echo '
                                <tr class="isi">
                                    <td colspan="2"><strong>Isi Disposisi :</strong>
                                    </td>
                                    <td><strong>Diteruskan Kepada</strong> : </td>
                                </tr>';
                            }
                        } echo '
                </tbody>
            </table>
            <div id="lead">
                <p>Kepala Dinas</p>
                <div style="height: 50px;"></div>';
                $query = mysqli_query($config, "SELECT kepsek, nip FROM tbl_instansi");
                list($kepsek,$nip) = mysqli_fetch_array($query);
                if(!empty($kepsek)){
                    echo '<p class="lead">'.$kepsek.'</p>';
                } else {
                    echo '<p class="lead">H. Riza Fachri, S.Kom.</p>';
                }
                if(!empty($nip)){
                    echo '<p>NIP. '.$nip.'</p>';
                } else {
                    echo '<p>NIP. -</p>';
                }
                echo '
            </div>
        </div>
        <div class="jarak2"></div>
    </div>
    <!-- Container END -->

    </div><!-- /.box-body -->



    </form>
  </div><!-- /.box -->
<!-- Row form END -->

   
</div>
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.row -->
';
include("admin/footer.php");
include("admin/js.php");
}

}

?>