<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ilias
 * Date: 26/11/2015
 * Time: 19:47
 */

namespace Auth\Utility;


class UserPassword
{
    public $salt = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXX';

    public $method = 'sha1';

    /**
     * Constructor
     *
     * @author Arvind Singh
     * @access public
     *
     * @param string $method
     *            // Encryption method
     */
    public function __construct($method = null)
    {
        if (! is_null($method)) {
            $this->method = $method;
        }
    }

    /**
     * Create Password
     *
     * @author Arvind Singh
     * @access public
     *
     * @param string $password
     *            User Password
     * @return string
     */
    public function create($password)
    {
        if ($this->method == 'md5') {
            return md5($this->salt . $password);
        } elseif ($this->method == 'sha1') {
            return sha1($this->salt . $password);
        } elseif ($this->method == 'bcrypt') {
            $bcrypt = new Bcrypt();
            $bcrypt->setCost(14);
            return $bcrypt->create($password);
        }
    }

    /**
     * Validate the user password
     *
     * @author Arvind Singh
     * @access public
     *
     * @param string $password
     *            // Password string
     *
     * @param string $hash
     *            // Hash string
     *
     * @return boolean
     */
    public function verify($password, $hash)
    {
        if ($this->method == 'md5') {
            return $hash == md5($this->salt . $password);
        } elseif ($this->method == 'sha1') {
            return $hash == sha1($this->salt . $password);
        } elseif ($this->method == 'bcrypt') {
            $bcrypt = new Bcrypt();
            $bcrypt->setCost(14);
            return $bcrypt->verify($password, $hash);
        }
    }
}