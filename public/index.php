<?php

require_once '../vendor/autoload.php';
require_once 'MyController.php';

$config['displayErrorDetails'] = true;
$app = new \Slim\App(["settings" => $config]);

/**
 * 课程成绩
 *
 * URI 参数:
 * {username}           账号: 即学号
 *
 * Headers 参数:
 * {X-DLPU-Password}    密码：     学号对应的密码
 * {X-DLPU-Data-Type}   数据类型:  new 为最新数据; old 为本地缓存数据(默认)
 * {X-DLPU-Semester}    学期:     为 空 时获取自入学到查询时的所有成绩(默认); 或指定某一学年学期如 2015-2016-2
 *
 */
$app->get('/v2/courses-scores/{username}', '\MyController:coursesScores');

/**
 * 考试安排信息
 *
 * URI 参数:
 * {username}               账号: 即学号
 *
 * Headers 参数:
 * {X-DLPU-Password}        密码：     学号对应的密码
 * {X-DLPU-Data-Type}       数据类型:  new 为最新数据; old 为本地缓存数据(默认)
 * {X-DLPU-Semester}        学期:      或指定某一学年学期如 2015-2016-2
 * {X-DLPU-Exams-Category}  考试类别:  1 => 期初; 2 => 期中; 3 => 期末(默认)
 *
 */
$app->get('/v2/exams-info/{username}', '\MyController:examsinfo');

/**
 * 学期理论课表
 *
 * URI 参数:
 * {username}           账号: 即学号
 *
 * Headers 参数:
 * {X-DLPU-Password}    密码：     学号对应的密码
 * {X-DLPU-Data-Type}   数据类型:  new 为最新数据; old 为本地缓存数据(默认)
 * {X-DLPU-Semester}    学期:      获取自入学到查询时的所有成绩(默认); 或指定某一学年学期如 2015-2016-2
 * {X-DLPU-Weeks}       周次:      为 空 时获取本学期课表; 或指定周次如 2
 *
 */
$app->get('/v2/timetable/{username}', '\MyController:timetable');

/**
 * 学籍卡片(个人信息)
 *
 * URI 参数:
 * {username}           账号: 即学号
 *
 * Headers 参数:
 * {X-DLPU-Password}    密码：     学号对应的密码
 * {X-DLPU-Data-Type}   数据类型:  new 为最新数据; old 为本地缓存数据(默认)
 *
 */
$app->get('/v2/userinfo/{username}', '\MyController:userinfo');

/**
 * 教务处公告(登陆之后的首页公告)
 *
 * URI 参数:
 * {username}           账号: 即学号
 *
 * Headers 参数:
 * {X-DLPU-Password}    密码：     学号对应的密码
 * {X-DLPU-Data-Type}   数据类型:  new 为最新数据; old 为本地缓存数据(默认)
 *
 */
$app->get('/v2/notice/{username}', '\MyController:notice');

/**
 * 修改密码
 *
 * URI 参数:
 * {username}           账号: 即学号
 *
 * Headers 参数:
 * {X-DLPU-Password}    密码：学号对应的密码
 *
 * POST 参数:
 * {password}           密码: 更改后的密码
 */
$app->get('/v2/password-update/{username}', '\MyController:passwordUpdate');

/**
 * 重置密码
 *
 * URI 参数:
 * {username}           账号: 即学号
 *
 * POST 参数:
 * {id}                 身份证号码
 */
$app->get('/v2/password-reset/{username}', '\MyController:passwordReset');

/**
 * 培养方案
 *
 * URI 参数:
 * {username}           账号: 即学号
 *
 * Headers 参数:
 * {X-DLPU-Password}    密码：学号对应的密码
 */
$app->get('/v2/training-scheme/{username}', '\MyController:trainingScheme');

/**
 * 等级考试成绩
 *
 * URI 参数:
 * {username}           账号: 即学号
 *
 * Headers 参数:
 * {X-DLPU-Password}    密码：学号对应的密码
 */
$app->get('/v2/level-scores/{username}', '\MyController:levelScores');

$app->run();
