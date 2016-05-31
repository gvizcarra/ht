#
# Table structure for table `mi_modulo`
#

CREATE TABLE mi_modulo (
  m_id int(8) unsigned NOT NULL auto_increment,
  m_valor varchar(255) NOT NULL default '',
  PRIMARY KEY  (m_id)
) ENGINE=MyISAM;

INSERT INTO mi_modulo VALUES (1,'Inserción de ejemplo');
