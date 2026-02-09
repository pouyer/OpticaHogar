
SET FOREIGN_KEY_CHECKS = 0;
-- creacion campo de codigo prestador en MINSALUD para RIPS
ALTER TABLE `profesionales_salud` ADD COLUMN `codigo_prestador_minsalud` VARCHAR(15) DEFAULT null AFTER `registro_profesional`;

-- creacion campo de codigo DANE en paises para RIPS
ALTER TABLE `paises` ADD COLUMN `codigo_dane` VARCHAR(5) DEFAULT null AFTER `id`;

UPDATE `paises` SET codigo_dane = '004' WHERE  codigo_pais = 'AFG' ;
UPDATE `paises` SET codigo_dane = '008' WHERE  codigo_pais = 'ALB' ;
UPDATE `paises` SET codigo_dane = '010' WHERE  codigo_pais = 'ATA' ;
UPDATE `paises` SET codigo_dane = '012' WHERE  codigo_pais = 'DZA' ;
UPDATE `paises` SET codigo_dane = '016' WHERE  codigo_pais = 'ASM' ;
UPDATE `paises` SET codigo_dane = '020' WHERE  codigo_pais = 'AND' ;
UPDATE `paises` SET codigo_dane = '024' WHERE  codigo_pais = 'AGO' ;
UPDATE `paises` SET codigo_dane = '028' WHERE  codigo_pais = 'ATG' ;
UPDATE `paises` SET codigo_dane = '031' WHERE  codigo_pais = 'AZE' ;
UPDATE `paises` SET codigo_dane = '032' WHERE  codigo_pais = 'ARG' ;
UPDATE `paises` SET codigo_dane = '036' WHERE  codigo_pais = 'AUS' ;
UPDATE `paises` SET codigo_dane = '040' WHERE  codigo_pais = 'AUT' ;
UPDATE `paises` SET codigo_dane = '044' WHERE  codigo_pais = 'BHS' ;
UPDATE `paises` SET codigo_dane = '048' WHERE  codigo_pais = 'BHR' ;
UPDATE `paises` SET codigo_dane = '050' WHERE  codigo_pais = 'BGD' ;
UPDATE `paises` SET codigo_dane = '051' WHERE  codigo_pais = 'ARM' ;
UPDATE `paises` SET codigo_dane = '052' WHERE  codigo_pais = 'BRB' ;
UPDATE `paises` SET codigo_dane = '056' WHERE  codigo_pais = 'BEL' ;
UPDATE `paises` SET codigo_dane = '060' WHERE  codigo_pais = 'BMU' ;
UPDATE `paises` SET codigo_dane = '064' WHERE  codigo_pais = 'BTN' ;
UPDATE `paises` SET codigo_dane = '068' WHERE  codigo_pais = 'BOL' ;
UPDATE `paises` SET codigo_dane = '070' WHERE  codigo_pais = 'BIH' ;
UPDATE `paises` SET codigo_dane = '072' WHERE  codigo_pais = 'BWA' ;
UPDATE `paises` SET codigo_dane = '074' WHERE  codigo_pais = 'BVT' ;
UPDATE `paises` SET codigo_dane = '076' WHERE  codigo_pais = 'BRA' ;
UPDATE `paises` SET codigo_dane = '084' WHERE  codigo_pais = 'BLZ' ;
UPDATE `paises` SET codigo_dane = '086' WHERE  codigo_pais = 'IOT' ;
UPDATE `paises` SET codigo_dane = '090' WHERE  codigo_pais = 'SLB' ;
UPDATE `paises` SET codigo_dane = '092' WHERE  codigo_pais = 'VGB' ;
UPDATE `paises` SET codigo_dane = '096' WHERE  codigo_pais = 'BRN' ;
UPDATE `paises` SET codigo_dane = '100' WHERE  codigo_pais = 'BGR' ;
UPDATE `paises` SET codigo_dane = '104' WHERE  codigo_pais = 'MMR' ;
UPDATE `paises` SET codigo_dane = '108' WHERE  codigo_pais = 'BDI' ;
UPDATE `paises` SET codigo_dane = '112' WHERE  codigo_pais = 'BLR' ;
UPDATE `paises` SET codigo_dane = '116' WHERE  codigo_pais = 'KHM' ;
UPDATE `paises` SET codigo_dane = '120' WHERE  codigo_pais = 'CMR' ;
UPDATE `paises` SET codigo_dane = '124' WHERE  codigo_pais = 'CAN' ;
UPDATE `paises` SET codigo_dane = '132' WHERE  codigo_pais = 'CPV' ;
UPDATE `paises` SET codigo_dane = '136' WHERE  codigo_pais = 'CYM' ;
UPDATE `paises` SET codigo_dane = '140' WHERE  codigo_pais = 'CAF' ;
UPDATE `paises` SET codigo_dane = '144' WHERE  codigo_pais = 'LKA' ;
UPDATE `paises` SET codigo_dane = '148' WHERE  codigo_pais = 'TCD' ;
UPDATE `paises` SET codigo_dane = '152' WHERE  codigo_pais = 'CHL' ;
UPDATE `paises` SET codigo_dane = '156' WHERE  codigo_pais = 'CHN' ;
UPDATE `paises` SET codigo_dane = '158' WHERE  codigo_pais = 'TWN' ;
UPDATE `paises` SET codigo_dane = '162' WHERE  codigo_pais = 'CXR' ;
UPDATE `paises` SET codigo_dane = '166' WHERE  codigo_pais = 'CCK' ;
UPDATE `paises` SET codigo_dane = '170' WHERE  codigo_pais = 'COL' ;
UPDATE `paises` SET codigo_dane = '174' WHERE  codigo_pais = 'COM' ;
UPDATE `paises` SET codigo_dane = '175' WHERE  codigo_pais = 'MYT' ;
UPDATE `paises` SET codigo_dane = '178' WHERE  codigo_pais = 'COG' ;
UPDATE `paises` SET codigo_dane = '180' WHERE  codigo_pais = 'COD' ;
UPDATE `paises` SET codigo_dane = '184' WHERE  codigo_pais = 'COK' ;
UPDATE `paises` SET codigo_dane = '188' WHERE  codigo_pais = 'CRI' ;
UPDATE `paises` SET codigo_dane = '191' WHERE  codigo_pais = 'HRV' ;
UPDATE `paises` SET codigo_dane = '192' WHERE  codigo_pais = 'CUB' ;
UPDATE `paises` SET codigo_dane = '196' WHERE  codigo_pais = 'CYP' ;
UPDATE `paises` SET codigo_dane = '203' WHERE  codigo_pais = 'CZE' ;
UPDATE `paises` SET codigo_dane = '204' WHERE  codigo_pais = 'BEN' ;
UPDATE `paises` SET codigo_dane = '208' WHERE  codigo_pais = 'DNK' ;
UPDATE `paises` SET codigo_dane = '212' WHERE  codigo_pais = 'DMA' ;
UPDATE `paises` SET codigo_dane = '214' WHERE  codigo_pais = 'DOM' ;
UPDATE `paises` SET codigo_dane = '218' WHERE  codigo_pais = 'ECU' ;
UPDATE `paises` SET codigo_dane = '222' WHERE  codigo_pais = 'SLV' ;
UPDATE `paises` SET codigo_dane = '226' WHERE  codigo_pais = 'GNQ' ;
UPDATE `paises` SET codigo_dane = '231' WHERE  codigo_pais = 'ETH' ;
UPDATE `paises` SET codigo_dane = '232' WHERE  codigo_pais = 'ERI' ;
UPDATE `paises` SET codigo_dane = '233' WHERE  codigo_pais = 'EST' ;
UPDATE `paises` SET codigo_dane = '234' WHERE  codigo_pais = 'FRO' ;
UPDATE `paises` SET codigo_dane = '238' WHERE  codigo_pais = 'FLK' ;
UPDATE `paises` SET codigo_dane = '239' WHERE  codigo_pais = 'SGS' ;
UPDATE `paises` SET codigo_dane = '242' WHERE  codigo_pais = 'FJI' ;
UPDATE `paises` SET codigo_dane = '246' WHERE  codigo_pais = 'FIN' ;
UPDATE `paises` SET codigo_dane = '248' WHERE  codigo_pais = 'ALA' ;
UPDATE `paises` SET codigo_dane = '250' WHERE  codigo_pais = 'FRA' ;
UPDATE `paises` SET codigo_dane = '254' WHERE  codigo_pais = 'GUF' ;
UPDATE `paises` SET codigo_dane = '258' WHERE  codigo_pais = 'PYF' ;
UPDATE `paises` SET codigo_dane = '260' WHERE  codigo_pais = 'ATF' ;
UPDATE `paises` SET codigo_dane = '262' WHERE  codigo_pais = 'DJI' ;
UPDATE `paises` SET codigo_dane = '266' WHERE  codigo_pais = 'GAB' ;
UPDATE `paises` SET codigo_dane = '268' WHERE  codigo_pais = 'GEO' ;
UPDATE `paises` SET codigo_dane = '270' WHERE  codigo_pais = 'GMB' ;
UPDATE `paises` SET codigo_dane = '275' WHERE  codigo_pais = 'PSE' ;
UPDATE `paises` SET codigo_dane = '276' WHERE  codigo_pais = 'DEU' ;
UPDATE `paises` SET codigo_dane = '288' WHERE  codigo_pais = 'GHA' ;
UPDATE `paises` SET codigo_dane = '292' WHERE  codigo_pais = 'GIB' ;
UPDATE `paises` SET codigo_dane = '296' WHERE  codigo_pais = 'KIR' ;
UPDATE `paises` SET codigo_dane = '300' WHERE  codigo_pais = 'GRC' ;
UPDATE `paises` SET codigo_dane = '304' WHERE  codigo_pais = 'GRL' ;
UPDATE `paises` SET codigo_dane = '308' WHERE  codigo_pais = 'GRD' ;
UPDATE `paises` SET codigo_dane = '312' WHERE  codigo_pais = 'GLP' ;
UPDATE `paises` SET codigo_dane = '316' WHERE  codigo_pais = 'GUM' ;
UPDATE `paises` SET codigo_dane = '320' WHERE  codigo_pais = 'GTM' ;
UPDATE `paises` SET codigo_dane = '324' WHERE  codigo_pais = 'GIN' ;
UPDATE `paises` SET codigo_dane = '328' WHERE  codigo_pais = 'GUY' ;
UPDATE `paises` SET codigo_dane = '332' WHERE  codigo_pais = 'HTI' ;
UPDATE `paises` SET codigo_dane = '334' WHERE  codigo_pais = 'HMD' ;
UPDATE `paises` SET codigo_dane = '336' WHERE  codigo_pais = 'VAT' ;
UPDATE `paises` SET codigo_dane = '340' WHERE  codigo_pais = 'HND' ;
UPDATE `paises` SET codigo_dane = '344' WHERE  codigo_pais = 'HKG' ;
UPDATE `paises` SET codigo_dane = '348' WHERE  codigo_pais = 'HUN' ;
UPDATE `paises` SET codigo_dane = '352' WHERE  codigo_pais = 'ISL' ;
UPDATE `paises` SET codigo_dane = '356' WHERE  codigo_pais = 'IND' ;
UPDATE `paises` SET codigo_dane = '360' WHERE  codigo_pais = 'IDN' ;
UPDATE `paises` SET codigo_dane = '364' WHERE  codigo_pais = 'IRN' ;
UPDATE `paises` SET codigo_dane = '368' WHERE  codigo_pais = 'IRQ' ;
UPDATE `paises` SET codigo_dane = '372' WHERE  codigo_pais = 'IRL' ;
UPDATE `paises` SET codigo_dane = '376' WHERE  codigo_pais = 'ISR' ;
UPDATE `paises` SET codigo_dane = '380' WHERE  codigo_pais = 'ITA' ;
UPDATE `paises` SET codigo_dane = '384' WHERE  codigo_pais = 'CIV' ;
UPDATE `paises` SET codigo_dane = '388' WHERE  codigo_pais = 'JAM' ;
UPDATE `paises` SET codigo_dane = '392' WHERE  codigo_pais = 'JPN' ;
UPDATE `paises` SET codigo_dane = '398' WHERE  codigo_pais = 'KAZ' ;
UPDATE `paises` SET codigo_dane = '400' WHERE  codigo_pais = 'JOR' ;
UPDATE `paises` SET codigo_dane = '404' WHERE  codigo_pais = 'KEN' ;
UPDATE `paises` SET codigo_dane = '408' WHERE  codigo_pais = 'PRK' ;
UPDATE `paises` SET codigo_dane = '410' WHERE  codigo_pais = 'KOR' ;
UPDATE `paises` SET codigo_dane = '414' WHERE  codigo_pais = 'KWT' ;
UPDATE `paises` SET codigo_dane = '417' WHERE  codigo_pais = 'KGZ' ;
UPDATE `paises` SET codigo_dane = '418' WHERE  codigo_pais = 'LAO' ;
UPDATE `paises` SET codigo_dane = '422' WHERE  codigo_pais = 'LBN' ;
UPDATE `paises` SET codigo_dane = '426' WHERE  codigo_pais = 'LSO' ;
UPDATE `paises` SET codigo_dane = '428' WHERE  codigo_pais = 'LVA' ;
UPDATE `paises` SET codigo_dane = '430' WHERE  codigo_pais = 'LBR' ;
UPDATE `paises` SET codigo_dane = '434' WHERE  codigo_pais = 'LBY' ;
UPDATE `paises` SET codigo_dane = '438' WHERE  codigo_pais = 'LIE' ;
UPDATE `paises` SET codigo_dane = '440' WHERE  codigo_pais = 'LTU' ;
UPDATE `paises` SET codigo_dane = '442' WHERE  codigo_pais = 'LUX' ;
UPDATE `paises` SET codigo_dane = '446' WHERE  codigo_pais = 'MAC' ;
UPDATE `paises` SET codigo_dane = '450' WHERE  codigo_pais = 'MDG' ;
UPDATE `paises` SET codigo_dane = '454' WHERE  codigo_pais = 'MWI' ;
UPDATE `paises` SET codigo_dane = '458' WHERE  codigo_pais = 'MYS' ;
UPDATE `paises` SET codigo_dane = '462' WHERE  codigo_pais = 'MDV' ;
UPDATE `paises` SET codigo_dane = '466' WHERE  codigo_pais = 'MLI' ;
UPDATE `paises` SET codigo_dane = '470' WHERE  codigo_pais = 'MLT' ;
UPDATE `paises` SET codigo_dane = '474' WHERE  codigo_pais = 'MTQ' ;
UPDATE `paises` SET codigo_dane = '478' WHERE  codigo_pais = 'MRT' ;
UPDATE `paises` SET codigo_dane = '480' WHERE  codigo_pais = 'MUS' ;
UPDATE `paises` SET codigo_dane = '484' WHERE  codigo_pais = 'MEX' ;
UPDATE `paises` SET codigo_dane = '492' WHERE  codigo_pais = 'MCO' ;
UPDATE `paises` SET codigo_dane = '496' WHERE  codigo_pais = 'MNG' ;
UPDATE `paises` SET codigo_dane = '498' WHERE  codigo_pais = 'MDA' ;
UPDATE `paises` SET codigo_dane = '499' WHERE  codigo_pais = 'MNE' ;
UPDATE `paises` SET codigo_dane = '500' WHERE  codigo_pais = 'MSR' ;
UPDATE `paises` SET codigo_dane = '504' WHERE  codigo_pais = 'MAR' ;
UPDATE `paises` SET codigo_dane = '508' WHERE  codigo_pais = 'MOZ' ;
UPDATE `paises` SET codigo_dane = '512' WHERE  codigo_pais = 'OMN' ;
UPDATE `paises` SET codigo_dane = '516' WHERE  codigo_pais = 'NAM' ;
UPDATE `paises` SET codigo_dane = '520' WHERE  codigo_pais = 'NRU' ;
UPDATE `paises` SET codigo_dane = '524' WHERE  codigo_pais = 'NPL' ;
UPDATE `paises` SET codigo_dane = '528' WHERE  codigo_pais = 'NLD' ;
UPDATE `paises` SET codigo_dane = '531' WHERE  codigo_pais = 'CUW' ;
UPDATE `paises` SET codigo_dane = '533' WHERE  codigo_pais = 'ABW' ;
UPDATE `paises` SET codigo_dane = '534' WHERE  codigo_pais = 'SXM' ;
UPDATE `paises` SET codigo_dane = '535' WHERE  codigo_pais = 'BES' ;
UPDATE `paises` SET codigo_dane = '540' WHERE  codigo_pais = 'NCL' ;
UPDATE `paises` SET codigo_dane = '548' WHERE  codigo_pais = 'VUT' ;
UPDATE `paises` SET codigo_dane = '554' WHERE  codigo_pais = 'NZL' ;
UPDATE `paises` SET codigo_dane = '558' WHERE  codigo_pais = 'NIC' ;
UPDATE `paises` SET codigo_dane = '562' WHERE  codigo_pais = 'NER' ;
UPDATE `paises` SET codigo_dane = '566' WHERE  codigo_pais = 'NGA' ;
UPDATE `paises` SET codigo_dane = '570' WHERE  codigo_pais = 'NIU' ;
UPDATE `paises` SET codigo_dane = '574' WHERE  codigo_pais = 'NFK' ;
UPDATE `paises` SET codigo_dane = '578' WHERE  codigo_pais = 'NOR' ;
UPDATE `paises` SET codigo_dane = '580' WHERE  codigo_pais = 'MNP' ;
UPDATE `paises` SET codigo_dane = '581' WHERE  codigo_pais = 'UMI' ;
UPDATE `paises` SET codigo_dane = '583' WHERE  codigo_pais = 'FSM' ;
UPDATE `paises` SET codigo_dane = '584' WHERE  codigo_pais = 'MHL' ;
UPDATE `paises` SET codigo_dane = '585' WHERE  codigo_pais = 'PLW' ;
UPDATE `paises` SET codigo_dane = '586' WHERE  codigo_pais = 'PAK' ;
UPDATE `paises` SET codigo_dane = '591' WHERE  codigo_pais = 'PAN' ;
UPDATE `paises` SET codigo_dane = '598' WHERE  codigo_pais = 'PNG' ;
UPDATE `paises` SET codigo_dane = '600' WHERE  codigo_pais = 'PRY' ;
UPDATE `paises` SET codigo_dane = '604' WHERE  codigo_pais = 'PER' ;
UPDATE `paises` SET codigo_dane = '608' WHERE  codigo_pais = 'PHL' ;
UPDATE `paises` SET codigo_dane = '612' WHERE  codigo_pais = 'PCN' ;
UPDATE `paises` SET codigo_dane = '616' WHERE  codigo_pais = 'POL' ;
UPDATE `paises` SET codigo_dane = '620' WHERE  codigo_pais = 'PRT' ;
UPDATE `paises` SET codigo_dane = '624' WHERE  codigo_pais = 'GNB' ;
UPDATE `paises` SET codigo_dane = '626' WHERE  codigo_pais = 'TLS' ;
UPDATE `paises` SET codigo_dane = '630' WHERE  codigo_pais = 'PRI' ;
UPDATE `paises` SET codigo_dane = '634' WHERE  codigo_pais = 'QAT' ;
UPDATE `paises` SET codigo_dane = '638' WHERE  codigo_pais = 'REU' ;
UPDATE `paises` SET codigo_dane = '642' WHERE  codigo_pais = 'ROU' ;
UPDATE `paises` SET codigo_dane = '643' WHERE  codigo_pais = 'RUS' ;
UPDATE `paises` SET codigo_dane = '646' WHERE  codigo_pais = 'RWA' ;
UPDATE `paises` SET codigo_dane = '652' WHERE  codigo_pais = 'BLM' ;
UPDATE `paises` SET codigo_dane = '654' WHERE  codigo_pais = 'SHN' ;
UPDATE `paises` SET codigo_dane = '659' WHERE  codigo_pais = 'KNA' ;
UPDATE `paises` SET codigo_dane = '660' WHERE  codigo_pais = 'AIA' ;
UPDATE `paises` SET codigo_dane = '662' WHERE  codigo_pais = 'LCA' ;
UPDATE `paises` SET codigo_dane = '663' WHERE  codigo_pais = 'MAF' ;
UPDATE `paises` SET codigo_dane = '666' WHERE  codigo_pais = 'SPM' ;
UPDATE `paises` SET codigo_dane = '670' WHERE  codigo_pais = 'VCT' ;
UPDATE `paises` SET codigo_dane = '674' WHERE  codigo_pais = 'SMR' ;
UPDATE `paises` SET codigo_dane = '678' WHERE  codigo_pais = 'STP' ;
UPDATE `paises` SET codigo_dane = '682' WHERE  codigo_pais = 'SAU' ;
UPDATE `paises` SET codigo_dane = '686' WHERE  codigo_pais = 'SEN' ;
UPDATE `paises` SET codigo_dane = '688' WHERE  codigo_pais = 'SRB' ;
UPDATE `paises` SET codigo_dane = '690' WHERE  codigo_pais = 'SYC' ;
UPDATE `paises` SET codigo_dane = '694' WHERE  codigo_pais = 'SLE' ;
UPDATE `paises` SET codigo_dane = '702' WHERE  codigo_pais = 'SGP' ;
UPDATE `paises` SET codigo_dane = '703' WHERE  codigo_pais = 'SVK' ;
UPDATE `paises` SET codigo_dane = '704' WHERE  codigo_pais = 'VNM' ;
UPDATE `paises` SET codigo_dane = '705' WHERE  codigo_pais = 'SVN' ;
UPDATE `paises` SET codigo_dane = '706' WHERE  codigo_pais = 'SOM' ;
UPDATE `paises` SET codigo_dane = '710' WHERE  codigo_pais = 'ZAF' ;
UPDATE `paises` SET codigo_dane = '716' WHERE  codigo_pais = 'ZWE' ;
UPDATE `paises` SET codigo_dane = '724' WHERE  codigo_pais = 'ESP' ;
UPDATE `paises` SET codigo_dane = '728' WHERE  codigo_pais = 'SSD' ;
UPDATE `paises` SET codigo_dane = '729' WHERE  codigo_pais = 'SDN' ;
UPDATE `paises` SET codigo_dane = '732' WHERE  codigo_pais = 'ESH' ;
UPDATE `paises` SET codigo_dane = '740' WHERE  codigo_pais = 'SUR' ;
UPDATE `paises` SET codigo_dane = '744' WHERE  codigo_pais = 'SJM' ;
UPDATE `paises` SET codigo_dane = '748' WHERE  codigo_pais = 'SWZ' ;
UPDATE `paises` SET codigo_dane = '752' WHERE  codigo_pais = 'SWE' ;
UPDATE `paises` SET codigo_dane = '756' WHERE  codigo_pais = 'CHE' ;
UPDATE `paises` SET codigo_dane = '760' WHERE  codigo_pais = 'SYR' ;
UPDATE `paises` SET codigo_dane = '762' WHERE  codigo_pais = 'TJK' ;
UPDATE `paises` SET codigo_dane = '764' WHERE  codigo_pais = 'THA' ;
UPDATE `paises` SET codigo_dane = '768' WHERE  codigo_pais = 'TGO' ;
UPDATE `paises` SET codigo_dane = '772' WHERE  codigo_pais = 'TKL' ;
UPDATE `paises` SET codigo_dane = '776' WHERE  codigo_pais = 'TON' ;
UPDATE `paises` SET codigo_dane = '780' WHERE  codigo_pais = 'TTO' ;
UPDATE `paises` SET codigo_dane = '784' WHERE  codigo_pais = 'ARE' ;
UPDATE `paises` SET codigo_dane = '788' WHERE  codigo_pais = 'TUN' ;
UPDATE `paises` SET codigo_dane = '792' WHERE  codigo_pais = 'TUR' ;
UPDATE `paises` SET codigo_dane = '795' WHERE  codigo_pais = 'TKM' ;
UPDATE `paises` SET codigo_dane = '796' WHERE  codigo_pais = 'TCA' ;
UPDATE `paises` SET codigo_dane = '798' WHERE  codigo_pais = 'TUV' ;
UPDATE `paises` SET codigo_dane = '800' WHERE  codigo_pais = 'UGA' ;
UPDATE `paises` SET codigo_dane = '804' WHERE  codigo_pais = 'UKR' ;
UPDATE `paises` SET codigo_dane = '807' WHERE  codigo_pais = 'MKD' ;
UPDATE `paises` SET codigo_dane = '818' WHERE  codigo_pais = 'EGY' ;
UPDATE `paises` SET codigo_dane = '826' WHERE  codigo_pais = 'GBR' ;
UPDATE `paises` SET codigo_dane = '831' WHERE  codigo_pais = 'GGY' ;
UPDATE `paises` SET codigo_dane = '832' WHERE  codigo_pais = 'JEY' ;
UPDATE `paises` SET codigo_dane = '833' WHERE  codigo_pais = 'IMN' ;
UPDATE `paises` SET codigo_dane = '834' WHERE  codigo_pais = 'TZA' ;
UPDATE `paises` SET codigo_dane = '840' WHERE  codigo_pais = 'USA' ;
UPDATE `paises` SET codigo_dane = '850' WHERE  codigo_pais = 'VIR' ;
UPDATE `paises` SET codigo_dane = '854' WHERE  codigo_pais = 'BFA' ;
UPDATE `paises` SET codigo_dane = '858' WHERE  codigo_pais = 'URY' ;
UPDATE `paises` SET codigo_dane = '860' WHERE  codigo_pais = 'UZB' ;
UPDATE `paises` SET codigo_dane = '862' WHERE  codigo_pais = 'VEN' ;
UPDATE `paises` SET codigo_dane = '876' WHERE  codigo_pais = 'WLF' ;
UPDATE `paises` SET codigo_dane = '882' WHERE  codigo_pais = 'WSM' ;
UPDATE `paises` SET codigo_dane = '887' WHERE  codigo_pais = 'YEM' ;
UPDATE `paises` SET codigo_dane = '894' WHERE  codigo_pais = 'ZMB' ;


