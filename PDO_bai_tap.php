<?php
// khai báo các biến để kết nối với CSDL 
try { $type  = " mysql ";
      $host = " localhost";
      $name  = "BAI_TAP_2";
      $username = "root";
      $password = "";

$conn = new PDO ('mysql:host = $host ; dbname = $name ', $username  , $password );// kết nối 

} catch (PDOException $p ){
    die ("kết nối lỗi ". $p -> getMessage () );}

// Thiết lập chế độ exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// chuẩn bị câu lệnh sql để tạo bảng 
try {$sql = (" CREATE TABLE SINH_VIEN (
    `MaSV` varchar(10) PRIMARY KEY NOT NULL,
    `Hoten` varchar(50) NOT NULL,
    `Ngaysinh` datetime NOT NULL,
    `Lophoc` varchar (50) NOT NULL, 
    `DTB` float NOT NULL)");

$conn->exec($sql); // Thực thi câu truy vấn
     
  echo "Tạo table thành công";
} 
catch (PDOException $e) {
  echo $e->getMessage();
}

// insert dữ liệu 
// Khởi tạo preparad 
$stmt = $conn -> prepare ('INSERT INTO SINH_VIEN (MaSV, Hoten, Ngaysinh, Lophoc, DTB) values (?,?,?,?,?)');

// gán các biến 
$stmt -> bindParam (1, $MaSV);
$stmt -> bindParam (2, $Hoten);
$stmt -> bindParam (3, $Ngaysinh);
$stmt -> bindParam (4, $Lophoc);
$stmt -> bindParam (5, $DTB);

// Gán giá trị và thực thi 
$MaSV = "SV001";
$Hoten ="Phương Thanh ";
$Ngaysinh = "2002-05-03";
$Lophoc = "K56SD2";
$DTB = "8.3";
$stmt -> execute ();

$MaSV = "SV002";
$Hoten ="Thanh Phương ";
$Ngaysinh = "2002-05-25";
$Lophoc = "K56SD2";
$DTB = "8.0";
$stmt -> execute ();

$MaSV = "SV003";
$Hoten ="Thanh Thảo ";
$Ngaysinh = "2002-07-03";
$Lophoc = "K56SD2";
$DTB = "8.2";
$stmt -> execute ();

$MaSV = "SV004";
$Hoten ="Lan Phương ";
$Ngaysinh = "2002-08-13";
$Lophoc = "K56SD2";
$DTB = "8.5";
$stmt -> execute ();

$MaSV = "SV005";
$Hoten ="Thanh Tâm";
$Ngaysinh = "2002-05-24";
$Lophoc = "K56SD2";
$DTB = "8.3";
$stmt -> execute ();

// Cập nhật điểm trung bình của sinh viên có mã "SV001" thành 8.5
$sql = "UPDATE SINH_VIEN SET DTB=:8.5 WHERE MaSV=:SV001";

$statement = $conn->prepare($sql);

if($statement->execute()) {
  echo "Update thành công";
}

//Xoá thông tin của sinh viên có mã "SV003" khỏi bảng danh sách.
$sql = "DELETE SINH_VIEN WHERE MaSV=:SV003";

$statement = $conn->prepare($sql);

if($statement->execute()) {
  echo "Xóa thành công";
}

//Tạo bảng lịch sử giao dịch với các cột: ngày giao dịch, loại giao dịch, số tiền, mô tả.
try {$sql = (" CREATE TABLE LSGD (
    `Ngay_giao_dich` datetime NOT NULL,
    `Loai_giao_dich` varchar (50) NOT NULL,
    `So_tien` float NOT NULL,
    `Mo_ta` varchar (50) NOT NULL )");

$conn->exec($sql); // Thực thi câu truy vấn
     
  echo "Tạo table thành công";
} 
catch (PDOException $e) {
  echo $e->getMessage();
}


//BÀI TẬP 2 
// Thêm một giao dịch mới vào bảng lịch sử với thông tin: ngày giao dịch là 7/5/2023, loại giao dịch là "rút tiền", số tiền là 500, mô tả là "rút tiền ATM".
// Khởi tạo preparad 
$stmt = $conn -> prepare ('INSERT INTO LSGD (STT, Ngay_giao_dich, Loai_giao_dich, So_tien, Mo_ta) values (?,?,?,?,?)');
 
$stmt -> bindParam (1, $STT) ;// gán các biến
$stmt -> bindParam (2, $Ngay_giao_dich) ;
$stmt -> bindParam (3, $Loai_giao_dich);
$stmt -> bindParam (4, $So_tien);
$stmt -> bindParam (5, $Mo_ta);

$STT = "1";// Gán giá trị và thực thi 
$Ngay_giao_dich = "2023-5-7";
$Loai_giao_dich ="Rút tiền";
$So_tien = "500";
$Mo_ta = "Rút tiền ATM";
$stmt -> execute ();

//Cập nhật số tiền của giao dịch có số thứ tự 3 trong bảng lịch sử thành 1000.
$sql = "UPDATE LSGD SET So_tien=:1000 WHERE STT=:3";

$statement = $conn->prepare($sql);

if($statement->execute()) {
  echo "Update thành công";
}

//Xoá thông tin của giao dịch có số thứ tự 5 khỏi bảng lịch sử.
$sql = "DELETE LSGD WHERE STT =:5";

$statement = $conn->prepare($sql);

if($statement->execute()) {
  echo "Xóa thành công";
}

//Tạo bảng danh sách sản phẩm với các cột: mã sản phẩm, tên sản phẩm, giá bán, số lượng tồn kho.
try {$sql = (" CREATE TABLE DSSP (
   `Ma_sp` int (10) primary key  NOT NULL,
    `Ten_sp` varchar (50) NOT NULL,
    `Gia_ban` float NOT NULL,
    `SL_ton_kho ` int  NOT NULL )");

$conn->exec($sql); // Thực thi câu truy vấn
     
  echo "Tạo table thành công";
} 
catch (PDOException $e) {
  echo $e->getMessage();
}

/*Thêm sản phẩm mới vào bảng danh sách sản phẩm với thông tin: mã sản phẩm là SP006
tên sản phẩm là "Điện thoại Samsung Galaxy A52", giá bán là 6.500.000 đồng, số lượng tồn kho là 20.*/
// Khởi tạo preparad 
$stmt = $conn -> prepare ('INSERT INTO DSSP (Ma_sp, Ten_sp, Gia_ban, SL_ton_kho) values (?,?,?,?)');
 
$stmt -> bindParam (1, $Ma_sp) ;// gán các biến
$stmt -> bindParam (2, $Ten_sp) ;
$stmt -> bindParam (3, $Gia_ban);
$stmt -> bindParam (4, $SL_ton_kho);

$Ma_sp = "SP006";// Gán giá trị và thực thi 
$Ten_sp = "Điện thoại Samsung Galaxy A52";
$Gia_ban ="6.500.000";
$SL_ton_kho = "20";
$stmt -> execute ();