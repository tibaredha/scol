-- 
-- TRACE IP v4.0
--
-- https://www.mlxcorp.net
-- 
-- Aout 2017
-- 

-- ------------------------------------------------------------------------------------------
-- TABLE : IP current list
-- ------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS traceip_online;
CREATE TABLE traceip_online (

	id				INT(10)      NOT NULL auto_increment,

	ua				VARCHAR(255) NOT NULL DEFAULT '',
	ip				VARCHAR(50)  NOT NULL DEFAULT '',
	date_time		DATETIME     NOT NULL DEFAULT '0000-00-00 00:00:00',
	cpt				INT(11)      NOT NULL DEFAULT 0,
	is_locked		SMALLINT(1)  NOT NULL DEFAULT 0,

	PRIMARY KEY(id),
	INDEX(ip)
) Engine = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;




-- ------------------------------------------------------------------------------------------
-- TABLE : IP whitelist, blacklist
-- ------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS traceip_lists;
CREATE TABLE traceip_lists (

	id				INT(10)      NOT NULL auto_increment,

	ip				VARCHAR(50)  NOT NULL DEFAULT '',
	date_time		DATETIME     NOT NULL DEFAULT '0000-00-00 00:00:00',
	list_type		ENUM('whitelist', 'blacklist') NOT NULL DEFAULT 'blacklist',

	PRIMARY KEY(id),
	UNIQUE(ip)
) Engine = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;



-- ------------------------------------------------------------------------------------------
-- TABLE : CONFIGURATION
-- ------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS traceip_cfg;
CREATE TABLE traceip_cfg (

	var				VARCHAR(255) NOT NULL,
	val				VARCHAR(255) NOT NULL,

	PRIMARY KEY(var)
) Engine = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;






-- nombre max de pages par minutes (déf. 25)
INSERT INTO `traceip_cfg` (var, val) VALUES ('TIP_MAX_PAGE_COUNT','25');

-- nombre de lignes par page (déf. 25)
INSERT INTO `traceip_cfg` (var, val) VALUES ('TIP_NUM_ROWS_PER_PAGE','25');

-- email où seront envoyés les emails d'alerte
INSERT INTO `traceip_cfg` (var, val) VALUES ('TIP_MAIL_TO','vous@votrefournisseur.tld');

-- email de qui seront envoyé les alertes (peu importe si l'adresse est vraie ou non)
INSERT INTO `traceip_cfg` (var, val) VALUES ('TIP_MAIL_FROM','peuimporte@votrefournisseur.tld');

-- Page d'admin du script, lien affiché dans les emails d'alerte
INSERT INTO `traceip_cfg` (var, val) VALUES ('TIP_ADMIN','http://votresite.tld/trace_ip.php?act=admin');

-- Message envoyé aux IP bannies
INSERT INTO `traceip_cfg` (var, val) VALUES ('TIP_MSG_BAN','<b>IP Interdite pour abus !</b>');
