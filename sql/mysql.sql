CREATE TABLE `mpu_cfi_contentfiles` (
  `cfi_10_id`      INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cfi_30_nome`    VARCHAR(255)     NOT NULL DEFAULT '',
  `cfi_30_arquivo` VARCHAR(100)     NOT NULL DEFAULT '',
  `cfi_30_mime`    VARCHAR(100)     NOT NULL DEFAULT '',
  `cfi_10_tamanho` INT(10)          NOT NULL DEFAULT '0',
  `cfi_12_exibir`  TINYINT(1)       NOT NULL DEFAULT '1',
  `cfi_22_data`    INT(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`cfi_10_id`)
)
  ENGINE = MyISAM;

CREATE TABLE `mpu_fil_files` (
  `fil_10_id`      INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fil_30_nome`    VARCHAR(255)     NOT NULL DEFAULT '',
  `fil_30_arquivo` VARCHAR(100)     NOT NULL DEFAULT '',
  `fil_30_mime`    VARCHAR(100)     NOT NULL DEFAULT '',
  `fil_10_tamanho` INT(10)          NOT NULL DEFAULT '0',
  `fil_12_exibir`  TINYINT(1)       NOT NULL DEFAULT '1',
  `fil_22_data`    INT(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`fil_10_id`)
)
  ENGINE = MyISAM;
CREATE TABLE `mpu_med_media` (
  `med_10_id`      INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `med_30_nome`    VARCHAR(255)     NOT NULL DEFAULT '',
  `med_30_arquivo` VARCHAR(100)     NOT NULL DEFAULT '',
  `med_10_altura`  INT(4) UNSIGNED  NOT NULL DEFAULT '0',
  `med_10_largura` INT(4) UNSIGNED  NOT NULL DEFAULT '0',
  `med_10_tamanho` INT(8) UNSIGNED  NOT NULL DEFAULT '0',
  `med_12_exibir`  TINYINT(1)       NOT NULL DEFAULT '1',
  `med_22_data`    INT(10)          NOT NULL DEFAULT '0',
  `med_10_tipo`    INT(1)           NOT NULL DEFAULT '1',
  PRIMARY KEY (`med_10_id`)
)
  ENGINE = MyISAM;
CREATE TABLE `mpu_mpb_mpublish` (
  `mpb_10_id`          INT(10) UNSIGNED     NOT NULL AUTO_INCREMENT,
  `mpb_10_idpai`       INT(10)              NOT NULL DEFAULT '0',
  `usr_10_uid`         INT(10) UNSIGNED     NOT NULL DEFAULT '0',
  `mpb_30_menu`        VARCHAR(50)          NOT NULL DEFAULT '',
  `mpb_30_titulo`      VARCHAR(100)         NOT NULL DEFAULT '',
  `mpb_35_conteudo`    LONGTEXT,
  `mpb_12_semlink`     TINYINT(1)           NOT NULL DEFAULT '0',
  `mpb_30_arquivo`     VARCHAR(255)                  DEFAULT 'NULL',
  `mpb_11_visivel`     TINYINT(10) UNSIGNED NOT NULL DEFAULT '1',
  `mpb_11_abrir`       TINYINT(3) UNSIGNED  NOT NULL DEFAULT '0',
  `mpb_12_comentarios` TINYINT(1)           NOT NULL DEFAULT '0',
  `mpb_12_exibesub`    TINYINT(1)           NOT NULL DEFAULT '1',
  `mpb_12_recomendar`  TINYINT(1)           NOT NULL DEFAULT '1',
  `mpb_12_imprimir`    TINYINT(1)           NOT NULL DEFAULT '1',
  `mpb_22_criado`      INT(10) UNSIGNED     NOT NULL DEFAULT '0',
  `mpb_22_atualizado`  INT(10) UNSIGNED     NOT NULL DEFAULT '0',
  `mpb_10_ordem`       INT(10) UNSIGNED              DEFAULT '0',
  `mpb_10_contador`    INT(10) UNSIGNED     NOT NULL DEFAULT '0',
  PRIMARY KEY (`mpb_10_id`),
  KEY `mpb_10_idpai` (`mpb_10_idpai`)
)
  ENGINE = MyISAM;
