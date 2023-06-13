<?php
// khai báo các biến để kết nối đến csdl
$servername = "localhost";
$usename ="root";
$password = "";
$databasename ="BAI_TAP_1";

$conn = mysqli_connect ($servername , $usename, $password,$databasename); // kết nối 
// kiểm tra sự kết nối 
if (!$conn){
    die ("Kết nối thất bại" . mysqli_connect_error ());
} else {
echo " Kết nối thành công ";
};

// tạo bảng 
$sql_stmt = " CREATE TABLE IF NOT EXISTS`SINH_VIEN` (
    `MaSV` varchar(10) PRIMARY KEY NOT NULL,
    `Hoten` varchar(50) NOT NULL,
    `Ngaysinh` datetime NOT NULL,
    `Lophoc` varchar (50) NOT NULL, 
    `DTB` float NOT NULL)";

$result = mysqli_query($conn , $sql_stmt);

if (!$result)
{
    die ("Tạo bảng thất bại ". mysqli_error());
} else {
echo " Tạo bảng thành công ";
}

// insert thông tin 
$sql_stmt = "INSERT INTO `SINH_VIEN` (`MaSV`, `Hoten`, `Ngaysinh`, `Lophoc`, `DTB` )
VALUES ('SV001', 'Phương Thanh', '2002-5-3', '12A1' , '8.5'),
       ('SV002', 'Thanh Thảo', '2002-16-3', '12A1' , '8.0'),
       ('SV003', 'Minh Hằng ', '2002-5-6', '12A1' , '7.5'),
       ('SV004', 'Thanh Tâm', '2002-24-8', '12A1' , '7.9'),
       ('SV005', 'Lan Phương ', '2002-25-2', '12A1' , '8.2')";

$result = mysqli_query ($conn, $sql_stmt);// thực thi 

// check 
if (!$result)
{
    die("Thêm dữ liệu thất bại ". mysqli_connect_error());
} else { 
    echo "Thêm dữ liệu thành công "; 
};

// Cập nhật điểm trung bình của sinh viên có mã "SV001" thành 8.5.
 $sql_stmt = "UPDATE `SINH_VIEN` SET `Diem_TB` = '8.5'";
 $sql_stmt = "WHERE `MaSV` = 'SV002' ";

 $result = mysqli_query( $conn, $sql_stmt);// thực thi 

 if (!$result)
{
    die ("Cập nhật điểm trung bình không thành công ".mysqli_error ());
} else {
    echo "Cập nhật điểm trung bình thành công ";
};

//Xoá thông tin của sinh viên có mã "SV003" khỏi bảng danh sách.
$sql_stmt = " DELETE `SINH_VIEN` ";
$sql_stmt = " WHERE `MaSV` = 'SV003'";

$result = mysqli_query ($conn, $sql_stmt);

if(!$result)
{
    die ("Xóa thông tin thất bại ". mysqli_connect_error ());
} else {
    echo "Xóa thông tin thành công ";
};

//Tạo bảng lịch sử giao dịch với các cột: ngày giao dịch, loại giao dịch, số tiền, mô tả.
$sql_stmt= "CREATE TABLE IF NOT EXISTS `LSGD` (
    `Ngay_giao_dich` datetime NOT NULL,
    `Loai_giao_dich` varchar (50) NOT NULL,
    `So_tien` float NOT NULL,
    `Mo_ta` varchar (50) NOT NULL );";

$result = mysqli_query( $conn, $sql_stmt );

if (!$result)
{
    die("Tạo bảng lịch sử giao dịch thất bại ". mysqli_connect_error());
} else { 
    echo "Tạo bảng lịch sử giao dịch thành công "; 
};




// BÀI TẬP 2 
// Thêm một giao dịch mới vào bảng lịch sử với thông tin: ngày giao dịch là 7/5/2023, loại giao dịch là "rút tiền", số tiền là 500, mô tả là "rút tiền ATM".
$sql_stmt = " INSERT INTO `LSGD` (`Ngay_giao_dich`,`Loai_giao_dich`,`So_tien`, `Mo_ta`),
VALUES ('2023-5-7', 'Rút tiền', '500', 'Rút tiền ATM') " ;
$result = mysqli_query ( $conn , $sql_stmt );
if (!$result){
    die (" Thêm mới giao dịch thất bại". mysqli_connect_error());
}else {
    echo " Thêm mới giao dịch thành công" ;
};

//Cập nhật số tiền của giao dịch có số thứ tự 3 trong bảng lịch sử thành 1000.
$sql_stmt = "INSERT INTO `LSGD` (`Ngay_giao_dich`,`Loai_giao_dich`,`So_tien`, `Mo_ta`),  
            VALUES  ( '2022-24-6', 'Rút tiền', '100', 'Rút tiền ATM'),
                    ( '2023-3-5', 'Rút tiền' , '500', 'Rút tiền ATM' ),
                    ( '2023-2-3', 'Rút tiền', '300', 'Rút tiền ATM'),
                    ( '2023-5-5' , 'Rút tiền', '200', 'Rút tiền ATM')"; // insert dữ liệu
$result = mysqli_query ( $conn, $sql_stmt); // thực thi 
if (!$result){
    die("  Thêm dữ liệu lỗi ".mysqli_error () );
} else {
    echo " Thêm dữ liệu thành công ";
};

$sql_stmt = "UPDATE `LSGD ` SET `So_tien` = '1000'"; // update theo yêu cầu 
$sql_stmt .= "WHERE `Ngay_giao_dich` = '2023-5-5'";

$result = mysqli_query($conn, $sql_stmt); // Thực thi 

if (!$result) {
    die("Update thất bại: " . mysqli_error());  
} else {
    echo "Update thành công ";
};

//Xoá thông tin của giao dịch có số thứ tự 5 khỏi bảng lịch sử.
$sql_stmt = "DELETE FROM `LSGD` WHERE `Ngay_giao_dich` = '2023-5-5'"; 
$result = mysqli_query($conn, $sql_stmt); // Thực thi 

if (!$result) {
    die("Xóa thất bại: " . mysqli_error());  
} else {
    echo "Xóa thành công ";
};

//Tạo bảng danh sách sản phẩm với các cột: mã sản phẩm, tên sản phẩm, giá bán, số lượng tồn kho.
$sql_stmt= "CREATE TABLE IF NOT EXISTS `DSSP` (
    `Ma_sp` int (10) primary key  NOT NULL,
    `Ten_sp` varchar (50) NOT NULL,
    `Gia_ban` float NOT NULL,
    `SL_ton_kho ` int  NOT NULL );";

$result = mysqli_query( $conn, $sql_stmt );

if (!$result)
{
    die("Tạo bảng danh sách sản phẩm thất bại ". mysqli_error());
} else { 
    echo "Tạo bảng danh sách sản phẩm thành công "; 
};

/*Thêm sản phẩm mới vào bảng danh sách sản phẩm với thông tin: mã sản phẩm là SP006
tên sản phẩm là "Điện thoại Samsung Galaxy A52", giá bán là 6.500.000 đồng, số lượng tồn kho là 20.*/
$sql_stmt = " INSERT INTO `DSSP` (`Ma_sp`,`Ten_sp`,`Gia_ban`,`SL_ton_kho `),
VALUES ('SP0006', 'Điện thoại Samsung Galaxy A52', '6.500.000', '20') " ;
$result = mysqli_query ( $conn , $sql_stmt );
if (!$result){
    die (" Thêm mới sản phẩm thất bại". mysqli_connect_error());
}else {
    echo " Thêm mới sản phẩm thành công" ;
};



