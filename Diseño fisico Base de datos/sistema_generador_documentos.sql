CREATE DATABASE SGD;

USE SGD;

CREATE TABLE Facultad(
    id_facultad int NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(200),
    acronimo VARCHAR(15),
    PRIMARY KEY (id_facultad)
);

CREATE TABLE Escuela(
    id_escuela int NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(200),
    acronimo VARCHAR(15),
    logo VARCHAR(45),
    id_facultad int NOT NULL,
    PRIMARY KEY (id_escuela),
    FOREIGN KEY (id_facultad) REFERENCES Facultad(id_facultad)
);

CREATE TABLE Cargo(
    id_cargo int NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50),
    PRIMARY KEY (id_cargo)
);

CREATE TABLE Usuario(
    id_usuario int NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(50),
    contrasenia VARCHAR(100),
    correo VARCHAR(100),
    fecha_registro TIMESTAMP,
    nombres VARCHAR(80),
    apellidos VARCHAR(100),
    id_cargo int NOT NULL,
    id_escuela int NOT NULL,
    PRIMARY KEY (id_usuario),
    FOREIGN KEY (id_cargo) REFERENCES Cargo(id_cargo),
    FOREIGN KEY (id_escuela) REFERENCES Escuela(id_escuela)
);

CREATE TABLE Archivo_excel(
    id_archivo_excel int NOT NULL AUTO_INCREMENT,
    nombre_archivo_excel VARCHAR(100),
    fecha_subida TIMESTAMP,
    id_usuario int NOT NULL,
    PRIMARY KEY (id_archivo_excel),
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Tutor(
    id_tutor int NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(30),
    apellidos VARCHAR(50),
    grado_academico VARCHAR(15),
    id_archivo_excel int NOT NULL,
    PRIMARY KEY (id_tutor),
    FOREIGN KEY (id_archivo_excel) REFERENCES Archivo_excel(id_archivo_excel)
);

CREATE TABLE Situacion_tutorado(
    id_situacion_tutorado int NOT NULL AUTO_INCREMENT,
    nombre_situacion VARCHAR(100),
    PRIMARY KEY (id_situacion_tutorado)
);

CREATE TABLE Tutorado(
    id_tutorado int NOT NULL AUTO_INCREMENT,
    apellidos_nombres VARCHAR(200),
    id_situacion_tutorado int NOT NULL,
    id_tutor int NOT NULL,
    id_archivo_excel int NOT NULL,
    PRIMARY KEY (id_tutorado),
    FOREIGN KEY (id_situacion_tutorado) REFERENCES Situacion_tutorado(id_situacion_tutorado),
    FOREIGN KEY (id_tutor) REFERENCES Tutor(id_tutor),
    FOREIGN KEY (id_archivo_excel) REFERENCES Archivo_excel(id_archivo_excel)
);

CREATE TABLE Tipo_archivo(
    id_tipo_archivo int NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50),
    PRIMARY KEY (id_tipo_archivo)
);

CREATE TABLE Archivo_extension(
    id_archivo_extension int NOT NULL AUTO_INCREMENT,
    nombre CHAR(5),
    icono VARCHAR(30),
    PRIMARY KEY (id_archivo_extension)
);

/*revisar*/

CREATE TABLE Archivos_generar(
    id_archivo_excel int NOT NULL,
    id_tipo_archivo int NOT NULL,
    id_archivo_extension int NOT NULL,
    PRIMARY KEY (id_archivo_excel, id_tipo_archivo, id_archivo_extension),
    FOREIGN KEY (id_archivo_excel) REFERENCES Archivo_excel(id_archivo_excel),
    FOREIGN KEY (id_tipo_archivo) REFERENCES Tipo_archivo(id_tipo_archivo),
    FOREIGN KEY (id_archivo_extension) REFERENCES Archivo_extension(id_archivo_extension)
);

CREATE TABLE Periodo_academico(
    id_periodo_academico int NOT NULL AUTO_INCREMENT,
    anio int,
    ciclo CHAR(11),
    PRIMARY KEY (id_periodo_academico)
);

