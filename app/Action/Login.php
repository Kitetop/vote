<?php
namespace App\Action;

use Mx\Http\ActionAbstract;

class Login extends ActionAbstract
{
    private $postRules=[
        'username'=>[
            'desc'=>'用户名',
            'rules'=>'required',
        ],
        'password'=>[
            'desc'=>'用户密码',
            'rules'=>'required',
        ],
    ];
    protected function handlePost()
    {
        $this->validate($this->postRules);
        $login=$this->callService('UserLogin',[
            'username'=>$this->props['username'],
            'password'=>$this->props['password'],
            'clientInfo'=>[
                'ua'=>$_SERVER['HTTP_USER_AGENT'],
                'ip'=>$this->request->ip(),
            ]
        ]);
        $url=$this->config('externalUrl').'login/'.$login->id;
        $location='Location:'.$url;
        $this->code(201);
        $this->header($location);
        $this->response('username',$login->username);
        $this->response('uri',$url);
    }

}