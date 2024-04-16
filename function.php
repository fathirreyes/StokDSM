<?php 

$conn = mysqli_connect("localhost","root","","stokdsm");

//menambah barang baru
if(isset($_POST['addnewbarang'])){
    $partnumber = $_POST['partnumber'];
    $partdescription = $_POST['partdescription'];
    $qnty = $_POST['qnty'];

    $addtotable = mysqli_query($conn,"insert into stock (partnumber, partdescription, qnty) values('$partnumber','$partdescription','$qnty')");
    if($addtotable){
        header('location:utama.php');
    } else {
        echo 'gagal';
        header('location:utama.php');
    }
};


//menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $keterangan = $_POST['keterangan'];
    $quantity = $_POST['quantity'];
    $tanggalnya = $_POST['tanggal'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['qnty'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$quantity;

    $addtomasuk = mysqli_query($conn,"insert into masuk (idbarang, keterangan, quantity, tanggal) values('$barangnya','$keterangan','$quantity','$tanggalnya')");
    $updatestockmasuk = mysqli_query($conn, "update stock set qnty='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    } else {
        echo 'gagal';
        header('location:masuk.php');
    }
}

//menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $quantity = $_POST['quantity'];
    $tanggalnya = $_POST['tanggal'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['qnty'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$quantity;

    $addtokeluar = mysqli_query($conn,"insert into keluar (idbarang, penerima, quantity, tanggal) values('$barangnya','$penerima','$quantity','$tanggalnya')");
    $updatestockkeluar = mysqli_query($conn, "update stock set qnty='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtokeluar&&$updatestockkeluar){
        header('location:keluar.php');
    } else {
        echo 'gagal';
        header('location:keluar.php');
    }
}


//update info barang 
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $partnumber = $_POST['partnumber'];
    $partdescription = $_POST['partdescription'];

    $update = mysqli_query($conn,"update stock set partnumber='$partnumber', partdescription='$partdescription' where idbarang='$idb'");
    if($update){
        header('location:utama.php');
    } else {
        echo 'gagal';
        header('location:utama.php');
    }
}

//Menghapus barang dari stock
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];
    
    $hapus - mysqli_query($conn,"delete from stock where idbarang='$idb'");
    if($hapus){
        header('location:utama.php');
    } else {
        echo 'gagal';
        header('location:utama.php');
    }
}

//mengubah data barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $partdescription = $_POST['partdescription'];
    $keterangan = $_POST['keterangan'];
    $quantity = $_POST['quantity'];
    
    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['qnty'];

    $qntyskrg = mysqli_query($conn,"select * from masuk where idmasuk='$idm'");
    $qntynya = mysqli_fetch_array($qntyskrg);
    $qntyskrg = $qntynya['quantity'];

    if($quantity>$qntyskrg){
        $selisih = $quantity-$qntyskrg;
        $kurangin = $stockskrg + $selisih;
        $kuranginstocknya = mysqli_query($conn,"update stock set qnty='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn,"update masuk set quantity='$quantity', keterangan='$keterangan' where idmasuk='$idm'");
            if($kuranginstocknya&&$updatenya){
                header('location:masuk.php');
            } else {
                echo 'gagal';
                header('location:masuk.php');
            }
    } else {
        $selisih = $qntyskrg-$quantity;
        $kurangin = $stockskrg - $selisih;
        $kuranginstocknya = mysqli_query($conn,"update stock set qnty='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn,"update masuk set quantity='$quantity', keterangan='$keterangan' where idmasuk='$idm'");
            if($kuranginstocknya&&$updatenya){
                header('location:masuk.php');
            } else {
                echo 'gagal';
                header('location:masuk.php');
            }
    }
}

//menghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $quantity = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['qnty'];

    $selisih = $stok-$quantity;

    $update = mysqli_query($conn,"update stock set qnty='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from masuk where idmasuk='$idm'");

    if($update&&$hapusdata){
        header('location:masuk.php');
    } else {
        echo 'gagal';
        header('location:masuk.php');
    }


}

// mengubah data barang keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $partdescription = $_POST['partdescription'];
    $penerima = $_POST['penerima'];
    $quantity = $_POST['quantity'];
    
    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['qnty'];

    $qntyskrg = mysqli_query($conn,"select * from keluar where idkeluar='$idk'");
    $qntynya = mysqli_fetch_array($qntyskrg);
    $qntyskrg = $qntynya['quantity'];

    if($quantity>$qntyskrg){
        $selisih = $quantity-$qntyskrg;
        $kurangin = $stockskrg - $selisih;
        $kuranginstocknya = mysqli_query($conn,"update stock set qnty='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn,"update keluar set quantity='$quantity', penerima='$penerima' where idkeluar='$idk'");
            if($kuranginstocknya&&$updatenya){
                header('location:keluar.php');
            } else {
                echo 'gagal';
                header('location:keluar.php');
            }
    } else {
        $selisih = $qntyskrg-$quantity;
        $kurangin = $stockskrg + $selisih;
        $kuranginstocknya = mysqli_query($conn,"update stock set qnty='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn,"update keluar set quantity='$quantity', penerima='$penerima' where idkeluar='$idk'");
            if($kuranginstocknya&&$updatenya){
                header('location:keluar.php');
            } else {
                echo 'gagal';
                header('location:keluar.php');
            }
    }
}

//menghapus barang keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $quantity = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['qnty'];

    $selisih = $stok+$quantity;

    $update = mysqli_query($conn,"update stock set qnty='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from keluar where idkeluar='$idk'");

    if($update&&$hapusdata){
        header('location:keluar.php');
    } else {
        echo 'gagal';
        header('location:keluar.php');
    }


}


?>