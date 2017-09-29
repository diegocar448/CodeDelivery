<?php

namespace CodeDelivery\Http\Middleware;

use Closure;
use CodeDelivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class OAuthCheckRole
{

    private $userRepository;

    //usamos o construtor para ter acesso ao userRepository.php
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    
    public function handle($request, Closure $next, $role) //aqui adicionamos um parametro para o middleware
    {
        $id = Authorizer::getResourceOwnerId(); //pega o id do usuario autenticado     
        $user =  $this->userRepository->find($id); //pegar usuario autenticado e verificar a role dele

        if ($user->role != $role) { //olha se a role do usuario é a que a gente precisa
            abort(403, 'Acess Forbidden');
        }
        return $next($request);
    }
}
