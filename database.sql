create DATABASE PTFastFood;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- table customer------------------------------
CREATE TABLE customer 
(`cusId` int(100) PRIMARY KEY NOT NULL AUTO_INCREMENT,
`cusName` varchar(50) NOT NULL,
`cusNickName` varchar(50) NOT NULL,
`cusPass` varchar(20) NOT NULL,
`cusEmail` varchar(50) NOT NULL,
`cusPhone` varchar(11) NOT NULL);

INSERT INTO `customer`
(`cusId`,`cusName`,`cusNickName`,`cusPass`,`cusEmail`,`cusPhone`)
VALUES (1,'User','User','123','User@gmail.com','0123456789');

-- table admin ---------------------------------
CREATE TABLE admin
(`adminId` varchar(5) PRIMARY KEY NOT NULL,
`adminName` varchar(50) NOT NULL,
`adminPhone` varchar(11) NOT NULL,
`adminPass` varchar(20) NOT NULL,
`adminEmail` varchar(50) NOT NULL);

INSERT INTO `admin`(`adminId`, `adminName`, `adminPhone`, `adminPass`, `adminEmail`)
VALUES ('SA01','Admin','01152637851','Sadmin01','sadmin@gmail.com');


-- table category ------------------------------
create table category
(`categoryName` varchar(100) PRIMARY KEY NOT NULL,
`categoryImage` text NOT NULL,
`categoryStatus` varchar(10)NOT NULL);

INSERT INTO `category`
(`categoryName`,`categoryImage`,`categoryStatus`)
VALUES('Burger','Img/burger category.png','on'),
('Dessert','Img/decert category.png','on'),
('Beverage','Img/beverage category.png','on');

-- table product --------------------------------
CREATE TABLE product
(`product_id` int NOT NULL AUTO_INCREMENT,
`product_name` varchar(100) NOT NULL,
`product_image` longblob NOT NULL,
`product_stock` int NOT NULL,
`product_detail` text NOT NULL,
`product_price` double NOT NULL,
`product_category` varchar(100),
`product_code` varchar(50) NOT NULL,
PRIMARY KEY(`product_id`),
CONSTRAINT `FK_ProductCategory` FOREIGN KEY(`product_category`)
REFERENCES `category`(`categoryName`));

--after add product type in this----------
ALTER TABLE `product`
ADD UNIQUE KEY `product_code_2` (`product_code`),
ADD KEY `product_code` (`product_code`),
ADD `product_quantity` int(100) not null DEFAULT 1;

-- table cart --------------------------------
CREATE TABLE cart (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_Pname` varchar(100) NOT NULL,
  `cart_Pprice` double NOT NULL,
  `cart_Pimage` text NOT NULL,
  `cart_Pqty` int(10) NOT NULL,
  `cart_Totalprice` double NOT NULL,
  `product_code` varchar(100) NOT NULL,
  PRIMARY KEY(`cart_id`),
  CONSTRAINT `FK_Product` FOREIGN KEY(`product_code`)
  REFERENCES `product`(`product_code`)
);