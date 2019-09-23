<!DOCTYPE html>
<html dir="<?php echo $direction; ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<link type="text/css" href="view/stylesheet/custom.css" rel="stylesheet" media="all" />
</head>
<body class="invoice_body">
<input type="button" id="print_button" value="In hóa đơn" onclick="this.style.display ='none'; window.print()" />
<table width="980" height="306" border="0" align="center" cellspacing="5">
  <tr>  </tr>
 
  <tr>
    <td height="29" colspan="2" align="center" class="style5"><table width="800" height="111">
      <tr>
	  <?php foreach ($infor_customers as $infor_customer) { ?>
        <td width="130" rowspan="4"><div class="thumb img_logo_invoice"><img src="http://localhost/baohanh/image/<?php echo $infor_customer['image'];?> "></div></td>
        <td width="538">
		<div align="center" class="style6">
		
		ĐẠI LÝ PHÂN PHỐI <?php echo $infor_customer['manufacturer'] ;?> CHÍNH HÃNG
		<?php } ;?>
		</div></td>
      </tr>
      <tr>
        <td>Địa Chỉ: Số 23 Đường số 13, Hiệp Bình Chánh, Thủ Đức, Hồ Chí Minh</td>
      </tr>
	 <?php foreach ($infor_customers as $infor_customer) { ?>
      <tr>
        <td>Website:<strong> <?php echo $infor_customer['website'] ;?></strong></td>
      </tr>
	 
      <tr>
        <td height="22">ĐT: <strong>08 6683 6631</strong> - Hotline: <strong>0969 36 86 39</strong></td>
      </tr>
    </table>    </td>
  </tr><tr>
    <td height="29" colspan="2" align="center" class="style5">
    <p class="style6"><br />
      PHIẾU XUẤT KHO KIÊM BẢO HÀNH</p></td>
  </tr>
  <tr>
    <td width="159" class="style5">Ngày xuất: <?php echo $infor_customer['date_added'] ;?></td>
    <td width="299" class="style5">Số chứng từ: PXK/HCM/<?php echo $infor_customer['order_id'] ;?></td>
  </tr>
  <tr>
    <td colspan="2" class="style5">Khách Hàng:  <strong><?php echo $infor_customer['customer_name'] ;?></strong></td>
  </tr>
  <tr>
    <td colspan="2" class="style5">Địa chỉ: <strong><?php echo $infor_customer['address'] ;?></strong></td>
  </tr>
  <tr>
    <td colspan="2" class="style5">Điện thoại: <strong><?php echo $infor_customer['telephone'] ;?></strong></td>
  </tr>
   <?php } ;?>
  <tr>
    <td colspan="2" class="style5">Nhân viên: Nguyễn Thanh Phong &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-*-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp SĐT Tư Vấn: <strong>0903 999 780</strong></td>
  </tr>
</table>
<table width="980" align="center" style="border:1px solid #69C; border-collapse:collapse;">
  <tr>
    <td width="10" align="center" class="td1 style5">STT</td>
    <td width="130" align="center" class="td1 style5"><span id="basic-addon1" size="20" maxlength="4">Mã imei</span></td>
    <td width="300" align="center" class="td1 style5">Tên Hàng</td>
	<td width="100" align="center" class="td1 style5">Bảo hành</td>
    <td width="74" align="center" class="td1 style5">Số Lượng</td>
    <td width="120" align="center" class="td1 style5">Thành Tiền</td>
  </tr>
  <?php foreach ($products as $product) { ?>
  <tr>
    <td align="center" class="td1 style5">1</td>
    <td align="center" class="td1 style5"><?php echo $product['imei'] ;?></td>
    <td align="center" class="td1 style5"><?php echo $product['name_product'] ;?></td>
	<td align="center" class="td1 style5"><?php echo $product['guarantee'] ;?></td>
    <td align="center" class="td1 style5"><?php echo $product['quantity_order'] ;?></td>
    <td align="center" class="td1 style5"><?php echo $product['total'] ;?> vnd</td>
  </tr>
  <?php } ;?>
  <tr>
    <td class="style5">&nbsp;</td>
    <td class="style5">&nbsp;</td>
	<td class="style5">&nbsp;</td>
	<td class="style5">&nbsp;</td>
    <td class="style5">&nbsp;&nbsp;Tổng tiền</td>
    <td class="style5">
	<b><?php echo $tongtien ;?></b> vnd </td>
  </tr>
</table>
<table width="980" border="0" align="center">
  <tr>
    <td colspan="2" class="style5"><strong>Lưu ý:</strong></td>
  </tr>
 
  <tr>
    <td colspan="2" class="style5">* Hai bên cùng kiểm tra thiết bị thấy rằng còn mới 100%</td>
  </tr>
  <tr>
    <td colspan="2" class="style5">* Biên bản bàn giao thiết bị này được lập thành 2 bản có giá trị như nhau, mỗi bên giữ một bản.</td>
  </tr>
<tr>
    <td colspan="2" class="style5"><strong><br />
      Chính sách ưu đãi cho khách hàng thân thiết:</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="style5">Giảm ngay <span class="style6"> %</span> cho <em><strong>đơn hàng tiếp theo</strong></em> hoặc <strong><em>giới thiệu khách hàng</em></strong> 
    mua hàng tại web: <span class="style7"><?php echo $product['website'] ;?></span></td>
  </tr>
  <tr>
    <td colspan="2" class="style5">* <strong>Hình thức thanh toán</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="style5">1/ nhắn mã thẻ cào với số tiền tương ứng </td>
  </tr>
   <tr>
    <td colspan="2" class="style5">2/ chuyển khoản qua ngân hàng với dịch vụ Internet Banking</td>
  </tr> <tr>
    <td colspan="2" class="style5">* Số tiền % quý khách sẽ nhận được ngay sau khi đơn hàng giao dịch thành công.</td>
  </tr>
  <tr>
    <td width="292" align="center" class="style5"><p><strong>Người giao</strong></p>
    <p>(Ký, ghi rõ họ tên)</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>Nguyễn Thanh Phong</p></td>
    <td width="309" align="center" class="style5"><p><strong>Người nhận</strong></p>
    <p>(Ký, ghi rõ họ tên)</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
<table width="504" border="0" align="center">
  <tr>
    <td height="91" colspan="2" align="center" class="style5">&nbsp;</td>
  </tr>
  <tr>
    <td width="398" align="center" class="style5"><strong>Cảm ơn Quý khách  đã mua sản phẩm của Công ty chúng tôi !</strong></td>
  </tr>
</table>
</body>
</html>