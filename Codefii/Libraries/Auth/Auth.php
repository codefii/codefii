<?php
/**
  * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
namespace Codefii\Libraries\Auth;
use Network\Session\Session;
use Codefii\Database\Config\Config;
use Network\Model\Model;
use Network\Hasher\Hasher;
class Auth
{
  private $_db;
  public function __construct()
  {
    $this->_db = Model::getDb();
  }
  //create a new user
  public function create($table,$fields = array())
  {
    if(!$this->_db->create($table,$fields))
    {
      throw new Exception('there was a problem creating an account');
    }
  }


}