-- creacion tabla departamento para RIPS
CREATE TABLE `departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pais` int DEFAULT NULL,
  `codigo_dane` varchar(10) DEFAULT NULL,
  `Nombre` varchar(100) NOT NULL,
  `campo_ordenamiento` int(11) DEFAULT 0,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int(11) NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT current_timestamp(),
  `usuario_id_actualizo` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `departamento_pais_fk` (`id_pais`),
  CONSTRAINT `departamento_pais_fk` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO `departamento` (`id_pais`, `codigo_dane`, `nombre`, `usuario_id_inserto`) VALUES 
( 44,'00', 'NO APLICA', 1 ),
( 44,'05', 'ANTIOQUIA', 1 ),
( 44,'08', 'ATLÁNTICO', 1 ),
( 44,'11', 'BOGOTÁ, D.C.', 1 ),
( 44,'13', 'BOLÍVAR', 1 ),
( 44,'15', 'BOYACÁ', 1 ),
( 44,'17', 'CALDAS', 1 ),
( 44,'18', 'CAQUETÁ', 1 ),
( 44,'19', 'CAUCA', 1 ),
( 44,'20', 'CESAR', 1 ),
( 44,'23', 'CÓRDOBA', 1 ),
( 44,'25', 'CUNDINAMARCA', 1 ),
( 44,'27', 'CHOCÓ', 1 ),
( 44,'41', 'HUILA', 1 ),
( 44,'44', 'LA GUAJIRA', 1 ),
( 44,'47', 'MAGDALENA', 1 ),
( 44,'50', 'META', 1 ),
( 44,'52', 'NARIÑO', 1 ),
( 44,'54', 'NORTE DE SANTANDER', 1 ),
( 44,'63', 'QUINDIO', 1 ),
( 44,'66', 'RISARALDA', 1 ),
( 44,'68', 'SANTANDER', 1 ),
( 44,'70', 'SUCRE', 1 ),
( 44,'73', 'TOLIMA', 1 ),
( 44,'76', 'VALLE DEL CAUCA', 1 ),
( 44,'81', 'ARAUCA', 1 ),
( 44,'85', 'CASANARE', 1 ),
( 44,'86', 'PUTUMAYO', 1 ),
( 44,'88', 'ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA', 1 ),
( 44,'91', 'AMAZONAS', 1 ),
( 44,'94', 'GUAINÍA', 1 ),
( 44,'95', 'GUAVIARE', 1 ),
( 44,'97', 'VAUPÉS', 1 ),
( 44,'99', 'VICHADA', 1 );


