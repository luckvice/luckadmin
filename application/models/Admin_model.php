<?php


if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    function get_user_list(){
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('status', 1);
        $query=$this->db->get();
        return $query->result();
    }

    function get_user_by_id($userID){
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('user_id', $userID);
        $query=$this->db->get();
        return $query->result_array();
    }

    function validate_email($postData){
        $this->db->where('email', $postData['email']);
        $this->db->where('status', 1);
        $this->db->from('usuario');
        $query=$this->db->get();

        if ($query->num_rows() == 0)
            return true;
        else
            return false;
    }

    function insert_user($postData){

        $validate = $this->validate_email($postData);

        if($validate){
            $password = $this->generate_password();
            $data = array(
                'email' => $postData['email'],
                'nome' => $postData['nome'],
                'grupo' => $postData['grupo'],
                'url_img' => $postData['url_img'],
                'senha' => md5($password),
                'criado_em' => date('Y\-m\-d\ H:i:s A'),
            );
            echo var_dump($data);
            $this->db->insert('usuario', $data);

            $message = "Detalhes da sua conta:<br><br>Email: ".$postData['email']."<br>Senha temporaria: ".$password."<br>Não esqueça de trocar sua senha ao logar.<br><br> Você pode logar em".base_url().".";
            $subject = "Nova conta criada";
            $this->send_email($message,$subject,$postData['email']);

            $module = "Gerenciamento de usuarios";
            $activity = "add new user ".$postData['email'];
            $this->insert_log($activity, $module);
            return array('status' => 'success', 'message' => '');

        }else{
            return array('status' => 'exist', 'message' => '');
        }

    }

    function update_usuario($postData){

        $oldData = $this->get_user_by_id($postData['id']);

        if($oldData[0]['email'] == $postData['email'])
            $validate = true;
        else
            $validate = $this->validate_email($postData);

        if($validate){
            $data = array(
                'email' => $postData['email'],
                'nome' => $postData['nome'],
                'grupo' => $postData['grupo'],
            );
            $this->db->where('user_id', $postData['id']);
            $this->db->update('usuario', $data);

            $record = "(".$oldData[0]['email']." to ".$postData['email'].", ".$oldData[0]['nome']." to ".$postData['nome'].",".$oldData[0]['grupo']." to ".$postData['grupo'].")";

            $module = "Gerenciamento de usuario";
            $activity = "update user ".$oldData[0]['email']."`s details ".$record;
            $this->insert_log($activity, $module);
            return array('status' => 'success', 'message' => $record);
        }else{
            return array('status' => 'exist', 'message' => '');
        }

    }


    function desativar_usuario($email,$id){

        $data = array(
            'status' => 0,
        );
        $this->db->where('user_id', $id);
        $this->db->update('usuario', $data);

        $module = "Gerenciamento de usuarios";
        $activity = "delete user ".$email;
        $this->insert_log($activity, $module);
        return array('status' => 'success', 'message' => '');

    }

    function reset_senha($email,$id){

        $password = $this->generate_password();
        $data = array(
            'password' => md5($password),
        );
        $this->db->where('user_id', $id);
        $this->db->update('usuario', $data);

        $message = "Sua senha foi resetada <br><br>Email: ".$email."<br>Senha temporaria: ".$password."<br>Por favor troque sua senha no painel de controle ".base_url().".";
        $subject = "Password Reset";
        $this->send_email($message,$subject,$email);

        $module = "Gerenciamento de usuarios";
        $activity = "reset user ".$email."`s password";
        $this->insert_log($activity, $module);
        return array('status' => 'success', 'message' => '');

    }

    function generate_password(){
        $chars = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKMNOPQRSTUVWXYZ023456789!@#$%^&*()_=";
        $password = substr( str_shuffle( $chars ), 0, 10 );

        return $password;
    }

    function insert_log($activity, $module){
        $id = $this->session->userdata('user_id');

        $data = array(
            'fk_user_id' => $id,
            'activity' => $activity,
            'module' => $module,
            'created_at' => date('Y\-m\-d\ H:i:s A')
        );
        $this->db->insert('log_atv', $data);
    }

    function get_log_atv(){
       /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        
        $aColumns = array('date_time', 'activity', 'email', 'module');
        $aColumnsWhere = array('log_atv.created_at', 'activity', 'email', 'module');
        $aColumnsJoin = array('log_atv.created_at as date_time', 'activity', 'email', 'module');

        // DB table to use
        $sTable = 'log_atv';
    
        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                    
                }
            }
        }
        
        /* 
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                
                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumnsWhere[$i], $this->db->escape_like_str($sSearch));

                }
            }
        }
        
        // Select Data
        $this->db->join('usuario', 'log_atv.fk_user_id = usuario.user_id', 'left');
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumnsJoin)), false);
        $rResult = $this->db->get($sTable);
    
        // Data set length after filtering
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
        // Total data set length
        $iTotal = $this->db->count_all($sTable);
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
            
            foreach($aColumns as $col)
            {
                if($col == 'date_time') $aRow[$col] = preg_replace('/\s/','<br />',$aRow[$col]);
                $row[] = $aRow[$col];
            }
    
            $output['aaData'][] = $row;
        }
    
        return $output;
    }


    function send_email($message,$subject,$sendTo){
        require_once APPPATH.'libraries/mailer/class.phpmailer.php';
        require_once APPPATH.'libraries/mailer/class.smtp.php';
        require_once APPPATH.'libraries/mailer/mailer_config.php';
        include APPPATH.'libraries/mailer/template/template.php';
        
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        try
        {
            $mail->SMTPDebug = 1;  
            $mail->SMTPAuth = true; 
            $mail->SMTPSecure = 'ssl'; 
            $mail->Host = HOST;
            $mail->Port = PORT;  
            $mail->Username = GUSER;  
            $mail->Password = GPWD;     
            $mail->SetFrom(GUSER, 'Sistema luckadmin');
            $mail->Subject = "Não responda - ".$subject;
            $mail->IsHTML(true);   
            $mail->WordWrap = 0;


            $hello = '<h1 style="color:#333;font-family:Helvetica,Arial,sans-serif;font-weight:300;padding:0;margin:10px 0 25px;text-align:center;line-height:1;word-break:normal;font-size:38px;letter-spacing:-1px">Ola! , &#9786;</h1>';
            $thanks = "<br><br><i>Este e-mail foi gerado automaticamente pelo LuckAdmin System</i><br/><br/>Obrigado,<br/>Admin<br/><br/>";

            $body = $hello.$message.$thanks;
            $mail->Body = $header.$body.$footer;
            $mail->AddAddress($sendTo);

            if(!$mail->Send()) {
                $error = 'Mail error: '.$mail->ErrorInfo;
                return array('status' => false, 'message' => $error);
            } else { 
                return array('status' => true, 'message' => '');
            }
        }
        catch (phpmailerException $e)
        {
            $error = 'Mail error: '.$e->errorMessage();
            return array('status' => false, 'message' => $error);
        }
        catch (Exception $e)
        {
            $error = 'Mail error: '.$e->getMessage();
            return array('status' => false, 'message' => $error);
        }
        
    }

}

/* End of file */
