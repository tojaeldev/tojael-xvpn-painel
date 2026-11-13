-- Executar uma vez no banco de dados atual do painel.
CREATE TABLE IF NOT EXISTS `dns_configs` (
 `id` int(11) NOT NULL AUTO_INCREMENT, `id_owner` int(11) NOT NULL,
 `Remarks` varchar(150) NOT NULL, `DNSAddress` varchar(255) NOT NULL,
 `Nameserver` varchar(255) NOT NULL, `PublicKey` text,
 `Username` varchar(150) DEFAULT NULL, `Password` text,
 PRIMARY KEY (`id`), KEY `idx_dns_owner` (`id_owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
