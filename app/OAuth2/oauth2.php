<?php 

namespace CodeDelivery\OAuth2;

class PasswordGrantVerifier
{
	public function verify($username, $password)
    {
    	$credentials = [
	        'email'    => $username,
	        'password' => $password,
        ];

      	if (Auth::once($credentials)) {
        	return Auth::user()->id;
      	}

      	return false;
    }
}