-- creacion tabla municipio para RIPS

CREATE TABLE `municipio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_departamento` int DEFAULT NULL,   
  `codigo_dane` varchar(10) DEFAULT NULL,
  `Nombre` varchar(150) NOT NULL,
  `campo_ordenamiento` int(11) DEFAULT 0,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int(11) NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT current_timestamp(),
  `usuario_id_actualizo` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    KEY `municipio_id_departamento_fk` (`id_departamento`),
    CONSTRAINT `municipio_id_departamento_fk` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO `municipio` (`id_departamento`, `codigo_dane`, `Nombre`, `usuario_id_inserto`) VALUES 
( 2,'05001', 'MEDELLÍN',1 ),
( 2,'05002', 'ABEJORRAL',1 ),
( 2,'05004', 'ABRIAQUÍ',1 ),
( 2,'05021', 'ALEJANDRÍA',1 ),
( 2,'05030', 'AMAGÁ',1 ),
( 2,'05031', 'AMALFI',1 ),
( 2,'05034', 'ANDES',1 ),
( 2,'05036', 'ANGELÓPOLIS',1 ),
( 2,'05038', 'ANGOSTURA',1 ),
( 2,'05040', 'ANORÍ',1 ),
( 2,'05042', 'SANTA FÉ DE ANTIOQUIA',1 ),
( 2,'05044', 'ANZÁ',1 ),
( 2,'05045', 'APARTADÓ',1 ),
( 2,'05051', 'ARBOLETES',1 ),
( 2,'05055', 'ARGELIA',1 ),
( 2,'05059', 'ARMENIA',1 ),
( 2,'05079', 'BARBOSA',1 ),
( 2,'05086', 'BELMIRA',1 ),
( 2,'05088', 'BELLO',1 ),
( 2,'05091', 'BETANIA',1 ),
( 2,'05093', 'BETULIA',1 ),
( 2,'05101', 'CIUDAD BOLÍVAR',1 ),
( 2,'05107', 'BRICEÑO',1 ),
( 2,'05113', 'BURITICÁ',1 ),
( 2,'05120', 'CÁCERES',1 ),
( 2,'05125', 'CAICEDO',1 ),
( 2,'05129', 'CALDAS',1 ),
( 2,'05134', 'CAMPAMENTO',1 ),
( 2,'05138', 'CAÑASGORDAS',1 ),
( 2,'05142', 'CARACOLÍ',1 ),
( 2,'05145', 'CARAMANTA',1 ),
( 2,'05147', 'CAREPA',1 ),
( 2,'05148', 'EL CARMEN DE VIBORAL',1 ),
( 2,'05150', 'CAROLINA',1 ),
( 2,'05154', 'CAUCASIA',1 ),
( 2,'05172', 'CHIGORODÓ',1 ),
( 2,'05190', 'CISNEROS',1 ),
( 2,'05197', 'COCORNÁ',1 ),
( 2,'05206', 'CONCEPCIÓN',1 ),
( 2,'05209', 'CONCORDIA',1 ),
( 2,'05212', 'COPACABANA',1 ),
( 2,'05234', 'DABEIBA',1 ),
( 2,'05237', 'DONMATÍAS',1 ),
( 2,'05240', 'EBÉJICO',1 ),
( 2,'05250', 'EL BAGRE',1 ),
( 2,'05264', 'ENTRERRÍOS',1 ),
( 2,'05266', 'ENVIGADO',1 ),
( 2,'05282', 'FREDONIA',1 ),
( 2,'05284', 'FRONTINO',1 ),
( 2,'05306', 'GIRALDO',1 ),
( 2,'05308', 'GIRARDOTA',1 ),
( 2,'05310', 'GÓMEZ PLATA',1 ),
( 2,'05313', 'GRANADA',1 ),
( 2,'05315', 'GUADALUPE',1 ),
( 2,'05318', 'GUARNE',1 ),
( 2,'05321', 'GUATAPÉ',1 ),
( 2,'05347', 'HELICONIA',1 ),
( 2,'05353', 'HISPANIA',1 ),
( 2,'05360', 'ITAGÜÍ',1 ),
( 2,'05361', 'ITUANGO',1 ),
( 2,'05364', 'JARDÍN',1 ),
( 2,'05368', 'JERICÓ',1 ),
( 2,'05376', 'LA CEJA',1 ),
( 2,'05380', 'LA ESTRELLA',1 ),
( 2,'05390', 'LA PINTADA',1 ),
( 2,'05400', 'LA UNIÓN',1 ),
( 2,'05411', 'LIBORINA',1 ),
( 2,'05425', 'MACEO',1 ),
( 2,'05440', 'MARINILLA',1 ),
( 2,'05467', 'MONTEBELLO',1 ),
( 2,'05475', 'MURINDÓ',1 ),
( 2,'05480', 'MUTATÁ',1 ),
( 2,'05483', 'NARIÑO',1 ),
( 2,'05490', 'NECOCLÍ',1 ),
( 2,'05495', 'NECHÍ',1 ),
( 2,'05501', 'OLAYA',1 ),
( 2,'05541', 'PEÑOL',1 ),
( 2,'05543', 'PEQUE',1 ),
( 2,'05576', 'PUEBLORRICO',1 ),
( 2,'05579', 'PUERTO BERRÍO',1 ),
( 2,'05585', 'PUERTO NARE',1 ),
( 2,'05591', 'PUERTO TRIUNFO',1 ),
( 2,'05604', 'REMEDIOS',1 ),
( 2,'05607', 'RETIRO',1 ),
( 2,'05615', 'RIONEGRO',1 ),
( 2,'05628', 'SABANALARGA',1 ),
( 2,'05631', 'SABANETA',1 ),
( 2,'05642', 'SALGAR',1 ),
( 2,'05647', 'SAN ANDRÉS DE CUERQUÍA',1 ),
( 2,'05649', 'SAN CARLOS',1 ),
( 2,'05652', 'SAN FRANCISCO',1 ),
( 2,'05656', 'SAN JERÓNIMO',1 ),
( 2,'05658', 'SAN JOSÉ DE LA MONTAÑA',1 ),
( 2,'05659', 'SAN JUAN DE URABÁ',1 ),
( 2,'05660', 'SAN LUIS',1 ),
( 2,'05664', 'SAN PEDRO DE LOS MILAGROS',1 ),
( 2,'05665', 'SAN PEDRO DE URABÁ',1 ),
( 2,'05667', 'SAN RAFAEL',1 ),
( 2,'05670', 'SAN ROQUE',1 ),
( 2,'05674', 'SAN VICENTE FERRER',1 ),
( 2,'05679', 'SANTA BÁRBARA',1 ),
( 2,'05686', 'SANTA ROSA DE OSOS',1 ),
( 2,'05690', 'SANTO DOMINGO',1 ),
( 2,'05697', 'EL SANTUARIO',1 ),
( 2,'05736', 'SEGOVIA',1 ),
( 2,'05756', 'SONSÓN',1 ),
( 2,'05761', 'SOPETRÁN',1 ),
( 2,'05789', 'TÁMESIS',1 ),
( 2,'05790', 'TARAZÁ',1 ),
( 2,'05792', 'TARSO',1 ),
( 2,'05809', 'TITIRIBÍ',1 ),
( 2,'05819', 'TOLEDO',1 ),
( 2,'05837', 'TURBO',1 ),
( 2,'05842', 'URAMITA',1 ),
( 2,'05847', 'URRAO',1 ),
( 2,'05854', 'VALDIVIA',1 ),
( 2,'05856', 'VALPARAÍSO',1 ),
( 2,'05858', 'VEGACHÍ',1 ),
( 2,'05861', 'VENECIA',1 ),
( 2,'05873', 'VIGÍA DEL FUERTE',1 ),
( 2,'05885', 'YALÍ',1 ),
( 2,'05887', 'YARUMAL',1 ),
( 2,'05890', 'YOLOMBÓ',1 ),
( 2,'05893', 'YONDÓ',1 ),
( 2,'05895', 'ZARAGOZA',1 ),
( 3,'08001', 'BARRANQUILLA',1 ),
( 3,'08078', 'BARANOA',1 ),
( 3,'08137', 'CAMPO DE LA CRUZ',1 ),
( 3,'08141', 'CANDELARIA',1 ),
( 3,'08296', 'GALAPA',1 ),
( 3,'08372', 'JUAN DE ACOSTA',1 ),
( 3,'08421', 'LURUACO',1 ),
( 3,'08433', 'MALAMBO',1 ),
( 3,'08436', 'MANATÍ',1 ),
( 3,'08520', 'PALMAR DE VARELA',1 ),
( 3,'08549', 'PIOJÓ',1 ),
( 3,'08558', 'POLONUEVO',1 ),
( 3,'08560', 'PONEDERA',1 ),
( 3,'08573', 'PUERTO COLOMBIA',1 ),
( 3,'08606', 'REPELÓN',1 ),
( 3,'08634', 'SABANAGRANDE',1 ),
( 3,'08638', 'SABANALARGA',1 ),
( 3,'08675', 'SANTA LUCÍA',1 ),
( 3,'08685', 'SANTO TOMÁS',1 ),
( 3,'08758', 'SOLEDAD',1 ),
( 3,'08770', 'SUAN',1 ),
( 3,'08832', 'TUBARÁ',1 ),
( 3,'08849', 'USIACURÍ',1 ),
( 4,'11001', 'BOGOTÁ, D.C.',1 ),
( 5,'13001', 'CARTAGENA DE INDIAS',1 ),
( 5,'13006', 'ACHÍ',1 ),
( 5,'13030', 'ALTOS DEL ROSARIO',1 ),
( 5,'13042', 'ARENAL',1 ),
( 5,'13052', 'ARJONA',1 ),
( 5,'13062', 'ARROYOHONDO',1 ),
( 5,'13074', 'BARRANCO DE LOBA',1 ),
( 5,'13140', 'CALAMAR',1 ),
( 5,'13160', 'CANTAGALLO',1 ),
( 5,'13188', 'CICUCO',1 ),
( 5,'13212', 'CÓRDOBA',1 ),
( 5,'13222', 'CLEMENCIA',1 ),
( 5,'13244', 'EL CARMEN DE BOLÍVAR',1 ),
( 5,'13248', 'EL GUAMO',1 ),
( 5,'13268', 'EL PEÑÓN',1 ),
( 5,'13300', 'HATILLO DE LOBA',1 ),
( 5,'13430', 'MAGANGUÉ',1 ),
( 5,'13433', 'MAHATES',1 ),
( 5,'13440', 'MARGARITA',1 ),
( 5,'13442', 'MARÍA LA BAJA',1 ),
( 5,'13458', 'MONTECRISTO',1 ),
( 5,'13468', 'MOMPÓS',1 ),
( 5,'13473', 'MORALES',1 ),
( 5,'13490', 'NOROSÍ',1 ),
( 5,'13549', 'PINILLOS',1 ),
( 5,'13580', 'REGIDOR',1 ),
( 5,'13600', 'RÍO VIEJO',1 ),
( 5,'13620', 'SAN CRISTÓBAL',1 ),
( 5,'13647', 'SAN ESTANISLAO',1 ),
( 5,'13650', 'SAN FERNANDO',1 ),
( 5,'13654', 'SAN JACINTO',1 ),
( 5,'13655', 'SAN JACINTO DEL CAUCA',1 ),
( 5,'13657', 'SAN JUAN NEPOMUCENO',1 ),
( 5,'13667', 'SAN MARTÍN DE LOBA',1 ),
( 5,'13670', 'SAN PABLO',1 ),
( 5,'13673', 'SANTA CATALINA',1 ),
( 5,'13683', 'SANTA ROSA',1 ),
( 5,'13688', 'SANTA ROSA DEL SUR',1 ),
( 5,'13744', 'SIMITÍ',1 ),
( 5,'13760', 'SOPLAVIENTO',1 ),
( 5,'13780', 'TALAIGUA NUEVO',1 ),
( 5,'13810', 'TIQUISIO',1 ),
( 5,'13836', 'TURBACO',1 ),
( 5,'13838', 'TURBANÁ',1 ),
( 5,'13873', 'VILLANUEVA',1 ),
( 5,'13894', 'ZAMBRANO',1 ),
( 6,'15001', 'TUNJA',1 ),
( 6,'15022', 'ALMEIDA',1 ),
( 6,'15047', 'AQUITANIA',1 ),
( 6,'15051', 'ARCABUCO',1 ),
( 6,'15087', 'BELÉN',1 ),
( 6,'15090', 'BERBEO',1 ),
( 6,'15092', 'BETÉITIVA',1 ),
( 6,'15097', 'BOAVITA',1 ),
( 6,'15104', 'BOYACÁ',1 ),
( 6,'15106', 'BRICEÑO',1 ),
( 6,'15109', 'BUENAVISTA',1 ),
( 6,'15114', 'BUSBANZÁ',1 ),
( 6,'15131', 'CALDAS',1 ),
( 6,'15135', 'CAMPOHERMOSO',1 ),
( 6,'15162', 'CERINZA',1 ),
( 6,'15172', 'CHINAVITA',1 ),
( 6,'15176', 'CHIQUINQUIRÁ',1 ),
( 6,'15180', 'CHISCAS',1 ),
( 6,'15183', 'CHITA',1 ),
( 6,'15185', 'CHITARAQUE',1 ),
( 6,'15187', 'CHIVATÁ',1 ),
( 6,'15189', 'CIÉNEGA',1 ),
( 6,'15204', 'CÓMBITA',1 ),
( 6,'15212', 'COPER',1 ),
( 6,'15215', 'CORRALES',1 ),
( 6,'15218', 'COVARACHÍA',1 ),
( 6,'15223', 'CUBARÁ',1 ),
( 6,'15224', 'CUCAITA',1 ),
( 6,'15226', 'CUÍTIVA',1 ),
( 6,'15232', 'CHÍQUIZA',1 ),
( 6,'15236', 'CHIVOR',1 ),
( 6,'15238', 'DUITAMA',1 ),
( 6,'15244', 'EL COCUY',1 ),
( 6,'15248', 'EL ESPINO',1 ),
( 6,'15272', 'FIRAVITOBA',1 ),
( 6,'15276', 'FLORESTA',1 ),
( 6,'15293', 'GACHANTIVÁ',1 ),
( 6,'15296', 'GÁMEZA',1 ),
( 6,'15299', 'GARAGOA',1 ),
( 6,'15317', 'GUACAMAYAS',1 ),
( 6,'15322', 'GUATEQUE',1 ),
( 6,'15325', 'GUAYATÁ',1 ),
( 6,'15332', 'GÜICÁN DE LA SIERRA',1 ),
( 6,'15362', 'IZA',1 ),
( 6,'15367', 'JENESANO',1 ),
( 6,'15368', 'JERICÓ',1 ),
( 6,'15377', 'LABRANZAGRANDE',1 ),
( 6,'15380', 'LA CAPILLA',1 ),
( 6,'15401', 'LA VICTORIA',1 ),
( 6,'15403', 'LA UVITA',1 ),
( 6,'15407', 'VILLA DE LEYVA',1 ),
( 6,'15425', 'MACANAL',1 ),
( 6,'15442', 'MARIPÍ',1 ),
( 6,'15455', 'MIRAFLORES',1 ),
( 6,'15464', 'MONGUA',1 ),
( 6,'15466', 'MONGUÍ',1 ),
( 6,'15469', 'MONIQUIRÁ',1 ),
( 6,'15476', 'MOTAVITA',1 ),
( 6,'15480', 'MUZO',1 ),
( 6,'15491', 'NOBSA',1 ),
( 6,'15494', 'NUEVO COLÓN',1 ),
( 6,'15500', 'OICATÁ',1 ),
( 6,'15507', 'OTANCHE',1 ),
( 6,'15511', 'PACHAVITA',1 ),
( 6,'15514', 'PÁEZ',1 ),
( 6,'15516', 'PAIPA',1 ),
( 6,'15518', 'PAJARITO',1 ),
( 6,'15522', 'PANQUEBA',1 ),
( 6,'15531', 'PAUNA',1 ),
( 6,'15533', 'PAYA',1 ),
( 6,'15537', 'PAZ DE RÍO',1 ),
( 6,'15542', 'PESCA',1 ),
( 6,'15550', 'PISBA',1 ),
( 6,'15572', 'PUERTO BOYACÁ',1 ),
( 6,'15580', 'QUÍPAMA',1 ),
( 6,'15599', 'RAMIRIQUÍ',1 ),
( 6,'15600', 'RÁQUIRA',1 ),
( 6,'15621', 'RONDÓN',1 ),
( 6,'15632', 'SABOYÁ',1 ),
( 6,'15638', 'SÁCHICA',1 ),
( 6,'15646', 'SAMACÁ',1 ),
( 6,'15660', 'SAN EDUARDO',1 ),
( 6,'15664', 'SAN JOSÉ DE PARE',1 ),
( 6,'15667', 'SAN LUIS DE GACENO',1 ),
( 6,'15673', 'SAN MATEO',1 ),
( 6,'15676', 'SAN MIGUEL DE SEMA',1 ),
( 6,'15681', 'SAN PABLO DE BORBUR',1 ),
( 6,'15686', 'SANTANA',1 ),
( 6,'15690', 'SANTA MARÍA',1 ),
( 6,'15693', 'SANTA ROSA DE VITERBO',1 ),
( 6,'15696', 'SANTA SOFÍA',1 ),
( 6,'15720', 'SATIVANORTE',1 ),
( 6,'15723', 'SATIVASUR',1 ),
( 6,'15740', 'SIACHOQUE',1 ),
( 6,'15753', 'SOATÁ',1 ),
( 6,'15755', 'SOCOTÁ',1 ),
( 6,'15757', 'SOCHA',1 ),
( 6,'15759', 'SOGAMOSO',1 ),
( 6,'15761', 'SOMONDOCO',1 ),
( 6,'15762', 'SORA',1 ),
( 6,'15763', 'SOTAQUIRÁ',1 ),
( 6,'15764', 'SORACÁ',1 ),
( 6,'15774', 'SUSACÓN',1 ),
( 6,'15776', 'SUTAMARCHÁN',1 ),
( 6,'15778', 'SUTATENZA',1 ),
( 6,'15790', 'TASCO',1 ),
( 6,'15798', 'TENZA',1 ),
( 6,'15804', 'TIBANÁ',1 ),
( 6,'15806', 'TIBASOSA',1 ),
( 6,'15808', 'TINJACÁ',1 ),
( 6,'15810', 'TIPACOQUE',1 ),
( 6,'15814', 'TOCA',1 ),
( 6,'15816', 'TOGÜÍ',1 ),
( 6,'15820', 'TÓPAGA',1 ),
( 6,'15822', 'TOTA',1 ),
( 6,'15832', 'TUNUNGUÁ',1 ),
( 6,'15835', 'TURMEQUÉ',1 ),
( 6,'15837', 'TUTA',1 ),
( 6,'15839', 'TUTAZÁ',1 ),
( 6,'15842', 'ÚMBITA',1 ),
( 6,'15861', 'VENTAQUEMADA',1 ),
( 6,'15879', 'VIRACACHÁ',1 ),
( 6,'15897', 'ZETAQUIRA',1 ),
( 7,'17001', 'MANIZALES',1 ),
( 7,'17013', 'AGUADAS',1 ),
( 7,'17042', 'ANSERMA',1 ),
( 7,'17050', 'ARANZAZU',1 ),
( 7,'17088', 'BELALCÁZAR',1 ),
( 7,'17174', 'CHINCHINÁ',1 ),
( 7,'17272', 'FILADELFIA',1 ),
( 7,'17380', 'LA DORADA',1 ),
( 7,'17388', 'LA MERCED',1 ),
( 7,'17433', 'MANZANARES',1 ),
( 7,'17442', 'MARMATO',1 ),
( 7,'17444', 'MARQUETALIA',1 ),
( 7,'17446', 'MARULANDA',1 ),
( 7,'17486', 'NEIRA',1 ),
( 7,'17495', 'NORCASIA',1 ),
( 7,'17513', 'PÁCORA',1 ),
( 7,'17524', 'PALESTINA',1 ),
( 7,'17541', 'PENSILVANIA',1 ),
( 7,'17614', 'RIOSUCIO',1 ),
( 7,'17616', 'RISARALDA',1 ),
( 7,'17653', 'SALAMINA',1 ),
( 7,'17662', 'SAMANÁ',1 ),
( 7,'17665', 'SAN JOSÉ',1 ),
( 7,'17777', 'SUPÍA',1 ),
( 7,'17867', 'VICTORIA',1 ),
( 7,'17873', 'VILLAMARÍA',1 ),
( 7,'17877', 'VITERBO',1 ),
( 8,'18001', 'FLORENCIA',1 ),
( 8,'18029', 'ALBANIA',1 ),
( 8,'18094', 'BELÉN DE LOS ANDAQUÍES',1 ),
( 8,'18150', 'CARTAGENA DEL CHAIRÁ',1 ),
( 8,'18205', 'CURILLO',1 ),
( 8,'18247', 'EL DONCELLO',1 ),
( 8,'18256', 'EL PAUJÍL',1 ),
( 8,'18410', 'LA MONTAÑITA',1 ),
( 8,'18460', 'MILÁN',1 ),
( 8,'18479', 'MORELIA',1 ),
( 8,'18592', 'PUERTO RICO',1 ),
( 8,'18610', 'SAN JOSÉ DEL FRAGUA',1 ),
( 8,'18753', 'SAN VICENTE DEL CAGUÁN',1 ),
( 8,'18756', 'SOLANO',1 ),
( 8,'18785', 'SOLITA',1 ),
( 8,'18860', 'VALPARAÍSO',1 ),
( 9,'19001', 'POPAYÁN',1 ),
( 9,'19022', 'ALMAGUER',1 ),
( 9,'19050', 'ARGELIA',1 ),
( 9,'19075', 'BALBOA',1 ),
( 9,'19100', 'BOLÍVAR',1 ),
( 9,'19110', 'BUENOS AIRES',1 ),
( 9,'19130', 'CAJIBÍO',1 ),
( 9,'19137', 'CALDONO',1 ),
( 9,'19142', 'CALOTO',1 ),
( 9,'19212', 'CORINTO',1 ),
( 9,'19256', 'EL TAMBO',1 ),
( 9,'19290', 'FLORENCIA',1 ),
( 9,'19300', 'GUACHENÉ',1 ),
( 9,'19318', 'GUAPÍ',1 ),
( 9,'19355', 'INZÁ',1 ),
( 9,'19364', 'JAMBALÓ',1 ),
( 9,'19392', 'LA SIERRA',1 ),
( 9,'19397', 'LA VEGA',1 ),
( 9,'19418', 'LÓPEZ DE MICAY',1 ),
( 9,'19450', 'MERCADERES',1 ),
( 9,'19455', 'MIRANDA',1 ),
( 9,'19473', 'MORALES',1 ),
( 9,'19513', 'PADILLA',1 ),
( 9,'19517', 'PÁEZ',1 ),
( 9,'19532', 'PATÍA',1 ),
( 9,'19533', 'PIAMONTE',1 ),
( 9,'19548', 'PIENDAMÓ - TUNÍA',1 ),
( 9,'19573', 'PUERTO TEJADA',1 ),
( 9,'19585', 'PURACÉ',1 ),
( 9,'19622', 'ROSAS',1 ),
( 9,'19693', 'SAN SEBASTIÁN',1 ),
( 9,'19698', 'SANTANDER DE QUILICHAO',1 ),
( 9,'19701', 'SANTA ROSA',1 ),
( 9,'19743', 'SILVIA',1 ),
( 9,'19760', 'SOTARA',1 ),
( 9,'19780', 'SUÁREZ',1 ),
( 9,'19785', 'SUCRE',1 ),
( 9,'19807', 'TIMBÍO',1 ),
( 9,'19809', 'TIMBIQUÍ',1 ),
( 9,'19821', 'TORIBÍO',1 ),
( 9,'19824', 'TOTORÓ',1 ),
( 9,'19845', 'VILLA RICA',1 ),
( 10,'20001', 'VALLEDUPAR',1 ),
( 10,'20011', 'AGUACHICA',1 ),
( 10,'20013', 'AGUSTÍN CODAZZI',1 ),
( 10,'20032', 'ASTREA',1 ),
( 10,'20045', 'BECERRIL',1 ),
( 10,'20060', 'BOSCONIA',1 ),
( 10,'20175', 'CHIMICHAGUA',1 ),
( 10,'20178', 'CHIRIGUANÁ',1 ),
( 10,'20228', 'CURUMANÍ',1 ),
( 10,'20238', 'EL COPEY',1 ),
( 10,'20250', 'EL PASO',1 ),
( 10,'20295', 'GAMARRA',1 ),
( 10,'20310', 'GONZÁLEZ',1 ),
( 10,'20383', 'LA GLORIA',1 ),
( 10,'20400', 'LA JAGUA DE IBIRICO',1 ),
( 10,'20443', 'MANAURE BALCÓN DEL CESAR',1 ),
( 10,'20517', 'PAILITAS',1 ),
( 10,'20550', 'PELAYA',1 ),
( 10,'20570', 'PUEBLO BELLO',1 ),
( 10,'20614', 'RÍO DE ORO',1 ),
( 10,'20621', 'LA PAZ',1 ),
( 10,'20710', 'SAN ALBERTO',1 ),
( 10,'20750', 'SAN DIEGO',1 ),
( 10,'20770', 'SAN MARTÍN',1 ),
( 10,'20787', 'TAMALAMEQUE',1 ),
( 11,'23001', 'MONTERÍA',1 ),
( 11,'23068', 'AYAPEL',1 ),
( 11,'23079', 'BUENAVISTA',1 ),
( 11,'23090', 'CANALETE',1 ),
( 11,'23162', 'CERETÉ',1 ),
( 11,'23168', 'CHIMÁ',1 ),
( 11,'23182', 'CHINÚ',1 ),
( 11,'23189', 'CIÉNAGA DE ORO',1 ),
( 11,'23300', 'COTORRA',1 ),
( 11,'23350', 'LA APARTADA',1 ),
( 11,'23417', 'LORICA',1 ),
( 11,'23419', 'LOS CÓRDOBAS',1 ),
( 11,'23464', 'MOMIL',1 ),
( 11,'23466', 'MONTELÍBANO',1 ),
( 11,'23500', 'MOÑITOS',1 ),
( 11,'23555', 'PLANETA RICA',1 ),
( 11,'23570', 'PUEBLO NUEVO',1 ),
( 11,'23574', 'PUERTO ESCONDIDO',1 ),
( 11,'23580', 'PUERTO LIBERTADOR',1 ),
( 11,'23586', 'PURÍSIMA DE LA CONCEPCIÓN',1 ),
( 11,'23660', 'SAHAGÚN',1 ),
( 11,'23670', 'SAN ANDRÉS DE SOTAVENTO',1 ),
( 11,'23672', 'SAN ANTERO',1 ),
( 11,'23675', 'SAN BERNARDO DEL VIENTO',1 ),
( 11,'23678', 'SAN CARLOS',1 ),
( 11,'23682', 'SAN JOSÉ DE URÉ',1 ),
( 11,'23686', 'SAN PELAYO',1 ),
( 11,'23807', 'TIERRALTA',1 ),
( 11,'23815', 'TUCHÍN',1 ),
( 11,'23855', 'VALENCIA',1 ),
( 12,'25001', 'AGUA DE DIOS',1 ),
( 12,'25019', 'ALBÁN',1 ),
( 12,'25035', 'ANAPOIMA',1 ),
( 12,'25040', 'ANOLAIMA',1 ),
( 12,'25053', 'ARBELÁEZ',1 ),
( 12,'25086', 'BELTRÁN',1 ),
( 12,'25095', 'BITUIMA',1 ),
( 12,'25099', 'BOJACÁ',1 ),
( 12,'25120', 'CABRERA',1 ),
( 12,'25123', 'CACHIPAY',1 ),
( 12,'25126', 'CAJICÁ',1 ),
( 12,'25148', 'CAPARRAPÍ',1 ),
( 12,'25151', 'CÁQUEZA',1 ),
( 12,'25154', 'CARMEN DE CARUPA',1 ),
( 12,'25168', 'CHAGUANÍ',1 ),
( 12,'25175', 'CHÍA',1 ),
( 12,'25178', 'CHIPAQUE',1 ),
( 12,'25181', 'CHOACHÍ',1 ),
( 12,'25183', 'CHOCONTÁ',1 ),
( 12,'25200', 'COGUA',1 ),
( 12,'25214', 'COTA',1 ),
( 12,'25224', 'CUCUNUBÁ',1 ),
( 12,'25245', 'EL COLEGIO',1 ),
( 12,'25258', 'EL PEÑÓN',1 ),
( 12,'25260', 'EL ROSAL',1 ),
( 12,'25269', 'FACATATIVÁ',1 ),
( 12,'25279', 'FÓMEQUE',1 ),
( 12,'25281', 'FOSCA',1 ),
( 12,'25286', 'FUNZA',1 ),
( 12,'25288', 'FÚQUENE',1 ),
( 12,'25290', 'FUSAGASUGÁ',1 ),
( 12,'25293', 'GACHALÁ',1 ),
( 12,'25295', 'GACHANCIPÁ',1 ),
( 12,'25297', 'GACHETÁ',1 ),
( 12,'25299', 'GAMA',1 ),
( 12,'25307', 'GIRARDOT',1 ),
( 12,'25312', 'GRANADA',1 ),
( 12,'25317', 'GUACHETÁ',1 ),
( 12,'25320', 'GUADUAS',1 ),
( 12,'25322', 'GUASCA',1 ),
( 12,'25324', 'GUATAQUÍ',1 ),
( 12,'25326', 'GUATAVITA',1 ),
( 12,'25328', 'GUAYABAL DE SÍQUIMA',1 ),
( 12,'25335', 'GUAYABETAL',1 ),
( 12,'25339', 'GUTIÉRREZ',1 ),
( 12,'25368', 'JERUSALÉN',1 ),
( 12,'25372', 'JUNÍN',1 ),
( 12,'25377', 'LA CALERA',1 ),
( 12,'25386', 'LA MESA',1 ),
( 12,'25394', 'LA PALMA',1 ),
( 12,'25398', 'LA PEÑA',1 ),
( 12,'25402', 'LA VEGA',1 ),
( 12,'25407', 'LENGUAZAQUE',1 ),
( 12,'25426', 'MACHETÁ',1 ),
( 12,'25430', 'MADRID',1 ),
( 12,'25436', 'MANTA',1 ),
( 12,'25438', 'MEDINA',1 ),
( 12,'25473', 'MOSQUERA',1 ),
( 12,'25483', 'NARIÑO',1 ),
( 12,'25486', 'NEMOCÓN',1 ),
( 12,'25488', 'NILO',1 ),
( 12,'25489', 'NIMAIMA',1 ),
( 12,'25491', 'NOCAIMA',1 ),
( 12,'25506', 'VENECIA',1 ),
( 12,'25513', 'PACHO',1 ),
( 12,'25518', 'PAIME',1 ),
( 12,'25524', 'PANDI',1 ),
( 12,'25530', 'PARATEBUENO',1 ),
( 12,'25535', 'PASCA',1 ),
( 12,'25572', 'PUERTO SALGAR',1 ),
( 12,'25580', 'PULÍ',1 ),
( 12,'25592', 'QUEBRADANEGRA',1 ),
( 12,'25594', 'QUETAME',1 ),
( 12,'25596', 'QUIPILE',1 ),
( 12,'25599', 'APULO',1 ),
( 12,'25612', 'RICAURTE',1 ),
( 12,'25645', 'SAN ANTONIO DEL TEQUENDAMA',1 ),
( 12,'25649', 'SAN BERNARDO',1 ),
( 12,'25653', 'SAN CAYETANO',1 ),
( 12,'25658', 'SAN FRANCISCO',1 ),
( 12,'25662', 'SAN JUAN DE RIOSECO',1 ),
( 12,'25718', 'SASAIMA',1 ),
( 12,'25736', 'SESQUILÉ',1 ),
( 12,'25740', 'SIBATÉ',1 ),
( 12,'25743', 'SILVANIA',1 ),
( 12,'25745', 'SIMIJACA',1 ),
( 12,'25754', 'SOACHA',1 ),
( 12,'25758', 'SOPÓ',1 ),
( 12,'25769', 'SUBACHOQUE',1 ),
( 12,'25772', 'SUESCA',1 ),
( 12,'25777', 'SUPATÁ',1 ),
( 12,'25779', 'SUSA',1 ),
( 12,'25781', 'SUTATAUSA',1 ),
( 12,'25785', 'TABIO',1 ),
( 12,'25793', 'TAUSA',1 ),
( 12,'25797', 'TENA',1 ),
( 12,'25799', 'TENJO',1 ),
( 12,'25805', 'TIBACUY',1 ),
( 12,'25807', 'TIBIRITA',1 ),
( 12,'25815', 'TOCAIMA',1 ),
( 12,'25817', 'TOCANCIPÁ',1 ),
( 12,'25823', 'TOPAIPÍ',1 ),
( 12,'25839', 'UBALÁ',1 ),
( 12,'25841', 'UBAQUE',1 ),
( 12,'25843', 'VILLA DE SAN DIEGO DE UBATÉ',1 ),
( 12,'25845', 'UNE',1 ),
( 12,'25851', 'ÚTICA',1 ),
( 12,'25862', 'VERGARA',1 ),
( 12,'25867', 'VIANÍ',1 ),
( 12,'25871', 'VILLAGÓMEZ',1 ),
( 12,'25873', 'VILLAPINZÓN',1 ),
( 12,'25875', 'VILLETA',1 ),
( 12,'25878', 'VIOTÁ',1 ),
( 12,'25885', 'YACOPÍ',1 ),
( 12,'25898', 'ZIPACÓN',1 ),
( 12,'25899', 'ZIPAQUIRÁ',1 ),
( 13,'27001', 'QUIBDÓ',1 ),
( 13,'27006', 'ACANDÍ',1 ),
( 13,'27025', 'ALTO BAUDÓ',1 ),
( 13,'27050', 'ATRATO',1 ),
( 13,'27073', 'BAGADÓ',1 ),
( 13,'27075', 'BAHÍA SOLANO',1 ),
( 13,'27077', 'BAJO BAUDÓ',1 ),
( 13,'27086', 'Belén De Bajira',1 ),
( 13,'27099', 'BOJAYÁ',1 ),
( 13,'27135', 'EL CANTÓN DEL SAN PABLO',1 ),
( 13,'27150', 'CARMEN DEL DARIÉN',1 ),
( 13,'27160', 'CÉRTEGUI',1 ),
( 13,'27205', 'CONDOTO',1 ),
( 13,'27245', 'EL CARMEN DE ATRATO',1 ),
( 13,'27250', 'EL LITORAL DEL SAN JUAN',1 ),
( 13,'27361', 'ISTMINA',1 ),
( 13,'27372', 'JURADÓ',1 ),
( 13,'27413', 'LLORÓ',1 ),
( 13,'27425', 'MEDIO ATRATO',1 ),
( 13,'27430', 'MEDIO BAUDÓ',1 ),
( 13,'27450', 'MEDIO SAN JUAN',1 ),
( 13,'27491', 'NÓVITA',1 ),
( 13,'27493', 'Nuevo Belén de Bajirá',1 ),
( 13,'27495', 'NUQUÍ',1 ),
( 13,'27580', 'RÍO IRÓ',1 ),
( 13,'27600', 'RÍO QUITO',1 ),
( 13,'27615', 'RIOSUCIO',1 ),
( 13,'27660', 'SAN JOSÉ DEL PALMAR',1 ),
( 13,'27745', 'SIPÍ',1 ),
( 13,'27787', 'TADÓ',1 ),
( 13,'27800', 'UNGUÍA',1 ),
( 13,'27810', 'UNIÓN PANAMERICANA',1 ),
( 14,'41001', 'NEIVA',1 ),
( 14,'41006', 'ACEVEDO',1 ),
( 14,'41013', 'AGRADO',1 ),
( 14,'41016', 'AIPE',1 ),
( 14,'41020', 'ALGECIRAS',1 ),
( 14,'41026', 'ALTAMIRA',1 ),
( 14,'41078', 'BARAYA',1 ),
( 14,'41132', 'CAMPOALEGRE',1 ),
( 14,'41206', 'COLOMBIA',1 ),
( 14,'41244', 'ELÍAS',1 ),
( 14,'41298', 'GARZÓN',1 ),
( 14,'41306', 'GIGANTE',1 ),
( 14,'41319', 'GUADALUPE',1 ),
( 14,'41349', 'HOBO',1 ),
( 14,'41357', 'ÍQUIRA',1 ),
( 14,'41359', 'ISNOS',1 ),
( 14,'41378', 'LA ARGENTINA',1 ),
( 14,'41396', 'LA PLATA',1 ),
( 14,'41483', 'NÁTAGA',1 ),
( 14,'41503', 'OPORAPA',1 ),
( 14,'41518', 'PAICOL',1 ),
( 14,'41524', 'PALERMO',1 ),
( 14,'41530', 'PALESTINA',1 ),
( 14,'41548', 'PITAL',1 ),
( 14,'41551', 'PITALITO',1 ),
( 14,'41615', 'RIVERA',1 ),
( 14,'41660', 'SALADOBLANCO',1 ),
( 14,'41668', 'SAN AGUSTÍN',1 ),
( 14,'41676', 'SANTA MARÍA',1 ),
( 14,'41770', 'SUAZA',1 ),
( 14,'41791', 'TARQUI',1 ),
( 14,'41797', 'TESALIA',1 ),
( 14,'41799', 'TELLO',1 ),
( 14,'41801', 'TERUEL',1 ),
( 14,'41807', 'TIMANÁ',1 ),
( 14,'41872', 'VILLAVIEJA',1 ),
( 14,'41885', 'YAGUARÁ',1 ),
( 15,'44001', 'RIOHACHA',1 ),
( 15,'44035', 'ALBANIA',1 ),
( 15,'44078', 'BARRANCAS',1 ),
( 15,'44090', 'DIBULLA',1 ),
( 15,'44098', 'DISTRACCIÓN',1 ),
( 15,'44110', 'EL MOLINO',1 ),
( 15,'44279', 'FONSECA',1 ),
( 15,'44378', 'HATONUEVO',1 ),
( 15,'44420', 'LA JAGUA DEL PILAR',1 ),
( 15,'44430', 'MAICAO',1 ),
( 15,'44560', 'MANAURE',1 ),
( 15,'44650', 'SAN JUAN DEL CESAR',1 ),
( 15,'44847', 'URIBIA',1 ),
( 15,'44855', 'URUMITA',1 ),
( 15,'44874', 'VILLANUEVA',1 ),
( 16,'47001', 'SANTA MARTA',1 ),
( 16,'47030', 'ALGARROBO',1 ),
( 16,'47053', 'ARACATACA',1 ),
( 16,'47058', 'ARIGUANÍ',1 ),
( 16,'47161', 'CERRO DE SAN ANTONIO',1 ),
( 16,'47170', 'CHIVOLO',1 ),
( 16,'47189', 'CIÉNAGA',1 ),
( 16,'47205', 'CONCORDIA',1 ),
( 16,'47245', 'EL BANCO',1 ),
( 16,'47258', 'EL PIÑÓN',1 ),
( 16,'47268', 'EL RETÉN',1 ),
( 16,'47288', 'FUNDACIÓN',1 ),
( 16,'47318', 'GUAMAL',1 ),
( 16,'47460', 'NUEVA GRANADA',1 ),
( 16,'47541', 'PEDRAZA',1 ),
( 16,'47545', 'PIJIÑO DEL CARMEN',1 ),
( 16,'47551', 'PIVIJAY',1 ),
( 16,'47555', 'PLATO',1 ),
( 16,'47570', 'PUEBLOVIEJO',1 ),
( 16,'47605', 'REMOLINO',1 ),
( 16,'47660', 'SABANAS DE SAN ÁNGEL',1 ),
( 16,'47675', 'SALAMINA',1 ),
( 16,'47692', 'SAN SEBASTIÁN DE BUENAVISTA',1 ),
( 16,'47703', 'SAN ZENÓN',1 ),
( 16,'47707', 'SANTA ANA',1 ),
( 16,'47720', 'SANTA BÁRBARA DE PINTO',1 ),
( 16,'47745', 'SITIONUEVO',1 ),
( 16,'47798', 'TENERIFE',1 ),
( 16,'47960', 'ZAPAYÁN',1 ),
( 16,'47980', 'ZONA BANANERA',1 ),
( 17,'50001', 'VILLAVICENCIO',1 ),
( 17,'50006', 'ACACÍAS',1 ),
( 17,'50110', 'BARRANCA DE UPÍA',1 ),
( 17,'50124', 'CABUYARO',1 ),
( 17,'50150', 'CASTILLA LA NUEVA',1 ),
( 17,'50223', 'CUBARRAL',1 ),
( 17,'50226', 'CUMARAL',1 ),
( 17,'50245', 'EL CALVARIO',1 ),
( 17,'50251', 'EL CASTILLO',1 ),
( 17,'50270', 'EL DORADO',1 ),
( 17,'50287', 'FUENTE DE ORO',1 ),
( 17,'50313', 'GRANADA',1 ),
( 17,'50318', 'GUAMAL',1 ),
( 17,'50325', 'MAPIRIPÁN',1 ),
( 17,'50330', 'MESETAS',1 ),
( 17,'50350', 'LA MACARENA',1 ),
( 17,'50370', 'URIBE',1 ),
( 17,'50400', 'LEJANÍAS',1 ),
( 17,'50450', 'PUERTO CONCORDIA',1 ),
( 17,'50568', 'PUERTO GAITÁN',1 ),
( 17,'50573', 'PUERTO LÓPEZ',1 ),
( 17,'50577', 'PUERTO LLERAS',1 ),
( 17,'50590', 'PUERTO RICO',1 ),
( 17,'50606', 'RESTREPO',1 ),
( 17,'50680', 'SAN CARLOS DE GUAROA',1 ),
( 17,'50683', 'SAN JUAN DE ARAMA',1 ),
( 17,'50686', 'SAN JUANITO',1 ),
( 17,'50689', 'SAN MARTÍN',1 ),
( 17,'50711', 'VISTAHERMOSA',1 ),
( 18,'52001', 'PASTO',1 ),
( 18,'52019', 'ALBÁN',1 ),
( 18,'52022', 'ALDANA',1 ),
( 18,'52036', 'ANCUYÁ',1 ),
( 18,'52051', 'ARBOLEDA',1 ),
( 18,'52079', 'BARBACOAS',1 ),
( 18,'52083', 'BELÉN',1 ),
( 18,'52110', 'BUESACO',1 ),
( 18,'52203', 'COLÓN',1 ),
( 18,'52207', 'CONSACÁ',1 ),
( 18,'52210', 'CONTADERO',1 ),
( 18,'52215', 'CÓRDOBA',1 ),
( 18,'52224', 'CUASPÚD',1 ),
( 18,'52227', 'CUMBAL',1 ),
( 18,'52233', 'CUMBITARA',1 ),
( 18,'52240', 'CHACHAGÜÍ',1 ),
( 18,'52250', 'EL CHARCO',1 ),
( 18,'52254', 'EL PEÑOL',1 ),
( 18,'52256', 'EL ROSARIO',1 ),
( 18,'52258', 'EL TABLÓN DE GÓMEZ',1 ),
( 18,'52260', 'EL TAMBO',1 ),
( 18,'52287', 'FUNES',1 ),
( 18,'52317', 'GUACHUCAL',1 ),
( 18,'52320', 'GUAITARILLA',1 ),
( 18,'52323', 'GUALMATÁN',1 ),
( 18,'52352', 'ILES',1 ),
( 18,'52354', 'IMUÉS',1 ),
( 18,'52356', 'IPIALES',1 ),
( 18,'52378', 'LA CRUZ',1 ),
( 18,'52381', 'LA FLORIDA',1 ),
( 18,'52385', 'LA LLANADA',1 ),
( 18,'52390', 'LA TOLA',1 ),
( 18,'52399', 'LA UNIÓN',1 ),
( 18,'52405', 'LEIVA',1 ),
( 18,'52411', 'LINARES',1 ),
( 18,'52418', 'LOS ANDES',1 ),
( 18,'52427', 'MAGÜÍ',1 ),
( 18,'52435', 'MALLAMA',1 ),
( 18,'52473', 'MOSQUERA',1 ),
( 18,'52480', 'NARIÑO',1 ),
( 18,'52490', 'OLAYA HERRERA',1 ),
( 18,'52506', 'OSPINA',1 ),
( 18,'52520', 'FRANCISCO PIZARRO',1 ),
( 18,'52540', 'POLICARPA',1 ),
( 18,'52560', 'POTOSÍ',1 ),
( 18,'52565', 'PROVIDENCIA',1 ),
( 18,'52573', 'PUERRES',1 ),
( 18,'52585', 'PUPIALES',1 ),
( 18,'52612', 'RICAURTE',1 ),
( 18,'52621', 'ROBERTO PAYÁN',1 ),
( 18,'52678', 'SAMANIEGO',1 ),
( 18,'52683', 'SANDONÁ',1 ),
( 18,'52685', 'SAN BERNARDO',1 ),
( 18,'52687', 'SAN LORENZO',1 ),
( 18,'52693', 'SAN PABLO',1 ),
( 18,'52694', 'SAN PEDRO DE CARTAGO',1 ),
( 18,'52696', 'SANTA BÁRBARA',1 ),
( 18,'52699', 'SANTACRUZ',1 ),
( 18,'52720', 'SAPUYES',1 ),
( 18,'52786', 'TAMINANGO',1 ),
( 18,'52788', 'TANGUA',1 ),
( 18,'52835', 'SAN ANDRÉS DE TUMACO',1 ),
( 18,'52838', 'TÚQUERRES',1 ),
( 18,'52885', 'YACUANQUER',1 ),
( 19,'54001', 'SAN JOSÉ DE CÚCUTA',1 ),
( 19,'54003', 'ÁBREGO',1 ),
( 19,'54051', 'ARBOLEDAS',1 ),
( 19,'54099', 'BOCHALEMA',1 ),
( 19,'54109', 'BUCARASICA',1 ),
( 19,'54125', 'CÁCOTA',1 ),
( 19,'54128', 'CÁCHIRA',1 ),
( 19,'54172', 'CHINÁCOTA',1 ),
( 19,'54174', 'CHITAGÁ',1 ),
( 19,'54206', 'CONVENCIÓN',1 ),
( 19,'54223', 'CUCUTILLA',1 ),
( 19,'54239', 'DURANIA',1 ),
( 19,'54245', 'EL CARMEN',1 ),
( 19,'54250', 'EL TARRA',1 ),
( 19,'54261', 'EL ZULIA',1 ),
( 19,'54313', 'GRAMALOTE',1 ),
( 19,'54344', 'HACARÍ',1 ),
( 19,'54347', 'HERRÁN',1 ),
( 19,'54377', 'LABATECA',1 ),
( 19,'54385', 'LA ESPERANZA',1 ),
( 19,'54398', 'LA PLAYA',1 ),
( 19,'54405', 'LOS PATIOS',1 ),
( 19,'54418', 'LOURDES',1 ),
( 19,'54480', 'MUTISCUA',1 ),
( 19,'54498', 'OCAÑA',1 ),
( 19,'54518', 'PAMPLONA',1 ),
( 19,'54520', 'PAMPLONITA',1 ),
( 19,'54553', 'PUERTO SANTANDER',1 ),
( 19,'54599', 'RAGONVALIA',1 ),
( 19,'54660', 'SALAZAR',1 ),
( 19,'54670', 'SAN CALIXTO',1 ),
( 19,'54673', 'SAN CAYETANO',1 ),
( 19,'54680', 'SANTIAGO',1 ),
( 19,'54720', 'SARDINATA',1 ),
( 19,'54743', 'SILOS',1 ),
( 19,'54800', 'TEORAMA',1 ),
( 19,'54810', 'TIBÚ',1 ),
( 19,'54820', 'TOLEDO',1 ),
( 19,'54871', 'VILLA CARO',1 ),
( 19,'54874', 'VILLA DEL ROSARIO',1 ),
( 20,'63001', 'ARMENIA',1 ),
( 20,'63111', 'BUENAVISTA',1 ),
( 20,'63130', 'CALARCÁ',1 ),
( 20,'63190', 'CIRCASIA',1 ),
( 20,'63212', 'CÓRDOBA',1 ),
( 20,'63272', 'FILANDIA',1 ),
( 20,'63302', 'GÉNOVA',1 ),
( 20,'63401', 'LA TEBAIDA',1 ),
( 20,'63470', 'MONTENEGRO',1 ),
( 20,'63548', 'PIJAO',1 ),
( 20,'63594', 'QUIMBAYA',1 ),
( 20,'63690', 'SALENTO',1 ),
( 21,'66001', 'PEREIRA',1 ),
( 21,'66045', 'APÍA',1 ),
( 21,'66075', 'BALBOA',1 ),
( 21,'66088', 'BELÉN DE UMBRÍA',1 ),
( 21,'66170', 'DOSQUEBRADAS',1 ),
( 21,'66318', 'GUÁTICA',1 ),
( 21,'66383', 'LA CELIA',1 ),
( 21,'66400', 'LA VIRGINIA',1 ),
( 21,'66440', 'MARSELLA',1 ),
( 21,'66456', 'MISTRATÓ',1 ),
( 21,'66572', 'PUEBLO RICO',1 ),
( 21,'66594', 'QUINCHÍA',1 ),
( 21,'66682', 'SANTA ROSA DE CABAL',1 ),
( 21,'66687', 'SANTUARIO',1 ),
( 22,'68001', 'BUCARAMANGA',1 ),
( 22,'68013', 'AGUADA',1 ),
( 22,'68020', 'ALBANIA',1 ),
( 22,'68051', 'ARATOCA',1 ),
( 22,'68077', 'BARBOSA',1 ),
( 22,'68079', 'BARICHARA',1 ),
( 22,'68081', 'BARRANCABERMEJA',1 ),
( 22,'68092', 'BETULIA',1 ),
( 22,'68101', 'BOLÍVAR',1 ),
( 22,'68121', 'CABRERA',1 ),
( 22,'68132', 'CALIFORNIA',1 ),
( 22,'68147', 'CAPITANEJO',1 ),
( 22,'68152', 'CARCASÍ',1 ),
( 22,'68160', 'CEPITÁ',1 ),
( 22,'68162', 'CERRITO',1 ),
( 22,'68167', 'CHARALÁ',1 ),
( 22,'68169', 'CHARTA',1 ),
( 22,'68176', 'CHIMA',1 ),
( 22,'68179', 'CHIPATÁ',1 ),
( 22,'68190', 'CIMITARRA',1 ),
( 22,'68207', 'CONCEPCIÓN',1 ),
( 22,'68209', 'CONFINES',1 ),
( 22,'68211', 'CONTRATACIÓN',1 ),
( 22,'68217', 'COROMORO',1 ),
( 22,'68229', 'CURITÍ',1 ),
( 22,'68235', 'EL CARMEN DE CHUCURÍ',1 ),
( 22,'68245', 'EL GUACAMAYO',1 ),
( 22,'68250', 'EL PEÑÓN',1 ),
( 22,'68255', 'EL PLAYÓN',1 ),
( 22,'68264', 'ENCINO',1 ),
( 22,'68266', 'ENCISO',1 ),
( 22,'68271', 'FLORIÁN',1 ),
( 22,'68276', 'FLORIDABLANCA',1 ),
( 22,'68296', 'GALÁN',1 ),
( 22,'68298', 'GÁMBITA',1 ),
( 22,'68307', 'GIRÓN',1 ),
( 22,'68318', 'GUACA',1 ),
( 22,'68320', 'GUADALUPE',1 ),
( 22,'68322', 'GUAPOTÁ',1 ),
( 22,'68324', 'GUAVATÁ',1 ),
( 22,'68327', 'GÜEPSA',1 ),
( 22,'68344', 'HATO',1 ),
( 22,'68368', 'JESÚS MARÍA',1 ),
( 22,'68370', 'JORDÁN',1 ),
( 22,'68377', 'LA BELLEZA',1 ),
( 22,'68385', 'LANDÁZURI',1 ),
( 22,'68397', 'LA PAZ',1 ),
( 22,'68406', 'LEBRIJA',1 ),
( 22,'68418', 'LOS SANTOS',1 ),
( 22,'68425', 'MACARAVITA',1 ),
( 22,'68432', 'MÁLAGA',1 ),
( 22,'68444', 'MATANZA',1 ),
( 22,'68464', 'MOGOTES',1 ),
( 22,'68468', 'MOLAGAVITA',1 ),
( 22,'68498', 'OCAMONTE',1 ),
( 22,'68500', 'OIBA',1 ),
( 22,'68502', 'ONZAGA',1 ),
( 22,'68522', 'PALMAR',1 ),
( 22,'68524', 'PALMAS DEL SOCORRO',1 ),
( 22,'68533', 'PÁRAMO',1 ),
( 22,'68547', 'PIEDECUESTA',1 ),
( 22,'68549', 'PINCHOTE',1 ),
( 22,'68572', 'PUENTE NACIONAL',1 ),
( 22,'68573', 'PUERTO PARRA',1 ),
( 22,'68575', 'PUERTO WILCHES',1 ),
( 22,'68615', 'RIONEGRO',1 ),
( 22,'68655', 'SABANA DE TORRES',1 ),
( 22,'68669', 'SAN ANDRÉS',1 ),
( 22,'68673', 'SAN BENITO',1 ),
( 22,'68679', 'SAN GIL',1 ),
( 22,'68682', 'SAN JOAQUÍN',1 ),
( 22,'68684', 'SAN JOSÉ DE MIRANDA',1 ),
( 22,'68686', 'SAN MIGUEL',1 ),
( 22,'68689', 'SAN VICENTE DE CHUCURÍ',1 ),
( 22,'68705', 'SANTA BÁRBARA',1 ),
( 22,'68720', 'SANTA HELENA DEL OPÓN',1 ),
( 22,'68745', 'SIMACOTA',1 ),
( 22,'68755', 'SOCORRO',1 ),
( 22,'68770', 'SUAITA',1 ),
( 22,'68773', 'SUCRE',1 ),
( 22,'68780', 'SURATÁ',1 ),
( 22,'68820', 'TONA',1 ),
( 22,'68855', 'VALLE DE SAN JOSÉ',1 ),
( 22,'68861', 'VÉLEZ',1 ),
( 22,'68867', 'VETAS',1 ),
( 22,'68872', 'VILLANUEVA',1 ),
( 22,'68895', 'ZAPATOCA',1 ),
( 23,'70001', 'SINCELEJO',1 ),
( 23,'70110', 'BUENAVISTA',1 ),
( 23,'70124', 'CAIMITO',1 ),
( 23,'70204', 'COLOSÓ',1 ),
( 23,'70215', 'COROZAL',1 ),
( 23,'70221', 'COVEÑAS',1 ),
( 23,'70230', 'CHALÁN',1 ),
( 23,'70233', 'EL ROBLE',1 ),
( 23,'70235', 'GALERAS',1 ),
( 23,'70265', 'GUARANDA',1 ),
( 23,'70400', 'LA UNIÓN',1 ),
( 23,'70418', 'LOS PALMITOS',1 ),
( 23,'70429', 'MAJAGUAL',1 ),
( 23,'70473', 'MORROA',1 ),
( 23,'70508', 'OVEJAS',1 ),
( 23,'70523', 'PALMITO',1 ),
( 23,'70670', 'SAMPUÉS',1 ),
( 23,'70678', 'SAN BENITO ABAD',1 ),
( 23,'70702', 'SAN JUAN DE BETULIA',1 ),
( 23,'70708', 'SAN MARCOS',1 ),
( 23,'70713', 'SAN ONOFRE',1 ),
( 23,'70717', 'SAN PEDRO',1 ),
( 23,'70742', 'SAN LUIS DE SINCÉ',1 ),
( 23,'70771', 'SUCRE',1 ),
( 23,'70820', 'SANTIAGO DE TOLÚ',1 ),
( 23,'70823', 'TOLÚ VIEJO',1 ),
( 24,'73001', 'IBAGUÉ',1 ),
( 24,'73024', 'ALPUJARRA',1 ),
( 24,'73026', 'ALVARADO',1 ),
( 24,'73030', 'AMBALEMA',1 ),
( 24,'73043', 'ANZOÁTEGUI',1 ),
( 24,'73055', 'ARMERO',1 ),
( 24,'73067', 'ATACO',1 ),
( 24,'73124', 'CAJAMARCA',1 ),
( 24,'73148', 'CARMEN DE APICALÁ',1 ),
( 24,'73152', 'CASABIANCA',1 ),
( 24,'73168', 'CHAPARRAL',1 ),
( 24,'73200', 'COELLO',1 ),
( 24,'73217', 'COYAIMA',1 ),
( 24,'73226', 'CUNDAY',1 ),
( 24,'73236', 'DOLORES',1 ),
( 24,'73268', 'ESPINAL',1 ),
( 24,'73270', 'FALAN',1 ),
( 24,'73275', 'FLANDES',1 ),
( 24,'73283', 'FRESNO',1 ),
( 24,'73319', 'GUAMO',1 ),
( 24,'73347', 'HERVEO',1 ),
( 24,'73349', 'HONDA',1 ),
( 24,'73352', 'ICONONZO',1 ),
( 24,'73408', 'LÉRIDA',1 ),
( 24,'73411', 'LÍBANO',1 ),
( 24,'73443', 'SAN SEBASTIÁN DE MARIQUITA',1 ),
( 24,'73449', 'MELGAR',1 ),
( 24,'73461', 'MURILLO',1 ),
( 24,'73483', 'NATAGAIMA',1 ),
( 24,'73504', 'ORTEGA',1 ),
( 24,'73520', 'PALOCABILDO',1 ),
( 24,'73547', 'PIEDRAS',1 ),
( 24,'73555', 'PLANADAS',1 ),
( 24,'73563', 'PRADO',1 ),
( 24,'73585', 'PURIFICACIÓN',1 ),
( 24,'73616', 'RIOBLANCO',1 ),
( 24,'73622', 'RONCESVALLES',1 ),
( 24,'73624', 'ROVIRA',1 ),
( 24,'73671', 'SALDAÑA',1 ),
( 24,'73675', 'SAN ANTONIO',1 ),
( 24,'73678', 'SAN LUIS',1 ),
( 24,'73686', 'SANTA ISABEL',1 ),
( 24,'73770', 'SUÁREZ',1 ),
( 24,'73854', 'VALLE DE SAN JUAN',1 ),
( 24,'73861', 'VENADILLO',1 ),
( 24,'73870', 'VILLAHERMOSA',1 ),
( 24,'73873', 'VILLARRICA',1 ),
( 25,'76001', 'CALI',1 ),
( 25,'76020', 'ALCALÁ',1 ),
( 25,'76036', 'ANDALUCÍA',1 ),
( 25,'76041', 'ANSERMANUEVO',1 ),
( 25,'76054', 'ARGELIA',1 ),
( 25,'76100', 'BOLÍVAR',1 ),
( 25,'76109', 'BUENAVENTURA',1 ),
( 25,'76111', 'GUADALAJARA DE BUGA',1 ),
( 25,'76113', 'BUGALAGRANDE',1 ),
( 25,'76122', 'CAICEDONIA',1 ),
( 25,'76126', 'CALIMA',1 ),
( 25,'76130', 'CANDELARIA',1 ),
( 25,'76147', 'CARTAGO',1 ),
( 25,'76233', 'DAGUA',1 ),
( 25,'76243', 'EL ÁGUILA',1 ),
( 25,'76246', 'EL CAIRO',1 ),
( 25,'76248', 'EL CERRITO',1 ),
( 25,'76250', 'EL DOVIO',1 ),
( 25,'76275', 'FLORIDA',1 ),
( 25,'76306', 'GINEBRA',1 ),
( 25,'76318', 'GUACARÍ',1 ),
( 25,'76364', 'JAMUNDÍ',1 ),
( 25,'76377', 'LA CUMBRE',1 ),
( 25,'76400', 'LA UNIÓN',1 ),
( 25,'76403', 'LA VICTORIA',1 ),
( 25,'76497', 'OBANDO',1 ),
( 25,'76520', 'PALMIRA',1 ),
( 25,'76563', 'PRADERA',1 ),
( 25,'76606', 'RESTREPO',1 ),
( 25,'76616', 'RIOFRÍO',1 ),
( 25,'76622', 'ROLDANILLO',1 ),
( 25,'76670', 'SAN PEDRO',1 ),
( 25,'76736', 'SEVILLA',1 ),
( 25,'76823', 'TORO',1 ),
( 25,'76828', 'TRUJILLO',1 ),
( 25,'76834', 'TULUÁ',1 ),
( 25,'76845', 'ULLOA',1 ),
( 25,'76863', 'VERSALLES',1 ),
( 25,'76869', 'VIJES',1 ),
( 25,'76890', 'YOTOCO',1 ),
( 25,'76892', 'YUMBO',1 ),
( 25,'76895', 'ZARZAL',1 ),
( 26,'81001', 'ARAUCA',1 ),
( 26,'81065', 'ARAUQUITA',1 ),
( 26,'81220', 'CRAVO NORTE',1 ),
( 26,'81300', 'FORTUL',1 ),
( 26,'81591', 'PUERTO RONDÓN',1 ),
( 26,'81736', 'SARAVENA',1 ),
( 26,'81794', 'TAME',1 ),
( 27,'85001', 'YOPAL',1 ),
( 27,'85010', 'AGUAZUL',1 ),
( 27,'85015', 'CHÁMEZA',1 ),
( 27,'85125', 'HATO COROZAL',1 ),
( 27,'85136', 'LA SALINA',1 ),
( 27,'85139', 'MANÍ',1 ),
( 27,'85162', 'MONTERREY',1 ),
( 27,'85225', 'NUNCHÍA',1 ),
( 27,'85230', 'OROCUÉ',1 ),
( 27,'85250', 'PAZ DE ARIPORO',1 ),
( 27,'85263', 'PORE',1 ),
( 27,'85279', 'RECETOR',1 ),
( 27,'85300', 'SABANALARGA',1 ),
( 27,'85315', 'SÁCAMA',1 ),
( 27,'85325', 'SAN LUIS DE PALENQUE',1 ),
( 27,'85400', 'TÁMARA',1 ),
( 27,'85410', 'TAURAMENA',1 ),
( 27,'85430', 'TRINIDAD',1 ),
( 27,'85440', 'VILLANUEVA',1 ),
( 28,'86001', 'MOCOA',1 ),
( 28,'86219', 'COLÓN',1 ),
( 28,'86320', 'ORITO',1 ),
( 28,'86568', 'PUERTO ASÍS',1 ),
( 28,'86569', 'PUERTO CAICEDO',1 ),
( 28,'86571', 'PUERTO GUZMÁN',1 ),
( 28,'86573', 'PUERTO LEGUÍZAMO',1 ),
( 28,'86749', 'SIBUNDOY',1 ),
( 28,'86755', 'SAN FRANCISCO',1 ),
( 28,'86757', 'SAN MIGUEL',1 ),
( 28,'86760', 'SANTIAGO',1 ),
( 28,'86865', 'VALLE DEL GUAMUEZ',1 ),
( 28,'86885', 'VILLAGARZÓN',1 ),
( 29,'88001', 'SAN ANDRÉS',1 ),
( 29,'88564', 'PROVIDENCIA',1 ),
( 30,'91001', 'LETICIA',1 ),
( 30,'91263', 'EL ENCANTO',1 ),
( 30,'91405', 'LA CHORRERA',1 ),
( 30,'91407', 'LA PEDRERA',1 ),
( 30,'91430', 'LA VICTORIA',1 ),
( 30,'91460', 'MIRITÍ - PARANÁ',1 ),
( 30,'91530', 'PUERTO ALEGRÍA',1 ),
( 30,'91536', 'PUERTO ARICA',1 ),
( 30,'91540', 'PUERTO NARIÑO',1 ),
( 30,'91669', 'PUERTO SANTANDER',1 ),
( 30,'91798', 'TARAPACÁ',1 ),
( 31,'94001', 'INÍRIDA',1 ),
( 31,'94343', 'BARRANCO MINAS',1 ),
( 31,'94663', 'MAPIRIPANA',1 ),
( 31,'94883', 'SAN FELIPE',1 ),
( 31,'94884', 'PUERTO COLOMBIA',1 ),
( 31,'94885', 'LA GUADALUPE',1 ),
( 31,'94886', 'CACAHUAL',1 ),
( 31,'94887', 'PANA PANA',1 ),
( 31,'94888', 'MORICHAL',1 ),
( 32,'95001', 'SAN JOSÉ DEL GUAVIARE',1 ),
( 32,'95015', 'CALAMAR',1 ),
( 32,'95025', 'EL RETORNO',1 ),
( 32,'95200', 'MIRAFLORES',1 ),
( 33,'97001', 'MITÚ',1 ),
( 33,'97161', 'CARURÚ',1 ),
( 33,'97511', 'PACOA',1 ),
( 33,'97666', 'TARAIRA',1 ),
( 33,'97777', 'PAPUNAHUA',1 ),
( 33,'97889', 'YAVARATÉ',1 ),
( 34,'99001', 'PUERTO CARREÑO',1 ),
( 34,'99524', 'LA PRIMAVERA',1 ),
( 34,'99624', 'SANTA ROSALÍA',1 ),
( 34,'99773', 'CUMARIBO',1 )
;


