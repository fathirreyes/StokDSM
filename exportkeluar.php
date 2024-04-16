
<?php
require 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laporan Stock Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body class="sb-nav-fixed">
<div class="container">
<nav class="sb-topnav navbar navbar-dark">
        <h2>Laporan Barang Keluar</h2>
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                    <a href="keluar.php"><button type="button" class="btn btn-outline-dark">Kembali</button></a>
            </form>
</nav>
			<h4 style="margin-left: 15px;">(Inventory)</h4>
				<div class="data-tables datatable-dark">
					
                <table class="table table-bordered" id="examplekeluar" width="100%" cellspacing="0">
                                        <thead class="thead table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Part Number</th>
                                                <th>Part Description</th>
                                                <th>Qty</th>
                                                <th>Penerima</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ambilsemuadatastock = mysqli_query($conn,"select * from keluar k, stock s where s.idbarang = k.idbarang");
                                            $i = 1;
                                            while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                $partnumber = $data['partnumber'];
                                                $idk = $data['idkeluar'];
                                                $tanggal = $data['tanggal'];
                                                $partdescription = $data['partdescription'];
                                                $quantity = $data['quantity'];
                                                $idb = $data['idbarang'];
                                                $penerima = $data['penerima'];
                                            ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?php echo $tanggal;?></td>
                                                <td><?php echo $partnumber;?></td>
                                                <td><?php echo $partdescription;?></td>
                                                <td><?php echo $quantity;?></td>
                                                <td><?php echo $penerima;?></td>
                                            </tr>


                                            <?php 
                                            };

                                            ?>
                                        </tbody>
                                    </table>
					
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#examplekeluar').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>