<?php

class C_GetController extends C_Base {
    protected $content;
    protected $template='signin';
    protected $count=0;
    

    function __construct() {}
    function __destruct() {}


    protected function onInput()
    {
        parent::OnInput();
        $mPost = M_Posts::Instance();

        if (isset($_SESSION['login'])){
            $this->template='counter';
            $this->count = $mPost->getCount($_SESSION['login']);
        }

        if (isset($_GET['name']) && $_GET['name'] == 'reg')
            $this->template= 'signup';
    }

    protected function OnOutput()
    {

        $vars =['count' => $this->count, 'login' => '', 'error' => ''];
        $this->content = $this->Template("application/views/{$this->template}.php", $vars);
        parent::OnOutput();

    }
}