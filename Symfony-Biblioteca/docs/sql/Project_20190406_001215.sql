/*============================================================================*/
/* DBMS: MySQL 8*/
/* Created on : 06/04/2019 03:25:53                                           */
/*============================================================================*/


/*============================================================================*/
/*                                  TABLES                                    */
/*============================================================================*/
CREATE TABLE `LIVRO` (
  `ID`                    INT(10) NOT NULL AUTO_INCREMENT,
  `NOME`                  VARCHAR(250) NOT NULL,
  `DESCRICAO`             VARCHAR(400) NOT NULL,
  `LANCAMENTO`            DATETIME(2) NOT NULL,
  `ID_EDITORA`            INT(10) NOT NULL,
  `ID_AUTOR`              INT(10) NOT NULL,
CONSTRAINT `PK_LIVRO` PRIMARY KEY (`ID`)
)
;

CREATE TABLE `CATEGORIA` (
  `ID`                    INT(10) NOT NULL AUTO_INCREMENT,
  `NOME`                  VARCHAR(40) NOT NULL,
CONSTRAINT `PK_CATEGORIA` PRIMARY KEY (`ID`)
)
;

CREATE TABLE `EDITORA` (
  `ID`                    INT(10) NOT NULL AUTO_INCREMENT,
  `NOME`                  VARCHAR(400) NOT NULL,
CONSTRAINT `PK_EDITORA` PRIMARY KEY (`ID`)
)
;

CREATE TABLE `AUTOR` (
  `ID`                    INT(10) NOT NULL AUTO_INCREMENT,
  `NOME`                  VARCHAR(400) NOT NULL,
CONSTRAINT `PK_AUTOR` PRIMARY KEY (`ID`)
)
;

CREATE TABLE `USUARIO` (
  `ID`                    INT(10) NOT NULL AUTO_INCREMENT,
  `NOME`                  VARCHAR(40) NOT NULL,
  `NASCIMENTO`            DATETIME(2) NOT NULL,
  `SEXO`                  CHAR(40) NOT NULL,
  `CEP`                   VARBINARY(40) NOT NULL,
  `CPF`                   VARCHAR(40) NOT NULL,
  `CONTATO`               VARCHAR(40) NOT NULL,
  `STATUS`                CHAR(40) NOT NULL,
CONSTRAINT `PK_USUARIO` PRIMARY KEY (`ID`)
)
;

CREATE TABLE `EMPRESTIMO` (
  `ID`                    INT(10) NOT NULL AUTO_INCREMENT,
  `ID_LIVRO`              INT(10) NOT NULL,
  `DATA_EMPRESTIMO`       DATETIME(2) NOT NULL,
  `DATA_DEVOLUCAO`        DATETIME(2),
  `STATUS`                CHAR(40) NOT NULL,
CONSTRAINT `PK_EMPRESTIMO` PRIMARY KEY (`ID`)
)
;

CREATE TABLE `USUARIO_EMPRESTIMO` (
  `ID`                    INT(10) NOT NULL AUTO_INCREMENT,
  `ID_USUARIO`            INT(10) NOT NULL,
  `ID_EMPRESTIMO`         INT(10) NOT NULL,
CONSTRAINT `PK_USUARIO_EMPRESTIMO` PRIMARY KEY (`ID`)
)
;

CREATE TABLE `LIVRO_CATEGORIA` (
  `ID`                    INT(10) NOT NULL AUTO_INCREMENT,
  `ID_CATEGORIA`          INT(10) NOT NULL,
  `ID_LIVRO`              INT(10) NOT NULL,
CONSTRAINT `PK_LIVRO_CATEGORIA` PRIMARY KEY (`ID`)
)
;

/*============================================================================*/
/*                               FOREIGN KEYS                                 */
/*============================================================================*/
ALTER TABLE `LIVRO`
    ADD CONSTRAINT `FK_REFERENCE_2`
        FOREIGN KEY (`ID_EDITORA`)
            REFERENCES `EDITORA` (`ID`)
 ;

ALTER TABLE `LIVRO`
    ADD CONSTRAINT `FK_REFERENCE_3`
        FOREIGN KEY (`ID_AUTOR`)
            REFERENCES `AUTOR` (`ID`)
 ;


ALTER TABLE `EMPRESTIMO`
    ADD CONSTRAINT `FK_REFERENCE_4`
        FOREIGN KEY (`ID_LIVRO`)
            REFERENCES `LIVRO` (`ID`)
 ;


ALTER TABLE `USUARIO_EMPRESTIMO`
    ADD CONSTRAINT `FK_REFERENCE_5`
        FOREIGN KEY (`ID_USUARIO`)
            REFERENCES `USUARIO` (`ID`)
 ;

ALTER TABLE `USUARIO_EMPRESTIMO`
    ADD CONSTRAINT `FK_REFERENCE_6`
        FOREIGN KEY (`ID_EMPRESTIMO`)
            REFERENCES `EMPRESTIMO` (`ID`)
 ;


ALTER TABLE `LIVRO_CATEGORIA`
    ADD CONSTRAINT `FK_REFERENCE_7`
        FOREIGN KEY (`ID_CATEGORIA`)
            REFERENCES `CATEGORIA` (`ID`)
 ;

ALTER TABLE `LIVRO_CATEGORIA`
    ADD CONSTRAINT `FK_REFERENCE_8`
        FOREIGN KEY (`ID_LIVRO`)
            REFERENCES `LIVRO` (`ID`)
 ;


