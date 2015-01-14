DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
    `name` varchar(64) NOT NULL,
    `address` varchar(255), 
    `tel` char(16), 
    `qq` char(16), 
    `business` text, 
    `status` tinyint(1) NOT NULL DEFAULT '1', 
    `created_at` datetime NOT NULL,
    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='bank table';