-- creacion tabla localidad para RIPS   
CREATE TABLE `localidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_municipio` int DEFAULT NULL,   
  `codigo_dane` varchar(10) DEFAULT NULL,
  `Nombre` varchar(150) NOT NULL,
  `campo_ordenamiento` int(11) DEFAULT 0,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int(11) NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT current_timestamp(),
  `usuario_id_actualizo` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    KEY `localidad_id_municipio_fk` (`id_municipio`),
    CONSTRAINT `localidad_id_municipio_fk` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO `localidad` (`id_municipio`, `codigo_dane`, `Nombre`, `usuario_id_inserto`) VALUES 
(149, '01', ' Usaquén',1 ),
(149, '02', ' Chapinero',1 ),
(149, '03', ' Santa Fe',1 ),
(149, '04', ' San Cristóbal',1 ),
(149, '05', ' Usme',1 ),
(149, '06', ' Tunjuelito',1 ),
(149, '07', ' Bosa',1 ),
(149, '08', ' Kennedy',1 ),
(149, '09', ' Fontibón',1 ),
(149, '10', ' Engativá',1 ),
(149, '11', ' Suba',1 ),
(149, '12', ' Barrios Unidos',1 ),
(149, '13', ' Teusaquillo',1 ),
(149, '14', ' Los Mártires',1 ),
(149, '15', ' Antonio Nariño',1 ),
(149, '16', ' Puente Aranda',1 ),
(149, '17', ' La Candelaria',1 ),
(149, '18', ' Rafael Uribe Uribe',1 ),
(149, '19', ' Ciudad Bolívar',1 ),
(149, '20', ' Sumapaz',1 );

