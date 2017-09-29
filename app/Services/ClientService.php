<?php

namespace CodeDelivery\Services;

use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\UserRepository;

class ClientService
{
	private $clientRepository;

	private $userRepository;


	//usamos o client e o user repository caso precise alterar qualquer informação nas tabelas users e clients
	public function __construct(ClientRepository $clientRepository, UserRepository $userRepository)
	{
		$this->clientRepository = $clientRepository;
		$this->userRepository = $userRepository;
	}

	//faz as alterações no formulario
	public function update(array $data, $id)
	{
		$this->clientRepository->update($data, $id);

		//passando o id da tab client e pegar o user_id  //com isso ja temos o nosso user_id
		$userId = $this->clientRepository->find($id, ['user_id'])->user_id;
		
		$this->userRepository->update($data['user'], $userId);		
	}


	public function create(array $data)
	{
		//atribui a senha a formulario
		$data['user']['password'] = bcrypt(123456);

		//criar 1 novo user
		$user = $this->userRepository->create($data['user']);			

		//vai adicionar o user_id ao array principal
		$data['user_id'] = $user->id;

		//vamos criar um registro
		$this->clientRepository->create($data);	
		
	}
}