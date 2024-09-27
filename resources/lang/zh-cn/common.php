<?php
return [
    'auth_fail' => [401, '认证失败！'],
    'no_permission' => [403, '您没有权限操作此功能'],
    'server_busy' => [500, '服务器忙，请稍候重试~'],
    'server_error' => [501, '系统维护中，请联系客服'],
    'page_none' => [404, '您访问的地址不存在~'],
    'validate_fail' => [422, '数据验证失败~'],
    'no_records' => [1000, '没有找到相关的记录'],
    'operation_fail' => [1001, '操作失败'],
    'param_format_error' => [1002, '请求的参数格式不正确'],
    'name_exists' => [1003, '{name}已经存在！'],
    'msg' => [1004, '{msg}'],
    'name_none_exists' => [1005, '{name}不存在'],
    'illegal_operation' => [1006, '非法操作！'],

    'id_empty' => [1007, 'ID不能为空'],
    'email_empty' => [1008, '邮箱不能为空'],
    'exec_fail' => [1009, '操作失败'],

    'module_empty' => [1010, '模块名不能为空'],
    'controller_empty' => [1011, '控制器不能为空'],
    'method_empty' => [1012, '方法名不能为空'],
    'name_empty' => [1013, '名称不能为空'],
    'param_error' => [1014, '参数错误'],
    'param_require' => [1015, '{param}必填'],
    'length_error' => [1016, '{param}长度必须控制在{down}~{up}之间'],
    'delete_fail' => [1017, '删除失败'],
    'choose_file_type' => [1018, '请指定上传的文件类型'],
    'email_error' => [1019, '邮箱地址不正确'],

    'captcha_error' => [1020, '验证码失效或错误'],
    'param_number_error' => [1021, '参数必须为数字'],
    'file_empty' => [1022, '上传文件不能为空'],
    'file_ext_error' => [1023, '上传文件类型不正确'],
    'file_size_error' => [1024, '文件大小超过{size}M'],


    'status_type_empty' => [1025, '类型不能为空'],
    'status_type_error' => [1026, '数据类型错误'],

    'attachment_none' => [1027, '没有找到附件文件'],
    'code_import_file_error' => [1028, '上传文件格式不正确，请上传excel文件'],

    'key_name_exists' => [1029, '名称已存在'],
    'no_permission_data' => [1030, '您没有权限查看此数据'],
    'captcha_send_fail' => [1031, '验证码发送失败'],
    'sms_send_over_fail' => [1032, '短信发送失败，发送次数过多！'],
    'sms_send_more_fail' => [1033, '短信验证过于频繁请稍后重试！'],
    'auth_start_time_empty' => [1034, '权限开始时间不能为空！'],
    'auth_end_time_empty' => [1035, '权限结束时间不能为空！'],
    'file_upload_part_max_error' => [1036, '上传失败！文件太大！分片超过10000！'],
    'file_upload_part_discord' => [1037, '上传失败！分片未全部上传'],
    'data_change' => [1038, '数据已更改，请重新审核！'],
    'password_has_been_reset' => [1039, '密码已更改，请重新登录'],
    'user_other_login' => [1040, '您的账号已在其他地方登录！'],
    'param_cannot_required' => [1041,':param不可为空'], //validate->trans 专用

    'name_have_been_used' => [1042, '{name}已被使用！'],
    'notification_submit_main_page' => [1043, '用户{name}提交了主页申请，请及时处理！'],
    'notification_team_remove' => [1044, '{name}已将您移出团队！'],
    'notification_team_pass_apply' => [1045, '{name}通过了您的加入团队申请！'],
    'notification_team_refuse_apply' => [1046, '{name}拒绝了您的加入团队申请！'],
    'notification_team_refuse_inviter' => [1047, '{name}拒绝了您的团队邀请！'],
    'notification_team_inviter' => [1048, '{name}邀请您加入团队！'],
    'notification_activity_refuse' => [1049, '《{name}》{reject_reason}！'],
    'notification_activity_pass' => [1050, '《{name}》已通过平台审核！'],
    'notification_activity_up' => [1051, '《{name}》活动已上架！'],
    'notification_activity_down' => [1052, '《{name}》活动已下架！'],
    'notification_activity_join_exhibitor_refuse' => [1053, '《{name}》{reject_reason}！'],
    'notification_activity_join_exhibitor_pass' => [1054, '《{name}》已通过主办方审核！'],
    'notification_activity_join_audience_refuse' => [1055, '《{name}》{reject_reason}！'],
    'notification_activity_join_audience_pass' => [1056, '《{name}》已通过主办方审核！'],
    'notification_activity_report' => [1057, '《{name}》被举报了！'],
    'no_operator_permission' => [1058, '您没有权限操作此功能'],
    'email_unsubscribe_success' => [1059, '邮件退订成功'],
    'email_unsubscribe_tips' => [1060, '邮件退订后，将不再收到系统的通知邮件! '],
    'email_click_confirm' => [1061, '点击确认'],
    'email_subscribe' => [1062, '邮件退订'],
    'now' => [1063, '刚刚'],
    'minute_ago' => [1064, '分钟前'],
    'hour_ago' => [1065, '小时前'],
    'day_ago' => [1066, '天前'],
    'month_ago' => [1067, '月前'],
    'year_ago' => [1068, '年前'],
    'minute_ago_long' => [1064, '分钟前'],
    'hour_ago_long' => [1065, '小时前'],
    'day_ago_long' => [1066, '天前'],
    'month_ago_long' => [1067, '月前'],
    'year_ago_long' => [1068, '年前'],
    'thousand' => [1069, '千'],
    'ten_thousand' => [1070, '万'],
    'million' => [1071, '百万'],
    'hundred_million' => [1072, '亿'],
    'billion' => [1073, '十亿'],
    'app_not_auth' => [1074, '应用未授权！请使用主帐号登录！'],
    'app_disabled_sub_account' => [1075, '请使用主帐号登录！'],
    'app_auth_overdue' => [1076, '应用授权已过期！'],
    'app_auth_not_start' => [1077, '应用授权未开始！'],
    'app_disabled' => [1078, '您被禁止使用该应用！'],
    'app_email_allow_register' => [1079, '邮箱已被注册！'],
    'app_email_allow_use' => [1080, '邮箱已被使用！'],
    'app_auth_start_time_not_empty' => [1081, '授权开始时间不能为空！'],
    'app_auth_end_time_not_empty' => [1082, '授权开始时间不能为空！'],
    'app_auth_start_not_surpass_end' => [1083, '授权开始时间不能大于结束时间！'],
    'app_auth_start_not_less_now' => [1084, '授权结束时间不能小于当前时间！'],
    'app_invalid' => [1086, '无效的应用！'],
    'app_key_mismatching' => [1086, '授权错误！应用秘钥不匹配！'],
    'app_ver_not_exist' => [1087, '该应用版本不存在'],
    'valid_code_error' => [1088, '验证码错误！'],
    're_get_valid_code' => [1089, '请重新获取验证码！'],
    're_overtime' => [1090, '注册超时请重新注册！'],
    're_token_not_null' => [1091, '注册用户token不能为空！'],
    'email_not_reg' => [1092, '邮箱未被注册！'],
    'bind_phone_over_time' => [1093, '更换绑定手机失败！更换超时！'],
    'bind_phone_error' => [1094, '更换手机绑定参数错误！'],
    'bind_email_over_time' => [1095, '更换绑定邮箱失败！更换超时！'],
    'bind_email_error' => [1096, '更换邮箱绑定参数错误！'],
    'sms_yet_send_not_send' => [1097, '短信已经发送，一分钟内不可重复获取验证码！'],
    'app_not_has_roles' => [1098, '当前用户未获得此应用授权!'],
    'file_bucket_size_error' => [1099, '空间不足'],
    'unfreeze' => [1100, '解除限制'],
    'reason_is_not_empty' => [1101, '理由不能为空！'],
    'default_folder_file' => [1102, '默认素材库'],
    'default_folder_img' => [1103, '默认图库'],
    'default_folder_video' => [1104, '默认视频库'],
    'default_folder_audio' => [1105, '默认音频库'],
    'official_gallery' => [1106, '官方图库'],
    'default_folder_undelete' => [1107, '默认的文件夹不能删除'],
    'recommend_image_folder' => [1108, '推荐图库'],
    'my_image_folder' => [1109, '我的图库'],
    'advertising' => [1110, '广告'],
    'know_more' => [1111, '了解更多'],

    'thank_you' => [1112, '感谢您！'],
    'us_know' => [1113, '我们已收到您提交的信息。'],
    'ad' => [1114, '广告'],
    'empty_text' => [1115, '没有找到相关数据'],
    'zero' => [1116, '零'],
    'one' => [1117, '一'],
    'two' => [1118, '二'],
    'three' => [1119, '三'],
    'four' => [1120, '四'],
    'five' => [1121, '五'],
    'six' => [1122, '六'],
    'seven' => [1123, '七'],
    'eight' => [1124, '八'],
    'nine' => [1125, '九'],
    'million_s' => [1126, '万'],
    'billion_' => [1127, '亿'],
    'trillion' => [1128, '万亿'],
    'billion_s' => [1129, '亿亿'],
    'ten' => [1130, '十'],
    'hundred ' => [1131, '百'],
    'thousand ' => [1132, '千'],
    'price' => [1133, '￥{price}'],
    'free' => [1134, '免费'],
    'month' => [1135, '月'],
    'external_url' => [1136, '外部链接'],
    'tips' => [1137, '提示'],
    'bind_by_admin' => [1138, '请使用管理员账号绑定'],
    'app_unsubscribed' => [1139, '用户未开通此应用'],
    'authorized_fail' => [1140, '系统中心获取授权失败'],
    'notification_activity_matchpages_coupon' => [1141, '《{name}》已通过平台审核！获得2000元建站优惠券，优惠码”M58P”，领取地址：<a href="https://subscribe.matchpages.cn/apply.html" target="_blank">点击领取</a>'],
    'expo_plan' => [1142, '展会计划'],
    'achievement' => [1143, '历史展会'],
    'user_disabled' => [1144, '您的账号已被禁用！'],
//    'all' => '全部',
//    'other' => '其他',
//    'unknown' => '未知',
//    'not_login' => '账号未登录'
];