-- creacion tabla regimen para RIPS
CREATE TABLE `regimen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `campo_ordenamiento` int(11) DEFAULT 0,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int(11) NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT current_timestamp(),
  `usuario_id_actualizo` int(11) DEFAULT NULL,  
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO `regimen` (`codigo`, `nombre`, `usuario_id_inserto`) VALUES 
( '1', 'Subsidiado',1 ),
( '2', 'Contributivo',1 ),
( '3', 'Especial',1 ),
( '4', 'Excepción' ,1),
( '5', 'No afiliado' ,1);


-- creacion tabla finalidad_consulta para RIPS
CREATE TABLE `finalidad_consulta` (  
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `campo_ordenamiento` int(11) DEFAULT 0,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int(11) NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT current_timestamp(),
  `usuario_id_actualizo` int(11) DEFAULT NULL,  
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO `finalidad_consulta` (`codigo`, `nombre`, `usuario_id_inserto`) VALUES 
( '11', 'VALORACION INTEGRAL PARA LA PROMOCION Y MANTENIMIENTO' ,1 ),
( '12', 'DETECCION TEMPRANA DE ENFERMEDAD GENERAL' ,1 ),
( '13', 'DETECCION TEMPRANA DE ENFERMEDAD LABORAL' ,1 ),
( '14', 'PROTECCION ESPECIFICA' ,1 ),
( '15', 'DIAGNOSTICO' ,1 ),
( '16', 'TRATAMIENTO' ,1 ),
( '17', 'REHABILITACION' ,1 ),
( '18', 'PALIACION' ,1 ),
( '19', 'PLANIFICACION FAMILIAR Y ANTICONCEPCION' ,1 ),
( '20', 'PROMOCION Y APOYO A LA LACTANCIA MATERNA' ,1 ),
( '21', 'ATENCION BASICA DE ORIENTACION FAMILIAR' ,1 ),
( '22', 'ATENCION PARA EL CUIDADO PRECONCEPCIONAL' ,1 ),
( '23', 'ATENCION PARA EL CUIDADO PRENATAL' ,1 ),
( '24', 'INTERRUPCION VOLUNTARIA DEL EMBARAZO' ,1 ),
( '25', 'ATENCION DEL PARTO Y PUERPERIO' ,1 ),
( '26', 'ATENCION PARA EL CUIDADO DEL RECIEN NACIDO' ,1 ),
( '27', 'ATENCION PARA EL SEGUIMIENTO DEL RECIEN NACIDO' ,1 ),
( '28', 'PREPARACION PARA LA MATERNIDAD Y LA PATERNIDAD' ,1 ),
( '29', 'PROMOCION DE ACTIVIDAD FISICA' ,1 ),
( '30', 'PROMOCION DE LA CESACION DEL TABAQUISMO' ,1 ),
( '31', 'PREVENCION DEL CONSUMO DE SUSTANCIAS PSICOACTIVAS' ,1 ),
( '32', 'PROMOCION DE LA ALIMENTACION SALUDABLE' ,1 ),
( '33', 'PROMOCION PARA EL EJERCICIO DE LOS DERECHOS SEXUALES Y DERECHOS REPRODUCTIVOS' ,1 ),
( '34', 'PROMOCION PARA EL DESARROLLO DE HABILIDADES PARA LA VIDA' ,1 ),
( '35', 'PROMOCION PARA LA CONSTRUCCION DE ESTRATEGIAS DE AFRONTAMIENTO FRENTE A  SUCESOS VITALES' ,1 ),
( '36', 'PROMOCION DE LA SANA CONVIVENCIA Y EL TEJIDO  SOCIAL' ,1 ),
( '37', 'PROMOCION DE UN AMBIENTE SEGURO Y DE CUIDADO Y PROTECCION DEL AMBIENTE' ,1 ),
( '38', 'PROMOCION DEL EMPODERAMIENTO PARA EL EJERCICIO DEL DERECHO A LA SALUD' ,1 ),
( '39', 'PROMOCION PARA LA ADOPCION DE PRACTICAS DE CRIANZA Y CUIDADO PARA LA SALUD' ,1 ),
( '40', 'PROMOCION DE LA CAPACIDAD DE LA AGENCIA Y CUIDADO DE LA SALUD' ,1 ),
( '41', 'DESARROLLO DE HABILIDADES COGNITIVAS' ,1 ),
( '42', 'INTERVENCION COLECTIVA' ,1 ),
( '43', 'MODIFICACION DE LA ESTETICA CORPORAL FINES ESTETICOS' ,1 ),
( '44', 'OTRA' ,1 );


-- creacion tabla causa_externa para RIPS
CREATE TABLE `causa_externa` (  
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `campo_ordenamiento` int(11) DEFAULT 0,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int(11) NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT current_timestamp(),
  `usuario_id_actualizo` int(11) DEFAULT NULL,  
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO `causa_externa` (`codigo`, `nombre`, `usuario_id_inserto`) VALUES 
( '21', 'ACCIDENTE DE TRABAJO' ,1 ),
( '22', 'ACCIDENTE EN EL HOGAR' ,1 ),
( '23', 'ACCIDENTE DE TRANSITO DE ORIGEN COMUN' ,1 ),
( '24', 'ACCIDENTE DE TRANSITO DE ORIGEN LABORAL' ,1 ),
( '25', 'ACCIDENTE EN EL ENTORNO EDUCATIVO' ,1 ),
( '26', 'OTRO TIPO DE ACCIDENTE' ,1 ),
( '27', 'EVENTO CATASTROFICO DE ORIGEN NATURAL' ,1 ),
( '28', 'LESION POR AGRESION' ,1 ),
( '29', 'LESION AUTO INFLIGIDA' ,1 ),
( '30', 'SOSPECHA DE VIOLENCIA FISICA' ,1 ),
( '31', 'SOSPECHA DE VIOLENCIA PSICOLOGICA' ,1 ),
( '32', 'SOSPECHA DE VIOLENCIA SEXUAL' ,1 ),
( '33', 'SOSPECHA DE NEGLIGENCIA Y ABANDONO' ,1 ),
( '34', 'IVE RELACIONADO CON PELIGRO A LA SALUD O  VIDA DE LA MUJER' ,1 ),
( '35', 'IVE POR MALFORMACION CONGENITA  INCOMPATIBLE CON LA VIDA' ,1 ),
( '36', 'IVE POR VIOLENCIA SEXUAL, INCESTO O POR INSEMINACION ARTIFICIAL O  TRANSFERENCIA DE OVULO FECUNDADO NO CONSENTIDA' ,1 ),
( '37', 'EVENTO ADVERSO EN SALUD' ,1 ),
( '38', 'ENFERMEDAD GENERAL' ,1 ),
( '39', 'ENFERMEDAD LABORAL' ,1 ),
( '40', 'PROMOCION Y MANTENIMIENTO DE LA SALUD ? INTERVENCIONES INDIVIDUALES' ,1 ),
( '41', 'INTERVENCION COLECTIVA' ,1 ),
( '42', 'ATENCION DE POBLACION MATERNO PERINATAL' ,1 ),
( '43', 'RIESGO AMBIENTAL' ,1 ),
( '44', 'OTROS EVENTOS CATASTROFICOS' ,1 ),
( '45', 'ACCIDENTE DE MINA ANTIPERSONAL ? MAP' ,1 ),
( '46', 'ACCIDENTE DE ARTEFACTO EXPLOSIVO IMPROVISADO ? AEI' ,1 ),
( '47', 'ACCIDENTE DE MUNICION SIN EXPLOTAR- MUSE' ,1 ),
( '48', 'OTRA VICTIMA DE CONFLICTO ARMADO COLOMBIANO' ,1 ),
( '49', 'IVE POR DECISION O MANIFESTACION DE VOLUNTAD DE LA PERSONA GESTANTE HASTA LA SEMANA 24 DE GESTACION' ,1 );



-- creacion tabla tipo_usuario para RIPS
CREATE TABLE `tipo_usuario` (  
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `campo_ordenamiento` int(11) DEFAULT 0,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int(11) NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT current_timestamp(),
  `usuario_id_actualizo` int(11) DEFAULT NULL,  
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO `tipo_usuario` (`codigo`, `nombre`, `usuario_id_inserto`) VALUES 
( '1', 'Contributivo' ,1 ),
( '2', 'Subsidiado' ,1 ),
( '3', 'Vinculado' ,1 ),
( '4', 'Particular' ,1 ),
( '5', 'Otro' ,1 ),
( '6', 'Desplazado con Afiliación al Contributivo' ,1 ),
( '7', 'Desplazado con Afiliación al Subsidiado' ,1 ),
( '8', 'Desplazado No Aseguarado' ,1 );



-- Modificacion en tabla pacientes para RIPS
ALTER TABLE `pacientes` 
 DROP COLUMN `departamento`, 
 DROP COLUMN `ciudad`,
 DROP COLUMN `direccion`;
 
ALTER TABLE `pacientes`  
 ADD COLUMN `pais_residencia_id` int DEFAULT null AFTER `genero_id`,
 ADD COLUMN `departamento_id` int DEFAULT null AFTER `pais_residencia_id`,
 ADD COLUMN `municipio_id` int DEFAULT null AFTER `departamento_id`,
 ADD COLUMN `localidad_id` int DEFAULT null AFTER `municipio_id`,
 ADD COLUMN `zona_residencia` enum('U','R') DEFAULT 'U' AFTER `localidad_id`,
 ADD COLUMN `id_regimen` int DEFAULT null AFTER `eps_id`,
 ADD COLUMN `id_tipo_usuario` int DEFAULT null AFTER `id_regimen`,
 ADD KEY `fk_pacientes_paises_residencia` (`pais_residencia_id`),
 ADD KEY `fk_pacientes_departamento` (`departamento_id`),
 ADD KEY `fk_pacientes_municipio` (`municipio_id`),
 ADD KEY `fk_pacientes_localidad` (`localidad_id`),
 ADD KEY `fk_pacientes_regimen` (`id_regimen`),
 ADD KEY `fk_pacientes_tipo_usuario` (`id_tipo_usuario`),
 ADD CONSTRAINT `fk_pacientes_paises_residencia` FOREIGN KEY (`pais_residencia_id`) REFERENCES `paises` (`id`),
 ADD CONSTRAINT `fk_pacientes_departamento` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`),
 ADD CONSTRAINT `fk_pacientes_municipio` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`id`),
 ADD CONSTRAINT `fk_pacientes_localidad` FOREIGN KEY (`localidad_id`) REFERENCES `localidad` (`id`),
 ADD CONSTRAINT `fk_pacientes_regimen` FOREIGN KEY (`id_regimen`) REFERENCES `regimen` (`id`),
 ADD CONSTRAINT `fk_pacientes_tipo_usuario` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id`);


-- Modificacion en tabla citas_control para RIPS
ALTER TABLE citas_control
 ADD COLUMN `causa_externa_id` int DEFAULT null AFTER `tipo_consulta_id`,
 ADD COLUMN `finalidad_consulta_id` int DEFAULT null AFTER `causa_externa_id`,
 ADD COLUMN `valor_consulta` decimal(10,2) DEFAULT 0 AFTER `observaciones_generales`,
 ADD COLUMN `valor_cuota_moderadora` decimal(10,2) DEFAULT 0 AFTER `valor_consulta`,
 ADD COLUMN `valor_neto_pagar` decimal(10,2) DEFAULT 0 AFTER `valor_cuota_moderadora`,
 ADD KEY `fk_citas_control_causa_externa` (`causa_externa_id`),
 ADD KEY `fk_citas_control_finalidad_consulta` (`finalidad_consulta_id`),
 ADD CONSTRAINT `fk_citas_control_causa_externa` FOREIGN KEY (`causa_externa_id`) REFERENCES `causa_externa` (`id`),
 ADD CONSTRAINT `fk_citas_control_finalidad_consulta` FOREIGN KEY (`finalidad_consulta_id`) REFERENCES `finalidad_consulta` (`id`)
 ;



SET FOREIGN_KEY_CHECKS = 1;

-- ----------------------------------------------
-- VISTA RIPS
-- -----------------------------------------------
CREATE OR REPLACE VIEW vw_rips_consultas AS
SELECT
    cc.id AS cita_id,
    YEAR(cc.fecha_cita) AS anio,
    MONTH(cc.fecha_cita) AS mes,

    -- Prestador
    ps.codigo_prestador_minsalud AS cod_prestador,
    CONCAT(
        ps.primer_nombre, ' ',
        IFNULL(ps.segundo_nombre, ''), ' ',
        ps.primer_apellido, ' ',
        IFNULL(ps.segundo_apellido, '')
    ) AS razon_social_prestador,
    'PN' AS tipo_prestador,
    ps.identificacion AS num_doc_prestador,

    -- Paciente
    ti.codigo AS tipo_doc_paciente,
    p.identificacion AS num_doc_paciente,
    CONCAT(p.primer_nombre, ' ', IFNULL(p.segundo_nombre,''), ' ', p.primer_apellido, ' ', IFNULL(p.segundo_apellido,'')) AS nombre_paciente,
    p.fecha_nacimiento,
    g.codigo AS sexo,
    d.codigo_dane AS cod_departamento_residencia,
    m.codigo_dane AS cod_municipio_residencia,
    p.zona_residencia,
    r.codigo AS regimen,
    e.codigo AS eps_codigo,

    -- Consulta
    cc.fecha_cita AS fecha_inicio_atencion,
    tc.codigo AS cod_consulta,
    fc.codigo AS finalidad_consulta,
    ce.codigo AS causa_externa,
    dx.codigo AS cie10_principal,
    'I' AS tipo_diagnostico_principal,

    -- Valores
    cc.valor_consulta,
    cc.valor_cuota_moderadora,
    cc.valor_neto_pagar

FROM citas_control cc
JOIN pacientes p ON p.id = cc.paciente_id
JOIN profesionales_salud ps ON ps.id = cc.profesional_id
JOIN tipos_identificacion ti ON ti.id = p.tipo_identificacion_id
JOIN generos g ON g.id = p.genero_id
LEFT JOIN eps e ON e.id = p.eps_id
LEFT JOIN regimen r ON r.id = p.id_regimen
LEFT JOIN municipio m ON m.id = p.municipio_id
LEFT JOIN departamento d ON d.id = p.departamento_id
JOIN tipos_consulta tc ON tc.id = cc.tipo_consulta_id
JOIN diagnosticos_cie10 dx ON dx.id = cc.cie10_id
LEFT JOIN causa_externa ce ON ce.id = cc.causa_externa_id
LEFT JOIN finalidad_consulta fc ON fc.id = cc.finalidad_consulta_id
JOIN estados_cita EC ON  EC.id = cc.estado_cita_id 
WHERE EC.mostrar_en_hc = TRUE;
-- -----------------------------------------------
-- FIN VISTA RIPS
-- -----------------------------------------------


--