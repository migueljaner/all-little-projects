/*
Navicat MySQL Data Transfer

Source Server         : 192.168.0.33
Source Server Version : 50505
Source Host           : 192.168.0.33:3306
Source Database       : captive_portal

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-03-27 17:31:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for clientele
-- ----------------------------
DROP TABLE IF EXISTS `clientele`;
CREATE TABLE `clientele` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_is_useds` tinyint(1) NOT NULL DEFAULT '0',
  `nationality` int(10) unsigned NOT NULL,
  `birthdate` datetime NOT NULL,
  `is_minor` tinyint(1) NOT NULL DEFAULT '0',
  `gender_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientele_nationality_foreign` (`nationality`),
  KEY `clientele_gender_id_foreign` (`gender_id`),
  CONSTRAINT `clientele_gender_id_foreign` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`),
  CONSTRAINT `clientele_nationality_foreign` FOREIGN KEY (`nationality`) REFERENCES `countries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of clientele
-- ----------------------------

-- ----------------------------
-- Table structure for clientele_devices
-- ----------------------------
DROP TABLE IF EXISTS `clientele_devices`;
CREATE TABLE `clientele_devices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hostname` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mac` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operation_system` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maker` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_proprietor` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientele_devices_last_proprietor_foreign` (`last_proprietor`),
  CONSTRAINT `clientele_devices_last_proprietor_foreign` FOREIGN KEY (`last_proprietor`) REFERENCES `clientele` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of clientele_devices
-- ----------------------------

-- ----------------------------
-- Table structure for clientele_visit_establishments
-- ----------------------------
DROP TABLE IF EXISTS `clientele_visit_establishments`;
CREATE TABLE `clientele_visit_establishments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `establishment_id` int(10) unsigned NOT NULL,
  `clientele_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientele_visit_establishments_establishment_id_foreign` (`establishment_id`),
  KEY `clientele_visit_establishments_clientele_id_foreign` (`clientele_id`),
  CONSTRAINT `clientele_visit_establishments_clientele_id_foreign` FOREIGN KEY (`clientele_id`) REFERENCES `clientele` (`id`),
  CONSTRAINT `clientele_visit_establishments_establishment_id_foreign` FOREIGN KEY (`establishment_id`) REFERENCES `establishments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of clientele_visit_establishments
-- ----------------------------

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pms_id` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cif` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(10) unsigned NOT NULL,
  `crm_integration_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_region_id_foreign` (`region_id`),
  KEY `clients_crm_integration_id_foreign` (`crm_integration_id`),
  CONSTRAINT `clients_crm_integration_id_foreign` FOREIGN KEY (`crm_integration_id`) REFERENCES `crm_integrations` (`id`),
  CONSTRAINT `clients_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES ('1', '1', 'Client Test', 'A12345678', 'C/ Falsa, 123', '07006', '1', '1', '2019-02-25 23:47:40', null);

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', 'es', '2019-02-25 23:47:26', null);
INSERT INTO `countries` VALUES ('2', 'usa', '2019-02-25 23:47:26', null);

-- ----------------------------
-- Table structure for crm_integrations
-- ----------------------------
DROP TABLE IF EXISTS `crm_integrations`;
CREATE TABLE `crm_integrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of crm_integrations
-- ----------------------------
INSERT INTO `crm_integrations` VALUES ('1', 'vtiger', '2019-02-25 23:47:27', null);

-- ----------------------------
-- Table structure for establishment_categories
-- ----------------------------
DROP TABLE IF EXISTS `establishment_categories`;
CREATE TABLE `establishment_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of establishment_categories
-- ----------------------------
INSERT INTO `establishment_categories` VALUES ('1', 'hotel', '2019-02-25 23:47:26', null);

-- ----------------------------
-- Table structure for establishments
-- ----------------------------
DROP TABLE IF EXISTS `establishments`;
CREATE TABLE `establishments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `categori_id` int(10) unsigned NOT NULL,
  `type_quality_id` int(10) unsigned NOT NULL,
  `quality` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(10) unsigned NOT NULL,
  `average_stay` char(6) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `establishments_client_id_foreign` (`client_id`),
  KEY `establishments_categori_id_foreign` (`categori_id`),
  KEY `establishments_type_quality_id_foreign` (`type_quality_id`),
  KEY `establishments_region_id_foreign` (`region_id`),
  CONSTRAINT `establishments_categori_id_foreign` FOREIGN KEY (`categori_id`) REFERENCES `establishment_categories` (`id`),
  CONSTRAINT `establishments_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `establishments_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  CONSTRAINT `establishments_type_quality_id_foreign` FOREIGN KEY (`type_quality_id`) REFERENCES `quality_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of establishments
-- ----------------------------
INSERT INTO `establishments` VALUES ('1', 'e2b11b93-e26f-4b96-afbd-00e228e8a1c1', 'Establishment Test', 'C/ Falsa, 123', '07006', '1', '1', '1', '5', '1', '2', '2019-02-25 23:47:40', null);

-- ----------------------------
-- Table structure for genders
-- ----------------------------
DROP TABLE IF EXISTS `genders`;
CREATE TABLE `genders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of genders
-- ----------------------------
INSERT INTO `genders` VALUES ('1', 'man', '2019-02-25 23:47:26', null);
INSERT INTO `genders` VALUES ('2', 'woman', '2019-02-25 23:47:26', null);

-- ----------------------------
-- Table structure for languages
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of languages
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_01_26_170003_create_establishment_categories_table', '1');
INSERT INTO `migrations` VALUES ('4', '2019_01_26_170033_create_quality_types_table', '1');
INSERT INTO `migrations` VALUES ('5', '2019_01_26_170101_create_genders_table', '1');
INSERT INTO `migrations` VALUES ('6', '2019_01_26_170139_create_countries_table', '1');
INSERT INTO `migrations` VALUES ('7', '2019_01_26_170230_create_languages_table', '1');
INSERT INTO `migrations` VALUES ('8', '2019_01_26_171525_create_provinces_table', '1');
INSERT INTO `migrations` VALUES ('9', '2019_01_26_171552_create_regions_table', '1');
INSERT INTO `migrations` VALUES ('10', '2019_01_26_172312_create_crm_integrations_table', '1');
INSERT INTO `migrations` VALUES ('11', '2019_01_26_172313_create_clients_table', '1');
INSERT INTO `migrations` VALUES ('12', '2019_01_26_172459_create_profiles_table', '1');
INSERT INTO `migrations` VALUES ('13', '2019_01_26_173737_modify_users_table', '1');
INSERT INTO `migrations` VALUES ('14', '2019_01_26_181229_create_clientele_table', '1');
INSERT INTO `migrations` VALUES ('15', '2019_01_26_181913_create_clientele_devices_table', '1');
INSERT INTO `migrations` VALUES ('16', '2019_01_26_182915_create_establishments_table', '1');
INSERT INTO `migrations` VALUES ('17', '2019_01_26_183022_create_relationship_clientele_establishment_table', '1');
INSERT INTO `migrations` VALUES ('18', '2019_01_26_184422_create_clientele_visit_establishments_table', '1');
INSERT INTO `migrations` VALUES ('19', '2019_01_26_185500_create_relationship_clientele_devices_table', '1');
INSERT INTO `migrations` VALUES ('20', '2019_01_26_185501_add_country_to_countries', '1');
INSERT INTO `migrations` VALUES ('21', '2019_01_26_185502_add_province_to_provinces', '1');
INSERT INTO `migrations` VALUES ('22', '2019_01_26_185503_add_region_to_regions', '1');
INSERT INTO `migrations` VALUES ('23', '2019_02_03_115138_add_gender_to_genders_table', '1');
INSERT INTO `migrations` VALUES ('24', '2019_02_03_115427_add_establishment_category_to_establishment_categories_table', '1');
INSERT INTO `migrations` VALUES ('25', '2019_02_03_115739_add_quality_type_to_quality_types_table', '1');
INSERT INTO `migrations` VALUES ('26', '2019_02_17_132441_create_services_table', '1');
INSERT INTO `migrations` VALUES ('27', '2019_02_17_132609_create_services_enabled_clients_table', '1');
INSERT INTO `migrations` VALUES ('28', '2019_02_17_133126_create_services_enabled_establishments_table', '1');
INSERT INTO `migrations` VALUES ('29', '2019_02_23_175406_add_crm_integrations_to_crm_integrations', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for profiles
-- ----------------------------
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(10) unsigned NOT NULL,
  `phone` char(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_region_id_foreign` (`region_id`),
  KEY `profiles_client_id_foreign` (`client_id`),
  CONSTRAINT `profiles_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `profiles_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of profiles
-- ----------------------------

-- ----------------------------
-- Table structure for provinces
-- ----------------------------
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `provinces_country_id_foreign` (`country_id`),
  CONSTRAINT `provinces_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of provinces
-- ----------------------------
INSERT INTO `provinces` VALUES ('1', 'baleares', '1', '2019-02-25 23:47:26', null);
INSERT INTO `provinces` VALUES ('2', 'madrid', '1', '2019-02-25 23:47:26', null);

-- ----------------------------
-- Table structure for quality_types
-- ----------------------------
DROP TABLE IF EXISTS `quality_types`;
CREATE TABLE `quality_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of quality_types
-- ----------------------------
INSERT INTO `quality_types` VALUES ('1', 'star', '2019-02-25 23:47:26', null);

-- ----------------------------
-- Table structure for regions
-- ----------------------------
DROP TABLE IF EXISTS `regions`;
CREATE TABLE `regions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `regions_province_id_foreign` (`province_id`),
  CONSTRAINT `regions_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of regions
-- ----------------------------
INSERT INTO `regions` VALUES ('1', 'palma', '1', '2019-02-25 23:47:26', null);
INSERT INTO `regions` VALUES ('2', 'ibiza', '1', '2019-02-25 23:47:26', null);

-- ----------------------------
-- Table structure for relationship_clientele_devices
-- ----------------------------
DROP TABLE IF EXISTS `relationship_clientele_devices`;
CREATE TABLE `relationship_clientele_devices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `device_id` int(10) unsigned NOT NULL,
  `clientele_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `relationship_clientele_devices_device_id_foreign` (`device_id`),
  KEY `relationship_clientele_devices_clientele_id_foreign` (`clientele_id`),
  CONSTRAINT `relationship_clientele_devices_clientele_id_foreign` FOREIGN KEY (`clientele_id`) REFERENCES `clientele` (`id`),
  CONSTRAINT `relationship_clientele_devices_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `clientele_devices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of relationship_clientele_devices
-- ----------------------------

-- ----------------------------
-- Table structure for relationship_clientele_establishment
-- ----------------------------
DROP TABLE IF EXISTS `relationship_clientele_establishment`;
CREATE TABLE `relationship_clientele_establishment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `establishment_id` int(10) unsigned NOT NULL,
  `clientele_id` int(10) unsigned NOT NULL,
  `delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `relationship_clientele_establishment_establishment_id_foreign` (`establishment_id`),
  KEY `relationship_clientele_establishment_clientele_id_foreign` (`clientele_id`),
  CONSTRAINT `relationship_clientele_establishment_clientele_id_foreign` FOREIGN KEY (`clientele_id`) REFERENCES `clientele` (`id`),
  CONSTRAINT `relationship_clientele_establishment_establishment_id_foreign` FOREIGN KEY (`establishment_id`) REFERENCES `establishments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of relationship_clientele_establishment
-- ----------------------------

-- ----------------------------
-- Table structure for services
-- ----------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of services
-- ----------------------------

-- ----------------------------
-- Table structure for services_enabled_clients
-- ----------------------------
DROP TABLE IF EXISTS `services_enabled_clients`;
CREATE TABLE `services_enabled_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_enabled_clients_client_id_foreign` (`client_id`),
  KEY `services_enabled_clients_service_id_foreign` (`service_id`),
  CONSTRAINT `services_enabled_clients_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `services_enabled_clients_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of services_enabled_clients
-- ----------------------------

-- ----------------------------
-- Table structure for services_enabled_establishments
-- ----------------------------
DROP TABLE IF EXISTS `services_enabled_establishments`;
CREATE TABLE `services_enabled_establishments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `establishment_id` int(10) unsigned NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_enabled_establishments_establishment_id_foreign` (`establishment_id`),
  KEY `services_enabled_establishments_service_id_foreign` (`service_id`),
  CONSTRAINT `services_enabled_establishments_establishment_id_foreign` FOREIGN KEY (`establishment_id`) REFERENCES `establishments` (`id`),
  CONSTRAINT `services_enabled_establishments_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of services_enabled_establishments
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_id` int(10) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_profile_id_foreign` (`profile_id`),
  CONSTRAINT `users_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
