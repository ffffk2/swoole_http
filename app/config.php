<?php

return [
    'server' => [
        'host' => '0.0.0.0',
        'port' => 9503,
        'set' => [
            'worker_num' => 1,
            'daemonize' => false
        ],
    ],
    'request' => [
        'default' => [
            'module' => 'index',
            'controller' => 'index',
            'action' => 'index'
        ],
        'forbid' => ['common']
    ],
    'mysql' => [
        'host' => '127.0.0.1',
        'port' => '3306',
        'user' => 'root',
        'password' => 'Laravel5.5',
        'database' => 'haha132',
		'max' => 100,
		'min' => 20,
        'prefix' => 'wyt_'
    ],
    'redis' => [
        'host' => '127.0.0.1',
        'port' => 6379,
        'max' => 100,
        'min' => 20
    ],
    'pool' => [
        // 名字 => 类
        'mysql' => tool\pool\MysqlPool::class,
        'redis' => tool\pool\RedisPool::class
    ],
    'app' => [
        'upload' => [
            'default_img' => 'http://39.108.54.246:8099/cang.jpg'
        ]
    ],
    'msg' => [
        '200' => '成功',
        '201' => '网络异常',
        '202' => '系统繁忙，请稍后再试~',
        '204' => '浏览器预检通过',
        '400' => '请求失败',
        '401' => '未授权',
        '403' => '禁止请求',
        '404' => '未找到',
        '500' => '服务器错误',
        '504' => '网络请求超时',
        '110' => '非法请求',

        '10001' => '数据校验失败',
        '10002' => '缺少参数',
        
        '10100' => 'id不能为空',
        '10101' => '用户没有加入班级',
        '10102' => '班级不存在',
        '10103' => '用户已加入班级',
        '10104' => '用户已加入了该班级',
        '10105' => '不在查询范围',
        '10106' => '非班主任没权限移除学生/老师',
        '10107' => '不能移除自己',
        '10108' => '文件不存在',
        '10109' => '作业不存在',
        '10110' => '学生不存在',
        '10111' => '导入出错',
        '10112' => '原手机号码错误',
        '10113' => '作业不存在',


        '10200' => '数据获取成功',
        '10201' => '传入参数有误',
        '10202' => '代理商已存在',
        '10203' => '代理商id不能为空',
        '10204' => '代理商不存在',
        '10205' => '无数据',
        '10206' => '获取数据失败',
        '10207' => '该代理商已审核',
        '10208' => '代理商审核通过',
        '10209' => '代理商审核不通过',
        '10210' => '代理商审核失败',
        '10220' => '代理商账号格式不正确',
        '10230' => '分配的会员总数已超出限额',
        '10301' => '学校名称不能为空',
        '10302' => '请选择地址',
        '10303' => '请选择学校',
        '10304' => '老师账号数不正确',
        '10305' => '学生账号数不正确',
        '10306' => '代理人不能为空',
        '10307' => '找不到该学校',
        '10308' => '学校禁用成功',
        '10309' => '学校禁用失败',
        '10310' => '学校审核通过',
        '10311' => '学校审核不通过',
        '10312' => '找不到该管理员',
        '10313' => '重置密码成功',
        '10314' => '该学校已通过审核',
        '10315' => '该学校已被禁用',

        '10400' => '手机号码不正确',
        '10401' => '短信验证码错误',
        '10402' => '注册手机与获取验证码手机不一致',
        '10403' => '短信验证码过期',
        '10404' => '该号码已被注册',
        '10405' => '注册失败',
        '10406' => '缺少参数',
        '10407' => '请60秒后再获取',
        '10408' => '发送成功',
        '10409' => '发送失败',
        '10410' => '用户不存在',
        '10411' => '您已经绑定过手机',
        '10412' => '绑定成功',
        '10413' => '绑定失败',
        '10414' => '修改成功',
        '10415' => '修改失败',
        '10416' => '年级不存在',
        '10417' => '角色id不存在',
        '10418' => '添加成功',
        '10419' => '添加失败',
        '10420' => '删除成功',
        '10421' => '删除失败',
        '10422' => '名称已经存在',
        '10423' => '规则已经存在',
        '10424' => '此角色下还有用户,请先去删除或者禁用用户',
        '10425' => '类型不存在',
        '10426' => '有效期不存在',
        '10427' => '会员卡不存在',
        '10428' => '序列号或者会员卡号数量已达上限',

        '10501' => '用户id不能为空',
        '10502' => '题目id不能为空',
        '10503' => '学科id不能为空',
        '10504' => '题目内容不能为空',
        '10505' => '不能重复列入错题',
        '10429' => '退款成功',
        '10430' => '退款失败',
        '10431' => '订单未支付或已退款',
        '10432' => '订单不存在',
        '10433' => '该订单已补过单',
        '10434' => '该订单未付款',
        '10435' => '会员卡号或者密码错误',
        '10436' => '会员卡类型和有效期已存在',
        '10437' => '序列号不存在',
        '10438' => '订单创建失败',
        '10439' => '支付失败',
    ]
];