<!DOCTYPE html>
<html dir="<?php echo $direction; ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<link type="text/css" href="view/stylesheet/custom.css" rel="stylesheet" media="all" />
</head>
<body class="invoice_body">
<input type="button" id="print_button" value="In hóa đơn" onclick="this.style.display ='none'; window.print()" />
<table width="750" height="306" border="0" align="center" cellspacing="5">
  <tr>  </tr>
  
  <tr>
    <td height="29" colspan="2" align="center" class="style5"><table width="700" height="111">
      <tr>
        <td width="150" rowspan="4"></td>
        <td width="538"></td>
      </tr>
      <tr>
       </tr>
      <tr>
       </tr>
      <tr>
        </tr>
    </table>    </td>
  </tr>
  <tr>
    <td height="29" colspan="2" align="right" class="style5">
    <p class="style6">Thu COD: <font size="6"><?php echo $tongtien ;?> đ</font><br/>Đồng Kiễm
     </td>

  </tr>
  <?php foreach ($infor_customers as $infor_customer) { ?>
  <tr>
   
    <td width="299" class="style5">Số chứng từ: PXK/HCM/<?php echo $infor_customer['order_id'] ;?></td>
  </tr>
  <tr>
    <td colspan="2" class="style5">Khách Hàng:  <font size="5"><strong><?php echo $infor_customer['customer_name'] ;?></strong></font></td>
  </tr>
  <tr>
    <td colspan="2" class="style5">Địa chỉ: <font size="4.5"><strong><?php echo $infor_customer['address'] ;?></strong></font></td>
  </tr>
  <tr>
    <td colspan="2" class="style5">Điện thoại: <font size="5"><strong><?php echo $infor_customer['telephone'] ;?></strong></font></td>
  </tr>
  <?php } ;?>
  <tr>
    
  </tr>
</table>
<table width="900" align="center" style="border:1px solid #69C; border-collapse:collapse;">
  <tr>
    <td width="10" align="center" class="td1 style5"><b>STT</b></td>
    <td width="150" align="center" class="td1 style5"><span id="basic-addon1" size="20" maxlength="10"><b>Mã imei</b></span></td>
    <td width="380" align="center" class="td1 style5"><b>Tên Hàng</b></td>
	<td width="80" align="center" class="td1 style5"><b>Bảo hành</b></td>
    <td width="20" align="center" class="td1 style5"><b>SL</b></td>
    <td width="120" align="center" class="td1 style5"><b>Thành Tiền</b></td>
  </b></tr>
  <?php 
  $i=0;
  
  ;?>
  <?php foreach ($products as $product) {$i; $i++; ?> 
  
   
  <tr>
    <td align="center" class="td1 style5"><?php echo $i ;?></td>
    <td align="left" class="td1 style5">&nbsp;&nbsp;<?php echo $product['imei'] ;?></td>
    <td align="left" class="td1 style5">&nbsp;&nbsp;<?php echo $product['name_product'] ;?></td>
	<td align="center" class="td1 style5"><?php echo $product['guarantee'] ;?></td>
    <td align="center" class="td1 style5"><?php echo $product['quantity_order'] ;?></td>
    <td align="center" class="td1 style5"><?php echo $product['total'] ;?> vnd</td>
  </tr>
  <?php } ;?>
</table>
<br/>
 <br/>
 <br/>
 <br/>
</body>
</html>
