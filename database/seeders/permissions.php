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
INSERT INTO `permissions` VALUES (2, '控制台', 'web', 1, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (3, '权限', 'web', 0, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (4, '权限管理', 'web', 3, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (5, '角色管理', 'web', 3, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (6, '管理员管理', 'web', 3, 0, NULL, NULL, 1, NULL, 1);
INSERT INTO `permissions` VALUES (7, '设置', 'web', 0, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (8, '系统设置', 'web', 7, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (9, '我的设置', 'web', 7, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (10, '用户', 'web', 0, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (11, '商户管理', 'web', 10, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (12, '店铺管理', 'web', 10, 0, NULL, NULL, 1, NULL, 0);
INSERT INTO `permissions` VALUES (13, '用户管理', 'web', 10, 0, NULL, NULL, 1, NULL, 1);

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

SET FOREIGN_KEY_CHECKS = 1;
EOF;

        DB::select($query);
    }
}
