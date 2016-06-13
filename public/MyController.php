<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Interop\Container\ContainerInterface;
use Xu42\Qznjw2014\Qznjw2014;

class MyController
{
    protected $ci;

    //Constructor
    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    /**
     * 课程成绩
     * @param Request $request
     * @param Response $response
     * @param Array $args
     * @return mixed
     */
    public function coursesScores(Request $request, Response $response, $args)
    {
        $qznjw2014 = $this->initQznjw2014($request, $args);
        $data = $qznjw2014->coursesScores($request->getHeaderLine('X-DLPU-Semester'));
        return $this->responseBodySuccess($response, $data);
    }

    /**
     * 考试安排信息
     * @param Request $request
     * @param Response $response
     * @param Array $args
     * @return mixed
     */
    public function examsinfo(Request $request, Response $response, $args)
    {
        $qznjw2014 = $this->initQznjw2014($request, $args);
        $data = $qznjw2014->examsinfo($request->getHeaderLine('X-DLPU-Semester'), $request->getHeaderLine('X-DLPU-Exams-Category'));
        return $this->responseBodySuccess($response, $data);
    }

    /**
     * 学期理论课表
     * @param Request $request
     * @param Response $response
     * @param Array $args
     * @return mixed
     */
    public function timetable(Request $request, Response $response, $args)
    {
        $qznjw2014 = $this->initQznjw2014($request, $args);
        $data = $qznjw2014->timetable($request->getHeaderLine('X-DLPU-Semester'), $request->getHeaderLine('X-DLPU-Weeks'));
        return $this->responseBodySuccess($response, $data);
    }

    /**
     * 用户信息
     * @param Request $request
     * @param Response $response
     * @param Array $args
     * @return mixed
     */
    public function userinfo(Request $request, Response $response, $args)
    {
        $qznjw2014 = $this->initQznjw2014($request, $args);
        $data = $qznjw2014->userinfo();
        return $this->responseBodySuccess($response, $data);
    }

    /**
     * 通知公告
     * @param Request $request
     * @param Response $response
     * @param Array $args
     * @return mixed
     */
    public function notice(Request $request, Response $response, $args)
    {
        $qznjw2014 = $this->initQznjw2014($request, $args);
        $data = $qznjw2014->notice();
        return $this->responseBodySuccess($response, $data);
    }

    /**
     * 密码修改
     * @param Request $request
     * @param Response $response
     * @param Array $args
     * @return mixed
     */
    public function passwordUpdate(Request $request, Response $response, $args)
    {
        $qznjw2014 = $this->initQznjw2014($request, $args);
        $parsedBody = $request->getParsedBody();
        $data = $qznjw2014->passwordUpdate($request->getHeaderLine('X-DLPU-Password'), $parsedBody['password']);
        return $this->responseBodySuccess($response, $data);
    }

    /**
     * 密码重置
     * @param Request $request
     * @param Response $response
     * @param Array $args
     * @return mixed
     */
    public function passwordReset(Request $request, Response $response, $args)
    {
        $qznjw2014 = $this->initQznjw2014($request, $args);
        $parsedBody = $request->getParsedBody();
        $data = $qznjw2014->passwordReset($args['username'], $parsedBody['id']);
        return $this->responseBodySuccess($response, $data);
    }

    /**
     * 指导培养方案
     * @param Request $request
     * @param Response $response
     * @param Array $args
     * @return mixed
     */
    public function trainingScheme(Request $request, Response $response, $args)
    {
        $qznjw2014 = $this->initQznjw2014($request, $args);
        $data = $qznjw2014->trainingScheme();
        return $this->responseBodySuccess($response, $data);
    }

    /**
     * 等级考试成绩
     * @param Request $request
     * @param Response $response
     * @param Array $args
     * @return mixed
     */
    public function levelScores(Request $request, Response $response, $args)
    {
        $qznjw2014 = $this->initQznjw2014($request, $args);
        $data = $qznjw2014->levelScores();
        return $this->responseBodySuccess($response, $data);
    }

    /**
     * 封装 实例化 Qznjw2014 Class
     * @param Request $request
     * @param Array $args
     * @return Qznjw2014
     */
    private function initQznjw2014(Request $request, $args)
    {
        return (new Qznjw2014($args['username'], $request->getHeaderLine('X-DLPU-Password')));
    }

    /**
     * 封装 成功请求的 Response
     * @param Response $response
     * @param Array $data
     * @return mixed
     */
    private function responseBodySuccess(Response $response, $data)
    {
        return $response->withJson(['messages' => 'success', 'data' => $data]);
    }
}
