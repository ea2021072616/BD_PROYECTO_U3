-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Creando la base de datos `bdmijostore`
CREATE DATABASE IF NOT EXISTS `bdmijostore` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bdmijostore`;

-- Creando tabla `usuario`
-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Creando la base de datos `bdmijostore`
CREATE DATABASE IF NOT EXISTS `bdmijostore` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bdmijostore`;

-- Creando tabla `usuario`
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `correo` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creando tabla `categoria`
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creando tabla `producto` con el atributo `color`
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `descuento` varchar(2) DEFAULT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL, -- Atributo `color`
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria` (`categoria_id`),
  CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creando tabla `pedido`
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `estatus` varchar(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedido_usuario` (`usuario_id`),
  CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creando tabla `pedido_producto`
CREATE TABLE IF NOT EXISTS `pedido_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `unidades` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedido` (`pedido_id`),
  KEY `fk_producto` (`producto_id`),
  CONSTRAINT `fk_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`),
  CONSTRAINT `fk_producto` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creando tabla `imagenes` para imágenes adicionales de los productos
CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `imagen_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_imagen_producto` (`producto_id`),
  CONSTRAINT `fk_imagen_producto` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creando tabla `caracteristica` para las especificaciones del producto
CREATE TABLE IF NOT EXISTS `caracteristica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `sistema_operativo` varchar(100) DEFAULT NULL,
  `ram` varchar(50) DEFAULT NULL,
  `camara` varchar(100) DEFAULT NULL,
  `bateria` varchar(100) DEFAULT NULL,
  `almacenamiento` varchar(100) DEFAULT NULL,
  `pantalla` varchar(100) DEFAULT NULL,
  `procesador` varchar(100) DEFAULT NULL,
  `carga_rapida` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_caracteristica_producto` (`producto_id`),
  CONSTRAINT `fk_caracteristica_producto` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creando tabla `tipo_promocion` para definir los tipos de promociones
CREATE TABLE IF NOT EXISTS `tipo_promocion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creando tabla `promocion` con la relación a `tipo_promocion`
CREATE TABLE IF NOT EXISTS `promocion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `descuento_porcentaje` decimal(5,2) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `tipo_promocion_id` int(11) NOT NULL, -- Relación con tipo_promocion
  PRIMARY KEY (`id`),
  KEY `fk_promocion_producto` (`producto_id`),
  KEY `fk_promocion_tipo_promocion` (`tipo_promocion_id`),
  CONSTRAINT `fk_promocion_producto` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
  CONSTRAINT `fk_promocion_tipo_promocion` FOREIGN KEY (`tipo_promocion_id`) REFERENCES `tipo_promocion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Finalizando configuraciones
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `categoria` (`id`, `nombre`) VALUES
	(1, 'Xiaomi'),
	(2, 'Samsung'),
	(3, 'Redmi');


INSERT INTO `producto` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `descuento`, `fecha`, `imagen`) VALUES
	(1, 1, 'Xiaomi 13 Pro', 'Smartphone Xiaomi de alta gama con cámara Leica', 999.99, 20, NULL, '2024-10-31', 'Xiaomi 13 Pro.png'),
	(2, 1, 'Xiaomi 13', 'Smartphone Xiaomi con gran potencia y diseño moderno', 799.99, 30, NULL, '2024-10-31', 'Xiaomi 13.png'),
	(3, 1, 'Xiaomi 12T Pro', 'Smartphone con alta velocidad de carga y rendimiento', 649.99, 40, NULL, '2024-10-31', 'Xiaomi 12T Pro.png'),
	(4, 1, 'Xiaomi Redmi Note 12', 'Smartphone económico con excelente relación calidad-precio', 299.99, 80, NULL, '2024-10-31', 'Xiaomi Redmi Note 12.png'),
	(5, 1, 'Xiaomi 11 Lite', 'Smartphone ligero con buen rendimiento y cámaras', 349.99, 60, NULL, '2024-10-31', 'Xiaomi 11 Lite.png'),
	(6, 2, 'Samsung Galaxy S23 Ultra', 'Smartphone de gama alta con cámara de 200 MP', 1199.99, 15, NULL, '2024-10-31', 'Samsung Galaxy S23 Ultra.png'),
	(7, 2, 'Samsung Galaxy S23', 'Smartphone de alto rendimiento y diseño premium', 999.99, 25, NULL, '2024-10-31', 'Samsung Galaxy S23.png'),
	(8, 2, 'Samsung Galaxy Z Flip 5', 'Smartphone plegable compacto y versátil', 1099.99, 10, NULL, '2024-10-31', 'Samsung Galaxy Z Flip 5.jpg'),
	(9, 2, 'Samsung Galaxy A54', 'Smartphone de gama media con excelente pantalla', 399.99, 70, NULL, '2024-10-31', 'Samsung Galaxy A54.png'),
	(10, 2, 'Samsung Galaxy A34', 'Smartphone económico y funcional', 299.99, 90, NULL, '2024-10-31', 'Samsung Galaxy A34.png'),
	(11, 3, 'Redmi Note 12 Pro+', 'Smartphone Redmi con carga rápida y cámara avanzada', 399.99, 50, NULL, '2024-10-31', 'Redmi Note 12 Pro+.png'),
	(12, 3, 'Redmi Note 12 Pro', 'Smartphone Redmi con excelente rendimiento', 349.99, 60, NULL, '2024-10-31', 'Redmi Note 12 Pro.png'),
	(13, 3, 'Redmi K60 Pro', 'Smartphone de gama alta con gran rendimiento y diseño', 549.99, 30, NULL, '2024-10-31', 'Redmi K60 Pro.png'),
	(14, 3, 'Redmi 12C', 'Smartphone económico de Redmi con buena batería', 199.99, 100, NULL, '2024-10-31', 'Redmi 12C.png'),
	(15, 3, 'Redmi 12', 'Smartphone Redmi básico con características esenciales', 149.99, 120, NULL, '2024-10-31', 'Redmi 12.png');


-- Insertando datos en la tabla `tipo_promocion`
INSERT INTO `tipo_promocion` (`nombre`) VALUES
('Navidad'),
('Black Friday'),
('Cyber Monday'),
('Descuento por volumen'),
('Descuento exclusivo para miembros'),
('Descuento de lanzamiento');

-- Insertando datos en la tabla `promocion`
INSERT INTO `promocion` (`producto_id`, `fecha_inicio`, `fecha_fin`, `descuento_porcentaje`, `activo`, `tipo_promocion_id`) VALUES
(15, '2024-11-01', '2024-11-30', 15.00, 1, 1),  -- Promoción de 15% de descuento por tiempo limitado
(14, '2024-11-05', '2024-11-15', 20.00, 1, 2),  -- Promoción de 20% de descuento en oferta de temporada
(13, '2024-11-10', '2024-11-25', 10.00, 1, 3),  -- Promoción de 10% de descuento por volumen
(12, '2024-11-01', '2024-11-15', 5.00, 1, 4),   -- Promoción de 5% de descuento exclusivo para miembros
(11, '2024-11-15', '2024-11-30', 25.00, 1, 5);  -- Promoción de 25% de descuento de lanzamiento
