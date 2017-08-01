-- phpMyAdmin SQL Dump
-- version 4.4.15.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2016 at 06:48 AM
-- Server version: 5.5.47-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `value`) VALUES
(1, '2586dccc9e8a6740f1ccd5eeed18f211');

-- --------------------------------------------------------

--
-- Table structure for table `attach`
--

CREATE TABLE IF NOT EXISTS `attach` (
  `aid` tinyint(4) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suffix` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createtime` datetime NOT NULL,
  `del` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attach`
--

INSERT INTO `attach` (`aid`, `title`, `suffix`, `url`, `createtime`, `del`) VALUES
(0, 'nopic', '.jpg', '/Public/images/no_avatar.jpg', '2016-03-17 00:00:00', 0),
(1, 'test', '.png', '/Public/images/nopic.jpg', '2016-03-17 00:00:00', 0),
(21, '26_2016-04-12_16:27:31.jpg', '.jpg', '/Public/resorce/avatar/26_2016-04-12_16:27:31.jpg', '2016-04-12 16:27:31', 0),
(22, 'gt5z5RZVnCBa7s5XHbOaw8AignZgOBZAedeQNcuaC33qKpZe8SDajo7G1YT9n2XB2016-04-12_16:29:48.jpg', '.jpg', '/Public/resorce/goods_img/gt5z5RZVnCBa7s5XHbOaw8AignZgOBZAedeQNcuaC33qKpZe8SDajo7G1YT9n2XB2016-04-12_16:29:48.jpg', '2016-04-12 16:29:48', 0),
(23, 'HL5w8vfLIUIg7VLtVx05vwp7WN_m_oBtKob-JIu2nANynr-3uRJc3LjbKdcMO7C72016-04-12_16:29:48.jpg', '.jpg', '/Public/resorce/goods_img/HL5w8vfLIUIg7VLtVx05vwp7WN_m_oBtKob-JIu2nANynr-3uRJc3LjbKdcMO7C72016-04-12_16:29:48.jpg', '2016-04-12 16:29:48', 0),
(24, 'WwIVP8r823AuVLgGItAtfLGtnbE1qX7qtXGn0cIiHU68CmkTwRTQF654Elni0hWu2016-04-12_16:31:48.jpg', '.jpg', '/Public/resorce/goods_img/WwIVP8r823AuVLgGItAtfLGtnbE1qX7qtXGn0cIiHU68CmkTwRTQF654Elni0hWu2016-04-12_16:31:48.jpg', '2016-04-12 16:31:48', 0),
(25, '9bayzsOJ5bFwfh5CgFexvjheEoMXPmpICUyCuhkdWVeNXHVEnkvqPQaNGprGRu0D2016-04-12_16:31:48.jpg', '.jpg', '/Public/resorce/goods_img/9bayzsOJ5bFwfh5CgFexvjheEoMXPmpICUyCuhkdWVeNXHVEnkvqPQaNGprGRu0D2016-04-12_16:31:48.jpg', '2016-04-12 16:31:48', 0),
(26, '27_2016-04-12_16:35:14.jpg', '.jpg', '/Public/resorce/avatar/27_2016-04-12_16:35:14.jpg', '2016-04-12 16:35:14', 0),
(27, 'CRsV8wPENGWlrTyLLk_pFedd8p7o3mLTdE4hZCmO1fKy5GdOpMGINLctOlozBrlr2016-04-13_13:58:16.mp3', '.mp3', '/Public/resorce/audio/CRsV8wPENGWlrTyLLk_pFedd8p7o3mLTdE4hZCmO1fKy5GdOpMGINLctOlozBrlr2016-04-13_13:58:15.mp3', '2016-04-13 13:58:16', 0),
(28, 'laYg5BclJ3Z0g8AdhEdJYR9-5IY_2y5unNBklcC4YYOIOeQbptdWr3WYDzFtrn4g2016-04-18_20_17_15.jpg', '.jpg', '/Public/resorce/goods_img/laYg5BclJ3Z0g8AdhEdJYR9-5IY_2y5unNBklcC4YYOIOeQbptdWr3WYDzFtrn4g2016-04-18_20_17_15.jpg', '2016-04-18 20:17:15', 0),
(29, 'doLEU0Y6PhOaBhZoMA8Bwz4U1ds2ViZTC_6Nl50d9hE6BFkCk20GBsz-H2TGnSWy2016-04-21_18_41_58.jpg', '.jpg', '/Public/resorce/goods_img/doLEU0Y6PhOaBhZoMA8Bwz4U1ds2ViZTC_6Nl50d9hE6BFkCk20GBsz-H2TGnSWy2016-04-21_18_41_58.jpg', '2016-04-21 18:41:58', 0),
(30, '6euxS3ucINfdg9-7jNgJvuLMNvfFTCQfeYLYd7Q0wJDk0cPPqOvgTBmNcZ01KnlH2016-04-25_15_37_02.jpg', '.jpg', '/Public/resorce/goods_img/6euxS3ucINfdg9-7jNgJvuLMNvfFTCQfeYLYd7Q0wJDk0cPPqOvgTBmNcZ01KnlH2016-04-25_15_37_02.jpg', '2016-04-25 15:37:02', 0),
(31, '9Ta5BwbI3qnZgzHyObozVWU8Ew3qcpADVuCC2Niyw5QY5xzQG3zvOjqSXrOkKjjS2016-04-25_15_38_06.jpg', '.jpg', '/Public/resorce/goods_img/9Ta5BwbI3qnZgzHyObozVWU8Ew3qcpADVuCC2Niyw5QY5xzQG3zvOjqSXrOkKjjS2016-04-25_15_38_06.jpg', '2016-04-25 15:38:06', 0),
(32, 'D-Gp7b7elmB09cnZeqDjgC83y6g8n89nSmUMZDtqRJrjVFW6joQ_HJa75lhrwr1C2016-04-25_15_42_05.jpg', '.jpg', '/Public/resorce/goods_img/D-Gp7b7elmB09cnZeqDjgC83y6g8n89nSmUMZDtqRJrjVFW6joQ_HJa75lhrwr1C2016-04-25_15_42_05.jpg', '2016-04-25 15:42:05', 0),
(33, '3BYJ_QhgmzizLmRgLdTmIjXsmYP4DUluhpAR8rAk7IzVn2qYdTFZDQcmrY8XDqnZ2016-04-25_15_45_52.jpg', '.jpg', '/Public/resorce/goods_img/3BYJ_QhgmzizLmRgLdTmIjXsmYP4DUluhpAR8rAk7IzVn2qYdTFZDQcmrY8XDqnZ2016-04-25_15_45_52.jpg', '2016-04-25 15:45:52', 0),
(34, '28_2016-05-16_13:43:36.jpg', '.jpg', '/Public/resorce/avatar/28_2016-05-16_13:43:36.jpg', '2016-05-16 13:43:36', 0),
(35, 'wn9QNU5JrMuO_JCqfiIncje8w1waBfxPs8PlJJ9_gstvGlQVDpSw1_6z6GH4jkY22016-05-16_14_00_07.mp3', '.mp3', '/Public/resorce/audio/wn9QNU5JrMuO_JCqfiIncje8w1waBfxPs8PlJJ9_gstvGlQVDpSw1_6z6GH4jkY22016-05-16_14_00_05.mp3', '2016-05-16 14:00:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dict_city`
--

CREATE TABLE IF NOT EXISTS `dict_city` (
  `cityid` int(10) unsigned NOT NULL DEFAULT '0',
  `cityname` varchar(30) NOT NULL,
  `provid` int(10) unsigned NOT NULL,
  `state` varchar(1) DEFAULT NULL COMMENT '0 - 禁用rn1 - 启用 rn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dict_city`
--

INSERT INTO `dict_city` (`cityid`, `cityname`, `provid`, `state`) VALUES
(1000, '东城区', 10, '1'),
(1001, '西城区', 10, '1'),
(1002, '崇文区', 10, '1'),
(1003, '宣武区', 10, '1'),
(1004, '朝阳区 ', 10, '1'),
(1005, '丰台区', 10, '1'),
(1006, '石景山区', 10, '1'),
(1007, '海淀区', 10, '1'),
(1008, '门头沟区', 10, '1'),
(1009, '房山区', 10, '1'),
(1010, '通州区', 10, '1'),
(1011, '顺义区 ', 10, '1'),
(1012, '昌平区', 10, '1'),
(1013, '大兴区', 10, '1'),
(1014, '怀柔区', 10, '1'),
(1015, '平谷区', 10, '1'),
(1016, '密云县', 10, '1'),
(1017, '延庆县', 10, '1'),
(1018, '黄浦区 ', 11, '1'),
(1019, '卢湾区', 11, '1'),
(1020, '徐汇区', 11, '1'),
(1021, '长宁区', 11, '1'),
(1022, '静安区', 11, '1'),
(1023, '普陀区', 11, '1'),
(1024, '闸北区', 11, '1'),
(1025, '虹口区 ', 11, '1'),
(1026, '杨浦区', 11, '1'),
(1027, '闵行区', 11, '1'),
(1028, '宝山区', 11, '1'),
(1029, '嘉定区', 11, '1'),
(1030, '浦东新区', 11, '1'),
(1031, '金山区', 11, '1'),
(1032, '松江区 ', 11, '1'),
(1033, '青浦区', 11, '1'),
(1034, '南汇区', 11, '1'),
(1035, '奉贤区', 11, '1'),
(1036, '崇明县', 11, '1'),
(1037, '和平区', 12, '1'),
(1038, '河东区', 12, '1'),
(1039, '河西区 ', 12, '1'),
(1040, '南开区', 12, '1'),
(1041, '河北区', 12, '1'),
(1042, '红桥区', 12, '1'),
(1043, '塘沽区', 12, '1'),
(1044, '汉沽区', 12, '1'),
(1045, '大港区', 12, '1'),
(1046, '东丽区 ', 12, '1'),
(1047, '西青区', 12, '1'),
(1048, '津南区', 12, '1'),
(1049, '北辰区', 12, '1'),
(1050, '武清区', 12, '1'),
(1051, '宝坻区', 12, '1'),
(1052, '宁河县', 12, '1'),
(1053, '静海县 ', 12, '1'),
(1054, '蓟县', 12, '1'),
(1055, '万州区', 13, '1'),
(1056, '涪陵区', 13, '1'),
(1057, '渝中区', 13, '1'),
(1058, '大渡口区', 13, '1'),
(1059, '江北区', 13, '1'),
(1060, '沙坪坝区 ', 13, '1'),
(1061, '九龙坡区', 13, '1'),
(1062, '南岸区', 13, '1'),
(1063, '北碚区', 13, '1'),
(1064, '万盛区', 13, '1'),
(1065, '双桥区', 13, '1'),
(1066, '渝北区', 13, '1'),
(1067, '巴南区 ', 13, '1'),
(1068, '黔江区', 13, '1'),
(1069, '长寿区', 13, '1'),
(1070, '綦江县', 13, '1'),
(1071, '潼南县', 13, '1'),
(1072, '铜梁县', 13, '1'),
(1073, '大足县', 13, '1'),
(1074, '荣昌县 ', 13, '1'),
(1075, '璧山县', 13, '1'),
(1076, '梁平县', 13, '1'),
(1077, '城口县', 13, '1'),
(1078, '丰都县', 13, '1'),
(1079, '垫江县', 13, '1'),
(1080, '武隆县', 13, '1'),
(1081, '忠县 ', 13, '1'),
(1082, '开县', 13, '1'),
(1083, '云阳县', 13, '1'),
(1084, '奉节县', 13, '1'),
(1085, '巫山县', 13, '1'),
(1086, '巫溪县', 13, '1'),
(1087, '石柱土家族自治县', 13, '1'),
(1088, ' 秀山土家族苗族自治县', 13, '1'),
(1089, '酉阳土家族苗族自治县', 13, '1'),
(1090, '彭水苗族土家族自治县 ', 13, '1'),
(1091, '江津市', 13, '1'),
(1092, '合川市', 13, '1'),
(1093, '永川市', 13, '1'),
(1094, '南川市', 13, '1'),
(1095, '石家庄市', 14, '1'),
(1096, '唐山市', 14, '1'),
(1097, '秦皇岛市', 14, '1'),
(1098, '邯郸市', 14, '1'),
(1099, '邢台市', 14, '1'),
(1100, '保定市', 14, '1'),
(1101, '张家口市', 14, '1'),
(1102, '承德市', 14, '1'),
(1103, '沧州市', 14, '1'),
(1104, '廊坊市', 14, '1'),
(1105, '衡水市', 14, '1'),
(1106, '太原市', 15, '1'),
(1107, '大同市', 15, '1'),
(1108, '阳泉市', 15, '1'),
(1109, '长治市', 15, '1'),
(1110, '晋城市', 15, '1'),
(1111, '朔州市', 15, '1'),
(1112, '晋中市', 15, '1'),
(1113, '运城市', 15, '1'),
(1114, '忻州市', 15, '1'),
(1115, '临汾市', 15, '1'),
(1116, '吕梁市', 15, '1'),
(1117, '呼和浩特市', 16, '1'),
(1118, '包头市', 16, '1'),
(1119, '乌海市', 16, '1'),
(1120, '赤峰市', 16, '1'),
(1121, '通辽市', 16, '1'),
(1122, '鄂尔多斯市', 16, '1'),
(1123, '呼伦贝尔市', 16, '1'),
(1124, '乌兰察布市', 16, '1'),
(1125, '锡林郭勒盟市', 16, '1'),
(1126, '巴彦淖尔市', 16, '1'),
(1127, '阿拉善盟市', 16, '1'),
(1128, '兴安盟市', 16, '1'),
(1129, '沈阳市', 17, '1'),
(1130, '大连市', 17, '1'),
(1131, '鞍山市', 17, '1'),
(1132, '抚顺市', 17, '1'),
(1133, '本溪市', 17, '1'),
(1134, '丹东市', 17, '1'),
(1135, '锦州市', 17, '1'),
(1136, '葫芦岛市', 17, '1'),
(1137, '营口市', 17, '1'),
(1138, '盘锦市', 17, '1'),
(1139, '阜新市', 17, '1'),
(1140, '辽阳市', 17, '1'),
(1141, '铁岭市', 17, '1'),
(1142, '朝阳市', 17, '1'),
(1143, '长春市', 18, '1'),
(1144, '吉林市', 18, '1'),
(1145, '四平市', 18, '1'),
(1146, '辽源市', 18, '1'),
(1147, '通化市', 18, '1'),
(1148, '白山市', 18, '1'),
(1149, '松原市', 18, '1'),
(1150, '白城市', 18, '1'),
(1151, '延边朝鲜市', 18, '1'),
(1152, '哈尔滨市', 19, '1'),
(1153, '齐齐哈尔市', 19, '1'),
(1154, '鹤岗市', 19, '1'),
(1155, '双鸭山市', 19, '1'),
(1156, '鸡西市', 19, '1'),
(1157, '大庆市', 19, '1'),
(1158, '伊春市', 19, '1'),
(1159, '牡丹江市', 19, '1'),
(1160, '佳木斯市', 19, '1'),
(1161, '七台河市', 19, '1'),
(1162, '黑河市', 19, '1'),
(1163, '绥化市', 19, '1'),
(1164, '大兴安岭市', 19, '1'),
(1165, '南京市', 20, '1'),
(1166, '无锡市', 20, '1'),
(1167, '徐州市', 20, '1'),
(1168, '常州市', 20, '1'),
(1169, '苏州市', 20, '1'),
(1170, '南通市', 20, '1'),
(1171, '连云港市', 20, '1'),
(1172, '淮安市', 20, '1'),
(1173, '盐城市', 20, '1'),
(1174, '扬州市', 20, '1'),
(1175, '镇江市', 20, '1'),
(1176, '泰州市', 20, '1'),
(1177, '宿迁市', 20, '1'),
(1178, '杭州市', 21, '1'),
(1179, '宁波市', 21, '1'),
(1180, '温州市', 21, '1'),
(1181, '嘉兴市', 21, '1'),
(1182, '湖州市', 21, '1'),
(1183, '绍兴市', 21, '1'),
(1184, '金华市', 21, '1'),
(1185, '衢州市', 21, '1'),
(1186, '舟山市', 21, '1'),
(1187, '台州市', 21, '1'),
(1188, '丽水市', 21, '1'),
(1189, '合肥市', 22, '1'),
(1190, '芜湖市', 22, '1'),
(1191, '蚌埠市', 22, '1'),
(1192, '淮南市', 22, '1'),
(1193, '马鞍山市', 22, '1'),
(1194, '淮北市', 22, '1'),
(1195, '铜陵市', 22, '1'),
(1196, '安庆市', 22, '1'),
(1197, '黄山市', 22, '1'),
(1198, '滁州市', 22, '1'),
(1199, '阜阳市', 22, '1'),
(1200, '宿州市', 22, '1'),
(1201, '巢湖市', 22, '1'),
(1202, '六安市', 22, '1'),
(1203, '亳州市', 22, '1'),
(1204, '池州市', 22, '1'),
(1205, '宣城市', 22, '1'),
(1206, '福州市', 23, '1'),
(1207, '厦门市', 23, '1'),
(1208, '莆田市', 23, '1'),
(1209, '三明市', 23, '1'),
(1210, '泉州市', 23, '1'),
(1211, '漳州市', 23, '1'),
(1212, '南平市', 23, '1'),
(1213, '龙岩市', 23, '1'),
(1214, '宁德市', 23, '1'),
(1215, '南昌市', 24, '1'),
(1216, '景德镇市', 24, '1'),
(1217, '萍乡市', 24, '1'),
(1218, '新余市', 24, '1'),
(1219, '九江市', 24, '1'),
(1220, '鹰潭市', 24, '1'),
(1221, '赣州市', 24, '1'),
(1222, '吉安市', 24, '1'),
(1223, '宜春市', 24, '1'),
(1224, '抚州市', 24, '1'),
(1225, '上饶市', 24, '1'),
(1226, '济南市', 25, '1'),
(1227, '青岛市', 25, '1'),
(1228, '淄博市', 25, '1'),
(1229, '枣庄市', 25, '1'),
(1230, '东营市', 25, '1'),
(1231, '潍坊市', 25, '1'),
(1232, '烟台市', 25, '1'),
(1233, '威海市', 25, '1'),
(1234, '济宁市', 25, '1'),
(1235, '泰安市', 25, '1'),
(1236, '日照市', 25, '1'),
(1237, '莱芜市', 25, '1'),
(1238, '德州市', 25, '1'),
(1239, '临沂市', 25, '1'),
(1240, '聊城市', 25, '1'),
(1241, '滨州市', 25, '1'),
(1242, '菏泽市', 25, '1'),
(1243, '郑州市', 26, '1'),
(1244, '开封市', 26, '1'),
(1245, '洛阳市', 26, '1'),
(1246, '平顶山市', 26, '1'),
(1247, '焦作市', 26, '1'),
(1248, '鹤壁市', 26, '1'),
(1249, '新乡市', 26, '1'),
(1250, '安阳市', 26, '1'),
(1251, '濮阳市', 26, '1'),
(1252, '许昌市', 26, '1'),
(1253, '漯河市', 26, '1'),
(1254, '三门峡市', 26, '1'),
(1255, '南阳市', 26, '1'),
(1256, '商丘市', 26, '1'),
(1257, '信阳市', 26, '1'),
(1258, '周口市', 26, '1'),
(1259, '驻马店市', 26, '1'),
(1260, '济源市', 26, '1'),
(1261, '武汉市', 27, '1'),
(1262, '黄石市', 27, '1'),
(1263, '襄樊市', 27, '1'),
(1264, '十堰市', 27, '1'),
(1265, '荆州市', 27, '1'),
(1266, '宜昌市', 27, '1'),
(1267, '荆门市', 27, '1'),
(1268, '鄂州市', 27, '1'),
(1269, '孝感市', 27, '1'),
(1270, '黄冈市', 27, '1'),
(1271, '咸宁市', 27, '1'),
(1272, '随州市', 27, '1'),
(1273, '仙桃市', 27, '1'),
(1274, '天门市', 27, '1'),
(1275, '潜江市', 27, '1'),
(1276, '神农架市', 27, '1'),
(1277, '恩施土家市', 27, '1'),
(1278, '长沙市', 28, '1'),
(1279, '株洲市', 28, '1'),
(1280, '湘潭市', 28, '1'),
(1281, '衡阳市', 28, '1'),
(1282, '邵阳市', 28, '1'),
(1283, '岳阳市', 28, '1'),
(1284, '常德市', 28, '1'),
(1285, '张家界市', 28, '1'),
(1286, '益阳市', 28, '1'),
(1287, '郴州市', 28, '1'),
(1288, '怀化市', 28, '1'),
(1289, '娄底市', 28, '1'),
(1290, '湘西土家市', 28, '1'),
(1291, '永州市', 28, '1'),
(1292, '广州市', 29, '1'),
(1293, '深圳市', 29, '1'),
(1294, '珠海市', 29, '1'),
(1295, '汕头市', 29, '1'),
(1296, '韶关市', 29, '1'),
(1297, '佛山市', 29, '1'),
(1298, '江门市', 29, '1'),
(1299, '湛江市', 29, '1'),
(1300, '茂名市', 29, '1'),
(1301, '肇庆市', 29, '1'),
(1302, '惠州市', 29, '1'),
(1303, '梅州市', 29, '1'),
(1304, '汕尾市', 29, '1'),
(1305, '河源市', 29, '1'),
(1306, '阳江市', 29, '1'),
(1307, '清远市', 29, '1'),
(1308, '东莞市', 29, '1'),
(1309, '中山市', 29, '1'),
(1310, '潮州市', 29, '1'),
(1311, '揭阳市', 29, '1'),
(1312, '云浮市', 29, '1'),
(1313, '南宁市', 30, '1'),
(1314, '柳州市', 30, '1'),
(1315, '桂林市', 30, '1'),
(1316, '梧州市', 30, '1'),
(1317, '北海市', 30, '1'),
(1318, '防城港市', 30, '1'),
(1319, '钦州市', 30, '1'),
(1320, '贵港市', 30, '1'),
(1321, '玉林市', 30, '1'),
(1322, '百色市', 30, '1'),
(1323, '贺州市', 30, '1'),
(1324, '河池市', 30, '1'),
(1325, '来宾市', 30, '1'),
(1326, '崇左市', 30, '1'),
(1327, '海口市', 31, '1'),
(1328, '三亚市', 31, '1'),
(1329, '五指山市', 31, '1'),
(1330, '琼海市', 31, '1'),
(1331, '儋州市', 31, '1'),
(1332, '文昌市', 31, '1'),
(1333, '万宁市', 31, '1'),
(1334, '东方市', 31, '1'),
(1335, '澄迈市', 31, '1'),
(1336, '定安市', 31, '1'),
(1337, '屯昌市', 31, '1'),
(1338, '临高市', 31, '1'),
(1339, '白沙黎族市', 31, '1'),
(1340, '江黎族自市', 31, '1'),
(1341, '乐东黎族市', 31, '1'),
(1342, '陵水黎族市', 31, '1'),
(1343, '保亭黎族市', 31, '1'),
(1344, '琼中黎族市', 31, '1'),
(1345, '西沙群岛市', 31, '1'),
(1346, '南沙群岛市', 31, '1'),
(1347, '中沙群岛市', 31, '1'),
(1348, '成都市', 32, '1'),
(1349, '自贡市', 32, '1'),
(1350, '攀枝花市', 32, '1'),
(1351, '泸州市', 32, '1'),
(1352, '德阳市', 32, '1'),
(1353, '绵阳市', 32, '1'),
(1354, '广元市', 32, '1'),
(1355, '遂宁市', 32, '1'),
(1356, '内江市', 32, '1'),
(1357, '乐山市', 32, '1'),
(1358, '南充市', 32, '1'),
(1359, '宜宾市', 32, '1'),
(1360, '广安市', 32, '1'),
(1361, '达州市', 32, '1'),
(1362, '眉山市', 32, '1'),
(1363, '雅安市', 32, '1'),
(1364, '巴中市', 32, '1'),
(1365, '资阳市', 32, '1'),
(1366, '阿坝藏族市', 32, '1'),
(1367, '甘孜藏族市', 32, '1'),
(1368, '凉山彝族市', 32, '1'),
(1369, '贵阳市', 33, '1'),
(1370, '六盘水市', 33, '1'),
(1371, '遵义市', 33, '1'),
(1372, '安顺市', 33, '1'),
(1373, '铜仁市', 33, '1'),
(1374, '毕节市', 33, '1'),
(1375, '黔西南布市', 33, '1'),
(1376, '黔东南苗市', 33, '1'),
(1377, '黔南布依市', 33, '1'),
(1378, '昆明市', 34, '1'),
(1379, '曲靖市', 34, '1'),
(1380, '玉溪市', 34, '1'),
(1381, '保山市', 34, '1'),
(1382, '昭通市', 34, '1'),
(1383, '丽江市', 34, '1'),
(1384, '思茅市', 34, '1'),
(1385, '临沧市', 34, '1'),
(1386, '文山壮族自治州', 34, '1'),
(1387, '红河哈尼族彝族自治州', 34, '1'),
(1388, '西双版纳傣族自治州', 34, '1'),
(1389, '楚雄彝族自治州', 34, '1'),
(1390, '大理白族自治州', 34, '1'),
(1391, '德宏傣族景颇族自治州', 34, '1'),
(1392, '怒江傈僳族自治州', 34, '1'),
(1393, '迪庆藏族自治州', 34, '1'),
(1394, '拉萨市', 35, '1'),
(1395, '那曲地区', 35, '1'),
(1396, '昌都地区', 35, '1'),
(1397, '山南地区', 35, '1'),
(1398, '日喀则地区', 35, '1'),
(1399, '阿里地区', 35, '1'),
(1400, '林芝地区', 35, '1'),
(1401, '西安市', 36, '1'),
(1402, '铜川市', 36, '1'),
(1403, '宝鸡市', 36, '1'),
(1404, '咸阳市', 36, '1'),
(1405, '渭南市', 36, '1'),
(1406, '延安市', 36, '1'),
(1407, '汉中市', 36, '1'),
(1408, '榆林市', 36, '1'),
(1409, '安康市', 36, '1'),
(1410, '商洛市', 36, '1'),
(1411, '兰州市', 37, '1'),
(1412, '金昌市', 37, '1'),
(1413, '白银市', 37, '1'),
(1414, '天水市', 37, '1'),
(1415, '嘉峪关市', 37, '1'),
(1416, '武威市', 37, '1'),
(1417, '张掖市', 37, '1'),
(1418, '平凉市', 37, '1'),
(1419, '酒泉市', 37, '1'),
(1420, '庆阳市', 37, '1'),
(1421, '定西市', 37, '1'),
(1422, '陇南市', 37, '1'),
(1423, '临夏回族自治州', 37, '1'),
(1424, '甘南藏族自治州', 37, '1'),
(1425, '西宁市', 38, '1'),
(1426, '海东市', 38, '1'),
(1427, '海北藏族自治州', 38, '1'),
(1428, '黄南藏族自治州', 38, '1'),
(1429, '海南藏族自治州', 38, '1'),
(1430, '果洛藏族自治州', 38, '1'),
(1431, '玉树藏族自治州', 38, '1'),
(1432, '海西蒙古自治州', 38, '1'),
(1433, '银川市', 39, '1'),
(1434, '石嘴山市', 39, '1'),
(1435, '吴忠市', 39, '1'),
(1436, '固原市', 39, '1'),
(1437, '中卫市', 39, '1'),
(1438, '乌鲁木齐市', 40, '1'),
(1439, '克拉玛依市', 40, '1'),
(1440, '石河子市', 40, '1'),
(1441, '阿拉尔市', 40, '1'),
(1442, '图木舒克市', 40, '1'),
(1443, '五家渠市', 40, '1'),
(1444, '吐鲁番市', 40, '1'),
(1445, '哈密市', 40, '1'),
(1446, '和田市', 40, '1'),
(1447, '阿克苏地区', 40, '1'),
(1448, '喀什市', 40, '1'),
(1449, '克孜勒苏柯尔克孜自治州', 40, '1'),
(1450, '巴音郭楞蒙古自治州', 40, '1'),
(1451, '昌吉回族自治州', 40, '1'),
(1452, '博尔塔拉市', 40, '1'),
(1453, '伊犁哈萨市', 40, '1'),
(1454, '塔城市', 40, '1'),
(1455, '阿勒泰市', 40, '1'),
(1456, '台北市', 43, '1'),
(1457, '高雄市', 43, '1'),
(1458, '基隆市', 43, '1'),
(1459, '台中市', 43, '1'),
(1460, '台南市', 43, '1'),
(1461, '新竹市', 43, '1'),
(1462, '嘉义市', 43, '1'),
(1463, '台北县', 43, '1'),
(1464, '宜兰县', 43, '1'),
(1465, '新竹县', 43, '1'),
(1466, '桃园县', 43, '1'),
(1467, '苗栗县', 43, '1'),
(1468, '台中县', 43, '1'),
(1469, '彰化县', 43, '1'),
(1470, '南投县', 43, '1'),
(1471, '嘉义县', 43, '1'),
(1472, '云林县', 43, '1'),
(1473, '台南县', 43, '1'),
(1474, '高雄县', 43, '1'),
(1475, '屏东县', 43, '1'),
(1476, '台东县', 43, '1'),
(1477, '花莲县', 43, '1'),
(1478, '澎湖县', 43, '1');

-- --------------------------------------------------------

--
-- Table structure for table `dict_province`
--

CREATE TABLE IF NOT EXISTS `dict_province` (
  `provid` int(10) unsigned NOT NULL DEFAULT '0',
  `provname` varchar(30) NOT NULL,
  `baidu_name` varchar(255) NOT NULL,
  `type` varchar(1) DEFAULT NULL COMMENT '1 - 直辖市rn2 - 行政省rn3 - 自治区rn4 - 特别行政区rn5 - 其他国家rn见全局数据字典[省份类型] rn',
  `state` varchar(1) DEFAULT NULL COMMENT '0 - 禁用rn1 - 启用'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dict_province`
--

INSERT INTO `dict_province` (`provid`, `provname`, `baidu_name`, `type`, `state`) VALUES
(10, '北京市', '北京市', '1', '1'),
(11, '上海市', '上海市', '1', '1'),
(12, '天津市', '天津市', '1', '1'),
(13, '重庆市', '重庆市', '1', '1'),
(14, '河北省', '河北省', '2', '1'),
(15, '山西省', '山西省', '2', '1'),
(16, '内蒙古 ', '内蒙古自治区', '3', '1'),
(17, '辽宁省', '辽宁省', '2', '1'),
(18, '吉林省', '吉林省', '2', '1'),
(19, '黑龙江省', '黑龙江省', '2', '1'),
(20, '江苏省', '江苏省', '2', '1'),
(21, '浙江省', '浙江省', '2', '1'),
(22, '安徽省', '安徽省', '2', '1'),
(23, '福建省', '福建省', '2', '1'),
(24, '江西省', '江西省', '2', '1'),
(25, '山东省', '山东省', '2', '1'),
(26, '河南省', '河南省', '2', '1'),
(27, '湖北省', '湖北省', '2', '1'),
(28, '湖南省', '湖南省', '2', '1'),
(29, '广东省', '广东省', '2', '1'),
(30, '广西', '广西壮族自治区', '3', '1'),
(31, '海南省', '海南省', '2', '1'),
(32, '四川省', '四川省', '2', '1'),
(33, '贵州省', '贵州省', '2', '1'),
(34, '云南省', '云南省', '2', '1'),
(35, '西藏', '西藏自治区', '3', '1'),
(36, '陕西', '陕西', '2', '1'),
(37, '甘肃省', '甘肃省', '2', '1'),
(38, '青海省', '青海省', '2', '1'),
(39, '宁夏', '宁夏回族自治区', '3', '1'),
(40, '新疆', '新疆维吾尔自治区', '3', '1'),
(41, '香港', '香港特别行政区', '4', '1'),
(42, '澳门', '澳门特别行政区', '4', '1'),
(43, '台湾省', '台湾省', '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE IF NOT EXISTS `discussion` (
  `did` tinyint(4) NOT NULL,
  `uid` tinyint(4) NOT NULL,
  `gid` tinyint(4) NOT NULL,
  `bbs` text COLLATE utf8_unicode_ci NOT NULL,
  `ustate` tinyint(4) NOT NULL DEFAULT '0',
  `gstate` tinyint(4) NOT NULL DEFAULT '0',
  `updatetime` datetime DEFAULT NULL,
  `del` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`did`, `uid`, `gid`, `bbs`, `ustate`, `gstate`, `updatetime`, `del`) VALUES
(8, 27, 9, '[{"type":1,"content":"这个真的是限量版的吗","time":"2016-04-12 16:35:52"},{"type":3,"content":"对的，货真价实","time":"2016-04-12 16:36:52"},{"type":1,"content":"上海大学南8交易如何？","time":"2016-04-12 16:37:23"},{"type":3,"content":"可以，没有问题，下单吧","time":"2016-04-12 16:37:41"},{"type":1,"content":"弄","time":"2016-04-13 13:58:06"},{"type":2,"content":"27","time":"2016-04-13 13:58:15"},{"type":1,"content":"G","time":"2016-04-20 19:29:21"}]', 0, 0, '2016-04-20 19:29:21', 0),
(9, 28, 14, '[{"type":2,"content":"35","time":"2016-05-16 14:00:05"}]', 0, 0, '2016-05-16 14:00:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `focus`
--

CREATE TABLE IF NOT EXISTS `focus` (
  `fid` tinyint(4) NOT NULL,
  `fromid` tinyint(4) NOT NULL,
  `toid` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '1',
  `del` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `focus`
--

INSERT INTO `focus` (`fid`, `fromid`, `toid`, `type`, `state`, `del`) VALUES
(10, 27, 9, 0, 1, 0),
(11, 27, 26, 1, 0, 0),
(12, 28, 13, 0, 0, 0),
(13, 28, 16, 0, 1, 0),
(14, 28, 14, 0, 1, 0),
(15, 28, 10, 0, 1, 0),
(16, 28, 9, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `gid` tinyint(4) NOT NULL,
  `uid` tinyint(4) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `count` int(6) NOT NULL,
  `leastcount` int(6) DEFAULT '1',
  `describe` text COLLATE utf8_unicode_ci NOT NULL,
  `address` int(4) DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `sale_type` tinyint(4) NOT NULL,
  `attach` varchar(255) COLLATE utf8_unicode_ci DEFAULT '1',
  `auction` int(4) NOT NULL DEFAULT '0',
  `state` tinyint(4) NOT NULL,
  `createtime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `del` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`gid`, `uid`, `name`, `price`, `count`, `leastcount`, `describe`, `address`, `type`, `sale_type`, `attach`, `auction`, `state`, `createtime`, `endtime`, `del`) VALUES
(8, 26, '杯子-迪斯尼正版-大眼仔马克杯', 89, 0, 1, '这是迪斯尼正版大眼仔马克杯', NULL, 1, 0, '22,23', 0, 2, '2016-04-12 16:29:47', '2016-04-12 16:29:47', 0),
(9, 26, '耳机-skullcandy-限量版耳机', 1080, 1, 1, '', NULL, 2, 0, '24,25,29', 0, 2, '2016-04-12 16:31:47', '2016-04-12 16:31:47', 0),
(10, 26, 'DC玩偶-蝙蝠侠大小超人', 80, 2, 1, '80两份哦，还不快来买', NULL, 3, 0, '28', 0, 2, '2016-04-18 20:17:14', '2016-04-18 20:17:14', 0),
(11, 26, 'JAVA书籍_从入门到精通', 81, 200, 1, '这是一本JAVA书', NULL, 3, 0, '30', 0, 2, '2016-04-25 15:37:02', '2016-04-25 15:37:02', 0),
(12, 26, 'C语言_从入门到精通', 81, 200, 1, '', NULL, 3, 0, '31', 0, 2, '2016-04-25 15:38:06', '2016-04-25 15:38:06', 0),
(13, 26, '精美蛋糕_草莓味', 10, 10, 1, '', NULL, 4, 0, '32', 0, 2, '2016-04-25 15:42:04', '2016-04-25 15:42:04', 0),
(14, 26, '花', 2, 200, 1, '', NULL, 0, 0, '33', 0, 2, '2016-04-25 15:45:52', '2016-04-25 15:45:52', 0),
(15, 27, '花_2', 2, 199, 1, '', NULL, 0, 0, '33', 0, 2, '2016-04-25 15:45:52', '2016-04-25 15:45:52', 0),
(16, 27, '精美蛋糕_草莓味_2', 10, 9, 1, '', NULL, 4, 0, '32', 0, 2, '2016-04-25 15:42:04', '2016-04-25 15:42:04', 0),
(17, 27, 'DC玩偶-蝙蝠侠大小超人_2', 80, 2, 1, '80两份哦，还不快来买', NULL, 3, 0, '28', 0, 2, '2016-04-18 20:17:14', '2016-04-18 20:17:14', 0);

--
-- Triggers `goods`
--
DELIMITER $$
CREATE TRIGGER `edit_goods` AFTER UPDATE ON `goods`
 FOR EACH ROW if NEW.name<>OLD.name then
		update goods set goods.state=0 WHERE goods.gid=NEW.gid;
	end if
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `morder`
--

CREATE TABLE IF NOT EXISTS `morder` (
  `oid` tinyint(4) NOT NULL,
  `ooid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gid` tinyint(4) NOT NULL,
  `uid` tinyint(4) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provid` int(6) NOT NULL DEFAULT '11',
  `cityid` int(6) NOT NULL DEFAULT '1018',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(6) NOT NULL DEFAULT '1',
  `price` double NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `tradetime` datetime DEFAULT NULL,
  `confirmtime` datetime DEFAULT NULL,
  `finishtime` datetime DEFAULT NULL,
  `del` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `morder`
--

INSERT INTO `morder` (`oid`, `ooid`, `gid`, `uid`, `comment`, `provid`, `cityid`, `address`, `count`, `price`, `state`, `createtime`, `tradetime`, `confirmtime`, `finishtime`, `del`) VALUES
(8, 'S4350759', 9, 27, '', 11, 1028, '上海大学南八', 1, 1080, 2, '2016-04-12 16:38:51', '2016-04-14 16:38:15', '2016-04-12 16:39:11', '2016-04-12 16:39:35', 0),
(9, 'S5774529', 9, 27, '', 11, 1028, '上海大学南八', 1, 1080, 3, '2016-04-12 16:40:53', '2016-04-13 16:40:31', NULL, NULL, 0),
(10, 'S6160680', 9, 27, '', 11, 1024, '上海大学', 1, 1080, 2, '2016-04-12 16:45:26', '2016-04-14 16:45:12', '2016-04-25 15:48:52', '2016-04-14 16:39:35', 0),
(11, 'S5997621', 8, 27, '', 11, 1030, '千米高', 1, 89, 1, '2016-04-20 19:30:50', '2016-04-20 19:34:04', '2016-04-20 19:32:37', NULL, 0),
(12, 'S6101636', 15, 26, '', 11, 1030, '上海市浦东新区祖冲之路705号', 1, 2, 2, '2016-04-25 15:49:40', '2016-04-26 15:49:25', '2016-04-25 15:50:38', '2016-04-25 15:51:04', 0),
(13, 'S8523884', 16, 26, '', 11, 1030, '上海市浦东新区祖冲之路705号', 1, 10, 2, '2016-04-25 15:52:46', '2016-04-25 15:52:17', '2016-04-25 15:52:58', '2016-04-25 15:53:06', 0),
(14, 'S6101636', 15, 26, '', 11, 1030, '上海市浦东新区祖冲之路705号', 1, 2, 2, '2016-04-25 15:49:40', '2016-04-26 15:49:25', '2016-04-25 15:50:38', '2016-04-25 15:51:04', 0),
(15, 'S6101636', 15, 26, '', 11, 1030, '上海市浦东新区祖冲之路705号', 1, 2, 2, '2016-04-25 15:49:40', '2016-04-26 15:49:25', '2016-04-25 15:50:38', '2015-07-14 15:51:04', 0);

--
-- Triggers `morder`
--
DELIMITER $$
CREATE TRIGGER `confirm_order` AFTER INSERT ON `morder`
 FOR EACH ROW if NEW.state=0 then
	update goods set goods.count=goods.count-NEW.count WHERE goods.gid=NEW.gid;
    select count into @count from goods where goods.gid=NEW.gid;
		if @count=0 then
			update goods set goods.state=3 where goods.gid=NEW.gid;
		end if;
    end if
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_order` AFTER UPDATE ON `morder`
 FOR EACH ROW if NEW.state=3 then
	update goods set goods.count=goods.count+NEW.count WHERE goods.gid=NEW.gid;
end if
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `msystem`
--

CREATE TABLE IF NOT EXISTS `msystem` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `value` varchar(255) NOT NULL,
  `createtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  `del` tinyint(4) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `msystem`
--

INSERT INTO `msystem` (`id`, `type`, `value`, `createtime`, `updatetime`, `del`) VALUES
(13, 0, 'HfSEIoin1b4piPe6ER-ukmcjFwl0l4fL94ATPE0htqQ-KvTslQbj_7akyf6c9K2qMDyOCinM_ffzePWHhC9V1MbXsrp3IDynZG7OnXYyYHOhpcFSAVm1ys2ezPJeJmmTUHMdAAAOBG', '2016-04-21 09:09:13', '2016-05-17 14:47:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `qrcode`
--

CREATE TABLE IF NOT EXISTS `qrcode` (
  `qrid` tinyint(4) NOT NULL,
  `id` tinyint(4) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `del` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `qrcode`
--

INSERT INTO `qrcode` (`qrid`, `id`, `url`, `type`, `del`) VALUES
(9, 9, '/Public/resorce/QR/92016-04-12_16:35:58.png', 0, 0),
(10, 8, '/Public/resorce/QR/82016-04-18_20:08:45.png', 0, 0),
(11, 16, '/Public/resorce/QR/162016-05-16_15:28:27.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE IF NOT EXISTS `system` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `value` varchar(255) NOT NULL,
  `createtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  `del` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` tinyint(4) NOT NULL,
  `uphone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `upwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` tinyint(4) NOT NULL DEFAULT '0',
  `openid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1',
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aid` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `storename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `storedescribe` text COLLATE utf8_unicode_ci,
  `realname` varchar(255) COLLATE utf8_unicode_ci DEFAULT '无名氏',
  `createtime` datetime DEFAULT NULL,
  `provid` int(10) NOT NULL DEFAULT '11',
  `cityid` int(10) NOT NULL DEFAULT '1028',
  `del` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uphone`, `uname`, `upwd`, `sex`, `openid`, `role`, `token`, `aid`, `email`, `storename`, `storedescribe`, `realname`, `createtime`, `provid`, `cityid`, `del`) VALUES
(26, '13111111111', '测试账号1', '098f6bcd4621d373cade4e832627b4f6', 0, 'oCDlOuDdRXk9N4lMlDsOv8xWvxcY', 1, '6909e97655895d3097ee40fbd6491d84', '21', 'ceshi@163.com', '测试1的店铺', '这是测试1所开的店铺', '测试1', '2016-04-12 16:26:38', 11, 1024, 0),
(27, '13222222222', '测试账号2', '098f6bcd4621d373cade4e832627b4f6', 0, '', 1, '75cc8b4001576c4ea464f0617220d807', '26', 'ceshi@163.com', '测试2店铺', '这是测试2的店铺', '测试2', '2016-04-12 16:34:31', 11, 1030, 0),
(28, '13333333333', '测试用户3', '098f6bcd4621d373cade4e832627b4f6', 0, NULL, 1, 'e93ece5cd564d57fcbad1119f116b10c', '34', 'sss@163.com', NULL, NULL, '测试3', '2016-04-28 00:00:00', 11, 1028, 0),
(29, '13444444444', '测试用户4', '098f6bcd4621d373cade4e832627b4f6', 0, '123456789', 1, '1234567890', '0', 'sss@163.com', NULL, NULL, '测试4', '2016-04-28 00:00:00', 11, 1028, 0),
(30, '13555555555', '测试用户5', '098f6bcd4621d373cade4e832627b4f6', 0, '1234567891', 1, '12345678901', '0', 'sss@163.com', NULL, NULL, '测试5', '2016-04-28 00:00:00', 11, 1028, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_visit`
--

CREATE TABLE IF NOT EXISTS `user_visit` (
  `uvid` tinyint(4) NOT NULL,
  `uid` tinyint(4) NOT NULL,
  `gid` tinyint(4) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_visit`
--

INSERT INTO `user_visit` (`uvid`, `uid`, `gid`, `score`) VALUES
(1, 26, 8, 1),
(2, 26, 8, 30),
(3, 26, 9, 1),
(4, 26, 12, 1),
(5, 27, 8, 1),
(6, 27, 9, 1),
(7, 27, 15, 1),
(8, 28, 8, 30),
(9, 28, 12, 1),
(10, 28, 8, 1),
(11, 26, 11, 30),
(12, 26, 12, 1),
(13, 26, 17, 30),
(14, 28, 9, 1),
(15, 28, 15, 1),
(16, 30, 8, 30),
(17, 30, 11, 30),
(18, 30, 12, 5),
(19, 30, 16, 30),
(20, 28, 10, 0),
(21, 28, 11, 30),
(22, 28, 14, 1),
(23, 28, 15, 1),
(24, 28, 15, 1),
(25, 28, 15, 1),
(26, 28, 15, 1),
(27, 28, 15, 1),
(28, 28, 13, 1),
(29, 28, 13, 5),
(30, 28, 13, -5),
(31, 26, 10, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attach`
--
ALTER TABLE `attach`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `dict_city`
--
ALTER TABLE `dict_city`
  ADD PRIMARY KEY (`cityid`);

--
-- Indexes for table `dict_province`
--
ALTER TABLE `dict_province`
  ADD PRIMARY KEY (`provid`);

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `focus`
--
ALTER TABLE `focus`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `morder`
--
ALTER TABLE `morder`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `msystem`
--
ALTER TABLE `msystem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD PRIMARY KEY (`qrid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user_visit`
--
ALTER TABLE `user_visit`
  ADD PRIMARY KEY (`uvid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `attach`
--
ALTER TABLE `attach`
  MODIFY `aid` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `did` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `focus`
--
ALTER TABLE `focus`
  MODIFY `fid` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `gid` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `morder`
--
ALTER TABLE `morder`
  MODIFY `oid` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `msystem`
--
ALTER TABLE `msystem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `qrcode`
--
ALTER TABLE `qrcode`
  MODIFY `qrid` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `user_visit`
--
ALTER TABLE `user_visit`
  MODIFY `uvid` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
