# +===================================================================
# |
# | Generado el 19-11-2025 a las 06:32:08 PM
# | Servidor: localhost
# | MySQL Version: 10.4.32-MariaDB
# | PHP Version: 8.2.12
# | Base de datos: 'identiqr'
# | Tablas: 
# |
# +-------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS=0;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE `alumno` (
  `Matricula` varchar(15) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `ApePat` varchar(60) NOT NULL,
  `ApeMat` varchar(60) DEFAULT NULL,
  `FechaNac` date NOT NULL,
  `FeIngreso` date NOT NULL,
  `Correo` varchar(60) DEFAULT NULL,
  `Direccion` varchar(60) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
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

INSERT INTO `alumno` VALUES ('SLAO230036', 'ALEXIS SEBASTIAN', 'Sanchez', 'SANCHEZ LUNA', '2005-10-27', '2023-09-01', 'alexissanchezluna@outlook.com', 'Calle Santa Maria Lt 11, Col El Porvenir, Jiutepec Mor.', '777-480-5924', 'Jiutepec', 'Mor.', 'Masculino', '1', 'f61affe332753973ea50003a7da589f52240e0549741ef0d6037c8060f972b58', '2025-11-19', '2026-03-19');

DROP TABLE IF EXISTS `carrera`;
CREATE TABLE `carrera` (
  `idCarrera` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `planEstudios` varchar(45) NOT NULL,
  `idDepto` int(3) NOT NULL,
  PRIMARY KEY (`idCarrera`),
  KEY `idDepto` (`idDepto`),
  CONSTRAINT `carrera_ibfk_1` FOREIGN KEY (`idDepto`) REFERENCES `departamento` (`idDepto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `carrera` VALUES ('1', 'ITI', 'ITI-H18', '2');
INSERT INTO `carrera` VALUES ('2', 'IID', 'TSU-DS-NM24', '2');
INSERT INTO `carrera` VALUES ('3', 'IET', 'IET-H18', '2');
INSERT INTO `carrera` VALUES ('4', 'ISE', 'TSU-RC-NM24', '2');

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE `departamento` (
  `idDepto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(60) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`idDepto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `departamento` VALUES ('1', 'Sin Dirección asociada', 'Sin dirección.');
INSERT INTO `departamento` VALUES ('2', 'Direccion Academica', 'Dirección de carrera');
INSERT INTO `departamento` VALUES ('3', 'Servicios Escolares', 'Administración de trámites académicos y servicios para los estudiantes');
INSERT INTO `departamento` VALUES ('4', 'Dirección Desarrollo Academico', 'Gestión y mejora de los procesos académicos y pedagógicos (Tutoria)');
INSERT INTO `departamento` VALUES ('5', 'Dirección Asuntos Estudiantiles', 'Coordinación de actividades y servicios para el bienestar estudiantil');
INSERT INTO `departamento` VALUES ('6', 'Consultorio de atención de primer contacto', 'Consultoría y atención médica inicial para estudiantes');
INSERT INTO `departamento` VALUES ('7', 'Vinculación', 'Conexión con empresas, organizaciones y otras instituciones educativas');

DROP TABLE IF EXISTS `historialinfoqr`;
CREATE TABLE `historialinfoqr` (
  `idHistorialInfoQR` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `fechaHora` datetime NOT NULL,
  `accionRealizada` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `usuarioRealizado` varchar(45) NOT NULL,
  PRIMARY KEY (`idHistorialInfoQR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `informacionmedica`;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `informacionmedica` VALUES ('1', 'SLAO230036', 'A+', 'S/A', '777-123-4567', '2025-11-19');

DROP TABLE IF EXISTS `registroservicio`;
CREATE TABLE `registroservicio` (
  `FolioRegistro` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Matricula` varchar(15) NOT NULL,
  `idTramite` int(4) unsigned zerofill NOT NULL,
  `FechaHora` datetime NOT NULL,
  `descripcion` text DEFAULT 'S/D',
  `estatusT` varchar(45) DEFAULT 'Pendiente',
  `FolioSeguimiento` varchar(45) DEFAULT 'Procesando',
  PRIMARY KEY (`FolioRegistro`),
  KEY `Matricula` (`Matricula`),
  KEY `idTramite` (`idTramite`),
  CONSTRAINT `registroservicio_ibfk_1` FOREIGN KEY (`Matricula`) REFERENCES `alumno` (`Matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registroservicio_ibfk_2` FOREIGN KEY (`idTramite`) REFERENCES `serviciotramite` (`idTramite`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `registroservicio` VALUES ('0001', 'SLAO230036', '0011', '2025-11-19 15:52:13', '                            El Alumno [ALEXIS SEBASTIAN Sanchez SANCHEZ LUNA] con matrícula [SLAO230036] del cuatrimestre [7] de la carrera [ITI] solicitó un <JUSTIFICANTE> para el día [2025-11-19]. Requisitos o notas [fALTA A TUTORIA]                        ', 'Aprobado', 'SLAO230036-202519Jus-OZHN');
INSERT INTO `registroservicio` VALUES ('0015', 'SLAO230036', '0004', '2025-11-19 16:40:06', 'El Alumno [ALEXIS SEBASTIAN Sanchez SANCHEZ LUNA] con matrícula [SLAO230036] y correo [alexissanchezluna@outlook.com], inscrito en el 7 Cuatri de [ITI], <7O-2025> |PERIODO: <Solicitó el tramite> [Tramite de Servicios escolares - 3] el día <2025-11-19> |Motivo adicional: [NO APLICA] | Monto pagado: [$250.00] | Método de pago: [TDD]. Requerimientos extras: <PRIMERO>', 'Pendiente', 'SLAO230036-202519Ins-NIZA');
INSERT INTO `registroservicio` VALUES ('0018', 'SLAO230036', '0010', '2025-11-19 16:41:15', 'El Alumno [ALEXIS SEBASTIAN Sanchez SANCHEZ LUNA] con matrícula [SLAO230036] y correo [alexissanchezluna@outlook.com], inscrito en el 7 Cuatri de [ITI], <7O-2025> |PERIODO: <Solicitó el tramite> [Tramite de Servicios escolares - 3] el día <2025-11-19> |Motivo adicional: [OTROS] | Monto pagado: [$500.00] | Método de pago: [TDC]. Requerimientos extras: <PERDÍ LA CREDENCIAL>', 'Pendiente', 'SLAO230036-202519Rep-WYCP');
INSERT INTO `registroservicio` VALUES ('0019', 'SLAO230036', '0010', '2025-11-19 16:42:07', 'El Alumno [ALEXIS SEBASTIAN Sanchez SANCHEZ LUNA] con matrícula [SLAO230036] y correo [alexissanchezluna@outlook.com], inscrito en el 7 Cuatri de [ITI], <7O-2025> |PERIODO: <Solicitó el tramite> [Tramite de Servicios escolares - 3] el día <2025-11-19> |Motivo adicional: [OTROS] | Monto pagado: [$500.00] | Método de pago: [TDC]. Requerimientos extras: <PERDÍ LA CREDENCIAL>', 'Pendiente', 'SLAO230036-202519Rep-RFBR');
INSERT INTO `registroservicio` VALUES ('0022', 'SLAO230036', '0010', '2025-11-19 16:43:39', 'El Alumno [ALEXIS SEBASTIAN Sanchez SANCHEZ LUNA] con matrícula [SLAO230036] y correo [alexissanchezluna@outlook.com], inscrito en el 7 Cuatri de [ITI], <7O-2025> |PERIODO: <Solicitó el tramite> [Tramite de Servicios escolares - 3] el día <2025-11-19> |Motivo adicional: [OTROS] | Monto pagado: [$500.00] | Método de pago: [TDC]. Requerimientos extras: <PERDÍ LA CREDENCIAL>', 'Pendiente', 'SLAO230036-202519Rep-VCBZ');
INSERT INTO `registroservicio` VALUES ('0023', 'SLAO230036', '0014', '2025-11-19 16:44:04', 'El Alumno [ALEXIS SEBASTIAN Sanchez SANCHEZ LUNA] con matrícula [SLAO230036] y correo [alexissanchezluna@outlook.com], inscrito en el 7 Cuatri de [ITI], <7O-2025> |PERIODO: <Solicitó el tramite> [Tramite de Servicios escolares - 3] el día <2025-11-19> |Motivo adicional: [BAJA_TEMPORAL] | Monto pagado: [$1000.00] | Método de pago: [TDD]. Requerimientos extras: <POR MOTIVOS PERSONALES>', 'Aprobado', 'SLAO230036-202519Con-ZYSU');
INSERT INTO `registroservicio` VALUES ('0024', 'SLAO230036', '0003', '2025-11-19 17:15:57', 'El Alumno [ALEXIS SEBASTIAN Sanchez SANCHEZ LUNA] con matrícula [SLAO230036] y correo [alexissanchezluna@outlook.com], inscrito en el 7 Cuatri de [ITI], <7O-2025> |PERIODO: <Solicitó el tramite> [Tramite de Servicios escolares - 3] el día <2025-11-19> |Motivo adicional: [IMSS] | Monto pagado: [$250.00] | Método de pago: [TDD]. Requerimientos extras: <Urge>', 'Pendiente', 'SLAO230036-202519Rei-TKXG');
INSERT INTO `registroservicio` VALUES ('0025', 'SLAO230036', '0001', '2025-11-19 17:42:01', 'El Alumno [ALEXIS SEBASTIAN Sanchez SANCHEZ LUNA] con matrícula [SLAO230036] del cuatrimestre [7] de la carrera [ITI] <Solicitó unirse al extracurricular> de [Extracurricular-Fubtol]. Datos Médicos [$S/A- Sangre: A+]', 'Pendiente', 'SLAO230036-202519Ext-ZAEW');
INSERT INTO `registroservicio` VALUES ('0026', 'SLAO230036', '0004', '2025-11-19 18:11:14', 'El Alumno [ALEXIS SEBASTIAN Sanchez SANCHEZ LUNA] con matrícula [SLAO230036] y correo [alexissanchezluna@outlook.com], inscrito en el 7 Cuatri de [ITI], <7O-2025> |PERIODO: <Solicitó el tramite> [Tramite de Servicios escolares - 3] el día <2025-11-19> |Motivo adicional: [TITULACION] | Monto pagado: [$1.00] | Método de pago: [Transferencia]. Requerimientos extras: <RAPIDO>', 'Pendiente', 'SLAO230036-202519Ins-OGMR');

DROP TABLE IF EXISTS `serviciotramite`;
CREATE TABLE `serviciotramite` (
  `idTramite` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) NOT NULL,
  `idDepto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTramite`),
  KEY `idDepto` (`idDepto`),
  CONSTRAINT `serviciotramite_ibfk_1` FOREIGN KEY (`idDepto`) REFERENCES `departamento` (`idDepto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `genero` varchar(45) DEFAULT 'Otro',
  `usr` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `passw` varchar(255) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `idDepto` int(11) DEFAULT NULL,
  `FechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `idDepto` (`idDepto`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idDepto`) REFERENCES `departamento` (`idDepto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP FUNCTION IF EXISTS `calcCuatrimestre`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `calcCuatrimestre`(feIngreso date) RETURNS int(11)
    DETERMINISTIC
begin
	declare m, c int; #Meses || Cuatrimestres
    set m = timestampdiff(month,feIngreso,curdate());
    set c = (truncate(m/4,0) + 1);
    return c;
end//
DELIMITER ;

DROP FUNCTION IF EXISTS `calcPeriodo`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `calcPeriodo`(feIngreso DATE) RETURNS varchar(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    DETERMINISTIC
BEGIN
    DECLARE cuatri INT;
    DECLARE periodo CHAR(1);
    DECLARE anio CHAR(4);
    SET cuatri = CalcCuatrimestre(feIngreso);
    CASE 
        WHEN MONTH(CURDATE()) BETWEEN 1 AND 4 THEN 
            SET periodo = 'I';   -- Invierno
        WHEN MONTH(CURDATE()) BETWEEN 5 AND 8 THEN 
            SET periodo = 'P';   -- Primavera
        WHEN MONTH(CURDATE()) BETWEEN 9 AND 12 THEN 
            SET periodo = 'O';   -- Otoño
    END CASE;
    SET anio = YEAR(CURDATE());
    RETURN CONCAT(cuatri, periodo, '-', anio);
END//
DELIMITER ;

DROP PROCEDURE IF EXISTS `cancelarTramite`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `cancelarTramite`(IN FR int, OUT eliminado INT)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SET eliminado = 0;
    END;
    START TRANSACTION;
    DELETE FROM registroservicio WHERE (FolioRegistro = FR);
    SET eliminado = ROW_COUNT(); -- número de filas afectadas
    COMMIT;
END//
DELIMITER ;

DROP PROCEDURE IF EXISTS `cancelarTramite2`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `cancelarTramite2`(IN FS text, OUT eliminado INT)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SET eliminado = 0;
    END;
    START TRANSACTION;
    DELETE FROM registroservicio WHERE (FolioSeguimiento = FS);
    SET eliminado = ROW_COUNT(); -- número de filas afectadas
    COMMIT;
END//
DELIMITER ;

DROP PROCEDURE IF EXISTS `darBajaAlumno`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `darBajaAlumno`(IN matr VARCHAR(45), OUT eliminado INT)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SET eliminado = 0;
    END;
    START TRANSACTION;
    DELETE FROM alumno WHERE (Matricula = matr);
    SET eliminado = ROW_COUNT(); -- número de filas afectadas
    COMMIT;
END//
DELIMITER ;

DROP PROCEDURE IF EXISTS `darBajaUsuario`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `darBajaUsuario`(IN usuario VARCHAR(45), OUT eliminado INT)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SET eliminado = 0;
    END;
    START TRANSACTION;
    DELETE FROM usuario WHERE (usr = usuario);
    SET eliminado = ROW_COUNT(); -- número de filas afectadas
    COMMIT;
END//
DELIMITER ;

DROP PROCEDURE IF EXISTS `Login`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `Login`(in us varchar(255), in pass text)
begin
	declare pass_md5 text;
    set pass_md5 = md5(pass);
    select * from usuario where (usr = us or email = us) and passw = pass_md5; 
end//
DELIMITER ;

DROP PROCEDURE IF EXISTS `registrarUsuariosSP`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarUsuariosSP`(in nombre varchar(60), in ApP varchar(45), in ApM varchar(45),in usr varchar(100), in email varchar(100), in passw varchar(255), in rol varchar(45), in idDepto int)
begin
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
    END;
    START TRANSACTION; #Empezamos la transacción
    INSERT INTO Usuario (nombre,apellido_paterno,apellido_materno,usr,email,passw,rol,idDepto) 
		VALUES (nombre,ApP,ApM,usr,email,passw,rol,idDepto);
	SELECT LAST_INSERT_ID() AS id_usuario;
    COMMIT;
end//
DELIMITER ;

DROP PROCEDURE IF EXISTS `reporteInd_DirMed`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `reporteInd_DirMed`(in opc int,in f1 date,in f2 date, in g varchar(15), in idD int)
begin
    declare idDe int default 6; #Este sera una variable para modificar que departamento se refiere
    declare Matri,Nom,Pat,Mat,Corr,Tel,Ciu,Est,Gen,TipSan,Aler,Per,ContEme varchar(60); #Matricula, Nombre, Paterno, Materno, Correo, Telefono,Ciudad,Estado,Genero,TipoSangre,Alergias,Periodo,Contacto_emergencia
    declare Des,plEst varchar(45); #descripción, planEstudios,
    declare idCar, idDep, idInf, FolReg, idTra int; #idCarrera,idDepto,idInfoM, idTramite, idDepto
    declare DesServ, EstT, FolSeg text; #Descripción(registroservicio), estatusT, FolioSeguimiento
    declare FeNac,FeIng date; #FechaNacimiento, FechaIngreso
    declare FeHor datetime; #FechaHora
    declare buscarRep_DirMed cursor for
		SELECT
            a.Matricula,
            a.Nombre,
            a.ApePat,
            a.ApeMat,
            a.FechaNac,
            a.FeIngreso,
            a.Correo,
            a.Telefono,
            a.Ciudad,
            a.Estado,
            a.Genero,
            im.TipoSangre,
            im.Alergias,
            im.contacto_Emergencia,
            c.idCarrera,
            rs.folioRegistro AS IdRegistro,
            rs.descripcion AS DescripcionServ,
            rs.EstatusT AS EstatusServ,
            rs.FolioSeguimiento,
            rs.FechaHora AS FechaHoraServ,
            st.idTramite AS idTramite,
            st.idDepto AS idDepto
		FROM alumno a
        LEFT JOIN carrera c ON a.idCarrera = c.idCarrera
        LEFT JOIN informacionmedica im ON a.Matricula = im.Matricula
        LEFT JOIN registroservicio rs ON a.Matricula = rs.Matricula
        LEFT JOIN serviciotramite st ON st.idTramite = rs.idTramite
        WHERE
            (opc = 1 AND rs.FechaHora BETWEEN f1 AND f2)
		OR
            (opc = 2 AND a.Genero = g)
		AND
			(idD = idDe)
        ORDER BY rs.FechaHora DESC;
	declare continue handler for not found set @x = true;
    open buscarRep_DirMed;
    IF opc NOT IN (1,2) THEN
        SIGNAL SQLSTATE '22003' 
            SET MESSAGE_TEXT = 'Opción no válida. Usa 1 = rango fechas o 2 = género';
    END IF;
    loop1:loop
		fetch buscarRep_DirMed into Matri,Nom,Pat,Mat,FeNac,FeIng,Corr,Tel,Ciu,Est,Gen,TipSan,Aler,ContEme,idCar,FolReg,DesServ,EstT,FolSeg,FeHor,idTra,idDep;
    if @x then
		leave loop1;
	end if;
		select Matri,Nom,Pat,Mat,FeNac,FeIng,Corr,Tel,Ciu,Est,Gen,TipSan,Aler,ContEme,idCar,FolReg,DesServ,EstT,FolSeg,FeHor,idTra,idDep;
	end loop;
    close buscarRep_DirMed;
end//
DELIMITER ;

DROP TRIGGER IF EXISTS `actHash_QR_Alumno`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` trigger actHash_QR_Alumno before update on alumno
for each row
begin
	if ((old.qrHash != new.qrHash) and (new.qrHash != 'Pendiente')) then
        set new.fechaGenerarQR_1 = curdate();
        set new.fechaExpiracionQR_2 = adddate(new.fechaGenerarQR_1, interval 4 month); /*En automatico la fecha del HASH o de expiración sera en 4 MESES.*/
    end if;
end//
DELIMITER ;

DROP TRIGGER IF EXISTS `ingInfoMed_Medico`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` trigger ingInfoMed_Medico before insert on informacionMedica
for each row
begin
	set new.fechaIngreso_InfoMed = curdate();
end//
DELIMITER ;

DROP TRIGGER IF EXISTS `actInfoMed_Medico`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` trigger actInfoMed_Medico before update on informacionMedica
for each row
begin
	if(old.fechaIngreso_InfoMed != new.fechaIngreso_InfoMed) then
		set new.fechaIngreso_InfoMed = curdate(); 
    end if;
end//
DELIMITER ;

DROP TRIGGER IF EXISTS `regisServ_Tramite`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` trigger regisServ_Tramite before insert on registroservicio
for each row
begin
	declare letras varchar(4);
    declare tipoTram varchar(45);
	set new.FechaHora = now();
    set tipoTram = (select Descripcion from serviciotramite where idTramite = new.idTramite);
	set letras = CONCAT(
        char(FLOOR(RAND() * 26) + 65),
        char(FLOOR(RAND() * 26) + 65),
        char(FLOOR(RAND() * 26) + 65),
        char(FLOOR(RAND() * 26) + 65)
    );
    set new.FolioSeguimiento = concat(new.matricula,"-",year(curdate()),day(curdate()),substring(tipoTram,1,3),"-",letras);
end//
DELIMITER ;

DROP TRIGGER IF EXISTS `IngresoUsuario`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` trigger IngresoUsuario before insert on Usuario
for each row
begin
	declare n,p,m varchar(10);
    set new.passw = MD5(new.passw);
    set new.FechaRegistro = now();
    set new.usr = upper(concat(left(new.nombre,1),left(new.apellido_paterno,1),right(new.apellido_materno,1),year(new.FechaRegistro),"-",substring(UUID(),1,2)));
end//
DELIMITER ;

DROP TRIGGER IF EXISTS `Ing_Bita_Usuario`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` trigger Ing_Bita_Usuario after insert on Usuario
for each row
begin
	declare mensaje text;
    declare accionR varchar(20); #Registro,Modificación,Baja
    declare usR text;
    set mensaje = concat_ws(" ", "Usuario nuevo dado de alta.",new.nombre, new.email);
    set accionR = "Registro";
    set usR = concat_ws(" ", "Realizado por: ", user());
    insert into HistorialInfoQR values (0,now(),accionR,mensaje,usR);
end//
DELIMITER ;

DROP TRIGGER IF EXISTS `IngresoUsuarioAct`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` trigger IngresoUsuarioAct before update on Usuario
for each row
begin
	if(new.passw != old.passw) then
		set new.passw = MD5(new.passw);
		set new.FechaRegistro = now();
    end if;
    /*--DIFERENTES TIPOS DE ENCRIPTACIÓN
    select Password("abc");
	select MD5("abc");
	select sha("AAA");
	select aes_encrypt("AAA","clave") into @x;
	select convert(aes_decrypt(@x,"clave") using utf8);
    https://youtu.be/JQnrO1eDR-0?si=4VP6ykF-bHJVpSEc
    */
end//
DELIMITER ;

DROP TRIGGER IF EXISTS `Act_Bita_Usuario`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` trigger Act_Bita_Usuario after update on Usuario
for each row
begin
	declare mensaje text;
    declare accionR varchar(20); #Registro,Modificación,Baja
    declare usR text;
    set mensaje = concat_ws(" ", "Usuario actualizado datos: ",new.nombre, new.email, new.passw, "Anteriores: ", old.nombre,old.email,old.passw);
    set accionR = "Actualización";
    set usR = concat_ws(" ", "Realizado por: ", user());
    insert into HistorialInfoQR values (0,now(),accionR,mensaje,usR);
end//
DELIMITER ;

DROP TRIGGER IF EXISTS `Baja_Bita_Usuario`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` trigger Baja_Bita_Usuario after delete on Usuario
for each row
begin
	declare mensaje text;
    declare accionR varchar(20); #Registro,Modificación,Baja
    declare usR text;
    set mensaje = concat_ws(" ", "Usuario viejo dado de baja.",old.nombre, old.email);
    set accionR = "Baja";
    set usR = concat_ws(" ", "Realizado por: ", user());
    insert into HistorialInfoQR values (0,now(),accionR,mensaje,usR);
end//
DELIMITER ;

SET FOREIGN_KEY_CHECKS=1;
