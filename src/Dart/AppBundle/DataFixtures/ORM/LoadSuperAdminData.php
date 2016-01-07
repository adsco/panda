<?php

namespace Dart\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Application\Sonata\UserBundle\Entity\User;

/**
 * Super admin loader
 *
 * @package \Dart\AppBundle
 * @subpackage DataFixtures\ORM
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class LoadSuperAdminData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        
        $user->setEmail('adsads@email.com');
        $user->setEnabled(true);
        $user->setPassword('RWC25wnHcmFOzZMyvUPoC77seli2Qm98DQa4ihtnxNmha7oAmpr7qJ0FlfKwPBVbd5yiCTnrt7rK/rlsNfxJ0w==');
        $user->setUsername('admin');
        $user->addRole('ROLE_SUPER_ADMIN');
        
        $this->setSalt($user, '3cp8ass1k6ck0k8c8s4s0o4oso8w4o0');
        
        $manager->persist($user);
        $manager->flush();
    }
    
    private function setSalt(User $user, $salt)
    {
        $refClass = new \ReflectionClass($user);
        $property = $refClass->getProperty('salt');
        $property->setAccessible(true);
        $property->setValue($user, $salt);
    }
}
