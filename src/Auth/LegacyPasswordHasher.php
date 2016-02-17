<?
namespace App\Auth;

use Cake\Auth\AbstractPasswordHasher;

class LegacyPasswordHasher extends AbstractPasswordHasher
{

    public function hash($password)
    {
        //return 'teste'.$password;
    }

    public function check($password, $hashedPassword)
    {
        return 'teste'.$password === $hashedPassword;
    }
}