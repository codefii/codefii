<?php
/**
 * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
namespace Codefii\Session;
class Session
{
  /**
   * Object to hold session variables.
   *
   * @var object
   */
  protected $session;
  protected $sessionKey;
  /**
   * An unique ID for the session.
   *
   * @var string
   */
  protected $sessionId;
  /**
   * Initialize session object.
   *
   * @param string $sessionId
   */
  public function __construct($sessionId = null)
  {
    if (!session_id()) {
      session_start();
    }
    $this->sessionId = ($sessionId) ? $sessionId : md5($_SERVER['HTTP_HOST'] . '_session');
    if (isset($_SESSION[$this->sessionId]) && ($this->session = json_decode($_SESSION[$this->sessionId], true)) === null) {
      return;
    }
    if (!isset($_SESSION[$this->sessionId])) {
      $_SESSION[$this->sessionId] = json_encode([]);
    }
    $this->session = json_decode($_SESSION[$this->sessionId], true);
  }
  /**
   * Retrieve a session value by key.
   *
   * @param string $key
   */
  public function get($key)
  {
    return (isset($this->session[$key])) ? $this->session[$key] : null;
  }
  /**
   * Set a session variable by key and value.
   *
   * @param string $key
   * @param string $value
   */
  public function set($key, $value = null)
  {
    $this->session[$key] = $value;
    $this->sessionKey = $key;
    if ($value === null) {
      unset($this->session[$key]);
    }
    $_SESSION[$this->sessionId] = json_encode($this->session);
  }
  public function exists($key)
  {
    foreach($this->session as $sKey=>$sValue){
      if($sKey==$key){
        return true;
      }
    }
  }
  /**
   * Destroy the entire session variables.
   */
  public function destroy()
  {
    unset($_SESSION[$this->sessionId]);
    $this->session = null;
  }
  public function delete($sessionName){
    if($this->exists($sessionName)){
      unset($_SESSION[$sessionName]);
    }
  }
  public function isActive(){
    if(session_status() ===PHP_SESSION_ACTIVE){
      return true;
    }
  }
}
