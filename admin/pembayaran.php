<h3>Transaksi Pembayaran SPP</h3>
<form method="get" action="">
    nisn: <input type="text" name="nisn" />
    <input type="hidden" id="open" name="open" value="data_pembayaran"/>
    <input type="submit" name="cari" value="Cari Siswa" />
</form>

<?php
include_once "../src/koneksi.php";
if(isset($_GET['nisn']) && $_GET['nisn']!=''){
    $sqlSiswa = mysqli_query($koneksi, "SELECT * FROM kelas join siswa on kelas.id_kelas = siswa.id_kelas join spp on siswa.id_spp = spp.id_spp WHERE nisn='$_GET[nisn]'");
    $data=mysqli_fetch_array($sqlSiswa);
    $nisn = $data['nisn'];
?>

<h3>Biodata Siswa</h3>
<table>
<tr>
    <td>NISN</td>
    <td>:</td>
    <td><?php echo $data['nisn']; ?></td>
</tr>
<tr>
    <td>Nama Siswa</td>
    <td>:</td>
    <td><?php echo $data['nama']; ?></td>
</tr>
<tr>
    <td>Kelas</td>
    <td>:</td>
    <td><?php echo $data['nama_kelas']; ?></td>
</tr>
</table>

<h3>Tagihan SPP Siswa</h3>
<table border="1">
<tr>
    <th>No</th>
    <th>Bulan</th>
    <th>Tahun</th>
    <th>No. Bayar</th>
    <th>Tgl. Bayar</th>
    <th>Jumlah</th>
    <th>Keterangan</th>
    <th>Bayar</th>
</tr>

<?php
$sql = mysqli_query($koneksi, "SELECT * FROM pembayaran join spp on pembayaran.id_spp = spp.id_spp WHERE nisn='$data[nisn]'");
$no=1;
while($data=mysqli_fetch_array($sql)){
    echo "<tr>";
    echo "<td>$no</td>";
    echo "<td>$data[bulan_tagihan]</td>";
    echo "<td>$data[tahun_tagihan]</td>";
    echo "<td>$data[no_bayar]</td>";
    echo "<td>$data[tgl_pembayaran]</td>";
    echo "<td>$data[nominal]</td>";
    echo "<td>$data[keterangan]</td>";
    echo "<td align='center'>";
        if($data['no_bayar']==''){
            echo "<a href='proses_pembayaran.php?nisn=$nisn&act=bayar&id_pembayaran=$data[id_pembayaran]'>Bayar</a>";
        }else{
            echo "-";
        }
    echo "</td>";
    echo "</tr>";
    $no++;
}
?>
</table>
<?php
}
?>
<p>Pembayaran SPP dilakukan dengan cara mencari tagihan siswa dengan NISN melalui form di atas, kemudian proses pembayaran</p>