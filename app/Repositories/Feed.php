<?php

namespace App\Repositories;

class Feed 
{
    public $param = [];

    public static function start($act)
    {
        $root = new self;
        $root->param['act'] = $act;
        return $root;
    }

    public function order($data = null) {
        $this->param['order'] = $data;

        return $this;
    }

    public function filter($data = null) {
        $this->param['filter'] = $data;

        return $this;
    }

    public function limit($data = null) {
        $this->param['limit'] = $data;

        return $this;
    }

    public function offset($data = null) {
        $this->param['offset'] = $data;

        return $this;
    }

    public function record($data = null) {
        $this->param['record'] = $data;

        return $this;
    }

    public function key($data = null) {
        $this->param['key'] = $data;

        return $this;
    }

    public function get()
    {
        $data = FeederRepo::parameter($this->param)->get();
        return collect($data);
    }
}