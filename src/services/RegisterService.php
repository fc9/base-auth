<?php

namespace Fc9\Auth\Services;

use Fc9\Auth\Repositories\RegisterRepository;
//use Fc9\Net\Repositories\RegisterRepository;

class RegisterService
{
    public function register(array $data)
    {
//        $account = auth()->getCurrentUser();
//        $account->checkPermission('users.create');

        $user = RegisterRepository::register($data);

        //$node = $this->networkRepository->create($user);
        //$costumer = $this->bankRepository->create($user);

        //dispatch(new \Fc9\Auth\Events\RegistrationDone($user));

        return $user;
    }

}