CREATE TABLE Campos_memorando(
    id_campo_memorando int NOT NULL AUTO_INCREMENT,
    num_inicio_memorando int,
    responsable VARCHAR(500),
    cargo_responsable VARCHAR(500),
    fecha TIMESTAMP,
    id_periodo_academico int NOT NULL,
    id_archivo_excel int NOT NULL,
    PRIMARY KEY (id_campo_memorando),
    FOREIGN KEY (id_periodo_academico) REFERENCES Periodo_academico(id_periodo_academico),
    FOREIGN KEY (id_archivo_excel) REFERENCES Archivo_excel(id_archivo_excel)
);

CREATE TABLE Archivos_tablas_asignacion(
    id_archivo_tablas_asignacion int NOT NULL AUTO_INCREMENT,
    nombre_archivo VARCHAR(200),
    fecha_generacion TIMESTAMP,
    id_archivo_excel int NOT NULL,
    PRIMARY KEY (id_archivo_tablas_asignacion),
    FOREIGN KEY (id_archivo_excel) REFERENCES Archivo_excel(id_archivo_excel)
);

CREATE TABLE Archivo_tablas_asig_extension(
    id_archivo_tablas_asignacion int NOT NULL AUTO_INCREMENT,
    id_archivo_extension int NOT NULL,
    url_archivo VARCHAR(300),
    PRIMARY KEY (id_archivo_tablas_asignacion, id_archivo_extension),
    FOREIGN KEY (id_archivo_tablas_asignacion) REFERENCES Archivos_tablas_asignacion(id_archivo_tablas_asignacion),
    FOREIGN KEY (id_archivo_extension) REFERENCES Archivo_extension(id_archivo_extension)
);

CREATE TABLE Texto_memorando(
    id_texto_memorando VARCHAR(30) NOT NULL,
    texto VARCHAR(900),
    PRIMARY KEY (id_texto_memorando)
);

CREATE TABLE Memorando(
    id_memorando int NOT NULL AUTO_INCREMENT,
    nombre_archivo VARCHAR(300),
    id_texto_memorando VARCHAR(30) NOT NULL,
    id_tutor int NOT NULL,
    id_archivo_excel int NOT NULL,
    PRIMARY KEY (id_memorando),
    FOREIGN KEY (id_tutor) REFERENCES Tutor(id_tutor),
    FOREIGN KEY (id_texto_memorando) REFERENCES Texto_memorando(id_texto_memorando),
    FOREIGN KEY (id_archivo_excel) REFERENCES Archivo_excel(id_archivo_excel)
);

CREATE TABLE Archivo_memorando_extension(
    id_memorando int NOT NULL AUTO_INCREMENT,
    id_archivo_extension int NOT NULL,
    url_archivo VARCHAR(100),
    PRIMARY KEY (id_memorando, id_archivo_extension),
    FOREIGN KEY (id_memorando) REFERENCES Memorando(id_memorando),
    FOREIGN KEY (id_archivo_extension) REFERENCES Archivo_extension(id_archivo_extension)
);

CREATE TABLE Archivo_descarga(
    id_archivo_descarga int NOT NULL AUTO_INCREMENT,
    url_archivo VARCHAR(100),
    id_tipo_archivo int NOT NULL,
    id_archivo_excel int NOT NULL,
    PRIMARY KEY (id_archivo_descarga),
    FOREIGN KEY (id_tipo_archivo) REFERENCES Tipo_archivo(id_tipo_archivo),
    FOREIGN KEY (id_archivo_excel) REFERENCES Archivo_excel(id_archivo_excel)
);





/* INSERTANDO DATOS A LA BASE DE DATOS */
INSERT INTO `periodo_academico` (`id_periodo_academico`, `anio`, `ciclo`) VALUES
	(1, 2020, 'I'),
	(2, 2020, 'II'),
	(3, 2021, 'I'),
	(4, 2021, 'II'),
	(5, 2022, 'I'),
	(6, 2022, 'II');

