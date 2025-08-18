<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include ('../Connections/koneksi.php');
$cetak=mysql_query("select *from pln where idbayar='$_GET[idpel]' ");
$data=mysql_fetch_array($cetak);
?>
<title>Struk <?php echo $data['nama'] ?> - <?php echo $data['idpel'] ?></title>
</head>

<body>
<table width="1079" height="277" border="0" align="center">
  <tr>
    <td colspan="2">Loket Pembayaran <?php echo $data['aplikasi'] ?></td>
    <td width="161">&nbsp;</td>
    <td colspan="4">Loket Pembayaran <?php echo $data['aplikasi'] ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong>Struk Pembayaran Tagihan Listrik</strong></td>
    <td>&nbsp;</td>
    <td colspan="4" align="center"><strong>Struk Pembayaran Tagihan Listrik</strong></td>
  </tr>
  <tr>
    <td width="152">Tanggal</td>
    <td width="245"><?php echo $data['tgl_beli'] ?></td>
    <td>&nbsp;</td>
    <td width="123">ID Pelanggan</td>
    <td width="213"><?php echo $data['idpel'] ?></td>
    <td width="85">&nbsp; </td>
    <td width="54">&nbsp;</td>
  </tr>
  <tr>
    <td>Id Pelanggan</td>
    <td><?php echo $data['idpel'] ?></td>
    <td>&nbsp;</td>
    <td>Nama</td>
    <td><?php echo $data['nama'] ?></td>
    <td>&nbsp; </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Nama</td>
    <td><?php echo $data['nama'] ?></td>
    <td>&nbsp;</td>
    <td>Tarif Daya</td>
    <td><?php echo $data['daya'] ?></td>
    <td>&nbsp; </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Tarif Daya</td>
    <td><?php echo $data['daya'] ?></td>
    <td>&nbsp;</td>
    <td>Tagihan</td>
    <td>Rp. <?php echo (number_format( $data['tagihan'])) ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Periode</td>
    <td><?php echo $data['periode'] ?></td>
    <td>&nbsp;</td>
    <td>JPA Ref</td>
    <td>-</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Meter</td>
    <td><?php echo $data['meter'] ?></td>
    <td>&nbsp;</td>
    <td>Bulan</td>
    <td><?php echo $data['periode'] ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Admin</td>
    <td>Rp. <?php echo (number_format($data['admin'])) ?></td>
    <td>&nbsp;</td>
    <td>Stand Meter</td>
    <td><?php echo $data['meter'] ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Tagihan</td>
    <td>Rp. <?php echo (number_format($data['tagihan'])) ?></td>
    <td>&nbsp;</td>
    <td colspan="4">PLN Menyatakan bukti Struk ini Sebaga Bukti Pembayaran yang sah</td>
  </tr>
  <tr>
    <td>Total</td>
    <td>Rp. <?php echo (number_format($data['total'])) ?></td>
    <td>&nbsp;</td>
    <td>Admin</td>
    <td>Rp. <?php echo (number_format($data['admin'])) ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>JPA Ref</td>
    <td>-</td>
    <td>&nbsp;</td>
    <td>Total Bayar</td>
    <td>Rp. <?php echo (number_format($data['total'])) ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" align="center">Terima Kasih</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" align="center">Rincian Tagihan dapat Diakses di www.pln.co.id</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" align="center">Hub PLN Terdekat : 123</td>
  </tr>
</table>
</body>
</html>