/*
 Navicat Premium Data Transfer

 Source Server         : mysql@localhost
 Source Server Type    : MySQL
 Source Server Version : 80023
 Source Host           : localhost:3306
 Source Schema         : wjlaravel

 Target Server Type    : MySQL
 Target Server Version : 80023
 File Encoding         : 65001

 Date: 06/05/2021 23:19:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `role` int DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
BEGIN;
INSERT INTO `admins` VALUES (1, 'admin', NULL, 'admin@admin', NULL, '$2y$10$dJKIHKhwoLWZGVPhJiXbxuNVXH84daNFj9vNvioyBAtr/C0P4sAYq', NULL, NULL, NULL, '2021-05-02 10:55:02', '2021-05-02 10:55:02');
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for merchants
-- ----------------------------
DROP TABLE IF EXISTS `merchants`;
CREATE TABLE `merchants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `role` int DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `merchants_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of merchants
-- ----------------------------
BEGIN;
INSERT INTO `merchants` VALUES (1, 'admin', NULL, 'admin@admin', NULL, '$2y$10$dJKIHKhwoLWZGVPhJiXbxuNVXH84daNFj9vNvioyBAtr/C0P4sAYq', NULL, NULL, NULL, '2021-05-02 10:55:02', '2021-05-02 10:55:02');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2021_05_04_094501_create_permission_tables', 2);
INSERT INTO `migrations` VALUES (5, '2021_05_05_151221_create_admins_table', 3);
INSERT INTO `migrations` VALUES (6, '2021_05_05_151235_create_merchants_table', 3);
INSERT INTO `migrations` VALUES (7, '2021_05_05_151247_create_stores_table', 3);
COMMIT;

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
BEGIN;
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT '权限表自增ID',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限名称',
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限分组',
  `pid` int NOT NULL DEFAULT '0' COMMENT '父ID',
  `level` int NOT NULL DEFAULT '0' COMMENT '菜单等级',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_menus` tinyint(1) DEFAULT NULL COMMENT '是否是菜单',
  `route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '路径',
  `show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否隐藏 1=隐藏 0=显示',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` VALUES (1, '主页', 'web', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (2, '控制台', 'web', 1, 0, NULL, NULL, 1, 'home.console', 1);
INSERT INTO `permissions` VALUES (3, '权限', 'web', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (4, '权限管理', 'web', 3, 0, NULL, NULL, 1, 'admin.permission.permission.list', 1);
INSERT INTO `permissions` VALUES (5, '角色管理', 'web', 3, 0, NULL, NULL, 1, 'admin.permission.role.list', 1);
INSERT INTO `permissions` VALUES (6, '管理员管理', 'web', 3, 0, NULL, NULL, 1, 'admin.permission.member.list', 1);
INSERT INTO `permissions` VALUES (7, '设置', 'web', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (8, '系统设置', 'web', 7, 0, NULL, NULL, 1, 'admin.set.system.website', 1);
INSERT INTO `permissions` VALUES (9, '我的设置', 'web', 7, 0, NULL, NULL, 1, 'admin.set.system.website', 1);
INSERT INTO `permissions` VALUES (10, '用户', 'web', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (11, '商户管理', 'web', 10, 0, NULL, NULL, 1, 'admin.user.merchant.list', 1);
INSERT INTO `permissions` VALUES (12, '店铺管理', 'web', 10, 0, NULL, NULL, 1, 'admin.user.store.list', 1);
INSERT INTO `permissions` VALUES (13, '用户管理', 'web', 10, 0, NULL, NULL, 1, 'admin.user.user.list', 1);
INSERT INTO `permissions` VALUES (14, '主页', 'merchant', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (15, '控制台', 'merchant', 14, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (16, '权限', 'merchant', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (17, '权限管理', 'merchant', 16, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (18, '角色管理', 'merchant', 16, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (19, '管理员管理', 'merchant', 16, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (20, '设置', 'merchant', 0, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (21, '系统设置', 'merchant', 20, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (22, '我的设置', 'merchant', 20, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (23, '用户', 'merchant', 0, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (24, '店铺管理', 'merchant', 23, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (25, '用户管理', 'merchant', 23, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (26, '主页', 'store', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (27, '控制台', 'store', 26, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (28, '权限', 'store', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (29, '权限管理', 'store', 28, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (30, '角色管理', 'store', 28, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (31, '管理员管理', 'store', 28, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (32, '设置', 'store', 0, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (33, '系统设置', 'store', 32, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (34, '我的设置', 'store', 32, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (35, '用户', 'store', 0, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (36, '店铺管理', 'store', 35, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (37, '用户管理', 'store', 35, 0, NULL, NULL, 1, NULL, 1);
COMMIT;

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
BEGIN;
INSERT INTO `role_has_permissions` VALUES (1, 1);
INSERT INTO `role_has_permissions` VALUES (2, 1);
INSERT INTO `role_has_permissions` VALUES (3, 1);
INSERT INTO `role_has_permissions` VALUES (4, 1);
INSERT INTO `role_has_permissions` VALUES (5, 1);
INSERT INTO `role_has_permissions` VALUES (6, 1);
INSERT INTO `role_has_permissions` VALUES (7, 1);
INSERT INTO `role_has_permissions` VALUES (8, 1);
INSERT INTO `role_has_permissions` VALUES (9, 1);
INSERT INTO `role_has_permissions` VALUES (10, 1);
INSERT INTO `role_has_permissions` VALUES (11, 1);
INSERT INTO `role_has_permissions` VALUES (12, 1);
INSERT INTO `role_has_permissions` VALUES (13, 1);
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'superAdmin', 'web', '2021-05-05 22:21:03', '2021-05-05 22:21:03');
COMMIT;

-- ----------------------------
-- Table structure for stores
-- ----------------------------
DROP TABLE IF EXISTS `stores`;
CREATE TABLE `stores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stores_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of stores
-- ----------------------------
BEGIN;
INSERT INTO `stores` VALUES (1, 'admin', NULL, 'admin@admin', NULL, '$2y$10$dJKIHKhwoLWZGVPhJiXbxuNVXH84daNFj9vNvioyBAtr/C0P4sAYq', NULL, NULL, NULL, '2021-05-02 10:55:02', '2021-05-02 10:55:02');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'admin', 'admin@admin', NULL, '$2y$10$dJKIHKhwoLWZGVPhJiXbxuNVXH84daNFj9vNvioyBAtr/C0P4sAYq', NULL, '2021-05-02 10:55:02', '2021-05-02 10:55:02');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
