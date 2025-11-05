# +===================================================================
# |
# | Generado el 02-11-2025 a las 12:34:46 AM
# | Servidor: localhost
# | MySQL Version: 10.4.32-MariaDB
# | PHP Version: 8.2.12
# | Base de datos: 'identiqr'
# | Tablas: alumno;  carrera;  departamento;  historialinfoqr;  informacionmedica;  registroservicio;  serviciotramite;  usuario
# |
# +-------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS=0;


# | Vaciado de tabla 'alumno'
# +------------------------------------->
# DROP TABLE not specified.

# | Estructura de la tabla 'alumno'
# +------------------------------------->
CREATE TABLE `alumno` (
  `Matricula` varchar(15) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `ApePat` varchar(60) NOT NULL,
  `ApeMat` varchar(60) DEFAULT NULL,
  `FechaNac` date NOT NULL,
  `FeIngreso` date NOT NULL,
  `Correo` varchar(60) DEFAULT NULL,
  `Direccion` varchar(60) NOT NULL,
  `Telefono` varchar(11) NOT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `Genero` varchar(10) DEFAULT 'Otro',
  `idCarrera` int(11) NOT NULL,
  `qrHash` text DEFAULT 'Pendiente',
  `fechaGenerarQR_1` date NOT NULL,
  `fechaExpiracionQR_2` date DEFAULT NULL,
  PRIMARY KEY (`Matricula`),
  UNIQUE KEY `Correo` (`Correo`),
  KEY `idCarrera` (`idCarrera`),
  CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`idCarrera`) REFERENCES `carrera` (`idCarrera`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

# | Carga de datos de la tabla 'alumno'
# +------------------------------------->


# | Vaciado de tabla 'carrera'
# +------------------------------------->
# DROP TABLE not specified.

# | Estructura de la tabla 'carrera'
# +------------------------------------->
CREATE TABLE `carrera` (
  `idCarrera` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `planEstudios` varchar(45) NOT NULL,
  `idDepto` int(3) NOT NULL,
  PRIMARY KEY (`idCarrera`),
  KEY `idDepto` (`idDepto`),
  CONSTRAINT `carrera_ibfk_1` FOREIGN KEY (`idDepto`) REFERENCES `departamento` (`idDepto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

# | Carga de datos de la tabla 'carrera'
# +------------------------------------->
INSERT INTO `carrera` VALUES ('1', 'ITI', 'ITI-H18', '2');
INSERT INTO `carrera` VALUES ('2', 'IID', 'TSU-DS-NM24', '2');
INSERT INTO `carrera` VALUES ('3', 'IET', 'IET-H18', '2');
INSERT INTO `carrera` VALUES ('4', 'ISE', 'TSU-RC-NM24', '2');


# | Vaciado de tabla 'departamento'
# +------------------------------------->
# DROP TABLE not specified.

# | Estructura de la tabla 'departamento'
# +------------------------------------->
CREATE TABLE `departamento` (
  `idDepto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(60) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`idDepto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

# | Carga de datos de la tabla 'departamento'
# +------------------------------------->
INSERT INTO `departamento` VALUES ('1', 'Sin Dirección asociada', 'Sin dirección.');
INSERT INTO `departamento` VALUES ('2', 'Direccion Academica', 'Dirección de carrera');
INSERT INTO `departamento` VALUES ('3', 'Servicios Escolares', 'Administración de trámites académicos y servicios para los estudiantes');
INSERT INTO `departamento` VALUES ('4', 'Dirección Desarrollo Academico', 'Gestión y mejora de los procesos académicos y pedagógicos (Tutoria)');
INSERT INTO `departamento` VALUES ('5', 'Dirección Asuntos Estudiantiles', 'Coordinación de actividades y servicios para el bienestar estudiantil');
INSERT INTO `departamento` VALUES ('6', 'Consultorio de atención de primer contacto', 'Consultoría y atención médica inicial para estudiantes');
INSERT INTO `departamento` VALUES ('7', 'Vinculación', 'Conexión con empresas, organizaciones y otras instituciones educativas');


# | Vaciado de tabla 'historialinfoqr'
# +------------------------------------->
# DROP TABLE not specified.

# | Estructura de la tabla 'historialinfoqr'
# +------------------------------------->
CREATE TABLE `historialinfoqr` (
  `idHistorialInfoQR` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `fechaHora` datetime NOT NULL,
  `accionRealizada` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `usuarioRealizado` varchar(45) NOT NULL,
  PRIMARY KEY (`idHistorialInfoQR`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

# | Carga de datos de la tabla 'historialinfoqr'
# +------------------------------------->
INSERT INTO `historialinfoqr` VALUES ('00001', '2025-10-28 21:10:43', 'Registro', 'Usuario nuevo dado de alta. Identi identiqr.info@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00002', '2025-10-28 22:34:50', 'Registro', 'Usuario nuevo dado de alta. Pedro alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00003', '2025-10-28 23:13:17', 'Baja', 'Usuario viejo dado de baja. Pedro alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00004', '2025-10-28 23:14:00', 'Registro', 'Usuario nuevo dado de alta. JOSE MANUEL alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00005', '2025-10-29 18:06:08', 'Baja', 'Usuario viejo dado de baja. JOSE MANUEL alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00006', '2025-10-29 18:07:43', 'Registro', 'Usuario nuevo dado de alta. ALEXIS SEBASTIAN alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00007', '2025-10-29 18:09:42', 'Baja', 'Usuario viejo dado de baja. ALEXIS SEBASTIAN alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00008', '2025-10-29 18:10:01', 'Registro', 'Usuario nuevo dado de alta. ALEXIS SEBASTIAN alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00009', '2025-10-29 18:11:11', 'Baja', 'Usuario viejo dado de baja. ALEXIS SEBASTIAN alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00010', '2025-10-29 18:11:25', 'Registro', 'Usuario nuevo dado de alta. ALEXIS SEBASTIAN alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00011', '2025-10-29 18:22:17', 'Baja', 'Usuario viejo dado de baja. ALEXIS SEBASTIAN alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00012', '2025-10-29 18:22:24', 'Registro', 'Usuario nuevo dado de alta. JOSE MANUEL alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00013', '2025-10-29 20:39:16', 'Baja', 'Usuario viejo dado de baja. JOSE MANUEL alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00014', '2025-10-29 20:40:12', 'Registro', 'Usuario nuevo dado de alta. JOSE MANUEL alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00015', '2025-10-29 21:02:30', 'Baja', 'Usuario viejo dado de baja. JOSE MANUEL alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00016', '2025-10-29 21:03:14', 'Registro', 'Usuario nuevo dado de alta. JOSE MANUEL alexissanchezluna5@gmail.com', 'Realizado por:  root@localhost');
INSERT INTO `historialinfoqr` VALUES ('00017', '2025-10-30 12:43:21', 'Registro', 'Usuario nuevo dado de alta. Sandra lsandra@upemor.edu.mx', 'Realizado por:  root@localhost');


# | Vaciado de tabla 'informacionmedica'
# +------------------------------------->
# DROP TABLE not specified.

# | Estructura de la tabla 'informacionmedica'
# +------------------------------------->
CREATE TABLE `informacionmedica` (
  `idInfoM` int(11) NOT NULL AUTO_INCREMENT,
  `Matricula` varchar(15) NOT NULL,
  `TipoSangre` varchar(5) NOT NULL,
  `Alergias` text DEFAULT 'Sin_Alergias',
  `contacto_emergencia` varchar(15) DEFAULT NULL,
  `fechaIngreso_InfoMed` date DEFAULT NULL,
  PRIMARY KEY (`idInfoM`),
  KEY `Matricula` (`Matricula`),
  CONSTRAINT `informacionmedica_ibfk_1` FOREIGN KEY (`Matricula`) REFERENCES `alumno` (`Matricula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

# | Carga de datos de la tabla 'informacionmedica'
# +------------------------------------->


# | Vaciado de tabla 'registroservicio'
# +------------------------------------->
# DROP TABLE not specified.

# | Estructura de la tabla 'registroservicio'
# +------------------------------------->
CREATE TABLE `registroservicio` (
  `FolioRegistro` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Matricula` varchar(15) NOT NULL,
  `idTramite` int(4) unsigned zerofill NOT NULL,
  `FechaHora` datetime NOT NULL,
  `descripcion` text DEFAULT 'S/D',
  `estatusT` varchar(45) DEFAULT 'Pendiente',
  PRIMARY KEY (`FolioRegistro`),
  KEY `Matricula` (`Matricula`),
  KEY `idTramite` (`idTramite`),
  CONSTRAINT `registroservicio_ibfk_1` FOREIGN KEY (`Matricula`) REFERENCES `alumno` (`Matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registroservicio_ibfk_2` FOREIGN KEY (`idTramite`) REFERENCES `serviciotramite` (`idTramite`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

# | Carga de datos de la tabla 'registroservicio'
# +------------------------------------->


# | Vaciado de tabla 'serviciotramite'
# +------------------------------------->
# DROP TABLE not specified.

# | Estructura de la tabla 'serviciotramite'
# +------------------------------------->
CREATE TABLE `serviciotramite` (
  `idTramite` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) NOT NULL,
  `idDepto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTramite`),
  KEY `idDepto` (`idDepto`),
  CONSTRAINT `serviciotramite_ibfk_1` FOREIGN KEY (`idDepto`) REFERENCES `departamento` (`idDepto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

# | Carga de datos de la tabla 'serviciotramite'
# +------------------------------------->
INSERT INTO `serviciotramite` VALUES ('0001', 'Extracurricular', '5');
INSERT INTO `serviciotramite` VALUES ('0002', 'Tutorias', '4');
INSERT INTO `serviciotramite` VALUES ('0003', 'Reinscripcion', '3');
INSERT INTO `serviciotramite` VALUES ('0004', 'Inscripcion', '3');
INSERT INTO `serviciotramite` VALUES ('0005', 'Estancia I', '7');
INSERT INTO `serviciotramite` VALUES ('0006', 'Estancia II', '7');
INSERT INTO `serviciotramite` VALUES ('0007', 'Estadia', '7');
INSERT INTO `serviciotramite` VALUES ('0008', 'Servicio Social', '7');
INSERT INTO `serviciotramite` VALUES ('0009', 'Practicas Profesionales', '7');
INSERT INTO `serviciotramite` VALUES ('0010', 'Reposicion Credencial', '3');
INSERT INTO `serviciotramite` VALUES ('0011', 'Justificante', '2');
INSERT INTO `serviciotramite` VALUES ('0012', 'Recursamiento', '2');
INSERT INTO `serviciotramite` VALUES ('0013', 'Consulta medica', '6');
INSERT INTO `serviciotramite` VALUES ('0014', 'Constancias e historial', '3');


# | Vaciado de tabla 'usuario'
# +------------------------------------->
# DROP TABLE not specified.

# | Estructura de la tabla 'usuario'
# +------------------------------------->
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `genero` varchar(45) DEFAULT 'Otro',
  `usr` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `passw` varchar(150) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `idDepto` int(11) DEFAULT NULL,
  `FechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `idDepto` (`idDepto`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idDepto`) REFERENCES `departamento` (`idDepto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

# | Carga de datos de la tabla 'usuario'
# +------------------------------------->
INSERT INTO `usuario` VALUES ('1', 'Identi', 'Q', 'R', 'Otro', 'IQR2025-DB', 'identiqr.info@gmail.com', '16810c2c3c47c48bac34b13477334246', 'Administrador', '1', '2025-10-28 21:10:43');
INSERT INTO `usuario` VALUES ('22', 'JOSE MANUEL', 'Arenal', 'Araujo', 'Otro', 'JAO2025-FB', 'alexissanchezluna5@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Administrador', '1', '2025-10-29 21:03:14');
INSERT INTO `usuario` VALUES ('23', 'Sandra', 'Leon', 'Sosa', 'Otro', 'SLA2025-4F', 'lsandra@upemor.edu.mx', '81dc9bdb52d04dc20036dbd8313ed055', 'Administrativo_Vinculacion', '7', '2025-10-30 12:43:21');


SET FOREIGN_KEY_CHECKS=1;
