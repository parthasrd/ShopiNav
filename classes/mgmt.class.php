<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php');
class mgmt
{
	private $db;
	private $session;

	public function __construct($host = null, $db = null, $username = null, $pw = null)
	{
		$this->db = new database();
		$this->session = new session();
	}


	public function fetch(){
        $this->db->query("select * from bars where 1 = 1 ");
        $res = $this->db->resultset();
        return $res;
    }


    public function postbar($data){
        $bnr_txt = $data['banner_text'];
        $values = json_encode($data);
        $bars_status = $data['status'];

        $meta_data = array(
            'bars_title'=> $bnr_txt,
            'bars_values'=> $values,
            'bars_status'=> $bars_status
        );
        $res = $this->db->insert("bars", $meta_data);
        return $res;
    }

    public function editbar($data){
        $bnr_txt = $data['banner_text'];
        $values = json_encode($data);
        $bars_status = $data['status'];
        $bars_id = $data['bars_id'];



        $meta_data = array(
            'bars_title'=> $bnr_txt,
            'bars_values'=> $values
        );

        $condition = "bars_id ='".$bars_id."'";
        $this->db->update('bars',$meta_data,$condition);
        return true;

    }

    public function list_bar()
    {
        $sql="select * from bars where bars_del_status = 'N' order by bars_status DESC, bars_id DESC";
        $this->db->query($sql);
        $data = $this->db->resultsetObj();
        return $data;
    }

    public function bar_details($bid)
    {
        $sql="select * from bars where bars_id = '".$bid."' ";
        $this->db->query($sql);
        $data = $this->db->singleObj();
        return $data;
    }

    public function delbar($bid)
    {
        $condition = "bars_id ='".$bid."'";
        $data_arr = array('bars_del_status'=>'Y', 'bars_status'=>'N');
        $this->db->update('bars',$data_arr,$condition);
    }

    public function pubbar($bid)
    {
//      All set to inactive first
        $condition_all = "bars_store_id ='test'";
        $data_arr_all = array('bars_status'=>'N');
        $this->db->update('bars',$data_arr_all,$condition_all);

//      Active only one by ID
        $condition = "bars_id ='".$bid."'";
        $data_arr = array('bars_status'=>'Y');
        $this->db->update('bars',$data_arr,$condition);
    }

    public function deac_bar($bid)
    {
        $condition = "bars_id ='".$bid."'";
        $data_arr = array('bars_status'=>'N');
        $this->db->update('bars',$data_arr,$condition);
    }

    public function show_promo()
    {
        $sql="select * from bars where bars_del_status = 'N' and bars_status = 'Y' order by bars_status DESC, bars_id DESC limit 1";
        $this->db->query($sql);
        $data = $this->db->singleObj();
        return $data;
    }

}