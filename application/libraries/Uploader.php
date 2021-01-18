<?php

class Uploader
{
    protected $_ci;
    function __construct()
    {
        $this->_ci = &get_instance();
    }

    public function image($path)
	{
		$config['upload_path'] = './assets/uploads/'.$path.'/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 2000;
		$config['overwrite'] = true;
		$config['encrypt_name'] = true;

		$this->_ci->load->library('upload', $config);

		if (!$this->_ci->upload->do_upload('file')) {
            $data["status"]="error";
            $data["error"]=$this->_ci->upload->display_errors();
			return $data;
		} else {
            $data["status"]="success";
            $data["data"]=$this->_ci->upload->data();
			return $data;
		}
    }
    
}