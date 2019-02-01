<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: redis.proto

namespace Neptune;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>neptune.DoRegistRequest</code>
 */
class DoRegistRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string Address = 1;</code>
     */
    private $Address = '';
    /**
     * Generated from protobuf field <code>string Auth = 2;</code>
     */
    private $Auth = '';
    /**
     * Generated from protobuf field <code>uint32 InitialCap = 3;</code>
     */
    private $InitialCap = 0;
    /**
     * Generated from protobuf field <code>uint32 MaxCap = 4;</code>
     */
    private $MaxCap = 0;
    /**
     * Generated from protobuf field <code>sint64 IdleTimeout = 5;</code>
     */
    private $IdleTimeout = 0;
    /**
     * Generated from protobuf field <code>uint32 DBNum = 6;</code>
     */
    private $DBNum = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $Address
     *     @type string $Auth
     *     @type int $InitialCap
     *     @type int $MaxCap
     *     @type int|string $IdleTimeout
     *     @type int $DBNum
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Redis::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string Address = 1;</code>
     * @return string
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * Generated from protobuf field <code>string Address = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setAddress($var)
    {
        GPBUtil::checkString($var, True);
        $this->Address = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Auth = 2;</code>
     * @return string
     */
    public function getAuth()
    {
        return $this->Auth;
    }

    /**
     * Generated from protobuf field <code>string Auth = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setAuth($var)
    {
        GPBUtil::checkString($var, True);
        $this->Auth = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint32 InitialCap = 3;</code>
     * @return int
     */
    public function getInitialCap()
    {
        return $this->InitialCap;
    }

    /**
     * Generated from protobuf field <code>uint32 InitialCap = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setInitialCap($var)
    {
        GPBUtil::checkUint32($var);
        $this->InitialCap = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint32 MaxCap = 4;</code>
     * @return int
     */
    public function getMaxCap()
    {
        return $this->MaxCap;
    }

    /**
     * Generated from protobuf field <code>uint32 MaxCap = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setMaxCap($var)
    {
        GPBUtil::checkUint32($var);
        $this->MaxCap = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>sint64 IdleTimeout = 5;</code>
     * @return int|string
     */
    public function getIdleTimeout()
    {
        return $this->IdleTimeout;
    }

    /**
     * Generated from protobuf field <code>sint64 IdleTimeout = 5;</code>
     * @param int|string $var
     * @return $this
     */
    public function setIdleTimeout($var)
    {
        GPBUtil::checkInt64($var);
        $this->IdleTimeout = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint32 DBNum = 6;</code>
     * @return int
     */
    public function getDBNum()
    {
        return $this->DBNum;
    }

    /**
     * Generated from protobuf field <code>uint32 DBNum = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setDBNum($var)
    {
        GPBUtil::checkUint32($var);
        $this->DBNum = $var;

        return $this;
    }

}

