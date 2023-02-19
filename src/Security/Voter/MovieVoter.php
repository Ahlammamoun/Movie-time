<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class MovieVoter extends Voter
{
    public const EDIT = 'POST_EDIT';
    public const VIEW = 'POST_VIEW';

    protected function supports(string $attribute, $subject): bool
    {
       // $attribute récupère la valeur UPDATE_THE_MOVIE du controller 
       // du coup si tu veuw voter

        if($attribute === "UPDATE_THE_MOVIE")
        {
            return true;
        }else{
            return false;
        }


    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // $subject contient l'objet movie
        if($subject->getTitle() === 'shrek' && $user->getUSerIdentifer() !== 'manager@managercom')
        {
            return false;
        }

        return true;
    }
}
