<?php
namespace Codefii\Mail;
class Mailer {
	// smtp host
	public $host;
	// smtp port
	public $port;
	// smtp username
	public $user;
	// smtp password
	public $pass;
	// security mode (ssl or tls)
	public $security;
	// mail subject
	public $subject;
	// message content
	public $message;
	// mail content type
	public $type = 'text/html';
	// mail encoding
	public $encoding = 'UTF-8';
	// error message
	public $error;
	// print results
	public $debug = false;
	// mail from
	private $from;
	// recipient(s)
	private $to = array();
	/**
	 * set sender
	 * @param  string $address email address
	 * @param  string $name    sender name
	 * @return void
	 */
	public function from(String $address, String $name = null) {
		if (empty($name))
			$this->from = '<' . $address . '>';
		else
			$this->from = '"' . $name . '" <' . $address . '>';
	}
	/**
	 * set recipients
	 * @param  string $address email address
	 * @param  string $name    sender name
	 * @return void
	 */
	public function to(String $address, String $name = null) {
		if (empty($name))
			$this->to[] = '<' . $address . '>';
		else
			$this->to[] = '"' . $name . '" <' . $address . '>';
	}
	/**
	 * send mail
	 * @return boolean
	 */
	public function send() {
		$host = $this->host;
		if ($this->security == 'ssl')
			$host = 'ssl://' . $host;
		$socket = fsockopen($host, $this->port, $errno, $errstr);
		if ($socket === false) {
			$this->error = $errno . ' ' . $errstr;
			return false;
		} else if ($this->parse_result($socket, 220) === false)
			return false;
		$commands = array(
			'EHLO ' . $this->host => 250
		);
		if ($this->security == 'tls')
			$commands = array_merge($commands, array(
				'STARTTLS' => 220,
				'EHLO  ' . $this->host => 250
			));
		$commands = array_merge($commands, array(
			'AUTH LOGIN' => 334,
			base64_encode($this->user) => 334,
			base64_encode($this->pass) => 235,
			'MAIL FROM: ' . strstr($this->from, '<') => 250,
		));
		foreach ($this->to as $to)
			$commands['RCPT TO: ' . strstr($to, '<')] = 250;
		$commands = array_merge($commands, array(
			'DATA' => 354,
			'Subject: ' . $this->subject . "\r\n" .
				'To: ' . implode(', ', $this->to) . "\r\n" .
				'From: ' . $this->from . "\r\n" .
				'Content-Type: ' . $this->type . "\r\n" .
				'Content-Encoding: ' . $this->encoding . "\r\n\r\n" .
				$this->message => -1,
			'.' => 250,
			'QUIT' => 0
		));
		foreach ($commands as $command => $code) {
			fwrite($socket, $command . "\r\n");
			if ($code > -1 && $this->parse_result($socket, $code) === false) {
				$this->error .= ' (' . $command . ')';
				return false;
			}
			if ($command == 'STARTTLS' && stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT) === false) {
				$this->error .= 'Unable to start TLS encryption. (' . $command . ')';
				return false;
			}
		}
		fclose($socket);
		return true;
	}
	/**
	 * parse request result and check result with expected code
	 * @param  resource $socket connection
	 * @param  integer  $code   expected code
	 * @return boolean
	 */
	private function parse_result($socket, $code) {
		$result = '';
		while (substr($result, 3, 1) != ' ')
			$result = fgets($socket, 256);
		if ($this->debug === true)
			echo $result . '<br>' . "\n";
		if (empty($code) || substr($result, 0, 3) == $code)
			return true;
		$this->error = $result;
		return false;
	}
}
