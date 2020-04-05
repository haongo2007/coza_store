<?php 

class Google {
	protected $CI;
	public function __construct(){
		$this->CI =& get_instance();

		$this->CI->load->library('google/autoload');
        $this->CI->config->load('google');
        $this->client = new Google_Client();
		$this->client->setClientId($this->CI->config->item('google_client_id'));
		$this->client->setClientSecret($this->CI->config->item('google_client_secret'));
		$this->client->setRedirectUri($this->CI->config->item('google_redirect_url'));
		$this->client->setScopes(array(
			"https://www.googleapis.com/auth/plus.login",
			"https://www.googleapis.com/auth/plus.me",
			"https://www.googleapis.com/auth/userinfo.email",
			"https://www.googleapis.com/auth/userinfo.profile",
			"https://www.googleapis.com/auth/contacts.readonly",
			"https://www.googleapis.com/auth/user.birthday.read",
			"https://www.googleapis.com/auth/user.addresses.read",
			"https://www.googleapis.com/auth/user.phonenumbers.read"
			)
		);



	}

	public function login_url(){
		return  $this->client->createAuthUrl();

	}
	public function logout_url(){
		$this->client->revokeToken();

	}

	public function validate(){
		if (isset($_GET['code'])) {
		  $this->client->authenticate($_GET['code']);
		  $_SESSION['access_token'] = $this->client->getAccessToken();
		}
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			$this->client->setAccessToken($_SESSION['access_token']);
			$plus = new Google_Service_Plus($this->client);
			$person = $plus->people->get('me');

			/*$people_service = new Google_Service_PeopleService($this->client);
			$optParams = array(
			  'personFields' => 'birthdays,phoneNumbers,addresses',
			);
			$results = $people_service->people->get('people/me', $optParams);
			pre($results);*/
			$info['id'] = $person['id'];
			$info['email'] = $person['emails'][0]['value'];
			$info['name'] = $person['displayName'];
			$info['link'] = $person['url'];
			$info['profile_pic'] = str_replace("=s50", "=s300", $person['image']['url']);
		   return  $info;
		}


	}

}