INSERT INTO `cargo` (`id_cargo`, `nombre`) VALUES
	(1, 'SECRETARIO'),
	(2, 'COORDINADOR DE TUTORIA');

INSERT INTO `facultad` (`id_facultad`, `nombre`, `acronimo`) VALUES
	(1, 'FACULTAD DE MECANICA ELECTRICA, ELECTRONICA Y SISTEMAS', 'FIMEES');

INSERT INTO `escuela` (`id_escuela`, `nombre`, `acronimo`, `logo`, `id_facultad`) VALUES
	(1, 'INGENIERIA DE SISTEMAS', 'EPIS', 'logo_sistemas.png', 1);


INSERT INTO `usuario` (`id_usuario`, `usuario`, `contrasenia`, `correo`, `fecha_registro`, `nombres`, `apellidos`, `id_cargo`, `id_escuela`) VALUES
	(1, 'admin', 'admin', 'admin@admin.com', '2022-01-24 16:08:50', 'DEYVIS', 'MAMANI LACUTA', 1, 1);

INSERT INTO `situacion_tutorado` (`id_situacion_tutorado`, `nombre_situacion`) VALUES
	(1, 'riesgo'),
	(2, 'becario'),
	(3, 'ciclo 1'),
	(4, 'regular'),
	(5, 'unknow');

INSERT INTO `tipo_archivo` (`id_tipo_archivo`, `nombre`) VALUES
	(1, 'tablas de asignacion'),
	(2, 'memorandos');

INSERT INTO `archivo_extension` (`id_archivo_extension`, `nombre`, `icono`) VALUES
	(1, 'word', 'word.png'),
	(2, 'pdf', 'pdf.png');


