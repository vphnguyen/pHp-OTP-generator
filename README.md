# pHp-OTP-generate
From Việt Nam with love.
DATABASE =========================================================

CREATE TABLE `verification` (
  `tenKH` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay` timestamp NOT NULL DEFAULT current_timestamp(), 
  `HASH` text COLLATE utf8_unicode_ci NOT NULL,          
  `EMAIL` text COLLATE utf8_unicode_ci NOT NULL          
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

![alt text](https://github.com/vphnguyen/pHp-OTP-generator/blob/main/Table.png?raw=true)</br>
Column meaning:</br>
      tenKH  ==  ID, Username</br>
      ngay   ==  time request</br>
      HASH   ==  OTP after HASH</br>
      EMAIL  ==  email to send OTP</br>
PHP code =========================================================

$con=mysqli_connect(" a, b, b, d ");// server, user, password, database
1. Clean your expired rows.
2. Create new a row when meet a request from Client.
3. Save their ID and timestamp.
4. Get that timestamp.
5. Using your ID and timestamp as salt, hashed them with MD5, SHA-1 or anything you like.
6. Get the some numbers that you need (4-6 digits).
7. Update the rest empty column with that OTP from 6.

===========================
Dont forget to clean your table before you verifie any confirm from Client.

- V.P.Nguyễn -
