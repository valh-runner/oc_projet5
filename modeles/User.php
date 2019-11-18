<?php
/**
 * User entity specification
 */
class User
{
    /**
     * @var int
     */
    private $idUser;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $passwordHash;
    /**
     * @var string
     */
    private $registerDate;
    /**
     * @var bool
     */
    private $adminGranted;
    
    /**
     * Constructor
     * @param array $datas
     */
    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }
    
    /**
     * Getters
     */

    public function idUser()
    {
        return $this->idUser;
    }
    public function username()
    {
        return $this->username;
    }
    public function email()
    {
        return $this->email;
    }
    public function passwordHash()
    {
        return $this->passwordHash;
    }
    public function registerDate()
    {
        return $this->registerDate;
    }
    public function adminGranted()
    {
        return $this->adminGranted;
    }

    /**
     * Setters
     */
    
    public function setIdUser($id)
    {
        $this->idUser = $id;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPasswordHash($passwordHash)
    {
        $this->passwordHash = $passwordHash;
    }
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;
    }
    public function setAdminGranted($adminGranted)
    {
        $this->adminGranted = $adminGranted;
    }
    
    /**
     * Fill each attribute of the entity with datas
     * @param array $datas
     */
    public function hydrate(array $datas)
    {
        foreach ($datas as $fieldName => $data) {
            $fieldNameParts = explode('_', $fieldName);
            $methodName = 'set';
            foreach ($fieldNameParts as $fieldNamePart) {
                $methodName .= ucfirst($fieldNamePart);
            }
            if (method_exists($this, $methodName)) {
                $this->$methodName($data);
            }
        }
    }
}
