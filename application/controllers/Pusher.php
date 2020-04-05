<?php
class Pusher extends MY_Controller{

    function __construct(){
        parent::__construct();
    }
    public function index()
    {
        $this->load->view('vendor/autoload.php');

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '101d71ba1f48fc65f0f8',
            '8113aca0a3241eecbdaa',
            '814743',
            $options
        );
        $param = $this->input->post('data');
        $data['message'] = $this->input->post('value');
        switch ($param) {
            case 'client':
                $pusher->trigger('chat_client', 'my-event', $data);
                break;
            case 'admin':
                $pusher->trigger('chat_admin', 'my-event', $data);
                break;
            default:
                $data['ip'] = $this->input->ip_address();
                $data['open_chat'] = $this->input->post('data');
                $pusher->trigger('ci_load', 'my-event', $data);
                break;
        }
    }
}
?>