<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $query = <<<EOF
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT '权限表自增ID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限名称',
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限分组',
  `pid` int NOT NULL DEFAULT '0' COMMENT '父ID',
  `level` int NOT NULL DEFAULT '0' COMMENT '菜单等级',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_menus` tinyint(1) DEFAULT NULL COMMENT '是否是菜单',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '路径',
  `show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否隐藏 1=隐藏 0=显示',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` VALUES (1, '主页', 'web', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (2, '控制台', 'web', 1, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (3, '权限', 'web', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (4, '权限管理', 'web', 3, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (5, '角色管理', 'web', 3, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (6, '用户管理', 'web', 3, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (7, '管理员管理', 'web', 3, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (8, '主页', 'merchant', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (9, '控制台', 'merchant', 8, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (10, '权限', 'merchant', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (11, '权限管理', 'merchant', 10, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (12, '角色管理', 'merchant', 10, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (13, '用户管理', 'merchant', 10, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (14, '管理员管理', 'merchant', 10, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (15, '主页', 'store', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (16, '控制台', 'store', 16, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (17, '权限', 'store', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (18, '权限管理', 'store', 17, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (19, '角色管理', 'store', 17, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (20, '用户管理', 'store', 17, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (21, '管理员管理', 'store', 17, 0, NULL, NULL, 1, NULL, 1);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
EOF;

        DB::select($query);
    }
}