INSERT INTO `texto_memorando` (`id_texto_memorando`, `texto`) VALUES
	('1', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el periodo académico PERIODO_ACADEMICO; se le asigna los alumnos que se menciona a continuación, resaltando que los que indican RIESGO son alumnos que requieren mayor apoyo y seguimiento, a fin de continuar sus estudios.'),
	('1-2', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el periodo académico PERIODO_ACADEMICO; se le asigna los alumnos que se menciona a continuación, resaltando que los que indican RIESGO son alumnos que requieren mayor apoyo y seguimiento, a fin de continuar sus estudios, además, se le asignaron alumnos BECARIOS para apoyarlos en cuanto a su formación y desarrollo profesional.'),
	('1-2-3', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el segundo semestre académico 2021; se le asigna los alumnos que se menciona a continuación, resaltando que los que indican RIESGO son alumnos que requieren mayor apoyo y seguimiento, a fin de continuar sus estudios, además, se le asignaron alumnos BECARIOS para apoyarlos en cuanto a su formación y desarrollo profesional, y alumnos de PRIMER CICLO, para su apoyo en facilitar información, herramientas, conocimientos y motivando actitudes que le permitan enfrentar con mayor efectividad los desafíos académicos de la enseñanza universitaria.'),
	('1-2-3-4', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el segundo semestre académico 2021; se le asigna los alumnos que se menciona a continuación, resaltando que los que indican RIESGO son alumnos que requieren mayor apoyo y seguimiento, a fin de continuar sus estudios,  además, se le asignaron alumnos BECARIOS para apoyarlos en cuanto a su formación y desarrollo profesional, alumnos de PRIMER CICLO, para su apoyo en facilitar información, herramientas, conocimientos y motivando actitudes que le permitan enfrentar con mayor efectividad los desafíos académicos de la enseñanza universitaria, y alumnos REGULARES para brindarles apoyo para resolver situaciones de la vida diaria.'),
	('1-2-4', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el periodo académico PERIODO_ACADEMICO; se le asigna los alumnos que se menciona a continuación, resaltando que los que indican RIESGO son alumnos que requieren mayor apoyo y seguimiento, a fin de continuar sus estudios, además, se le asignaron alumnos BECARIOS para apoyarlos en cuanto a su formación y desarrollo profesional, y alumnos REGULARES para brindarles apoyo para resolver situaciones de la vida diaria.'),
	('1-3', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el periodo académico PERIODO_ACADEMICO; se le asigna los alumnos que se menciona a continuación, resaltando que los que indican RIESGO son alumnos que requieren mayor apoyo y seguimiento, a fin de continuar sus estudios, además, se le asignaron alumnos de PRIMER CICLO, para su apoyo en facilitar información, herramientas, conocimientos y motivando actitudes que le permitan enfrentar con mayor efectividad los desafíos académicos de la enseñanza universitaria.'),
	('1-3-4', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el periodo académico PERIODO_ACADEMICO; se le asigna los alumnos que se menciona a continuación, resaltando que los que indican RIESGO son alumnos que requieren mayor apoyo y seguimiento, a fin de continuar sus estudios, además, se le asignaron alumnos de PRIMER CICLO, para su apoyo en facilitar información, herramientas, conocimientos y motivando actitudes que le permitan enfrentar con mayor efectividad los desafíos académicos de la enseñanza universitaria, y alumnos REGULARES para brindarles apoyo para resolver situaciones de la vida diaria.'),
	('1-4', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el periodo académico PERIODO_ACADEMICO; se le asigna los alumnos que se menciona a continuación, resaltando que los que indican RIESGO son alumnos que requieren mayor apoyo y seguimiento, a fin de continuar sus estudios, además, se le asignaron alumnos REGULARES para brindarles apoyo para resolver situaciones de la vida diaria.'),
	('2', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el periodo académico PERIODO_ACADEMICO; se le asigna los alumnos que se menciona a continuación, alumnos BECARIOS para apoyarlos en cuanto a su formación y desarrollo profesional.'),
	('2-3', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el segundo semestre académico 2021; se le asigna los alumnos que se menciona a continuación, alumnos BECARIOS para apoyarlos en cuanto a su formación y desarrollo profesional, alumnos de PRIMER CICLO, para su apoyo en facilitar información, herramientas, conocimientos y motivando actitudes que le permitan enfrentar con mayor efectividad los desafíos académicos de la enseñanza universitaria.'),
	('2-3-4', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el segundo semestre académico 2021; se le asigna los alumnos que se menciona a continuación, alumnos BECARIOS para apoyarlos en cuanto a su formación y desarrollo profesional, alumnos de PRIMER CICLO, para su apoyo en facilitar información, herramientas, conocimientos y motivando actitudes que le permitan enfrentar con mayor efectividad los desafíos académicos de la enseñanza universitaria, y alumnos REGULARES para brindarles apoyo para resolver situaciones de la vida diaria.'),
	('2-4', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el periodo académico PERIODO_ACADEMICO; se le asigna los alumnos que se menciona a continuación, alumnos BECARIOS para apoyarlos en cuanto a su formación y desarrollo profesional, y alumnos REGULARES para brindarles apoyo para resolver situaciones de la vida diaria.'),
	('3', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el periodo académico PERIODO_ACADEMICO; se le asigna los alumnos que se menciona a continuación, alumnos de PRIMER CICLO, para su apoyo en facilitar información, herramientas, conocimientos y motivando actitudes que le permitan enfrentar con mayor efectividad los desafíos académicos de la enseñanza universitaria.'),
	('3-4', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el periodo académico PERIODO_ACADEMICO; se le asigna los alumnos que se menciona a continuación, alumnos de PRIMER CICLO, para su apoyo en facilitar información, herramientas, conocimientos y motivando actitudes que le permitan enfrentar con mayor efectividad los desafíos académicos de la enseñanza universitaria, y alumnos REGULARES para brindarles apoyo para resolver situaciones de la vida diaria.'),
	('4', 'En cumplimiento a la Directiva Académica y Reglamentos de la UNA-Puno, en su calidad de tutor, para el periodo académico PERIODO_ACADEMICO; se le asigna los alumnos que se menciona a continuación, alumnos REGULARES para brindarles apoyo para resolver situaciones de la vida diaria.');
/*!40000 ALTER TABLE `texto_memorando` ENABLE KEYS */;